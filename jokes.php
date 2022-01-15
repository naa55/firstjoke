<?php

try {
  
    include __DIR__ . "/includes/DatabaseConnection.php";
//     include __DIR__ . "/includes/DatabaseFunctions.php";
include __DIR__ . "/classes/DatabaseTable.php";

    // $sql = "SELECT `id`, `joketext` FROM `jokes`";
    // $result = $pdo->query($sql);

//     $jokes = allJokes($pdo);
        $jokesTable = new DatabaseTable($pdo, 'jokes', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');
        $result = $jokesTable->findAll();

        $jokes = [];
        foreach($result as $joke) {
                // $author = findById($pdo, 'author', 'id', $joke['authorid']);
                $author = $authorsTable->findById($joke['authorid']);
                $jokes[] = [
                        'id'=>$joke['id'],
                        'joketext'=>$joke['joketext'],
                        'jokedate'=>$joke['jokedate'],
                        'name' => $author['name'],
                        'email' => $author['email']
                ];
        }

    // $sql = 'SELECT `jokes`.`id`,`joketext`, `name`, `email` 
    // FROM `jokes` 
    // INNER JOIN `author` 
    // ON `authorid` = `author`.`id`';
    // $result = $pdo->query($sql);

    // while($row = $result->fetch())  {
    //     $jokes[] = ['joketext'=>$row['joketext'], 'id'=>$row['id'], "email"=>$row["email"], "name"=>$row["name"]];
    // }

    $title = "Joke list";
    // Start the buffer
//     $totalJoke = total($pdo, 'jokes');
    ob_start(); 
   include __DIR__ . "/templates/jokes.html.php";

   $output = ob_get_clean();


} catch(PDOException $e) {
        $output = "Unable to connect to server" 
        . $e->getMessage() . " in " 
        .$e->getFile()
        . $e->getLine();
}


include __DIR__ . "/templates/layout.html.php";