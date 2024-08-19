-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2024 at 05:22 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artsy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `productid` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `productid`, `user`, `created_at`) VALUES
(28, '10', '2', '2020-12-09 18:52:32'),
(29, '11', '2', '2020-12-09 18:52:33'),
(31, '11', '3', '2024-07-15 05:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int NOT NULL,
  `oid` varchar(50) NOT NULL,
  `ptitle` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `oid`, `ptitle`, `price`) VALUES
(3, '3', 'Couple Swan', '700000'),
(4, '4', 'Gunung Fuji', '200000'),
(5, '5', 'Senja di danau', '450000'),
(6, '6', 'Makan bersama', '200000'),
(7, '7', 'Senja di Prancis', '130000'),
(8, '8', 'Me, you and the moon', '80000'),
(9, '9', 'colorful', '650000'),
(11, '11', 'face mix', '350000'),
(12, '12', 'Senja di danau', '450000');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT '0.00',
  `receiver_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user`, `address`, `created_at`, `total_amount`, `receiver_name`, `phone_number`, `postal_code`, `payment_method`) VALUES
(3, '3', 'jakarta', '2024-07-15 05:26:09', 500000.00, NULL, NULL, NULL, NULL),
(4, '4', 'kemayoran, jakarta pusat', '2024-07-15 13:13:17', 750000.00, NULL, NULL, NULL, NULL),
(5, '4', 'tanjung duren', '2024-07-15 13:14:43', 650000.00, NULL, NULL, NULL, NULL),
(7, '4', 'surabaya', '2024-07-15 13:28:38', 130000.00, NULL, NULL, NULL, NULL),
(8, '5', 'jakarta', '2024-07-17 04:26:21', 80000.00, NULL, NULL, NULL, NULL),
(9, '6', 'jakarta', '2024-07-18 17:47:30', 650000.00, NULL, NULL, NULL, NULL),
(11, '6', 'jakarta', '2024-07-18 18:16:29', 350000.00, 'bejo', '084273894329', '4223', 'bank_transfer'),
(12, '6', 'jakarta', '2024-07-19 02:27:04', 450000.00, 'bejo', '084273894329', '4223', 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `img`, `category`, `created_at`) VALUES
(1, 'kemarau', '150000', 'gambar1.jpeg', 'Nature', '2020-12-09 01:40:06'),
(2, 'Senja di danau', '450000', 'gambar2.jpeg', 'Nature', '2020-12-09 01:40:06'),
(3, 'Matahari terbenam', '80000', 'gambar3.jpeg', 'Nature', '2020-12-09 02:29:46'),
(4, 'Pesisir', '250000', 'gambar4.jpeg', 'Aesthetic', '2020-12-09 02:46:10'),
(5, 'Senja di Prancis', '130000', 'gambar5.jpeg', 'Aesthetic', '2020-12-09 02:49:43'),
(6, 'Pedesaan', '750000', 'gambar6.jpeg', 'Nature', '2020-12-09 02:49:43'),
(7, 'day and night', '100000', 'gambar7.jpeg', 'Aesthetic', '2020-12-09 02:52:06'),
(8, 'Makan bersama', '200000', 'gambar8.jpeg', 'Nature', '2020-12-09 02:53:40'),
(9, 'Afternoon', '100000', 'gambar9.jpeg', 'Aesthetic', '2020-12-09 02:56:29'),
(10, 'Gold Mountain', '1000000', 'gambar10.jpg', 'Aesthetic', '2020-12-09 02:58:11'),
(11, 'Pemandangan gunung', '690000', 'gambar11.jpg', 'Nature', '2020-12-09 03:00:21'),
(12, 'face mix', '350000', 'gambar12.jpg', 'Abstrac', '2020-12-09 03:01:29'),
(13, 'Pegunungan', '400000', 'gambar13.jpg', 'Abstrac', '2020-12-09 03:03:33'),
(14, 'Alpukat', '100000', 'gambar14.jpeg', 'Abstrac', '2020-12-09 03:05:17'),
(15, 'Rumah', '1500000', 'gambar15.jpg', 'Nature', '2020-12-09 03:07:05'),
(16, 'Gunung Fuji', '200000', 'gambar16.jpg', 'Nature', '2020-12-09 03:08:13'),
(17, 'Afternoon Vibes', '80000', 'gambar17.jpg', 'Aesthetic', '2020-12-09 03:09:21'),
(18, 'Me, you and the moon', '80000', 'gambar18.jpg', 'Aesthetic', '2020-12-09 03:10:27'),
(19, 'Mountain view at night', '2000000', 'gambar19.jpg', 'Nature', '2020-12-09 03:11:33'),
(20, 'Couple Swan', '700000', 'gambar20.jpg', 'Nature', '2020-12-09 03:13:02'),
(21, 'Aurora Green', '85000', 'gambar21.jpeg', 'Nature', '2020-12-09 03:14:09'),
(22, 'Aurora Blues', '150000', 'gambar22.jpg', 'Aesthetic', '2020-12-09 03:15:49'),
(23, 'View Aurora', '120000', 'gambar23.jpg', 'Aesthetic', '2020-12-09 03:21:24'),
(24, 'Pink Sky', '100000', 'gambar24.jpg', 'Aesthetic', '2020-12-09 03:23:04'),
(25, 'Senja Vobes', '70000', 'gambar25.jpg', 'Aesthetic', '2020-12-09 03:23:04'),
(26, 'colorful', '650000', 'gambar26.jpg', 'abstrac', '2024-07-18 16:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `created_at`) VALUES
(3, 'revin', 'revinpilat@gmail.com', '0809090727342', '1d985746c0d88436ccf93c6081243cf4', '2024-07-15 05:24:22'),
(4, 'gavin', 'gavin.exlsv119@gmai.com', '085718961867', '08259334e4ee0d1710b82a2043b335a6', '2024-07-15 13:08:32'),
(5, 'naldi', 'naldi@gmail.com', '08612419818', '41ae3626b038f944e7dac6816f4bf3a0', '2024-07-17 04:25:42'),
(6, 'bejo', 'bejo@gmail.com', '084273894329', 'b9864018663e18d7a3ce2a9ae9cb8b4e', '2024-07-18 17:46:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
