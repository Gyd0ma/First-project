<?php

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS)); 

if (strlen($login) < 4) {
    echo "Login error";
    exit();
}
if (strlen($password) < 4) {
    echo "Password error";
    exit();
}

$salt = 'gn531*&)*(329@$&*&^!!^';
$password = md5($password . $salt);

// Connect to the database
require_once 'db.php';

$sql = 'INSERT INTO `user` (`login`, `password`) VALUES (?, ?)';
$query = $pdo->prepare($sql);

try {
    $query->execute([$login, $password]);
    echo "Registration successful";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

header( "location: /php.loc/index.html" );