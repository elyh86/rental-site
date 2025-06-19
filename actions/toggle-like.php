<?php
// Include database connection
require_once __DIR__ . '/../database/connection.php';

// Check if request is AJAX
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Make sure car_likes table exists
try {
    $stmt = $conn->query("SHOW TABLES LIKE 'car_likes'");
    $likesTableExists = $stmt->rowCount() > 0;
    
    if (!$likesTableExists) {
        // Create car_likes table if it doesn't exist
        $sql = file_get_contents(__DIR__ . '/../database/create_car_likes_table.sql');
        $conn->exec($sql);
    }
} catch (PDOException $e) {
    // Log error but continue
    error_log('Error checking/creating car_likes table: ' . $e->getMessage());
}

// Get car ID from POST data
$carId = isset($_POST['car_id']) ? intval($_POST['car_id']) : 0;

// Get user IP address (for identifying unique users)
$userIp = $_SERVER['REMOTE_ADDR'];

// Response array
$response = [
    'success' => false,
    'message' => '',
    'is_liked' => false
];

// Validate car ID
if ($carId <= 0) {
    $response['message'] = 'Invalid car ID';
} else {
    try {
        // Check if user already liked this car
        $stmt = $conn->prepare("SELECT id FROM car_likes WHERE car_id = :car_id AND user_ip = :user_ip");
        $stmt->bindParam(':car_id', $carId);
        $stmt->bindParam(':user_ip', $userIp);
        $stmt->execute();
        
        $existingLike = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existingLike) {
            // User already liked this car, so remove the like
            $stmt = $conn->prepare("DELETE FROM car_likes WHERE id = :id");
            $stmt->bindParam(':id', $existingLike['id']);
            $stmt->execute();
            
            // Update is_favorite in cars table
            $stmt = $conn->prepare("UPDATE cars SET is_favorite = 0 WHERE id = :car_id");
            $stmt->bindParam(':car_id', $carId);
            $stmt->execute();
            
            $response['success'] = true;
            $response['message'] = 'Car unliked successfully';
            $response['is_liked'] = false;
        } else {
            // User hasn't liked this car yet, so add a like
            $stmt = $conn->prepare("INSERT INTO car_likes (car_id, user_ip) VALUES (:car_id, :user_ip)");
            $stmt->bindParam(':car_id', $carId);
            $stmt->bindParam(':user_ip', $userIp);
            $stmt->execute();
            
            // Update is_favorite in cars table
            $stmt = $conn->prepare("UPDATE cars SET is_favorite = 1 WHERE id = :car_id");
            $stmt->bindParam(':car_id', $carId);
            $stmt->execute();
            
            $response['success'] = true;
            $response['message'] = 'Car liked successfully';
            $response['is_liked'] = true;
        }
    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
}

// Send response
if ($isAjax) {
    // If AJAX request, return JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If regular form submission, redirect back
    $redirectUrl = '/car-detail?id=' . $carId;
    if ($response['success']) {
        $redirectUrl .= '&like_status=' . ($response['is_liked'] ? 'added' : 'removed');
    } else {
        $redirectUrl .= '&error=' . urlencode($response['message']);
    }
    
    header('Location: ' . $redirectUrl);
}
exit;
