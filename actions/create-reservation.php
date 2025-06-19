<?php
session_start();
require_once __DIR__ . "/../database/connection.php";

// Redirect if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: /login-form');
    exit();
}

// Validate form data
if (empty($_POST['car_id']) || empty($_POST['pickup_date']) || empty($_POST['return_date']) || empty($_POST['price_per_day'])) {
    $_SESSION['reservation_error'] = "Alle velden zijn verplicht.";
    header('Location: /car-detail?id=' . $_POST['car_id']);
    exit();
}

$car_id = intval($_POST['car_id']);
$user_id = $_SESSION['id'];
$pickup_date = $_POST['pickup_date'];
$return_date = $_POST['return_date'];
$price_per_day = floatval(str_replace(',', '.', $_POST['price_per_day']));

// Validate dates
$pickup_timestamp = strtotime($pickup_date);
$return_timestamp = strtotime($return_date);
$current_timestamp = strtotime(date('Y-m-d'));

if ($pickup_timestamp < $current_timestamp) {
    $_SESSION['reservation_error'] = "De ophaaldatum kan niet in het verleden liggen.";
    header('Location: /car-detail?id=' . $car_id);
    exit();
}

if ($return_timestamp <= $pickup_timestamp) {
    $_SESSION['reservation_error'] = "De retourdatum moet na de ophaaldatum liggen.";
    header('Location: /car-detail?id=' . $car_id);
    exit();
}

// Calculate total days and price
$days_diff = ceil(($return_timestamp - $pickup_timestamp) / (60 * 60 * 24));
$total_price = $days_diff * $price_per_day;

try {
    // Check if car exists
    $check_car = $conn->prepare("SELECT * FROM cars WHERE id = :car_id");
    $check_car->bindParam(":car_id", $car_id);
    $check_car->execute();
    
    if ($check_car->rowCount() === 0) {
        $_SESSION['reservation_error'] = "Deze auto bestaat niet.";
        header('Location: /ons-aanbod');
        exit();
    }
    
    // Check for overlapping reservations for this car
    $check_overlapping = $conn->prepare("
        SELECT * FROM reservations 
        WHERE car_id = :car_id 
        AND status IN ('pending', 'confirmed') 
        AND ((start_date <= :pickup_date AND end_date >= :pickup_date) 
            OR (start_date <= :return_date AND end_date >= :return_date)
            OR (start_date >= :pickup_date AND end_date <= :return_date))
    ");
    $check_overlapping->bindParam(":car_id", $car_id);
    $check_overlapping->bindParam(":pickup_date", $pickup_date);
    $check_overlapping->bindParam(":return_date", $return_date);
    $check_overlapping->execute();
    
    if ($check_overlapping->rowCount() > 0) {
        $_SESSION['reservation_error'] = "Deze auto is in de gekozen periode niet beschikbaar. Kies andere data.";
        header('Location: /car-detail?id=' . $car_id);
        exit();
    }
    
    // Create the reservation
    $create_reservation = $conn->prepare("
        INSERT INTO reservations (car_id, user_id, start_date, end_date, total_price, status) 
        VALUES (:car_id, :user_id, :start_date, :end_date, :total_price, 'pending')
    ");
    $create_reservation->bindParam(":car_id", $car_id);
    $create_reservation->bindParam(":user_id", $user_id);
    $create_reservation->bindParam(":start_date", $pickup_date);
    $create_reservation->bindParam(":end_date", $return_date);
    $create_reservation->bindParam(":total_price", $total_price);
    $create_reservation->execute();
    
    $_SESSION['reservation_success'] = "Uw reservering is succesvol aangemaakt en wacht op bevestiging.";
    header('Location: /my-reservations');
    exit();
    
} catch (PDOException $e) {
    $_SESSION['reservation_error'] = "Er is een fout opgetreden bij het maken van de reservering: " . $e->getMessage();
    header('Location: /car-detail?id=' . $car_id);
    exit();
}
?>
