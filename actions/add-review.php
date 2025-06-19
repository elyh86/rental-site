<?php
// Include database connection
require_once __DIR__ . '/../database/connection.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $carId = isset($_POST['car_id']) ? intval($_POST['car_id']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $position = isset($_POST['position']) ? trim($_POST['position']) : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 5;
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    
    // Validate data
    if ($carId <= 0 || empty($name) || empty($position) || empty($comment)) {
        $error = "All fields are required.";
    } else {
        try {
            // Format current date
            $date = date('d F Y');
            
            // Insert review into database
            $stmt = $conn->prepare("INSERT INTO reviews (car_id, name, position, date, rating, comment) 
                                   VALUES (:car_id, :name, :position, :date, :rating, :comment)");
            
            $stmt->bindParam(':car_id', $carId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':comment', $comment);
            
            $stmt->execute();
            
            // Update the reviews_count in the cars table
            // First, count the current number of reviews for this car
            $stmt = $conn->prepare("SELECT COUNT(*) FROM reviews WHERE car_id = :car_id");
            $stmt->bindParam(':car_id', $carId);
            $stmt->execute();
            $reviewCount = $stmt->fetchColumn();
            
            // Update the car's reviews_count field
            $reviewCountText = $reviewCount . '+ Reviewer';
            $stmt = $conn->prepare("UPDATE cars SET reviews_count = :reviews_count WHERE id = :car_id");
            $stmt->bindParam(':reviews_count', $reviewCountText);
            $stmt->bindParam(':car_id', $carId);
            $stmt->execute();
            
            // Redirect back to the car detail page with success message
            header("Location: /car-detail?id=" . $carId . "&success=1");
            exit;
            
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
    
    // If there was an error, redirect back with error message
    if (isset($error)) {
        header("Location: /car-detail?id=" . $carId . "&error=" . urlencode($error));
        exit;
    }
} else {
    // If not a POST request, redirect to home
    header("Location: /");
    exit;
}
