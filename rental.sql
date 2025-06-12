-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 12:50 PM
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
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `role`) VALUES
(9, 'kelvin@kelvin.nl', '$2y$12$w2fuXiPg1m2jC.C9BCCB5ebeEPNUcwxVp2StqdFJa9y62xwwmfKWK', NULL),
(10, 'cassandra@cassandra.nl', '$2y$12$pVGqaOKe9t0QZZozeub4ueghtgx09JEKWb/ohSPhh6VCucC8Zpplm', NULL),
(12, 'asd@a.a', '$2y$14$Vtj86ZbqM1.yLcW4gS84DeT3z1WP6J2c2Yfiw0hq3gpJxQzgUA1eC', NULL),
(13, 'asd@aaa.aaa', '$2y$14$ZRaOk2dNQPjopEgYOtQvMepDdUyQ9p1YJlHrqPzHtmVHvHWIhoJou', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `type` enum('regular','business') NOT NULL,
  `category` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `capacity` varchar(50) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `fuel_capacity` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `type`, `category`, `image_url`, `description`, `capacity`, `transmission`, `fuel_capacity`, `price`, `original_price`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 'Koenigsegg', '', 'regular', 'Sport', 'assets/images/products/car (0).svg', 'De Koenigsegg is een Zweedse hypercar met adembenemende prestaties. Met zijn lichtgewicht constructie en krachtige motor biedt deze auto een ongeëvenaarde rijervaring voor liefhebbers van pure snelheid.', '2 People', 'Manual', '90l', 99.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(2, 'Nissan GT - R', '', 'regular', 'Sport', 'assets/images/products/car (1).svg', 'De Nissan GT-R, ook bekend als \"Godzilla\", is een technologisch wonder met een handgemaakte twin-turbo V6. De AWD-configuratie en geavanceerde elektronica maken het een van de snelste productieauto\'s op het circuit.', '2 People', 'Manual', '70l', 80.00, 100.00, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(3, 'Rolls - Royce', '', 'regular', 'Sedan', 'assets/images/products/car (2).svg', 'De Rolls-Royce staat synoniem voor ultieme luxe en verfijning. Met zijn handgemaakte interieur en fluisterstille motor biedt deze auto een ongeëvenaarde comfortabele rijervaring voor de meest veeleisende klanten.', '4 People', 'Manual', '80l', 96.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(4, 'Nissan GT - R', '', 'regular', 'Sport', 'assets/images/products/car (3).svg', 'De Nissan GT-R combineert Japanse technologie met indrukwekkende prestaties. Deze iconische sportwagen biedt superieure handling en snelheid, met een twin-turbo V6 motor die pure kracht levert in alle omstandigheden.', '2 People', 'Manual', '70l', 80.00, 100.00, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(5, 'All New Rush', '', 'regular', 'SUV', 'assets/images/products/car (4).svg', 'De All New Rush is een veelzijdige SUV die ruimte en comfort combineert met betrouwbaarheid. Perfect voor zowel stedelijke ritten als avontuurlijke uitstapjes, met voldoende ruimte voor het hele gezin.', '6 People', 'Manual', '70l', 72.00, 80.00, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(6, 'CR - V', '', 'regular', 'SUV', 'assets/images/products/car (5).svg', 'De CR-V is een premium SUV met uitstekende rijeigenschappen en een ruim interieur. Deze veelzijdige auto biedt een comfortabele en veilige rijervaring voor het hele gezin, met de nieuwste technologische snufjes.', '6 People', 'Manual', '80l', 80.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(7, 'All New Terios', '', 'regular', 'SUV', 'assets/images/products/car (6).svg', 'De All New Terios is een compacte SUV die wendbaarheid combineert met avontuurlijke capaciteiten. Met zijn zuinige motor en verhoogde bodemvrijheid is deze auto perfect voor zowel stadsritten als uitstapjes buiten de gebaande paden.', '6 People', 'Manual', '70l', 74.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(8, 'CR - V', '', 'regular', 'SUV', 'assets/images/products/car (7).svg', 'De CR-V is bekend om zijn betrouwbaarheid en veelzijdigheid. Met een ruim interieur, zuinige motor en uitstekende veiligheidsvoorzieningen is dit een ideale gezinswagen voor dagelijks gebruik en langere reizen.', '6 People', 'Manual', '80l', 80.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(9, 'MG ZX Exclusice', '', 'regular', 'Hatchback', 'assets/images/products/car (8).svg', 'De MG ZX Exclusice is een stijlvolle hatchback met een modern design en uitstekende prestaties. Deze auto biedt een perfecte balans tussen comfort, stijl en rijplezier voor de moderne bestuurder.', '4 People', 'Manual', '70l', 76.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(10, 'New MG ZS', '', 'regular', 'SUV', 'assets/images/products/car (9).svg', 'De New MG ZS is een compacte SUV die stijl en betaalbaarheid combineert. Met zijn ruime interieur, moderne technologie en efficiënte motor biedt deze auto uitstekende waarde voor gezinnen en avonturiers.', '6 People', 'Manual', '80l', 80.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(11, 'MG ZX Excite', '', 'regular', 'Hatchback', 'assets/images/products/car (10).svg', 'De MG ZX Excite biedt een opwindende rijervaring in een compacte en stijlvolle hatchback. Met sportieve handling, moderne technologie en een efficiënte motor is dit de perfecte auto voor de enthousiaste bestuurder.', '4 People', 'Manual', '70l', 74.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(12, 'New MG ZS', '', 'regular', 'SUV', 'assets/images/products/car (11).svg', 'De New MG ZS is een moderne SUV met een stijlvol design en uitstekende prestaties. Met zijn ruime interieur, geavanceerde veiligheidsvoorzieningen en zuinige motor biedt deze auto een comfortabele rijervaring voor het hele gezin.', '6 People', 'Manual', '80l', 80.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(13, 'Citroën', 'Berlingo', 'business', 'Transport', 'assets/images/citroene.avif', 'De Citroën Berlingo combineert functionaliteit met comfort. Deze compacte bedrijfswagen biedt een verrassend ruim laadvolume van 3,3m³ en heeft innovatieve schuifdeuren aan beide zijden voor gemakkelijke toegang. Perfect voor stedelijk gebruik.', '3 Personen', 'Schakel', '50l', 89.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(14, 'Volkswagen', 'Transporter T6', 'business', 'Transport', 'assets/images/bedrijfswagens/bedrijfswagen1.jpg', 'De Volkswagen Transporter T6 is een van de meest betrouwbare bedrijfswagens op de markt. Met een laadvolume tot 9,3m³ en de nieuwste veiligheidstechnologie biedt het de perfecte balans tussen capaciteit en rijcomfort.', '3 Personen', 'Schakel', '70l', 94.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(15, 'Mercedes-Benz', 'Sprinter', 'business', 'Transport', 'assets/images/bedrijfswagens/bedrijfswagen2.jpg', 'De Mercedes-Benz Sprinter staat voor premium kwaliteit in het bedrijfswagensegment. Met zijn ruime interieur, connectiviteitsdiensten en assistentiesystemen levert deze grote bestelwagen topprestaties voor veeleisende professionals.', '3 Personen', 'Automaat', '75l', 109.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(16, 'Ford', 'Transit Custom', 'business', 'Transport', 'assets/images/bedrijfswagens/bedrijfswagen3.jpg', 'De Ford Transit Custom biedt een laadvermogen tot 1.450 kg en slimme opbergoplossingen. Deze middelgrote bestelwagen is uitgerust met de nieuwste Ford EcoBlue diesel-motoren voor optimale brandstofefficiëntie.', '3 Personen', 'Schakel', '70l', 92.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(17, 'Renault', 'Trafic', 'business', 'Transport', 'assets/images/bedrijfswagens/bedrijfswagen4.jpg', 'De Renault Trafic is ontworpen met de moderne ondernemer in gedachten. Met een laadruimte die tot 8,6m³ kan bereiken en innovatieve oplossingen zoals het doorlaadluik onder de passagiersstoel, is veelzijdigheid gegarandeerd.', '3 Personen', 'Schakel', '80l', 89.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(18, 'Opel', 'Vivaro', 'business', 'Transport', 'assets/images/bedrijfswagens/bedrijfswagen5.jpg', 'De Opel Vivaro is een bedrijfswagen met veel comfort en functionaliteit. Met een payload tot 1.400 kg en innovatieve FlexCargo-functie kan je lange voorwerpen gemakkelijk vervoeren. De zuinige motoren houden de operationele kosten laag.', '3 Personen', 'Schakel', '70l', 88.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(19, 'Peugeot', 'Expert', 'business', 'Transport', 'assets/images/bedrijfswagens/bedrijfswagen6.jpg', 'De Peugeot Expert biedt de wendbaarheid van een personenauto met de capaciteit van een bedrijfswagen. Met een hoogte van minder dan 1,90 m heeft u toegang tot de meeste parkeergarages, terwijl u nog steeds een laadvolume tot 6,6m³ heeft.', '3 Personen', 'Schakel', '69l', 90.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(20, 'Fiat', 'Ducato', 'business', 'Transport', 'assets/images/bedrijfswagens/bedrijfswagen7.jpg', 'De Fiat Ducato is een grote bedrijfswagen met een laadvolume tot 17m³ en een payload tot 2.200 kg. De MultiJet-motoren bieden een uitstekende combinatie van kracht en zuinigheid voor zwaar transport.', '3 Personen', 'Schakel', '90l', 99.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54'),
(21, 'Iveco', 'Daily', 'business', 'Transport', 'assets/images/bedrijfswagens/bedrijfswagen8.jpg', 'De Iveco Daily onderscheidt zich door zijn robuuste constructie en veelzijdigheid. Met een laadvolume tot 19,6m³ en een trekvermogen tot 3.500 kg is geen enkele taak te groot. De geavanceerde connectiviteitsfuncties maken wagenparkbeheer eenvoudig.', '3 Personen', 'Schakel', '100l', 105.00, NULL, 1, '2025-05-16 12:00:54', '2025-05-16 12:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `remember_tokens`
--

CREATE TABLE `remember_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_car_type` (`type`);

--
-- Indexes for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD CONSTRAINT `remember_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
