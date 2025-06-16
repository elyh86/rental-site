<?php
// Database configuratie
$host = 'localhost';
$dbname = 'rental';
$username = 'root';
$password = '';

try {
    // Maak een nieuwe database connectie
    $conn = new mysqli($host, $username, $password, $dbname);

    // Controleer de connectie
    if ($conn->connect_error) {
        throw new Exception("Connectie mislukt: " . $conn->connect_error);
    }

    // Zet de charset op utf8mb4
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    // Toon een gebruiksvriendelijke foutmelding
    die("Er is een probleem met de database connectie. Probeer het later opnieuw.");
} 