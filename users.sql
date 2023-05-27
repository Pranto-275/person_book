-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 08:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `c_password` varchar(255) NOT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `last_update` date NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `email`, `phone`, `is_active`, `password`, `c_password`, `join_date`, `last_update`, `profile_image`, `cover_image`) VALUES
(1, '88241', 'alax', 'gede@mailinator.com', '37', 1, 'Pa$$w0rd!', 'Pa$$w0rd!', '2023-05-10', '2023-05-10', '', ''),
(2, '12055', 'zolyka', 'ridanytuf@mailinator.com', '46', 1, '123', '$2y$10$1UOvOcQBEMYJOBQO.ufAFeeaLJW0xiJIn6NXaqGl672u2buN78Meu', '2023-05-10', '2023-05-10', '', ''),
(3, '45556', 'Atiqur Rahman Pranto', 'pranto.rahaman38@gmail.com', '123', 1, '$2y$10$lUJNNiL1eZF.4OOMuf66OuNqbJ76NW/5hgeEdUKbpZz/Uw2jRRGTq', '$2y$10$lUJNNiL1eZF.4OOMuf66OuNqbJ76NW/5hgeEdUKbpZz/Uw2jRRGTq', '2023-05-10', '2023-05-10', 'img/1684733756.jpg', 'img/16847337561684733756.jpg'),
(4, '47254', 'atiqur pranto', 'atiqur35-275@diu.edu.bd', '01730445326', 1, '$2y$10$Vy378ldLal6jpRrbPF3tU.pKE9.hzsbgJfA7rzfO/Sc287coE6nPW', '$2y$10$Vy378ldLal6jpRrbPF3tU.pKE9.hzsbgJfA7rzfO/Sc287coE6nPW', '2023-05-10', '2023-05-10', 'img/1684731357.jpg', 'img/1684731454.jpg'),
(5, '91955', 'Najmul Hasan', 'nazmul15-12366@diu.edu.bd', '0177777777', 1, '$2y$10$gLGH93TDGNZP0mAzA5GVMOATtYKFzRXftGQtj8fJLXAgr0PUKhe3u', '$2y$10$gLGH93TDGNZP0mAzA5GVMOATtYKFzRXftGQtj8fJLXAgr0PUKhe3u', '2023-05-22', '2023-05-22', 'img/1684731357.jpg', 'img/1685164881.jpg'),
(6, '45603', 'sporsho', 'ashilreza12@gmail.com', '0185552148862', 1, '$2y$10$pyRxFMFy42JuxNI7JZsY4.o31b7hhqhVJqZNfqfxfo0R.5ihYo8LS', '$2y$10$pyRxFMFy42JuxNI7JZsY4.o31b7hhqhVJqZNfqfxfo0R.5ihYo8LS', '2023-05-23', '2023-05-23', 'img/1684841880.jpg', 'img/1684841924.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
