-- Maak de cars tabel
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
    type VARCHAR(50) NOT NULL,
    status ENUM('available', 'rented') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Maak de rentals tabel
CREATE TABLE IF NOT EXISTS rentals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    user_id INT NOT NULL,
    pickup_date DATETIME NOT NULL,
    return_date DATETIME NOT NULL,
    pickup_location VARCHAR(100) NOT NULL,
    return_location VARCHAR(100) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('active', 'completed', 'cancelled') DEFAULT 'active',
    extra_insurance BOOLEAN DEFAULT FALSE,
    child_seat BOOLEAN DEFAULT FALSE,
    gps BOOLEAN DEFAULT FALSE,
    winter_tires BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Voeg wat voorbeeld auto's toe
INSERT INTO cars (brand, model, year, price, image_url, category, transmission, fuel_capacity, capacity, type) VALUES
('Toyota', 'Corolla', 2022, 45.00, '/assets/images/cars/toyota-corolla.jpg', 'Sedan', 'Automatisch', '1.6L', 5, 'regular'),
('Volkswagen', 'Golf', 2021, 50.00, '/assets/images/cars/vw-golf.jpg', 'Hatchback', 'Handmatig', '1.4L', 5, 'regular'),
('BMW', '3 Series', 2023, 75.00, '/assets/images/cars/bmw-3.jpg', 'Luxe', 'Automatisch', '2.0L', 5, 'regular'),
('Mercedes', 'C-Class', 2022, 80.00, '/assets/images/cars/mercedes-c.jpg', 'Luxe', 'Automatisch', '2.0L', 5, 'regular'),
('Ford', 'Transit', 2021, 65.00, '/assets/images/cars/ford-transit.jpg', 'Transport', 'Handmatig', '2.0L', 3, 'transport'); 