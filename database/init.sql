-- Maak de database aan
CREATE DATABASE IF NOT EXISTS rental;
USE rental;

-- Maak de account tabel aan
CREATE TABLE IF NOT EXISTS account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Maak de cars tabel aan
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    transmission VARCHAR(50) NOT NULL,
    fuel_capacity VARCHAR(50) NOT NULL,
    capacity INT NOT NULL,
    description TEXT,
    status ENUM('available', 'rented') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Maak de rentals tabel aan
CREATE TABLE IF NOT EXISTS rentals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    user_id INT NOT NULL,
    pickup_date DATETIME NOT NULL,
    return_date DATETIME NOT NULL,
    pickup_location VARCHAR(100) NOT NULL,
    return_location VARCHAR(100) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    extra_insurance BOOLEAN DEFAULT FALSE,
    child_seat BOOLEAN DEFAULT FALSE,
    gps BOOLEAN DEFAULT FALSE,
    winter_tires BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES account(id) ON DELETE CASCADE
);

-- Maak de reviews tabel aan
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES account(id) ON DELETE CASCADE
);

-- Voeg voorbeeld auto's toe als de tabel leeg is
INSERT INTO cars (brand, model, year, price, category, transmission, fuel_capacity, capacity, image_url, description)
SELECT * FROM (
    SELECT 'Volkswagen' as brand, 'Golf' as model, 2022 as year, 75.00 as price, 'Economy' as category, 'Automaat' as transmission, 'Benzine' as fuel_capacity, 5 as capacity, '/assets/images/cars/golf.jpg' as image_url, 'Een zuinige en betrouwbare Volkswagen Golf.' as description
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM cars LIMIT 1); 