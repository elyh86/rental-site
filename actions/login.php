<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/../database/connection.php";

$select_user = $conn->prepare("SELECT * FROM account WHERE email = :email");
$select_user->bindParam(":email", $_POST['email']);
$select_user->execute();
$user = $select_user->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($_POST['password'], $user['password'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    header('Location: /');
    exit;
} else {
    $_SESSION['error'] = 'Invalid email or password.';
    header('Location: /pages/login-form.php');
    exit;
}
