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

// Get car ID from URL
$carId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($carId === 0) {
    $_SESSION['admin_error'] = "Ongeldige auto ID.";
    header('Location: /admin');
    exit();
}

try {
    // Check if car exists and get its details
    $checkStmt = $conn->prepare("SELECT brand, main_image FROM cars WHERE id = :id");
    $checkStmt->bindParam(':id', $carId);
    $checkStmt->execute();
    
    if ($checkStmt->rowCount() === 0) {
        $_SESSION['admin_error'] = "Auto niet gevonden.";
        header('Location: /admin');
        exit();
    }
    
    $car = $checkStmt->fetch(PDO::FETCH_ASSOC);
    $carBrand = $car['brand'];
    $carImage = $car['main_image'];
    
    // Check if car has active reservations
    $reservationStmt = $conn->prepare("
        SELECT COUNT(*) as active_count 
        FROM reservations 
        WHERE car_id = :car_id AND status IN ('pending', 'confirmed')
    ");
    $reservationStmt->bindParam(':car_id', $carId);
    $reservationStmt->execute();
    $reservationCount = $reservationStmt->fetch(PDO::FETCH_ASSOC)['active_count'];
    
    if ($reservationCount > 0) {
        $_SESSION['admin_error'] = "Deze auto kan niet worden verwijderd omdat er actieve reserveringen zijn.";
        header('Location: /admin');
        exit();
    }
    
    // Start transaction
    $conn->beginTransaction();
    
    // Delete reviews for this car
    $deleteReviewsStmt = $conn->prepare("DELETE FROM reviews WHERE car_id = :car_id");
    $deleteReviewsStmt->bindParam(':car_id', $carId);
    $deleteReviewsStmt->execute();
    
    // Delete reservations for this car (only completed/canceled ones)
    $deleteReservationsStmt = $conn->prepare("DELETE FROM reservations WHERE car_id = :car_id");
    $deleteReservationsStmt->bindParam(':car_id', $carId);
    $deleteReservationsStmt->execute();
    
    // Delete the car
    $deleteCarStmt = $conn->prepare("DELETE FROM cars WHERE id = :id");
    $deleteCarStmt->bindParam(':id', $carId);
    $deleteCarStmt->execute();
    
    // Commit transaction
    $conn->commit();
    
    // Delete car image file if it exists and is not the default image
    if ($carImage && $carImage !== 'car (0).svg') {
        $imagePath = __DIR__ . "/../assets/images/products/" . $carImage;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $_SESSION['admin_success'] = "De auto '$carBrand' is succesvol verwijderd uit het wagenpark.";
    header('Location: /admin');
    exit();
    
} catch (PDOException $e) {
    // Rollback transaction on error
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    
    $_SESSION['admin_error'] = "Er is een fout opgetreden bij het verwijderen van de auto: " . $e->getMessage();
    header('Location: /admin');
    exit();
}
?> 