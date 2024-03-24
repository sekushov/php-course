<?php
    $user = 'root';
    $passwordDB = '';
    $db = 'testo';
    $host = '127.0.0.1';
    $dsn = 'mysql:host='.$host.';dbname='.$db;
    $pdo = new PDO($dsn, $user, $passwordDB);
?>