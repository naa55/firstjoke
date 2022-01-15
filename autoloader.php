<?php
function autoloader($className) {
    
    $file = str_replace('\\', '/', $className). '.php';
    $file =  __DIR__ . '/classes/' . $className . '.php';
    include $file;
}

spl_autoload_register('autoloader');