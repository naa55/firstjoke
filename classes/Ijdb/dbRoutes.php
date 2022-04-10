<?php

namespace Ijdb;

class dbRoutes implements \Ninja\Routes {
    private $authorsTable;
    private $jokesTable;
    private $categoriesTable;
    private $authentication;
    private $jokesCategoriesTable;
    private $personalProfileTable;
    private $profileTable;
    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';
        // $this->jokesTable = new \Ninja\DatabaseTable($pdo, 'jokes', 'id');
        // $this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
        $this->jokesTable = new \Ninja\DatabaseTable($pdo,'jokes', 'id', '\Ijdb\Entity\Joke',
[&$this->authorsTable, &$this->jokesCategoriesTable, &$this->profileTable]);
        $this->authorsTable = new \Ninja\DatabaseTable($pdo,'author', 'id', '\Ijdb\Entity\Author',
[&$this->jokesTable, &$this->userPermissionsTable]);
        $this->categoriesTable = new \Ninja\DatabaseTable($pdo,'category','id', '\Ijdb\Entity\Category', [&$this->jokesTable, &$this->jokesCategoriesTable]);
        // $this->personalProfileTable = new \Ninja\DatabaseTable($pdo, 'profile', 'id', '\Ijdb\Entity\Profile', [&$this->jokesTable, &$this->profileTable]);
        // $this->categoriesTable = new \Ninja\DatabaseTable($pdo,'category','id');
        $this->jokesCategoriesTable = new \Ninja\DatabaseTable($pdo, 'categorys_table', 'catId');
        $this->userPermissionsTable = new \Ninja\DatabaseTable($pdo, 'user_permission', 'authorId');
        $this->favjokeTable = new \Ninja\DatabaseTable($pdo, 'favjoke', 'id');
        $this->profileTable = new \Ninja\DatabaseTable($pdo, 'profile', 'id');
        $this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
    }

    public function getRoutes() : array {
      
        $jokeController = new \Ijdb\Controllers\Joke($this->jokesTable, $this->authorsTable, $this->favjokeTable, $this->profileTable, $this->categoriesTable, $this->authentication, $this->jokesCategoriesTable);
        $authorController = new \Ijdb\Controllers\Register($this->authorsTable);
        $loginController = new \Ijdb\Controllers\Login($this->authentication);
        $categoryController = new \Ijdb\Controllers\Category($this->categoriesTable);
        $profileController = new \Ijdb\Controllers\Profile($this->profileTable, $this->authentication, $this->authorsTable, $this->jokesTable);
        $routes = [
            'author/register'=>[
                'GET' => [
                    'controller' =>$authorController,
                    'action' => 'registrationForm'
                ],
                'POST' => [
                    'controller' =>$authorController,
                    'action' => 'registerUser'
                ],
            ],
            'login'=> [
                'GET'=> [
                    'controller' => $loginController,
                    'action'=> 'loginForm'
                ],
                'POST' => [
                    'controller'=> $loginController,
                    'action'=> 'processLogin'
                ]
                ],
            'login/success'=>[
                'GET'=>[
                    'controller'=> $loginController,
                    'action'=> 'success'
                ]
                ],
            'login/error' => [
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'error'
                ]
                ],
                'logout' => [
                    'GET' => [
                        'controller'=> $loginController,
                        'action' => 'logout'
                    ],
                    ],
            'access/error'=>[
                    'GET'=>[
                        'controller'=>$loginController,
                        'action'=>'access'
                    ]
                    ],
            'author/success'=>[
                'GET' => [
                    'controller' =>$authorController,
                    'action' => 'success'
                ],
            ],
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ],
                'login'=>true
                ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ],
            'login'=>true
        ],
            'joke/list' => [
            'GET' => [
            'controller' => $jokeController,
            'action' => 'list'
        ]
        ],
            '' => [
            'GET' => [
            'controller' => $jokeController,
            'action' => 'home'
            ]
            ],
            'joke/favoriate'=>[
                'POST'=> [
                    'controller' => $jokeController,
                    'action' => 'favJoke'
                ]
                ],
            'joke/favlist'=>[
                'GET'=>[
                    'controller'=> $jokeController,
                    'action'=> 'favList'
                ]
                ],
            'category/edit'=>[
                'POST'=>[
                    'controller'=>$categoryController,
                    'action'=>'saveEdit'
                ],
                'GET'=>[
                    'controller'=>$categoryController,
                    'action'=>'edit'
                ],
                'login'=>true,
                'permissions'=> \Ijdb\Entity\Author::EDIT_CATEGORIES
            ],
            'category/list'=>[
                'GET'=>[
                    'controller'=>$categoryController,
                    'action'=>'list'
                ],
                'login'=>true,
                'permissions'=> \Ijdb\Entity\Author::LIST_CATEGORIES
            ],
            'category/delete'=>[
                'POST'=>[
                    'controller'=>$categoryController,
                    'action'=>'delete'
                ],
                'login'=>true,
                'permissions' => \Ijdb\Entity\Author::REMOVE_CATEGORIES
            ],
        'author/permissions' =>[
            'GET'=>[
                'controller'=>$authorController,
                'action'=> 'permissions'
            ],
            'POST'=> [
                'controller'=>$authorController,
                'action'=> 'savePermissions'
            ],
            'login'=>true,
            'permissions'=>\Ijdb\Entity\Author::EDIT_USER_ACCESS
        ],
        'author/list'=>[
            'GET'=>[
                'controller'=> $authorController,
                'action'=>'list'
            ],
            'login'=>true,
            'permissions'=>\Ijdb\Entity\Author::EDIT_USER_ACCESS
        ],
        'profile/user'=>[
            'GET'=>[
                'controller'=> $profileController,
                'action'=>'list'
            ],
            // 'login'=>false
        ],
        'profile/edit'=>[
            'GET'=>[
                'controller'=>$profileController,
                'action'=>'edit'
            ],
            'POST'=>[
                'controller'=>$profileController,
                'action'=>'saveEdit'
            ],
           
            'login'=>true
        ],
        'profile/delete'=>[
            'POST'=>[
                'controller'=>$profileController,
                'action'=>'delete'
            ],
            'login'=>true
        ]
];

            return $routes;
   
}

public function getAuthentication() :\Ninja\Authentication {
    return $this->authentication;
}

public function checkPermission($permission) :bool {
    $user = $this->authentication->getUser();
    if($user && $user->hasPermission($permission)) {
        return true;
    } else {
        return false;
    }
}
}
      
       
    
        