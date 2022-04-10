<?php
 try {
     $pdo = new PDO('mysql:host=localhost;dbname=ijokes;charset=utf8','userijokes','secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 } catch(PDOException $e) {
    $output = 'Database error: ' . $e->getMessage() . ' in '
  . $e->getFile() . ':' . $e->getLine();
 }


  