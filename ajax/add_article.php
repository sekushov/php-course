<?php
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));   // Удаление пробелов, валидация
    $intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
    $text = trim(filter_var($_POST['text'], FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($title) < 2)
        $error = 'Введите название';
    else if(strlen($intro) < 5)
        $error = 'Введите intro';
    else if(strlen($text) < 5)
        $error = 'Введите текст статьи';

    if ($error != '') {
        echo $error;
        exit();
    }

    require_once './../mysql_connect.php';

    $sql = 'INSERT INTO articles(title, intro, text, date, author) VALUES(:title, :intro, :text, :date, :author)';
    $query = $pdo->prepare($sql);
    $query->execute(['title' => $title, 'intro' => $intro, 'text' => $text, 'date' => time(), 'author' => $_COOKIE['log']]);

    echo 'Готово';
?>