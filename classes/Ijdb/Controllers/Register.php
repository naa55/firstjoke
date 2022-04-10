<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;
class Register {

    private $authorsTable;
    
    public function __construct(\Ninja\DatabaseTable $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    public function registerUser() {

        $author = $_POST['author'];
        $errors = [];
        $valid = true;
        if(empty($author['name'])) {
            $valid  = false;
            $errors[] = 'Name cannot be blank';
        }

        if(empty($author['email'])) {
            $valid  = false;
            $errors[] = 'Email cannot be blank';
        } elseif (filter_var($author['email'],
        FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = 'Invalid email address';
        } else { 
        $author['email'] = strtolower($author['email']);
        if (count($this->authorsTable->find('email',
            $author['email'])) > 0) {
            $valid = false;
            $errors[] = 'That email address is already
            registered';
            }
        }

        if(empty($author['password'])) {
            $valid  = false;
            $errors[] = 'Password cannot be blank';
        }

        if($valid  == true) {
            $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);
            $this->authorsTable->save($author);
            header('Location: /joke/list');
        } else {
            return ['template' => 'register.html.php',
            'title' => 'Register an account', 'variables'=>['errors'=>$errors, 'author' => $author]];
        }
    }

    public function registrationForm() {
        return ['template' => 'register.html.php',
        'title' => 'Register an account'];
    }

    public function success()
    {
    return ['template' => 'registersuccess.html.php',
    'title' => 'Registration Successful'];
    }

    public function list() {
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * 3;

        $totalAuthors = count($this->authorsTable->findAll('id DESC', 3, $offset));
        

        $authors = $this->authorsTable->findAll('id DESC', 3, $offset);
        return ['template' => 'authorlist.html.php','title' => 'Author List', 'variables' => ['authors' => $authors, 'authTotal'=>$totalAuthors, 'currentPage'=>$page]];
    }

    public function permissions() {
        $author = $this->authorsTable->findById($_GET['id']);
        $reflected = new \ReflectionClass('\Ijdb\Entity\Author');
        $constants = $reflected->getConstants();
        return ['template' => 'permissions.html.php','title' => 'Edit Permissions','variables' => ['author' => $author,'permissions' => $constants]
];
    }

    public function savePermissions() {
        $author = ['id'=>$_GET['id'], 'permissions'=> array_sum($_POST['permissions'] ?? [])];
        // var_dump($author);
        $this->authorsTable->save($author);
        header('Location: /author/list');
    }
    
    
}