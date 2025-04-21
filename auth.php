<?php

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS)); 

if (strlen($login) < 4) {
    echo "<script>alert('Login error'); window.history.back();</script>";
    exit();
}
if (strlen($password) < 4) {
    echo "<script>alert('Password error'); window.history.back();</script>";
    exit();
}

$salt = 'gn531*&)*(329@$&*&^!!^';
$password = md5($password . $salt);

require_once 'db.php';

$sql = 'SELECT id FROM user WHERE login = ? AND password = ?';
$query = $pdo->prepare($sql);
$query->execute([$login, $password]);

if ($query->rowCount() == 0) {
    echo "<script>alert('Invalid login or password'); window.history.back();</script>";
    exit();
} else {
    setcookie('user', $login, time() + 3600 * 24 * 30, '/');
    echo "<script>window.location.href = '/php.loc/lo-fi/lo-fi.php';</script>";
    exit();
}
?>