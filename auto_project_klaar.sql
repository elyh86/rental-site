-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 01:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auto_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `role`, `profile_image`) VALUES
(9, 'kelvin@kelvin.nl', '$2y$12$w2fuXiPg1m2jC.C9BCCB5ebeEPNUcwxVp2StqdFJa9y62xwwmfKWK', NULL, NULL),
(10, 'cassandra@cassandra.nl', '$2y$12$pVGqaOKe9t0QZZozeub4ueghtgx09JEKWb/ohSPhh6VCucC8Zpplm', NULL, NULL),
(18, 'a@a.a', '$2y$12$gBcLF5qq4UGsTkPGuyKNPuIwdyJ.ZwAGileSBJjE5TYJTc.WSqYp6', NULL, 'assets/images/profiles/profile_18_1750367764.png'),
(19, 'admin@rydr.nl', '$2y$12$62PwqQoQECbAI1MLKSdNVOe1NB/R37kJrM9Vgm7pKQRRbNvrpLNj.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `capacity` varchar(50) NOT NULL,
  `steering` varchar(50) NOT NULL,
  `gasoline` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `reviews_count` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `main_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `type`, `capacity`, `steering`, `gasoline`, `price`, `old_price`, `rating`, `reviews_count`, `description`, `main_image`, `created_at`) VALUES
(1, 'Koenigsegg', 'Sport', '2 People', 'Manual', '70L', 99.00, 120.00, 0, '0', 'The Koenigsegg is a high-performance sports car known for its speed and luxury.', 'car (0).svg', '2025-06-06 11:45:52'),
(2, 'Nissan GT - R', 'Sport', '2 People', 'Manual', '70L', 80.00, 100.00, 0, '1+ Reviewer', 'The Nissan GT-R is a high-performance sports car with advanced technology and impressive speed.', 'car (1).svg', '2025-06-06 11:45:52'),
(3, 'Rolls - Royce - Dawn', 'Sedan', '4 People', 'Manual', '70L', 96.00, 120.00, 0, '0', 'The Rolls-Royce is a luxury vehicle known for its comfort, elegance, and premium features.', 'Car (2).svg', '2025-06-06 11:45:52'),
(4, 'Nissan GT - R', 'Sport', '2 People', 'Manual', '70L', 80.00, 100.00, 0, '0', 'The Nissan GT-R is a high-performance sports car with advanced technology and impressive speed.', 'Car (3).svg', '2025-06-06 11:45:52'),
(5, 'All New Rush', 'SUV', '6 People', 'Manual', '70L', 72.00, 80.00, 0, '0', 'The All New Rush is a versatile SUV with ample space and modern features for families.', 'Car (4).svg', '2025-06-06 11:45:52'),
(6, 'CR - V', 'SUV', '6 People', 'Manual', '80L', 80.00, 100.00, 0, '0', 'The CR-V is a reliable and spacious SUV perfect for both city driving and adventures.', 'Car (5).svg', '2025-06-06 11:45:52'),
(7, 'All New Terios', 'SUV', '6 People', 'Manual', '90L', 74.00, 90.00, 0, '0', 'The All New Terios is a compact SUV with excellent handling and fuel efficiency.', 'Car (6).svg', '2025-06-06 11:45:52'),
(8, 'CR - V', 'SUV', '6 People', 'Manual', '80L', 80.00, 100.00, 0, '0', 'The MG 3 is a compact car with sporty styling and affordable running costs.', 'Car (7).svg', '2025-06-06 11:45:52'),
(9, 'MG ZX Exclusive', 'Hatchback', '4 People', 'Electric', '95L', 76.00, 80.00, 0, '0', 'The MG ZX Exclusive is a stylish hatchback with premium features and excellent fuel economy.', 'Car (8).svg', '2025-06-06 11:45:52'),
(10, 'New MG ZS', 'SUV', '6 People', 'Manual', '80L', 80.00, 100.00, 0, '0', 'The New MG ZS is a modern SUV with advanced safety features and comfortable interior.', 'Car (9).svg', '2025-06-06 11:45:52'),
(11, 'MG ZX Excite', 'Hatchback', '4 People', 'Electric', '70L', 74.00, 80.00, 0, '0', 'The MG ZX Excite is a sporty hatchback with dynamic performance and modern technology.', 'Car (10).svg', '2025-06-06 11:45:52'),
(12, 'New MG ZS', 'SUV', '6 People', 'Manual', '80L', 80.00, 100.00, 0, '0', 'The New MG ZS is a modern SUV with advanced safety features and comfortable interior.', 'Car (11).svg', '2025-06-06 11:45:52'),
(13, 'Mercedes-Benz', 'Bedrijfsbus', '8 People', 'Manual', '75L', 85.00, 95.00, 0, '0', 'De Mercedes-Benz bedrijfsbus is ideaal voor zakelijk vervoer en transport. Ruim, betrouwbaar en comfortabel voor zowel passagiers als goederen. Perfect voor bedrijfsuitjes, transport en logistiek.', 'pngtree-photo-white-van-png-image_11538407.png', '2025-06-19 23:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','canceled','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `car_id`, `user_id`, `start_date`, `end_date`, `total_price`, `status`, `created_at`) VALUES
(13, 2, 19, '2025-06-21', '2025-06-23', 160.00, 'pending', '2025-06-19 23:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `date` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `car_id`, `name`, `position`, `date`, `rating`, `comment`) VALUES
(1, 2, 'Mooie Auto', 'Klant', '19 June 2025', 1, 'Prachtig');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
