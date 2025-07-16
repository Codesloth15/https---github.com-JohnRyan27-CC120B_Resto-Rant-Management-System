-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 08:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto_rant_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_order_receipts`
--

CREATE TABLE `history_order_receipts` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `summary` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `completed_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_order_receipts`
--

INSERT INTO `history_order_receipts` (`id`, `username`, `room_id`, `room_name`, `status`, `created_at`, `summary`, `total`, `completed_at`) VALUES
(15, 'kiko', 3, '2323', 'Done', '2025-07-15 14:22:17', 'sdfsdfsdf x2 ₱66.00, Total: ₱66.00', 66.00, '2025-07-15 14:28:01'),
(16, 'kiko', 3, '2323', 'Done', '2025-07-15 14:22:37', 'df x2 ₱666.00, sdfsdfsdf x2 ₱66.00, sdsd x2 ₱400.00, sdsd x2 ₱66.00, Total: ₱1,198.00', 1198.00, '2025-07-15 14:24:53'),
(17, 'kiko', 3, '2323', 'Done', '2025-07-15 14:32:16', 'sdfsdfsdf x1 ₱33.00, Total: ₱33.00', 33.00, '2025-07-15 14:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `history_transactions`
--

CREATE TABLE `history_transactions` (
  `transaction_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `date_to_avail` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_transactions`
--

INSERT INTO `history_transactions` (`transaction_id`, `username`, `room_id`, `room_name`, `price`, `date_to_avail`, `created_at`, `status`, `completed_at`) VALUES
(1, 'niko', 1, 'ksdl;df', 3434.00, '2025-06-22', '2025-06-22 22:20:19', 'Approved', '2025-06-22 14:20:32'),
(3, 'niko', 1, 'ksdl;df', 3434.00, '2025-06-22', '2025-06-22 22:27:06', 'Approved', '2025-06-22 14:27:16'),
(4, 'kiko', 1, 'ksdl;df', 3434.00, '2025-07-15', '2025-07-15 10:13:30', 'Approved', '2025-07-15 03:52:12'),
(5, 'kiko', 1, 'ksdl;df', 3434.00, '2025-07-15', '2025-07-15 10:51:03', 'Approved', '2025-07-15 03:52:11'),
(6, 'kiko', 2, 'dfvf', 33.00, '2025-07-15', '2025-07-15 12:34:56', 'Approved', '2025-07-15 04:52:53'),
(7, 'kiko', 2, 'dfvf', 33.00, '2025-07-15', '2025-07-15 12:51:06', 'Approved', '2025-07-15 04:52:53'),
(8, 'kiko', 2, 'dfvf', 33.00, '2025-07-15', '2025-07-15 12:53:06', 'Approved', '2025-07-15 04:57:50'),
(9, 'kiko', 2, 'dfvf', 33.00, '2025-07-15', '2025-07-15 12:53:48', 'Approved', '2025-07-15 04:57:50'),
(10, 'kiko', 2, 'dfvf', 33.00, '2025-07-18', '2025-07-15 12:53:59', 'Approved', '2025-07-15 04:57:49'),
(11, 'kiko', 2, 'dfvf', 33.00, '2025-07-18', '2025-07-15 12:54:18', 'Approved', '2025-07-15 04:57:48'),
(12, 'kiko', 2, 'dfvf', 33.00, '2025-07-18', '2025-07-15 12:57:42', 'Approved', '2025-07-15 05:06:11'),
(13, 'kiko', 2, 'dfvf', 33.00, '2025-07-15', '2025-07-15 12:57:57', 'Approved', '2025-07-15 05:06:11'),
(14, 'kiko', 2, 'dfvf', 33.00, '2025-07-15', '2025-07-15 13:06:21', 'Approved', '2025-07-15 05:08:09'),
(15, 'kiko', 1, 'ksdl;df', 3434.00, '2025-07-16', '2025-07-15 13:06:56', 'Approved', '2025-07-15 05:08:08'),
(16, 'kiko', 1, 'ksdl;df', 3434.00, '2025-07-15', '2025-07-15 13:10:24', 'Approved', '2025-07-15 05:10:36'),
(17, 'kiko', 3, '2323', 22.00, '2025-07-15', '2025-07-15 13:12:47', 'Approved', '2025-07-15 05:12:57'),
(18, 'kiko', 3, '2323', 22.00, '2025-07-15', '2025-07-15 13:15:52', 'Approved', '2025-07-15 05:15:58'),
(19, 'kiko', 3, '2323', 22.00, '2025-07-15', '2025-07-15 13:46:49', 'Approved', '2025-07-15 06:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_foods`
--

CREATE TABLE `ordered_foods` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `room_name` varchar(100) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `food_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered_foods`
--

INSERT INTO `ordered_foods` (`id`, `transaction_id`, `username`, `room_id`, `room_name`, `food_id`, `food_name`, `quantity`, `total_price`, `created_at`) VALUES
(1, 0, 'niko', 0, 'N/A', 1, 'sdsd', 34, 6800.00, '2025-07-11 03:11:46'),
(2, 0, 'niko', 0, 'N/A', 1, 'sdsd', 5, 1000.00, '2025-07-11 07:54:57'),
(3, 0, 'niko', 0, 'N/A', 1, 'sdsd', 9, 1800.00, '2025-07-11 08:06:13'),
(4, 0, 'niko', 0, 'N/A', 1, 'sdsd', 5, 1000.00, '2025-07-11 08:28:42'),
(5, 0, 'niko', 0, 'N/A', 2, 'sdsd', 2, 400.00, '2025-07-11 08:28:42'),
(6, 0, 'niko', 0, 'N/A', 3, 'sdsd', 2, 400.00, '2025-07-11 08:28:42'),
(7, 0, 'niko', 0, 'N/A', 2, 'sdsd', 3, 600.00, '2025-07-11 08:40:00'),
(8, 0, 'niko', 0, 'N/A', 3, 'sdsd', 6, 1200.00, '2025-07-11 08:40:00'),
(9, 0, 'niko', 0, 'N/A', 4, 'sdsd', 4, 800.00, '2025-07-11 08:40:00'),
(10, 0, 'kiko', 0, 'N/A', 13, 'sdfsdfsdf', 3, 99.00, '2025-07-15 02:05:46'),
(11, 0, 'kiko', 0, 'N/A', 5, 'sdsd', 6, 1200.00, '2025-07-15 02:05:46'),
(12, 0, 'kiko', 0, 'N/A', 12, 'sdsd', 2, 66.00, '2025-07-15 02:05:46'),
(13, 0, 'kiko', 0, 'N/A', 5, 'sdsd', 2, 400.00, '2025-07-15 02:06:53'),
(14, 0, 'kiko', 0, 'N/A', 13, 'sdfsdfsdf', 1, 33.00, '2025-07-15 02:11:05'),
(15, 0, 'kiko', 0, 'N/A', 5, 'sdsd', 1, 200.00, '2025-07-15 02:11:05'),
(16, 1, 'kiko', 1, 'ksdl;df', 5, 'sdsd', 2, 400.00, '2025-07-15 02:13:53'),
(17, 0, 'kiko', 0, 'N/A', 14, 'df', 2, 666.00, '2025-07-15 05:42:28'),
(18, 0, 'kiko', 0, 'N/A', 13, 'sdfsdfsdf', 2, 66.00, '2025-07-15 05:42:28'),
(19, 0, 'kiko', 0, 'N/A', 12, 'sdsd', 2, 66.00, '2025-07-15 05:42:28'),
(20, 0, 'kiko', 0, 'N/A', 5, 'sdsd', 1, 200.00, '2025-07-15 05:45:34'),
(21, 3, 'kiko', 3, '2323', 13, 'sdfsdfsdf', 1, 33.00, '2025-07-15 05:47:05'),
(22, 3, 'kiko', 3, '2323', 13, 'sdfsdfsdf', 2, 66.00, '2025-07-15 05:50:52'),
(23, 3, 'kiko', 3, '2323', 5, 'sdsd', 2, 400.00, '2025-07-15 05:50:52'),
(24, 3, 'kiko', 3, '2323', 12, 'sdsd', 2, 66.00, '2025-07-15 05:50:52'),
(25, 3, 'kiko', 3, '2323', 5, 'sdsd', 2, 400.00, '2025-07-15 05:53:50'),
(26, 3, 'kiko', 3, '2323', 5, 'sdsd', 1, 200.00, '2025-07-15 05:56:39'),
(27, 3, 'kiko', 3, '2323', 5, 'sdsd', 1, 200.00, '2025-07-15 05:56:56'),
(28, 3, 'kiko', 3, '2323', 5, 'sdsd', 1, 200.00, '2025-07-15 05:57:56'),
(29, 3, 'kiko', 3, '2323', 5, 'sdsd', 1, 200.00, '2025-07-15 06:02:02'),
(30, 3, 'kiko', 3, '2323', 5, 'sdsd', 2, 400.00, '2025-07-15 06:04:09'),
(31, 3, 'kiko', 3, '2323', 14, 'df', 1, 333.00, '2025-07-15 06:06:21'),
(32, 3, 'kiko', 3, '2323', 5, 'sdsd', 2, 400.00, '2025-07-15 06:09:03'),
(33, 3, 'kiko', 3, '2323', 13, 'sdfsdfsdf', 2, 66.00, '2025-07-15 06:22:17'),
(34, 3, 'kiko', 3, '2323', 14, 'df', 2, 666.00, '2025-07-15 06:22:37'),
(35, 3, 'kiko', 3, '2323', 13, 'sdfsdfsdf', 2, 66.00, '2025-07-15 06:22:37'),
(36, 3, 'kiko', 3, '2323', 5, 'sdsd', 2, 400.00, '2025-07-15 06:22:37'),
(37, 3, 'kiko', 3, '2323', 12, 'sdsd', 2, 66.00, '2025-07-15 06:22:37'),
(38, 3, 'kiko', 3, '2323', 13, 'sdfsdfsdf', 1, 33.00, '2025-07-15 06:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_receipts`
--

CREATE TABLE `order_receipts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Done') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rage_rooms`
--

CREATE TABLE `rage_rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `room_type` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `props` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rage_rooms`
--

INSERT INTO `rage_rooms` (`id`, `name`, `description`, `room_type`, `price`, `image_path`, `created_at`, `props`, `status`) VALUES
(3, '2323', '23', 'Solo', 22.00, 'uploads/Desktop_Screenshot_2025.07.11_-_10.45.32.20-removebg-preview.png', '2025-07-15 05:12:06', 'eee', 'Available'),
(4, 'Smash Room', 'Break plates, TVs, and glassware in our safest, most satisfying rage zone.', 'Couple', 200.00, 'uploads/rageroom1.jpg', '2025-07-16 02:00:22', 'Bat Wood Tire', 'available'),
(5, 'Smash Room', 'Break plates, TVs, and glassware in our safest, most satisfying rage zone.', 'Couple', 200.00, 'uploads/rageroom1.jpg', '2025-07-16 03:49:00', 'Bat Wood Tire', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `resto_menu`
--

CREATE TABLE `resto_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` enum('Meal','Drink','Snack','Dessert','Other') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resto_menu`
--

INSERT INTO `resto_menu` (`id`, `name`, `description`, `category`, `price`, `image_path`, `created_at`, `photo`) VALUES
(5, 'sdsd', 'sdsd', 'Drink', 200.00, NULL, '2025-07-11 08:08:23', 'uploads/6870c677bfba0.png'),
(12, 'sdsd', 'sdsd', 'Snack', 33.00, NULL, '2025-07-11 08:34:16', 'uploads/6870cc8899aef.png'),
(13, 'sdfsdfsdf', 'dfdf', 'Drink', 33.00, NULL, '2025-07-15 02:04:44', 'uploads/6875b73ca372a.png'),
(14, 'df', 'dfdf', 'Drink', 333.00, NULL, '2025-07-15 02:26:02', 'uploads/6875bc3ac746b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `username`, `rating`, `message`, `created_at`) VALUES
(1, 'your_username', 5, 'This was an amazing experience! Loved every minute.', '2025-06-24 14:33:22'),
(2, 'alex_rage', 5, 'Insanely fun! The rage room is therapeutic!', '2025-06-24 14:34:08'),
(3, 'jenny_s', 4, 'Loved the vibe. The staff was very helpful.', '2025-06-24 14:34:08'),
(4, 'matt_destroyer', 5, 'Best place to let off steam. Highly recommend.', '2025-06-24 14:34:08'),
(5, 'karen88', 3, 'Nice concept, but could be cleaner.', '2025-06-24 14:34:08'),
(6, 'ronnie_blaze', 4, 'Food was great, rage room was better!', '2025-06-24 14:34:08'),
(7, 'smashqueen', 5, 'I came, I smashed, I conquered.', '2025-06-24 14:34:08'),
(8, 'timmy_the_smasher', 4, 'Could use more smashables, but still fun.', '2025-06-24 14:34:08'),
(9, 'lucy_m', 5, 'Awesome combo of food and destruction.', '2025-06-24 14:34:08'),
(10, 'harry_knocks', 4, 'Loved it! Will definitely come back with friends.', '2025-06-24 14:34:08'),
(11, 'zara_strikes', 5, 'One of the best stress relievers I’ve tried!', '2025-06-24 14:34:08'),
(12, 'niko', 3, 'afv sdfvdfvsdfv', '2025-07-12 14:50:27'),
(13, 'niko', 3, 'afv sdfvdfvsdfv', '2025-07-12 14:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date_to_avail` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `hours` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `username`, `password`, `role`) VALUES
(1, 'Charlou', 'ybarleycharlou04@gmail.com', '09277433290', 'Appas Tabuk City Kalinga', 'niko', '$2y$10$p0KN40p0.crQisfmA6kKz.YVDI0iG/g9.s85rrw7UxfUbcbSgCCoe', 'admin\r\n'),
(2, 'sdfgsdf', 'sdfgsdfg@gmail.com', '09277433290', 'AppasTabukCity', 'drfdf', '$2y$10$kgqkK4f1Y.GT/glUl9D.neVIoeFyk6c61HWcQ2bSCEHRLXrFAFbTK', 'user'),
(3, 'Charlou', 'charlou@gmail.com', '09277433290', 'Appas Tabuk City', 'naj', '$2y$10$gsa6sbyi4Tjl.X8UcFberORDZcVp6gL92BWnRRqiYrDbwfpw/dNj2', ''),
(4, 'naj', 'naj@gmail.com', '09277422390', 'Appas Tabuk City', 'kiko', '$2y$10$ZhWXF6kAFsZZRIJwOiXnbODjmOKr2Po4uG6nSp0b0TQzjCUXLW9FS', ''),
(5, 'Charlou', 'ybarleycharlou04@gmail.com', '09277433290', 'Appas Tabuk City Kalinga', 'Cj', '$2y$10$f8ZTmHRXCIcGwwl0lc.u5.isg2LPSM1AtFsnMQVM9ZbrbX0bEq8B2', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_order_receipts`
--
ALTER TABLE `history_order_receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_transactions`
--
ALTER TABLE `history_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `ordered_foods`
--
ALTER TABLE `ordered_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_receipts`
--
ALTER TABLE `order_receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rage_rooms`
--
ALTER TABLE `rage_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resto_menu`
--
ALTER TABLE `resto_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ordered_foods`
--
ALTER TABLE `ordered_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `order_receipts`
--
ALTER TABLE `order_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rage_rooms`
--
ALTER TABLE `rage_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resto_menu`
--
ALTER TABLE `resto_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
