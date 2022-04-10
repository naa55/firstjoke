<?php
try {
    include __DIR__ .'/../includes/autoloader.php';
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    $entryPoint = new \Ninja\EntryPoint($route,  new \Ijdb\dbRoutes(),  $_SERVER['REQUEST_METHOD']);
    $entryPoint->run();
} catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
}
