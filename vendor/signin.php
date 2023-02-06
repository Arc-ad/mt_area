<?php
session_start();
include_once '../assets/path.php';


$login = $_POST['login'];
$password = $_POST['password'];
if ($login === '' || !ctype_graph($login) || mb_strlen($login) < 6 ) {
    $error_field[] = 'login';
}
if ($password === '' || !ctype_graph($password) || mb_strlen($password) < 6 || (!preg_match('/[A-z]+/',
        $password)) || (!preg_match('/[0-9]+/', $password))) {
    $error_field[] = 'password';

}
if(!empty($error_field)){
    $response = [
        'status' => false,
        'type' => 1,
        'message' => 'Проверьте правильность полей',
        'fields' => $error_field

    ];
    echo json_encode($response);
    die();
}

$password = md5($password);

$userCollection = json_decode(file_get_contents('../' . $path));
if (isset($userCollection)) {
    foreach ($userCollection as $object) {
        if ($login === $object->login && $password === $object->password) {
            $_SESSION['user'] = [
                "name" => $object->name,
                "email" => $object->email,
                'login' => $object->login
            ];
            $response = [
                'status' => true
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => false,
                'message' => 'Не верный логин или пароль'
            ];
            echo json_encode($response);
        }
    }
} else {
    $response = [
        'status' => false,
        'message' => 'Не верный логин или пароль'
    ];
    echo json_encode($response);
}
