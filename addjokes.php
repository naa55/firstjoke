
if(isset($_POST["joketext"])) {
    try {
        include __DIR__ . "/includes/DatabaseConnection.php";
        include __DIR__ . "/includes/DatabaseFunctions.php";

    
        

        insert($pdo, 'jokes', ['authorid' => 3, 
        'joketext'=>$_POST['joketext'], 
        'jokedate'=> new DateTime()]);

        header('Location: jokes.php');
        
            
    
    } catch(PDOException $e) {
            $output = "Unable to connect to server" 
            . $e->getMessage() . " in " 
            .$e->getFile()
            . $e->getLine();
    }
} else {
    $title = "Add a new Joke";
 ob_start();
   include __DIR__ . "/templates/addjokes.html.php";

   $output = ob_get_clean();
}


include __DIR__ . "/templates/layout.html.php";