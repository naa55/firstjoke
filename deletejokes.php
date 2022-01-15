<?php
try {
    include __DIR__ . "/includes/DatabaseConnection.php";
    // include __DIR__ . "/includes/DatabaseFunctions.php";
    include __DIR__ . '/classes/DatabaseTable.php';
    $jokesTable = new DatabaseTable($pdo, 'jokes', 'id');

    $jokesTable->delete($_POST['id']);

    // $sql = 'DELETE FROM`jokes` WHERE `id` = :id';
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':id', $_POST['id']);
    // $stmt->execute();

    // deleteJoke($pdo, $_POST['id']);

    // delete($pdo, 'jokes', 'id', $_POST['id']);
    // delete($pdo, 'joke', 'id', $_POST['id']);
    header('location:jokes.php');

} catch(PDOException $e) {
    $title = "An error has occurred";
    $output = "An error has occurred";

        $output = "Unable to connect to server" 
        . $e->getMessage() . " in " 
        .$e->getFile()
        . $e->getLine();
}


include __DIR__ . "/templates/layout.html.php";