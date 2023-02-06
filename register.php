<?php
session_start();
if(isset($_SESSION['user'])){
    header('Location: profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/styles/main.css">
</head>
<body>
<!-- Форма регистрации -->
<form>
    <label >Имя</label>
    <input type="text" name="name" placeholder="Введите свое имя">

    <label >Логин</label>
    <input type="text" name="login" placeholder="Введите свой логин">

    <label >Почта</label>
    <input type="email" name="email" placeholder="Введите адрес электронной почты">

    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">

    <label>Подтверждение пароля</label>
    <input type="password" name="password_confirm" placeholder="Подтвердите пароль">

    <button type="submit" class="register-btn">Войти</button>
    <p>
        У вас уже есть аккаунт? - <a href="index.php">Авторизируйтесь</a>!
    </p>
    <p class="msg none">Lorem ipsum dolor sit amet.</p>'

</form>
<script src="assets/js/jquery-3.6.3.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>