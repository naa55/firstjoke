<?php

namespace Ijdb\Controllers;
use \Ninja\Authentication;


class Profile {
    private $profileTable;
    private $authentication;
    private $authorsTable;
    private $jokesTable;

    public function __construct(\Ninja\DatabaseTable $profileTable,Authentication $authentication, \Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $jokesTable) 
    {
        $this->profileTable = $profileTable;
        $this->authentication = $authentication;
        $this->authorsTable = $authorsTable;
        $this->jokesTable = $jokesTable;

    }

    public function list() {
        // $profile =$this->authorsTable->findById($_GET['id']);
        $user = $this->authentication->getUser();
        $profile =$this->profileTable->findAll();

        foreach($profile as $person) {
            if($person->authorid == $_GET['id']) {
                $des = $person;
            } 
        }
        $title = 'Profile';
        return ['template'=>'profile.html.php', 'title'=>$title, 'variables'=>['profile'=>$des??null, 'userId'=>$user->id]];

    }

    public function saveEdit() {
        $user = $this->authentication->getUser();
        $profile = $_POST['profile'];
         $profile['authorid'] = $user->id;
        //  var_dump($profile);
        // $person = ['bio'=>$profile['bio'], 'hobbie'=>$profile['hobbie'], 'authorid'=>$user->id];
        $this->profileTable->save($profile);
        header('location: /joke/list');

    }


    public function edit() {
        if(isset($_GET['id'])) {
            $profile = $this->profileTable->findAll();
            $user = $this->authentication->getUser();

            foreach($profile as $person) {
                if($person->authorid == $user->id) {
                    $des = $person;
                }
            }

        }
             $title = 'Edit joke';
                return ['template' => 'editprofile.html.php',
        'title' => $title, 'variables'=>['profile'=>$des ?? null]];

    }
}