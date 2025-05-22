<?php
require_once "../includes/header.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /login-form');
    exit;
}

// Get current user data
$stmt = $conn->prepare("SELECT password FROM account WHERE id = :id");
$stmt->execute([':id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verify current password
if (!password_verify($_POST['current_password'], $user['password'])) {
    $_SESSION['message'] = "Huidig wachtwoord is onjuist";
    header('Location: /account');
    exit;
}

// Validate new password
if ($_POST['new_password'] !== $_POST['confirm_password']) {
    $_SESSION['message'] = "Nieuwe wachtwoorden komen niet overeen";
    header('Location: /account');
    exit;
}

if (strlen($_POST['new_password']) < 8) {
    $_SESSION['message'] = "Nieuw wachtwoord moet minimaal 8 tekens lang zijn";
    header('Location: /account');
    exit;
}

// Update password
$stmt = $conn->prepare("UPDATE account SET 
    password = :password,
    updated_at = NOW()
    WHERE id = :user_id");

try {
    $options = ['cost' => 14];
    $hashed_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT, $options);
    
    $stmt->execute([
        ':password' => $hashed_password,
        ':user_id' => $_SESSION['user_id']
    ]);
    
    $_SESSION['message'] = "Wachtwoord succesvol gewijzigd";
    $_SESSION['message_type'] = "success";
} catch (PDOException $e) {
    $_SESSION['message'] = "Er is een fout opgetreden bij het wijzigen van je wachtwoord";
}

header('Location: /account');
exit;
