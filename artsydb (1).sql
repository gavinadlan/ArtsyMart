-- DROP and CREATE db
DROP DATABASE IF EXISTS `artsydb`;
CREATE DATABASE `artsydb` CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `artsydb`;

-- Tabel Users
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Products
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Orders
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT '0.00',
  `receiver_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel OrderItems
CREATE TABLE `orderitems` (
  `id` int NOT NULL AUTO_INCREMENT,
  `oid` int NOT NULL,
  `ptitle` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`),
  CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Cart
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_users` (`user_id`),
  KEY `fk_cart_products` (`product_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Users (lengkapi id 6,7,8 agar konsisten dengan orders)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(3, 'ghea','ghea@gmail.com','$2y$10$GM/7j0Y…QS','user','2020-12-07 00:23:39'),
(5, 'anton','anton@gmail.com','$2y$10$rR3Z1U.…6HU6','user','2020-12-07 02:03:05'),
(6, 'bejo','bejo@gmail.com','$2y$10$Th1w6JMg8…LJHEEx/k','user','2020-12-08 01:05:17'),
(7, 'agung','agung@gmail.com','$2y$10$kbFG8ZL91…Fyji2P8S','user','2020-12-08 01:22:33'),
(8, 'agus','agus@gmail.com','$2y$10$S5eGHf/8GZ7M…2O5mnAAZIC2','user','2020-12-08 01:24:36');

-- Data Products
INSERT INTO `products` (`id`,`title`,`price`,`img`,`category`,`created_at`) VALUES
(1,'kemarau','150000','gambar1.jpeg','Nature','2020-12-08 18:40:06'),
(2,'Senja di danau','450000','gambar2.jpeg','Nature','2020-12-08 18:40:06'),
(3,'Matahari terbenam','80000','gambar3.jpeg','Nature','2020-12-08 19:29:46'),
(4,'Pesisir','250000','gambar4.jpeg','Aesthetic','2020-12-08 19:46:10'),
(5,'Senja di Prancis','130000','gambar5.jpeg','Aesthetic','2020-12-08 19:49:43'),
(6,'Pedesaan','750000','gambar6.jpeg','Nature','2020-12-08 19:49:43'),
(7,'day and night','100000','gambar7.jpeg','Aesthetic','2020-12-08 19:52:06'),
(8,'Makan bersama','200000','gambar8.jpeg','Nature','2020-12-08 19:53:40'),
(9,'Afternoon','100000','gambar9.jpeg','Aesthetic','2020-12-08 19:56:29'),
(10,'Gold Mountain','1000000','gambar10.jpg','Aesthetic','2020-12-08 19:58:11'),
(11,'Pemandangan gunung','690000','gambar11.jpg','Nature','2020-12-08 20:00:21'),
(12,'face mix','350000','gambar12.jpg','Abstrac','2020-12-08 20:01:29'),
(13,'Pegunungan','400000','gambar13.jpg','Abstrac','2020-12-08 20:03:33'),
(14,'Alpukat','100000','gambar14.jpeg','Abstrac','2020-12-08 20:05:17'),
(15,'Rumah','1500000','gambar15.jpg','Nature','2020-12-08 20:07:05'),
(16,'Gunung Fuji','200000','gambar16.jpg','Nature','2020-12-08 20:08:13'),
(17,'Afternoon Vibes','80000','gambar17.jpg','Aesthetic','2020-12-08 20:09:21'),
(18,'Me, you and the moon','80000','gambar18.jpg','Aesthetic','2020-12-08 20:10:27'),
(19,'Mountain view at night','2000000','gambar19.jpg','Nature','2020-12-08 20:11:32'),
(20,'Aurora Blues','150000','gambar20.jpg','Aesthetic','2020-12-08 20:13:20'),
(21,'Colorful','650000','gambar21.jpeg','Abstrac','2020-12-08 20:16:06'),
(22,'Couple Swan','700000','gambar22.jpg','Abstrac','2020-12-08 20:18:23');

-- Data Orders
INSERT INTO `orders` (`id`,`userid`,`address`,`created_at`,`total_amount`,`receiver_name`,`phone_number`,`postal_code`,`payment_method`) VALUES
(11,6,'jakarta','2024-07-18 11:16:29',350000.00,'bejo','084273894329','4223','bank_transfer'),
(12,6,'jakarta','2024-07-18 19:27:04',450000.00,'bejo','084273894329','4223','paypal'),
(13,7,'jakarta','2024-07-19 00:16:34',150000.00,'agung','0346363533','4223','bank_transfer'),
(14,8,'jakarta','2024-07-19 01:42:01',180000.00,'agus','0346363533','4223','cash_on_delivery'),
(15,8,'jakarta','2024-07-19 01:45:11',450000.00,'bu kartini','43343535','4223','credit_card');

-- Data OrderItems (only valid IDs)
INSERT INTO `orderitems` (`id`,`oid`,`ptitle`,`price`) VALUES
(11,11,'face mix','350000'),
(12,12,'Senja di danau','450000'),
(13,13,'Aurora Blues','150000'),
(14,14,'Matahari terbenam','80000'),
(15,14,'day and night','100000'),
(16,15,'Senja di danau','450000');
