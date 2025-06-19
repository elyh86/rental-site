<?php

function getDatabaseConnection() {
    $username = "root";
    $password = "";
    $dbname = "auto_project";
    
    try {
        $conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Create a global connection variable for backward compatibility
$conn = getDatabaseConnection();