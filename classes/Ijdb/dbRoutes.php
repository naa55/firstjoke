<?php

namespace Ijdb;

class dbRoutes implements \Ninja\Routes {
    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';
        $this->jokesTable = new \Ninja\DatabaseTable($pdo, 'jokes', 'id');
        $this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
        $this->favjokeTable = new \Ninja\DatabaseTable($pdo, 'favjoke', 'id');
        $this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
    }

    public function getRoutes() : array {
      
        $jokeController = new \Ijdb\Controllers\Joke($this->jokesTable, $this->authorsTable, $this->favjokeTable,$this->authentication);
        $authorController = new \Ijdb\Controllers\Register($this->authorsTable);
        $loginController = new \Ijdb\Controllers\Login($this->authentication);
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
            'joke/edit/id'=>[
                'POST'=>[
                    'controller' => $jokeController,
                    'action' => 'edit'
                ]
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
            'joke/home' => [
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
            ]
];

            return $routes;
   
}

public function getAuthentication() :\Ninja\Authentication {
    return $this->authentication;
}
}
      
       
    
        