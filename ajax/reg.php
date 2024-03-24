<?php
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));   // Удаление пробелов, валидация
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($username) < 2)
        $error = 'Введите имя';
    else if(strlen($email) < 2)
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

    $sql = 'INSERT INTO users(username, email, password) VALUES(:username, :email, :password)';
    $query = $pdo->prepare($sql);
    $query->execute(['username' => $username, 'email' => $email, 'password' => $password]);

    echo 'Пользователь зарегистрирован';
?>