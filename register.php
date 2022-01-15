<?php 

try {
        include __DIR__ . '/classes/DatabaseTable.php';
     
        $jokesTable = new DatabaseTable($pdo, 'jokes', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');
      
        $action = $_GET['action'] ?? 'home';
        $controllerName = $_GET['controller'] ?? 'joke';

        if ($controllerName === 'joke') {
            $controller = new JokeController($jokesTable,
            $authorsTable);
            }
            else if ($controllerName === 'register') {
            $controller = new RegisterController($authorsTable);
            }
            $page = $controller->$action();

            // if ($action == strtolower($action) && $controllerName == strtolower($controllerName)) {
            //     $className = ucfirst($controllerName) . 'Controller';
            //     include __DIR__ . '/controllers/' . $className . '.php';
            //     $controller = new $className($jokesTable, $authorsTable);
            // $page = $controller->$action();
            // } else {
            // http_response_code(301);
            // header('location: index.php?action=' .
            // strtolower($controllerName) . '&action=' .
            // strtolower($action));
            // }

            $title = $page['title'];
            if (isset($page['variables'])) {
            $output = loadTemplate($page['template'],
            $page['variables']);
            } else {
            $output = loadTemplate($page['template']);
            }
} catch(PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
    . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/templates/layout.html.php';