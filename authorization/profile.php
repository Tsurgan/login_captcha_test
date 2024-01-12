<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<?php
session_start();

if (!isset($_SESSION["userid"])) {

    header("location: main.html");
    exit;
}
?>
<html>

<body>

<form action="prf.php" method="post">
    <div>
        <label for="name">Имя:</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="phone">Телефон:</label>
        <input type="tel" name="phone">
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="text" name="email">
    </div>
    <div>
        <label for="pass">Пароль:</label>
        <input type="password" name="pass">
    </div>
    <div>
        <input type="submit" value="Сохранить">
    </div>
</form>
<form action="lgout.php">
    <div>
        <input type="submit" value="Выйти">
    </div>
</form>
</body>
</html>
