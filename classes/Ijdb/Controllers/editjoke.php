<?php
namespace Ijdb\Controllers;

include __DIR__ . "/includes/DatabaseConnection.php";

class Edit {

    private $authorsTable;
    private $jokesTable;

    public function __construct(\Ninja\DatabaseTable $jokesTable, \Ninja\DatabaseTable $authorsTable)
    {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
    }
    public function edit() {
        var_dump($_GET['id']);
        if (isset($_GET['id'])) {
            $joke = $this->jokesTable->findById($_GET['id']);
        }
        $title = 'Edit joke';

        return ['template' => 'editjoke.html.php',
        'title' => $title, 'variables'=>['joke'=>$joke ?? null]];
    
}
}

// try {
//     $jokesTable = new \Ninja\DatabaseTable($pdo, 'jokes', 'id');
//     if (isset($_POST['joke'])) {

//         $joke = $_POST['joke'];
//         $joke['jokedate'] = new \DateTime();
//         $joke['authorid'] = 1;
//         $jokesTable->save($joke);
      

//         header('location: jokes.php');
//         } else {
//             if(isset($_GET['id'])) {
//                 $joke = $jokesTable->findById($_GET['id']);
//             }
//         $title = 'Edit joke';
//         ob_start();
//         include __DIR__ . "/templates/editjoke.html.php";
//         }
// }catch(PDOException $e) {
//     $output = "Unable to connect to server" 
//     . $e->getMessage() . " in " 
//     .$e->getFile()
//     . $e->getLine();
// }

// include __DIR__ . "/templates/layout.html.php";