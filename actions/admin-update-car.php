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
if (empty($_POST['car_id']) || empty($_POST['brand']) || empty($_POST['type']) || 
    empty($_POST['description']) || empty($_POST['capacity']) || empty($_POST['steering']) || 
    empty($_POST['gasoline']) || empty($_POST['price'])) {
    $_SESSION['admin_error'] = "Alle verplichte velden moeten worden ingevuld.";
    header('Location: /admin');
    exit();
}

$carId = intval($_POST['car_id']);

try {
    // Check if car exists
    $checkStmt = $conn->prepare("SELECT main_image FROM cars WHERE id = :id");
    $checkStmt->bindParam(':id', $carId);
    $checkStmt->execute();
    
    if ($checkStmt->rowCount() === 0) {
        $_SESSION['admin_error'] = "Auto niet gevonden.";
        header('Location: /admin');
        exit();
    }
    
    $currentCar = $checkStmt->fetch(PDO::FETCH_ASSOC);
    $currentImage = $currentCar['main_image'];
    $newImageName = $currentImage; // Keep current image by default
    
    // Handle image upload if new image is provided
    if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . "/../assets/images/products/";
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        
        if (!in_array($_FILES['main_image']['type'], $allowedTypes)) {
            $_SESSION['admin_error'] = "Alleen JPG, PNG en SVG bestanden zijn toegestaan.";
            header('Location: /admin-edit-car?id=' . $carId);
            exit();
        }
        
        if ($_FILES['main_image']['size'] > $maxFileSize) {
            $_SESSION['admin_error'] = "De afbeelding is te groot. Maximum grootte is 5MB.";
            header('Location: /admin-edit-car?id=' . $carId);
            exit();
        }
        
        // Generate unique filename
        $fileExtension = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
        $newImageName = 'car_' . time() . '_' . uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $newImageName;
        
        // Move uploaded file
        if (!move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadPath)) {
            $_SESSION['admin_error'] = "Er is een fout opgetreden bij het opslaan van de afbeelding.";
            header('Location: /admin-edit-car?id=' . $carId);
            exit();
        }
        
        // Delete old image if it's different from the new one
        if ($currentImage !== $newImageName) {
            $oldImagePath = $uploadDir . $currentImage;
            if (file_exists($oldImagePath) && $currentImage !== 'car (0).svg') {
                unlink($oldImagePath);
            }
        }
    }
    
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
        header('Location: /admin-edit-car?id=' . $carId);
        exit();
    }

    // Update car in database
    $stmt = $conn->prepare("
        UPDATE cars 
        SET brand = :brand, type = :type, capacity = :capacity, steering = :steering, 
            gasoline = :gasoline, price = :price, old_price = :old_price, 
            description = :description, main_image = :main_image 
        WHERE id = :id
    ");
    
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':capacity', $capacity);
    $stmt->bindParam(':steering', $steering);
    $stmt->bindParam(':gasoline', $gasoline);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':old_price', $oldPrice);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':main_image', $newImageName);
    $stmt->bindParam(':id', $carId);
    
    $stmt->execute();
    
    $_SESSION['admin_success'] = "De auto '$brand' is succesvol bijgewerkt.";
    header('Location: /admin');
    exit();
    
} catch (PDOException $e) {
    $_SESSION['admin_error'] = "Er is een fout opgetreden bij het bijwerken van de auto: " . $e->getMessage();
    header('Location: /admin-edit-car?id=' . $carId);
    exit();
}
?> 