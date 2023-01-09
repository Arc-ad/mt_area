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
<form action="vendor/signup.php" method="post" enctype="multipart/form-data">
    <label >Имя</label>
    <input type="text" name="name" placeholder="Введите свое имя">
    <?php
    if (isset($_SESSION['err_name'])) {
        echo '<p class="msg msg_error"> ' . $_SESSION['err_name'] . ' </p>';
    }
    unset($_SESSION['err_name']);
    ?>
    <label >Логин</label>
    <input type="text" name="login" placeholder="Введите свой логин">
    <?php
    if (isset($_SESSION['err_login'])) {
        echo '<p class="msg msg_error"> ' . $_SESSION['err_login'] . ' </p>';
    }
    unset($_SESSION['err_login']);
    ?>
    <label >Почта</label>
    <input type="email" name="email" placeholder="Введите адрес электронной почты">
    <?php
    if (isset($_SESSION['err_email'])) {
        echo '<p class="msg msg_error"> ' . $_SESSION['err_email'] . ' </p>';
    }
    unset($_SESSION['err_email']);
    ?>
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <?php
    if (isset($_SESSION['err_pass'])) {
        echo '<p class="msg msg_error"> ' . $_SESSION['err_pass'] . ' </p>';
    }
    unset($_SESSION['err_pass']);
    ?>
    <label>Подтверждение пароля</label>
    <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
    <?php
    if (isset($_SESSION['err_pass_confirm'])) {
        echo '<p class="msg msg_error"> ' . $_SESSION['err_pass_confirm'] . ' </p>';
    }
    unset($_SESSION['err_pass_confirm']);
    ?>
    <button type="submit">Войти</button>
    <p>
        У вас уже есть аккаунт? - <a href="index.php">Авторизируйтесь</a>!
    </p>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>

</form>
</body>
</html>