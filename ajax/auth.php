<?php
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($email) < 2)
        $error = 'Введите email';
    else if(strlen($password) < 2)
        $error = 'Введите пароль';

    if ($error != '') {
        echo $error;
        exit();
    }

    $hash = "powfjd666KFLlaaee";            // соль - абракадабра
    $password = md5($password . $hash);     // функция шифрования + добавление своей абракадабры = 32 символа

    require_once './../mysql_connect.php';

    $sql = 'SELECT `id` FROM `users` WHERE `email` = :email && `password` = :password';
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email, 'password' => $password]);

    $user = $query->fetch(PDO::FETCH_OBJ);
    if ($user->id == 0) {
        echo 'Такого пользователя не существует';
    } else {
        setcookie('log', $email, time() + 3600 * 24, "/");
        echo 'Пользователь авторизован';
    }
?>