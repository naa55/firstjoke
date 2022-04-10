<?php

namespace Ijdb\Controllers;

class Login {

    private $authentication;

    public function __construct(\Ninja\Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function processLogin() {
        if($this->authentication->login($_POST['email'], $_POST['password'])) {
            header('location: /login/success');
        } else {
            return ['template' => 'login.html.php',
            'title' => 'Log In','variables' => [
            'error' => 'Invalid username/password.'
            ]
            ];
        }
    }

    public function success() {
        return ['template' => 'loginsuccess.html.php',
        'title' => 'Login Successful'];
    }

    public function loginForm() {
        return ['template' => 'login.html.php',
            'title' => 'Log In'];
    }
    public function error() {
        return ['template' => 'loginerror.html.php', 'title'
        => 'You are not logged in'];
    }

    public function access() {
        return ['template' => 'accesserror.html.php', 'title'
        => 'Access Denialed'];
    }

    public function logout() {
        session_unset();
        return ['template' => 'logout.html.php','title' => 'You have been logged out'];
    }
}