<?php
    namespace Ijdb\Controllers;
    use \Ninja\Authentication;

class Joke {

    private $authorsTable;
    private $jokesTable;
    private $favjokeTable;

    public function __construct(\Ninja\DatabaseTable $jokesTable, \Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $favjokeTable, Authentication $authentication)
    {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
        $this->favjokeTable = $favjokeTable;
        $this->authentication = $authentication;
    }
    public function list() {
        $result = $this->jokesTable->findAll();

        $jokes = [];
        foreach($result as $joke) {
                $author=$this->authorsTable->findById($joke['authorid']);
                $jokes[] = [
                        'id'=>$joke['id'],
                        'joketext'=>$joke['joketext'],
                        'jokedate'=>$joke['jokedate'],
                        'name'=>$author['name'],
                        'email'=>$author['email'],
                        'authorId'=> $author['id']
                ];
        }
       

        $title = 'Joke list';
            $totalJokes = $this->jokesTable->total();
            $author = $this->authentication->getUser();
        return ['template' => 'jokes.html.php', 'title' => $title, 'variables'=>['totalJokes'=> $totalJokes, 'jokes'=>$jokes, 'userId'=>$author['id'] ?? null]];
    }

    public function home() {
        $title = 'Internet Joke Database';
        
        return ['template' => 'home.html.php', 'title' => $title];
        }

    public function delete() {
        $author = $this->authentication->getUser();
        $joke = $this->jokesTable->findById($_POST['id']);
            if($joke['authorid'] != $author['id']) {
                return;
            }
        $this->jokesTable->delete($_POST['id']);
    
        header('location:index.php?route=joke/list');
        
    }

    public function author() {
        $result = $this->authorsTable->findAll();
        $authors = [];
        foreach($result as $author) {
            $authors[]=[
                'id'=>$author['id'],
                'name'=> $author['name'],
                'email'=> $author['email']
            ];
        }
        $title = "Authors List";
        ob_start();
        include __DIR__ . '/../templates/authorlist.html.php';
        $output = ob_get_clean();
        return ['output' => $output, 'title' => $title];

    }

    public function saveEdit() {
        $author = $this->authentication->getUser();
        if(isset($_GET['id'])) {
            $joke = $this->jokesTable->findById($_GET['id']);
            if($joke['authorid'] != $author['id']) {
                return;
            }
        }
            $joke = $_POST['joke'];
            $joke['jokedate'] = new \DateTime();
            $joke['authorid'] = $author['id'];
            $this->jokesTable->save($joke);
            header('location: index.php?route=joke/list');
            
    }

    public function edit() {
            $author = $this->authentication->getUser();
            if (isset($_POST['id'])) {
                $joke = $this->jokesTable->findById($_POST['id']);
            }
            $title = 'Edit joke';

   
            return ['template' => 'editjoke.html.php',
            'title' => $title, 'variables'=>['joke'=>$joke ?? null, 'id'=>$_POST['id'], 'userId'=>$author['id'] ?? null]];
        
    } 

   public function favList() {
    $result = $this->favjokeTable->findAll();
    $user = $this->authentication->getUser();
    $favlist = [];
    foreach($result as $fav) {
        if($fav['authorid'] == $user['id']) {
                $favlist[]=[
                    'joketext'=>$fav['joketext']
                ];
        }
    }
        $title = "Favoriate List";
        return ['template' => 'favlist.html.php','title' => $title, 'variables'=>['favlist'=>$favlist]];
    }

    public function favJoke() {
        $favoriate = $this->jokesTable->findById($_POST['id']);
        $author=$this->authorsTable->findById($favoriate['authorid']);
        $user = $this->authentication->getUser();
        $fav = [
            'id'=>$author['id'],
            'joketext'=>$favoriate['joketext'],
            'authorid'=>$user['id']
        ];
        var_dump($fav);
        $this->favjokeTable->save($fav);
        // header('location: index.php?route=joke/list');
    }
}