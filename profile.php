<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
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
<!-- Профиль -->
<form >
    <h2 style="margin: 10px 0;">Здравствуйте <?= $_SESSION['user']['name'] ?></h2>
    <a href="vendor/logout.php" class="logout">Выход</a>
</form>
</body>
</html>