-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 jun 2025 om 01:01
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

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
-- Tabelstructuur voor tabel `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `role`, `profile_image`) VALUES
(9, 'kelvin@kelvin.nl', '$2y$12$w2fuXiPg1m2jC.C9BCCB5ebeEPNUcwxVp2StqdFJa9y62xwwmfKWK', NULL, NULL),
(10, 'cassandra@cassandra.nl', '$2y$12$pVGqaOKe9t0QZZozeub4ueghtgx09JEKWb/ohSPhh6VCucC8Zpplm', NULL, NULL),
(12, 'admin@example.com', '$2y$14$K/2auo4V4KVMiX/tpbLCR.khyOoZ7bVs0YukuJyvmHHvvYV7Ksqq.', NULL, NULL),
(13, 'iceyy622@gmail.com', '$2y$14$smoykcryDnZ/4VLGJQgpJO6xaIhpR8d76Vbu3X2Bxwty0czGe46me', NULL, NULL),
(14, 'Elonmusk@gmail.com', '$2y$14$hTpPXe.Tca2zOQ.ryllMi.JxNpm9WJYCCquzzHTIefWcgxfeIF6XS', NULL, NULL),
(15, 'lll@gmail.com', '$2y$12$SXmvubxeJrK2Hc/tHkD41ehGJ2x8sJyDH1CTI2kMAiAyTmieHOikq', NULL, 'assets/images/profiles/profile_15_1747905197.png'),
(16, 'osariemengrace531@gmail.com', '$2y$12$jsbAu38A.FrPD/Wt..bayeYHQz7x22E8angBAMc/mbOwkwrHtjbSG', NULL, 'assets/images/profiles/profile_16_1747905819.jpg'),
(17, 'lllk@gmail.com', '$2y$12$h8m9Z06aq7Lla9Q9CBr.t.Dhv629Khkb1/DbujKzAqGeiv9s5YIFG', NULL, 'assets/images/profiles/profile_17_1749203994.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cars`
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
-- Gegevens worden geëxporteerd voor tabel `cars`
--

INSERT INTO `cars` (`id`, `brand`, `type`, `capacity`, `steering`, `gasoline`, `price`, `old_price`, `rating`, `reviews_count`, `description`, `main_image`, `created_at`) VALUES
(1, 'Koenigsegg', 'Sport', '2 People', 'Manual', '70L', 99.00, 120.00, 0, '0', 'The Koenigsegg is a high-performance sports car known for its speed and luxury.', 'car (0).svg', '2025-06-06 11:45:52'),
(2, 'Nissan GT - R', 'Sport', '2 People', 'Manual', '70L', 80.00, 100.00, 0, '0', 'The Nissan GT-R is a high-performance sports car with advanced technology and impressive speed.', 'car (1).svg', '2025-06-06 11:45:52'),
(3, 'Rolls - Royce - Dawn', 'Sedan', '4 People', 'Manual', '70L', 96.00, 120.00, 0, '0', 'The Rolls-Royce is a luxury vehicle known for its comfort, elegance, and premium features.', 'Car (2).svg', '2025-06-06 11:45:52'),
(4, 'Nissan GT - R', 'Sport', '2 People', 'Manual', '70L', 80.00, 100.00, 0, '0', 'The Nissan GT-R is a high-performance sports car with advanced technology and impressive speed.', 'Car (3).svg', '2025-06-06 11:45:52'),
(5, 'All New Rush', 'SUV', '6 People', 'Manual', '70L', 72.00, 80.00, 0, '0', 'The All New Rush is a versatile SUV with ample space and modern features for families.', 'Car (4).svg', '2025-06-06 11:45:52'),
(6, 'CR - V', 'SUV', '6 People', 'Manual', '80L', 80.00, 100.00, 0, '0', 'The CR-V is a reliable and spacious SUV perfect for both city driving and adventures.', 'Car (5).svg', '2025-06-06 11:45:52'),
(7, 'All New Terios', 'SUV', '6 People', 'Manual', '90L', 74.00, 90.00, 0, '0', 'The All New Terios is a compact SUV with excellent handling and fuel efficiency.', 'Car (6).svg', '2025-06-06 11:45:52'),
(8, 'CR - V', 'SUV', '6 People', 'Manual', '80L', 80.00, 100.00, 0, '0', 'The MG 3 is a compact car with sporty styling and affordable running costs.', 'Car (7).svg', '2025-06-06 11:45:52'),
(9, 'MG ZX Exclusive', 'Hatchback', '4 People', 'Electric', '95L', 76.00, 80.00, 0, '0', 'The MG ZX Exclusive is a stylish hatchback with premium features and excellent fuel economy.', 'Car (8).svg', '2025-06-06 11:45:52'),
(10, 'New MG ZS', 'SUV', '6 People', 'Manual', '80L', 80.00, 100.00, 0, '0', 'The New MG ZS is a modern SUV with advanced safety features and comfortable interior.', 'Car (9).svg', '2025-06-06 11:45:52'),
(11, 'MG ZX Excite', 'Hatchback', '4 People', 'Electric', '70L', 74.00, 80.00, 0, '0', 'The MG ZX Excite is a sporty hatchback with dynamic performance and modern technology.', 'Car (10).svg', '2025-06-06 11:45:52'),
(12, 'New MG ZS', 'SUV', '6 People', 'Manual', '80L', 80.00, 100.00, 0, '0', 'The New MG ZS is a modern SUV with advanced safety features and comfortable interior.', 'Car (11).svg', '2025-06-06 11:45:52');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservations`
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
-- Gegevens worden geëxporteerd voor tabel `reservations`
--

INSERT INTO `reservations` (`id`, `car_id`, `user_id`, `start_date`, `end_date`, `total_price`, `status`, `created_at`) VALUES
(7, 1, 17, '2025-05-30', '2025-06-01', 198.00, 'pending', '2025-05-27 09:39:00'),
(8, 10, 17, '2025-06-27', '2025-06-30', 240.00, 'pending', '2025-06-05 11:02:29'),
(9, 2, 17, '2025-06-08', '2025-06-21', 1040.00, 'pending', '2025-06-05 11:05:53'),
(10, 1, 17, '2025-07-05', '2025-07-24', 1881.00, 'pending', '2025-06-06 08:21:01'),
(11, 3, 17, '2025-06-06', '2025-06-11', 480.00, 'pending', '2025-06-06 11:32:54'),
(12, 5, 17, '2025-06-14', '2025-06-22', 576.00, 'pending', '2025-06-07 14:37:44');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
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
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
