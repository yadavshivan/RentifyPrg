-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 11:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentify`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `property_id`, `created_at`) VALUES
(1, 5, 1, '2024-05-19 07:59:34'),
(2, 5, 1, '2024-05-19 07:59:35'),
(3, 5, 1, '2024-05-19 07:59:36'),
(4, 5, 1, '2024-05-19 08:10:44'),
(5, 5, 1, '2024-05-19 08:10:48'),
(6, 5, 1, '2024-05-19 08:13:32'),
(7, 5, 1, '2024-05-19 08:16:07'),
(8, 5, 1, '2024-05-19 08:17:19'),
(9, 5, 1, '2024-05-19 09:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `place` varchar(100) NOT NULL,
  `area` varchar(50) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `nearby_facilities` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `title`, `place`, `area`, `bedrooms`, `bathrooms`, `description`, `nearby_facilities`, `created_at`) VALUES
(1, 3, 'test', 'pune', '23444', 23, 23, 'dnbcmznczmcbxn', 'jhbxzc', '2024-05-19 05:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('seller','buyer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `user_type`, `created_at`) VALUES
(1, 'shivani', 'yadav', 'yadavshivanjali14@gmail.com', '5648365945', '$2y$10$Dn1DklugWrwkmU03r5grQ.4jM9Xa5InUi5BBfG7EVX2D2v5YWXQde', 'seller', '2024-05-19 05:20:33'),
(3, 'shivani', 'yadav', 'yadavshivanjali59@gmail.com', '+918767957084', '$2y$10$hDKtU0W.ISAjYqoTt7Dbqe1SDp5FMaQ4fzbm4cy9LuaOVeQOjdquu', 'seller', '2024-05-19 05:30:01'),
(4, 'meena', 'yadav', 'meena@123gmai.com', '1234565434', '$2y$10$Y6LV2XMR0UsCY0ayBzBND.o9k5ok25I2aMRT1x8yKpht9PJh1Yn7K', 'seller', '2024-05-19 06:19:37'),
(5, 'Shiv', 'yadav', 'admin@jhamobi.com', '12345678', '$2y$10$.j3glA5Q7OASvg7psgRFXuDwyE449F2i/dqolQQmaYh6wYaO/sxsi', 'buyer', '2024-05-19 07:10:29'),
(6, 'nila', 'mane', 'nila12@gmail.com', '66554433', '$2y$10$662fL1hmqmJedZY5rhheoenk3xeTKzQF1JIs.QuXrKCOUIYVaZff.', 'buyer', '2024-05-19 08:46:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
