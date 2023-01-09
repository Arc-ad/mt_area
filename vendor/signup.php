<?php

session_start();
require_once 'connect.php';

$name = test_input($_POST['name']);
$login = test_input($_POST['login']);
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);
$password_confirm = test_input($_POST['password_confirm']);


if (mb_strlen($name) < 2 && !ctype_alpha($name)) {
    $_SESSION['err_name'] = "Минимум 2 символа, только буквы!";
}
if (!ctype_graph($login) || mb_strlen($login) < 6 ) {
    $_SESSION['err_login'] = 'Минимум 6 символов';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['err_email'] = "Введите действующий Email";
}
if (!ctype_graph($password) || mb_strlen($password) < 6 || (!preg_match('/[A-zА-я]+/', $password)) || (!preg_match('/[0-9]+/', $password))) {
    $_SESSION['err_pass'] = 'Минимум 6 символов , обязательно должны состоять из цифр и букв';
} elseif ($password !== $password_confirm) {
    $_SESSION['err_pass_confirm'] = "Пароли должны совпадать!";
}
if (isset($_SESSION['err_name']) || isset($_SESSION['err_login']) || isset($_SESSION['err_email']) || isset($_SESSION['err_pass'])) {
    header('location: ../register.php');
} else {
    $user = [
        'name' => $name,
        'login' => $login,
        'email' => $email,
        'password' => md5($password)
    ];

    $userCollection = json_decode(file_get_contents('../../data.json'));

    if (isset($userCollection)) {
        //проверка на наличе пользователя в бд, по умолчанию незарегистрирован
        $isRegistered = false;
        foreach ($userCollection as $object) {
            if ($user['email'] === $object->email || $user['login'] === $object->login) {
                $_SESSION['err_login'] = 'такой пользователь уже есть';
                $isRegistered = true;
                break;
            }
        }
            if ($isRegistered) {
                $_SESSION['message'] = "Такой пользователь зарегистрирован!";
                header('Location: ../register.php');
            } else {

                $userCollection[] = $user;
                file_put_contents('../../data.json', json_encode($userCollection));
                $_SESSION['message'] = 'Регистрация прошла успешно!';
                header('Location: ../index.php');
            }

    } else {
        $userCollection[] = $user;
        file_put_contents('../../data.json', json_encode($userCollection));
        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../index.php');
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}