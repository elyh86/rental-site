<?php
require_once "../includes/header.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /login-form');
    exit;
}

// Validate email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = "Ongeldig e-mailadres";
    header('Location: /account');
    exit;
}

// Check if email is already in use by another user
$stmt = $conn->prepare("SELECT id FROM account WHERE email = :email AND id != :user_id");
$stmt->execute([
    ':email' => $_POST['email'],
    ':user_id' => $_SESSION['user_id']
]);

if ($stmt->rowCount() > 0) {
    $_SESSION['message'] = "Dit e-mailadres is al in gebruik";
    header('Location: /account');
    exit;
}

// Update user profile
$stmt = $conn->prepare("UPDATE account SET 
    email = :email,
    name = :name,
    phone = :phone,
    updated_at = NOW()
    WHERE id = :user_id");

try {
    $stmt->execute([
        ':email' => $_POST['email'],
        ':name' => $_POST['name'] ?? null,
        ':phone' => $_POST['phone'] ?? null,
        ':user_id' => $_SESSION['user_id']
    ]);

    // Update session email
    $_SESSION['email'] = $_POST['email'];
    
    $_SESSION['message'] = "Profiel succesvol bijgewerkt";
    $_SESSION['message_type'] = "success";
} catch (PDOException $e) {
    $_SESSION['message'] = "Er is een fout opgetreden bij het bijwerken van je profiel";
}

header('Location: /account');
exit;
