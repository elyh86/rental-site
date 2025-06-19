<?php
session_start();
require_once __DIR__ . "/../database/connection.php";

// Redirect if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: /');
    exit();
}

// Get current user info
$stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
$stmt->bindParam(":id", $_SESSION['id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verify current password
if (!password_verify($_POST['current_password'], $user['password'])) {
    $_SESSION['account_message'] = "Huidig wachtwoord is onjuist.";
    header('Location: /account');
    exit();
}

// Controleer of er een profielfoto is geüpload
$profile_image_path = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['size'] > 0) {
    // Create uploads directory if it doesn't exist
    $upload_dir = __DIR__ . "/../assets/images/profiles/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Genereer een unieke bestandsnaam
    $file_extension = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
    $new_filename = "profile_" . $_SESSION['id'] . "_" . time() . "." . $file_extension;
    $upload_path = $upload_dir . $new_filename;
    
    // Controleer bestandstype
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($file_extension, $allowed_types)) {
        $_SESSION['account_message'] = "Alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
        header('Location: /account');
        exit();
    }
    
    // Controleer bestandsgrootte (max 5MB)
    if ($_FILES["profile_image"]["size"] > 5000000) {
        $_SESSION['account_message'] = "Bestand is te groot (max 5MB).";
        header('Location: /account');
        exit();
    }
    
    // Upload bestand
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $upload_path)) {
        $profile_image_path = "assets/images/profiles/" . $new_filename;
    } else {
        $_SESSION['account_message'] = "Er is een probleem opgetreden bij het uploaden van je profielfoto.";
        header('Location: /account');
        exit();
    }
}

// Update email if changed
if ($_POST['email'] != $user['email']) {
    // Check if email is already taken
    $check_email = $conn->prepare("SELECT id FROM account WHERE email = :email AND id != :id");
    $check_email->bindParam(":email", $_POST['email']);
    $check_email->bindParam(":id", $_SESSION['id']);
    $check_email->execute();
    
    if ($check_email->rowCount() > 0) {
        $_SESSION['account_message'] = "Dit e-mailadres is al in gebruik.";
        header('Location: /account');
        exit();
    }
    
    // Update email
    $update_email = $conn->prepare("UPDATE account SET email = :email WHERE id = :id");
    $update_email->bindParam(":email", $_POST['email']);
    $update_email->bindParam(":id", $_SESSION['id']);
    $update_email->execute();
    
    $_SESSION['email'] = $_POST['email']; // Update session email
}

// Update password if provided
if (!empty($_POST['new_password'])) {
    if ($_POST['new_password'] === $_POST['confirm_password']) {
        $options = ['cost' => 12];
        $hashed_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT, $options);
        
        $update_password = $conn->prepare("UPDATE account SET password = :password WHERE id = :id");
        $update_password->bindParam(":password", $hashed_password);
        $update_password->bindParam(":id", $_SESSION['id']);
        $update_password->execute();
    } else {
        $_SESSION['account_message'] = "Nieuwe wachtwoorden komen niet overeen.";
        header('Location: /account');
        exit();
    }
}

// Update profile image if uploaded
if ($profile_image_path !== null) {
    // Controleer of de profile_image kolom bestaat in de account tabel
    try {
        $check_column = $conn->query("SHOW COLUMNS FROM account LIKE 'profile_image'")->rowCount();
        
        if ($check_column == 0) {
            // Kolom bestaat nog niet, voeg deze toe
            $conn->exec("ALTER TABLE account ADD COLUMN profile_image VARCHAR(255) NULL");
        }
        
        $update_image = $conn->prepare("UPDATE account SET profile_image = :profile_image WHERE id = :id");
        $update_image->bindParam(":profile_image", $profile_image_path);
        $update_image->bindParam(":id", $_SESSION['id']);
        $update_image->execute();
    } catch (PDOException $e) {
        // Noteer de fout maar ga door
        error_log("Error updating profile image: " . $e->getMessage());
    }
}

$_SESSION['account_message'] = "Je accountgegevens zijn succesvol bijgewerkt.";
header('Location: /account');
exit();
?>
