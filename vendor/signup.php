<?php

session_start();
include_once '../assets/path.php';

$name = test_input($_POST['name']);
$login = test_input($_POST['login']);
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);
$password_confirm = test_input($_POST['password_confirm']);


if (mb_strlen($name) < 2 && !ctype_alpha($name)) {
    $error_fields[] = 'name';
}
if (!ctype_graph($login) || mb_strlen($login) < 6) {
    $error_fields[] = 'login';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_fields[] = 'email';
}
if (!ctype_graph($password) || mb_strlen($password) < 6 || (!preg_match('/[A-z]+/', $password)) || (!preg_match('/[0-9]+/', $password))) {
    $error_fields[] = 'password';
}
if ($password !== $password_confirm) {
    $error_fields[] = 'password_confirm';
}

if (!empty($error_fields)) {
    $response = [
        'status' => 'false',
        'type' => 1,
        'message' => 'Проверьте правильность полей',
        'fields' => $error_fields
    ];

    echo json_encode($response);
    die();
}

// создаем нового пользователя
$user = [
    'name' => $name,
    'login' => $login,
    'email' => $email,
    'password' => md5($password)
];

$userCollection = json_decode(file_get_contents('../' . $path));

//проверка на наличе пользователя в бд, по умолчанию незарегистрирован
if (isset($userCollection)) {
    foreach ($userCollection as $object) {
        if ($user['email'] === $object->email || $user['login'] === $object->login) {

            $response = [
                'status' => false,
                'type' => 2,
                'message' => 'Пользователь с такой почтой или логином уже зарегистрирован!'
            ];
            echo json_encode($response);
            die();
        }
    }
}

$userCollection[] = $user;
file_put_contents('../' . $path, json_encode($userCollection));
$response = [
    'status' => true,
    'message' => 'Регистрация прошла успешно!'
];
echo json_encode($response);


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}