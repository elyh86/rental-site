<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Controleer of gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header('Location: /login-form');
    exit;
}

// Controleer of het een POST request is
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /our-offer');
    exit;
}

try {
    // Valideer de benodigde velden
    $required_fields = ['car_id', 'pickup_date', 'return_date', 'pickup_location', 'return_location'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            throw new Exception("Veld {$field} is verplicht");
        }
    }

    // Haal de auto op om de prijs te berekenen
    $stmt = $conn->prepare("SELECT price FROM cars WHERE id = ?");
    $stmt->bind_param("i", $_POST['car_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_assoc();

    if (!$car) {
        throw new Exception("Auto niet gevonden");
    }

    // Bereken het aantal dagen
    $pickup_date = new DateTime($_POST['pickup_date']);
    $return_date = new DateTime($_POST['return_date']);
    $interval = $pickup_date->diff($return_date);
    $days = $interval->days + 1; // +1 omdat we ook de eerste dag meetellen

    // Bereken de totaalprijs
    $total_price = $car['price'] * $days;

    // Voeg extra's toe aan de prijs
    if (isset($_POST['extra_insurance']) && $_POST['extra_insurance'] === 'true') {
        $total_price += 15 * $days;
    }
    if (isset($_POST['child_seat']) && $_POST['child_seat'] === 'true') {
        $total_price += 5 * $days;
    }
    if (isset($_POST['gps']) && $_POST['gps'] === 'true') {
        $total_price += 10 * $days;
    }
    if (isset($_POST['winter_tires']) && $_POST['winter_tires'] === 'true') {
        $total_price += 20 * $days;
    }

    // Voeg de verhuur toe aan de database
    $stmt = $conn->prepare("
        INSERT INTO rentals (
            car_id, user_id, pickup_date, return_date, 
            pickup_location, return_location, total_price,
            extra_insurance, child_seat, gps, winter_tires
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $extra_insurance = isset($_POST['extra_insurance']) && $_POST['extra_insurance'] === 'true' ? 1 : 0;
    $child_seat = isset($_POST['child_seat']) && $_POST['child_seat'] === 'true' ? 1 : 0;
    $gps = isset($_POST['gps']) && $_POST['gps'] === 'true' ? 1 : 0;
    $winter_tires = isset($_POST['winter_tires']) && $_POST['winter_tires'] === 'true' ? 1 : 0;

    $stmt->bind_param(
        "iissssddiii",
        $_POST['car_id'],
        $_SESSION['user_id'],
        $_POST['pickup_date'],
        $_POST['return_date'],
        $_POST['pickup_location'],
        $_POST['return_location'],
        $total_price,
        $extra_insurance,
        $child_seat,
        $gps,
        $winter_tires
    );

    if (!$stmt->execute()) {
        throw new Exception("Fout bij het opslaan van de verhuur: " . $stmt->error);
    }

    // Update de status van de auto naar 'rented'
    $stmt = $conn->prepare("UPDATE cars SET status = 'rented' WHERE id = ?");
    $stmt->bind_param("i", $_POST['car_id']);
    $stmt->execute();

    // Redirect naar de verhuurde auto's pagina met een succes bericht
    header('Location: /my-rented-cars?success=1');
    exit;

} catch (Exception $e) {
    // Redirect terug naar de verhuur pagina met een foutmelding
    header('Location: /rent-car?error=' . urlencode($e->getMessage()));
    exit;
} 