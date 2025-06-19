<?php
session_start();

// Check if user is logged in and has admin role
if (!isset($_SESSION['id'])) {
    header('Location: /login-form');
    exit();
}

// For now, we'll use a simple admin check - you can enhance this later
$admin_emails = ['admin@example.com', 'admin@rydr.nl', 'lllk@gmail.com']; // Add admin emails here
if (!in_array($_SESSION['email'], $admin_emails)) {
    $_SESSION['admin_error'] = "U heeft geen toegang tot deze functie.";
    header('Location: /admin');
    exit();
}

require_once __DIR__ . "/../database/connection.php";

// Validate form data
if (empty($_POST['brand']) || empty($_POST['type']) || empty($_POST['description']) || 
    empty($_POST['capacity']) || empty($_POST['steering']) || empty($_POST['gasoline']) || 
    empty($_POST['price']) || !isset($_FILES['main_image'])) {
    $_SESSION['admin_error'] = "Alle verplichte velden moeten worden ingevuld.";
    header('Location: /admin-add-car');
    exit();
}

// Validate and process image upload
$uploadDir = __DIR__ . "/../assets/images/products/";
$allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];
$maxFileSize = 5 * 1024 * 1024; // 5MB

if ($_FILES['main_image']['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['admin_error'] = "Er is een fout opgetreden bij het uploaden van de afbeelding.";
    header('Location: /admin-add-car');
    exit();
}

if (!in_array($_FILES['main_image']['type'], $allowedTypes)) {
    $_SESSION['admin_error'] = "Alleen JPG, PNG en SVG bestanden zijn toegestaan.";
    header('Location: /admin-add-car');
    exit();
}

if ($_FILES['main_image']['size'] > $maxFileSize) {
    $_SESSION['admin_error'] = "De afbeelding is te groot. Maximum grootte is 5MB.";
    header('Location: /admin-add-car');
    exit();
}

// Generate unique filename
$fileExtension = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
$fileName = 'car_' . time() . '_' . uniqid() . '.' . $fileExtension;
$uploadPath = $uploadDir . $fileName;

// Move uploaded file
if (!move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadPath)) {
    $_SESSION['admin_error'] = "Er is een fout opgetreden bij het opslaan van de afbeelding.";
    header('Location: /admin-add-car');
    exit();
}

try {
    // Prepare data
    $brand = trim($_POST['brand']);
    $type = trim($_POST['type']);
    $description = trim($_POST['description']);
    $capacity = trim($_POST['capacity']);
    $steering = trim($_POST['steering']);
    $gasoline = trim($_POST['gasoline']);
    $price = floatval(str_replace(',', '.', $_POST['price']));
    $oldPrice = !empty($_POST['old_price']) ? floatval(str_replace(',', '.', $_POST['old_price'])) : 0;

    // Validate price
    if ($price <= 0) {
        $_SESSION['admin_error'] = "De huurprijs moet groter zijn dan 0.";
        header('Location: /admin-add-car');
        exit();
    }

    // Insert car into database
    $stmt = $conn->prepare("
        INSERT INTO cars (brand, type, capacity, steering, gasoline, price, old_price, description, main_image) 
        VALUES (:brand, :type, :capacity, :steering, :gasoline, :price, :old_price, :description, :main_image)
    ");
    
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':capacity', $capacity);
    $stmt->bindParam(':steering', $steering);
    $stmt->bindParam(':gasoline', $gasoline);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':old_price', $oldPrice);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':main_image', $fileName);
    
    $stmt->execute();
    
    $_SESSION['admin_success'] = "De auto '$brand' is succesvol toegevoegd aan het wagenpark.";
    header('Location: /admin');
    exit();
    
} catch (PDOException $e) {
    // Delete uploaded file if database insert fails
    if (file_exists($uploadPath)) {
        unlink($uploadPath);
    }
    
    $_SESSION['admin_error'] = "Er is een fout opgetreden bij het opslaan van de auto: " . $e->getMessage();
    header('Location: /admin-add-car');
    exit();
}
?> 