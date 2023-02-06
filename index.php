<?php
session_start();
if (isset($_SESSION['user'])) {
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
<div id="noJS">Please enable JavaScript...</div>
<div id="site">
    <!-- Форма авторизации -->
    <form>
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit" class="login-btn">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="register.php">Зарегистрируйтесь</a>!
        </p>
        <p class="msg none">Lorem ipsum.</p>
    </form>
</div>
<script src="assets/js/jquery-3.6.3.js"></script>
<script>
    $(document).ready(function () {
        $("#noJS").hide();
        $("#site").show();
    });
</script>
<script src="assets/js/main.js"></script>
</body>
</html>