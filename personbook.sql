-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 11:53 AM
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
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(100) NOT NULL,
  `user_one` varchar(255) NOT NULL,
  `user_two` varchar(255) NOT NULL,
  `connected_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_one`, `user_two`, `connected_date`) VALUES
(19, '47254', '45556', '2023-05-27 10:03:43.962390'),
(20, '45556', '45603', '2023-05-27 10:05:27.554309'),
(21, '45603', '47254', '2023-05-27 10:06:25.498092'),
(22, '47254', '91955', '2023-05-27 10:07:16.058374');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `id` int(100) NOT NULL,
  `sender` int(100) NOT NULL,
  `receiver_id` int(100) NOT NULL,
  `send_time` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `posts` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `like_count` int(255) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `posts`, `image`, `like_count`, `created_at`) VALUES
(94, '45556', 'this is post', 'img/1684726317.jpg', 2, '2023-05-22 09:31:57'),
(95, '47254', 'Batman Dark Knight', 'img/1684735596.png', 1, '2023-05-22 12:06:36'),
(97, '45556', 'test', 'img/1684736441.jpg', 2, '2023-05-22 12:20:41'),
(98, '45603', 'Music', 'img/1684841996.jpg', 3, '2023-05-23 17:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `post_react`
--

CREATE TABLE `post_react` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `react` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_react`
--

INSERT INTO `post_react` (`id`, `user_id`, `post_id`, `react`) VALUES
(120, 45556, 0, 1),
(128, 47254, 94, 1),
(158, 45556, 94, 1),
(161, 45556, 97, 1),
(163, 45556, 95, 1),
(164, 45603, 98, 1),
(165, 45556, 98, 1),
(166, 91955, 98, 1),
(167, 91955, 97, 1);

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
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_react`
--
ALTER TABLE `post_react`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `post_react`
--
ALTER TABLE `post_react`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
