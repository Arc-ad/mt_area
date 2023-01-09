<?php
session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$userCollection = json_decode(file_get_contents('../../data.json'));
foreach ($userCollection as $object) {
    if ($login === $object->login && $password === $object->password) {
        $_SESSION['user'] = [
            "name" => $object->name,
            "email" => $object->email,
            'login' => $object->logig
        ];
        header('Location: ../profile.php');
        break;
    }else{
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: ../index.php');
    }
}

