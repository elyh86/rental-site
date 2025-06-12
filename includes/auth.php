<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkAuth() {
    global $conn;
    
    // Check if user is already logged in via session
    if (isset($_SESSION['user_id'])) {
        // Check session timeout (30 minutes)
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
            // Session expired
            session_unset();
            session_destroy();
            return false;
        }
        $_SESSION['last_activity'] = time();
        return true;
    }
    
    // Check for remember me cookie
    if (isset($_COOKIE['remember_token'])) {
        $token = $_COOKIE['remember_token'];
        
        // Find valid token
        $stmt = $conn->prepare("SELECT user_id FROM remember_tokens WHERE token = :token AND expires > NOW()");
        $stmt->execute([':token' => $token]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Get user data
            $stmt = $conn->prepare("SELECT id, email FROM account WHERE id = :id");
            $stmt->execute([':id' => $result['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // Start new session
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['last_activity'] = time();
                return true;
            }
        }
        
        // Invalid or expired token - remove cookie
        setcookie('remember_token', '', time() - 3600, '/', '', true, true);
    }
    
    return false;
}

function logout() {
    global $conn;
    
    // Remove remember me token if exists
    if (isset($_COOKIE['remember_token'])) {
        $token = $_COOKIE['remember_token'];
        $stmt = $conn->prepare("DELETE FROM remember_tokens WHERE token = :token");
        $stmt->execute([':token' => $token]);
        setcookie('remember_token', '', time() - 3600, '/', '', true, true);
    }
    
    // Destroy session
    session_unset();
    session_destroy();
    
    // Redirect to login page
    header('Location: /login-form');
    exit;
}
