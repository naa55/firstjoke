<?php
try {
    include __DIR__ .'/autoloader.php';
    $route = $_GET['route'] ?? 'home';
    $entryPoint = new \Ninja\EntryPoint($route,  new \Ijdb\dbRoutes(),  $_SERVER['REQUEST_METHOD']);
    $entryPoint->run();
} catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
}
