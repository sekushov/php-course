<?php
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));   // Удаление пробелов, валидация
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($username) < 2)
        $error = 'Введите имя';
    else if(strlen($email) < 2)
        $error = 'Введите email';
    else if(strlen($mess) < 2)
        $error = 'Введите текст сообщения';

    if ($error != '') {
        echo $error;
        exit();
    }

    $my_email = 'studia9@bk.ru';
    $subject = '=?utf-8?B?'.base64_encode('Сообщение с PHP').'?=';
    $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";
    mail($my_email, $subject, $mess, $headers);

    echo 'Сообщение отправлено';
?>