<?php
    namespace Ijdb\Controllers;
    use \Ninja\Authentication;

class Joke {

    private $authorsTable;
    private $jokesTable;
    private $favjokeTable;
    private $categoriesTable;
    private $profileTable;
    private $jokesCategoriesTable;

    public function __construct(\Ninja\DatabaseTable $jokesTable, \Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $favjokeTable, \Ninja\DatabaseTable $profileTable, \Ninja\DatabaseTable $categoriesTable, Authentication $authentication, \Ninja\DatabaseTable $jokesCategoriesTable)
    {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
        $this->favjokeTable = $favjokeTable;
        $this->categoriesTable = $categoriesTable;
        $this->authentication = $authentication;
        $this->profileTable = $profileTable;
        $this->jokesCategoriesTable = $jokesCategoriesTable;
    }
    public function list() {
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * 5;
        if (isset($_GET['category'])) {
            $category = $this->categoriesTable->findById($_GET['category']);
            $jokes = $category->getJokes(5, $offset);
            $totalJokes = $category->getNumJokes();
        
        }else {
            $jokes = $this->jokesTable->findAll('jokedate DESC', 5, $offset);
            $totalJokes = $this->jokesTable->total();
        }
        // $jokes = $this->jokesTable->findAll();

        // $jokes = [];
        // foreach($result as $joke) {
        //         $author=$this->authorsTable->findById($joke->authorid);
        //         $jokes[] = [
        //                 'id'=>$joke->id,
        //                 'joketext'=>$joke->joketext,
        //                 'jokedate'=>$joke->jokedate,
        //                 'name'=>$author->name,
        //                 'email'=>$author->email,
        //                 'authorId'=> $author->id
        //         ];
        // }
            // $catIds = $this->jokesCategoriesTable->findAll();
                // $catId = $_GET['category'];
            
            
        $title = 'Joke list';

            $totalJokes = $this->jokesTable->total();
            $author = $this->authentication->getUser();
        return ['template' => 'jokes.html.php', 'title' => $title, 
        'variables'=>['totalJokes'=> $totalJokes, 'jokes'=>$jokes, 
        'userId'=>$author->id ?? null, 'categories'=>$this->categoriesTable->findAll(), 
        'currentPage'=>$page, 'category' => $_GET['category'] ?? null]];
    }

    public function home() {
        $title = 'Internet Joke Database';
        
        return ['template' => 'home.html.php', 'title' => $title];
        }

    public function delete() {
        $author = $this->authentication->getUser();
        $joke = $this->jokesTable->findById($_POST['id']);
            if($joke->authorid != $author->id) {
                return;
            }
        $this->jokesTable->delete($_POST['id']);
     
        header('location:/joke/list');
        
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

    // public function saveEdit() {
    //     $author = $this->authentication->getUser();
    //     if(isset($_GET['id'])) {
    //         $joke = $this->jokesTable->findById($_GET['id']);
    //         if($joke['authorid'] != $author['id']) {
    //             return;
    //         }
    //     }
    //         $joke = $_POST['joke'];
    //         $joke['jokedate'] = new \DateTime();
    //         $joke['authorid'] = $author['id'];
    //         $this->jokesTable->save($joke);
    //         header('location: index.php?route=joke/list');
            
    // }
    public function saveEdit() {
        $author = $this->authentication->getUser();
        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();
        $jokeEntity = $author->addJoke($joke);
        $jokeEntity->clearCategories();
        
        foreach ($_POST['category'] as $categoryId) {
            $jokeEntity->addCategory($categoryId);
        }
        // $author = $this->authentication->getUser();
        // $joke = $_POST['joke'];
        // $joke['jokedate'] = new \DateTime();

        // $jokeEntity = $author->addJoke($joke);
        // foreach($_POST['category'] as $categoryId) {
        //     $jokeEntity->addCategory($categoryId);
            
        // }
        header('location: /joke/list');

    }

    public function edit() {
            $author = $this->authentication->getUser();
            $categories = $this->categoriesTable->findAll();
            if (isset($_GET['id'])) {
                $joke = $this->jokesTable->findById($_GET['id']);
            }
            $title = 'Edit joke';
            return ['template' => 'editjoke.html.php',
            'title' => $title, 'variables'=>['joke'=>$joke ?? null, 'userId'=>$author->id ?? null, 'categories'=>$categories]];
        
    } 

   public function favList() {
    $result = $this->favjokeTable->findAll();
    $user = $this->authentication->getUser();
    $favlist = [];
    foreach($result as $fav) {
        if($fav->authorid == $user->id) {
                $favlist[]=[
                    'joketext'=>$fav->joketext
                ];
        }
    }
        $title = "Favoriate List";
        return ['template' => 'favlist.html.php','title' => $title, 'variables'=>['favlist'=>$favlist]];
    }

    public function favJoke() {
        $favoriate = $this->jokesTable->findById($_POST['id']);
        $author=$this->authorsTable->findById($favoriate->authorid);
        $user = $this->authentication->getUser();
        $fav = [
            'id'=>$author->id,
            'joketext'=>$favoriate->joketext,
            'authorid'=>$user->id
        ];
        var_dump($fav);
        $this->favjokeTable->save($fav);
        // header('location: index.php?route=joke/list');
    }

  


    // public function profileSaveEdit() {
    //     $user = $this->authentication->getUser();
    //     $profile = $_POST['profile'];

        
    //     $personal = ['bio'=>$profile['bio'], 'hobbie'=>$profile['hobbie'],'authorid'=> $user->id];
    //     // var_dump($personal);
    //     $this->profileTable->save($personal);
    //     header('location:/joke/list');

    // }

    // public function profileEdit() {
    //     $author = $this->authentication->getUser();
    //     if(isset($_GET['id'])) {
    //         $profile = $this->profileTable->findById($_GET['id']);
    //     }
    //      $title = 'Edit joke';
    //     return ['template' => 'editprofile.html.php',
    //     'title' => $title, 'variables'=>['profile'=>$profile ?? null]];
    // }

    public function profile() {
        $author = $this->authentication->getUser();
        $profile = $this->profileTable->findById($author->id);
        var_dump($profile);
        $title = 'My Profile';
     
        return ['template' => 'profile.html.php',
        'title' => $title, 'variables'=>['profile'=>$profile ?? null, 'userId'=>$author->id ?? null]];
    }

    public function profileDelete() {
    $this->profileTable->delete($_POST['id']);
        header('location:/profile/my');
    }
}