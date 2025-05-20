<?php
session_start();
require_once "database/connection.php";

$select_user = $conn->prepare("SELECT * FROM account WHERE email = :email");
$select_user->bindParam(":email", $_POST['email']);
$select_user->execute();
$user = $select_user->fetch(PDO::FETCH_ASSOC);

if (password_verify($_POST['password'], $user['password'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    header('Location: /');
}
