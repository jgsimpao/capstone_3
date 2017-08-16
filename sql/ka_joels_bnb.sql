-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 03:45 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ka_joels_bnb`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_07_26_082529_create_rooms_table', 1),
(4, '2017_07_26_083328_create_reservations_table', 1),
(5, '2017_07_27_010404_create_roles_table', 1),
(6, '2017_07_27_105403_create_pictures_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `file_path`, `room_id`, `created_at`, `updated_at`) VALUES
(1, 'images/rooms/201A/bed.jpg', 1, NULL, NULL),
(2, 'images/rooms/201A/side-1.jpg', 1, NULL, NULL),
(3, 'images/rooms/201A/side-2.jpg', 1, NULL, NULL),
(4, 'images/rooms/201A/side-3.jpg', 1, NULL, NULL),
(5, 'images/rooms/201B/bed.jpg', 2, NULL, NULL),
(6, 'images/rooms/201B/side-1.jpg', 2, NULL, NULL),
(7, 'images/rooms/201B/side-2.jpg', 2, NULL, NULL),
(8, 'images/rooms/201B/side-3.jpg', 2, NULL, NULL),
(9, 'images/rooms/202A/bed.jpg', 3, NULL, NULL),
(10, 'images/rooms/202A/side-1.jpg', 3, NULL, NULL),
(11, 'images/rooms/202A/side-2.jpg', 3, NULL, NULL),
(12, 'images/rooms/202A/side-3.jpg', 3, NULL, NULL),
(13, 'images/rooms/202B/bed.jpg', 4, NULL, NULL),
(14, 'images/rooms/202B/side-1.jpg', 4, NULL, NULL),
(15, 'images/rooms/202B/side-2.jpg', 4, NULL, NULL),
(16, 'images/rooms/202B/side-3.jpg', 4, NULL, NULL),
(17, 'images/rooms/201E/bed.jpg', 5, NULL, NULL),
(18, 'images/rooms/201E/side-1.jpg', 5, NULL, NULL),
(19, 'images/rooms/201E/side-2.jpg', 5, NULL, NULL),
(20, 'images/rooms/201E/side-3.jpg', 5, NULL, NULL),
(21, 'images/rooms/201F/bed.jpg', 6, NULL, NULL),
(22, 'images/rooms/201F/side-1.jpg', 6, NULL, NULL),
(23, 'images/rooms/201F/side-2.jpg', 6, NULL, NULL),
(24, 'images/rooms/201F/side-3.jpg', 6, NULL, NULL),
(25, 'images/rooms/202E/bed.jpg', 7, NULL, NULL),
(26, 'images/rooms/202E/side-1.jpg', 7, NULL, NULL),
(27, 'images/rooms/202E/side-2.jpg', 7, NULL, NULL),
(28, 'images/rooms/202E/side-3.jpg', 7, NULL, NULL),
(29, 'images/rooms/202F/bed.jpg', 8, NULL, NULL),
(30, 'images/rooms/202F/side-1.jpg', 8, NULL, NULL),
(31, 'images/rooms/202F/side-2.jpg', 8, NULL, NULL),
(32, 'images/rooms/202F/side-3.jpg', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `persons` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `exclusive` tinyint(4) NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `rate_night` decimal(15,2) NOT NULL,
  `rate_week` decimal(15,2) NOT NULL,
  `rate_month` decimal(15,2) NOT NULL,
  `amenities` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_code`, `capacity`, `rate_night`, `rate_week`, `rate_month`, `amenities`, `created_at`, `updated_at`) VALUES
(1, '201A', 2, '750.00', '5000.00', '20000.00', 'STANDARD B&B ROOM AMENITIES', NULL, NULL),
(2, '201B', 2, '750.00', '5000.00', '20000.00', 'STANDARD B&B ROOM AMENITIES', NULL, NULL),
(3, '202A', 2, '750.00', '5000.00', '20000.00', 'STANDARD B&amp;B ROOM AMENITIES', NULL, '2017-08-06 17:06:19'),
(4, '202B', 2, '750.00', '5000.00', '20000.00', 'STANDARD B&B ROOM AMENITIES', NULL, NULL),
(5, '201E', 2, '750.00', '5000.00', '20000.00', 'STANDARD B&B ROOM AMENITIES', NULL, NULL),
(6, '201F', 2, '750.00', '5000.00', '20000.00', 'STANDARD B&B ROOM AMENITIES', NULL, NULL),
(7, '202E', 2, '750.00', '5000.00', '20000.00', 'STANDARD B&B ROOM AMENITIES', NULL, NULL),
(8, '202F', 2, '750.00', '5000.00', '20000.00', 'STANDARD B&B ROOM AMENITIES', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Joel', 'Simpao', '111-1111', 'admin@kajoel.com', '$2y$10$QkDpMHf9xRytpNwXY1ATEuCYc.Bq.Z4Trw/BHQJ9LU8Lx4cNWzXw6', 1, 'bK5UjhbsiM12jrjExGEzGkRvmwwOmvY07CPxnrdtqB7DnyPrrdQl1a7efKaC', NULL, NULL),
(2, 'Test', 'Acct', '222-2222', 'test@acct.com', '$2y$10$sfgvJ/i1O7fY3hKk4sq87ufP.O.JzOyK6Bg258PMWYsHWqOkCApaG', 2, '1SDrnNaqUWuf7gZlOR8m4MVHVus2veN87yrEEtboQ6wFJ61UfuaqFrZ6RACs', '2017-08-06 17:03:29', '2017-08-06 17:03:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pictures_file_path_unique` (`file_path`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_room_code_unique` (`room_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
