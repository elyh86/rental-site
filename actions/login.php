<?php
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../database/connection.php";

// Controleer of email en wachtwoord zijn ingevuld
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    header('Location: /login-form?error=Vul alle velden in');
    exit;
}

// Zoek de gebruiker op basis van email
$select_user = $conn->prepare("SELECT * FROM account WHERE email = :email");
$select_user->bindParam(":email", $_POST['email']);
$select_user->execute();
$user = $select_user->fetch(PDO::FETCH_ASSOC);

// Controleer of de gebruiker bestaat en het wachtwoord correct is
if ($user && password_verify($_POST['password'], $user['password'])) {
    // Start een nieuwe sessie voor veiligheid
    session_regenerate_id(true);
    
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['last_activity'] = time();
    
    // Als "remember me" is aangevinkt
    if (isset($_POST['remember_me']) && $_POST['remember_me'] == '1') {
        // Genereer een unieke token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+30 days'));
        
        // Sla de remember me token op in de database
        $stmt = $conn->prepare("INSERT INTO remember_tokens (user_id, token, expires) VALUES (:user_id, :token, :expires)");
        $stmt->execute([
            ':user_id' => $user['id'],
            ':token' => $token,
            ':expires' => $expires
        ]);
        
        // Zet de cookie voor 30 dagen
        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', true, true);
    }
    
    header('Location: /');
    exit;
} else {
    // Als de login mislukt, stuur terug naar login form met foutmelding
    header('Location: /login-form?error=Ongeldige email of wachtwoord');
    exit;
}
