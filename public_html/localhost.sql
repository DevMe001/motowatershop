-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2024 at 06:28 PM
-- Server version: 10.6.16-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--
CREATE DATABASE IF NOT EXISTS `shop_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shop_db`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(14, 0, 'Cathleen Lehmann', 'cathleen.lehmann@gmail.com', '(02) 4000 09', 'want to be on top 10 Google rankings without any upfront payment? I\'m John, an SEO expert.\r\n Email me at razibarkai1643@gmail.com with your site and keywords, and I\'ll assess it.\r\nI won\'t charge until you reach the top 10. Nothing to lose! Waiting for your email.'),
(15, 0, 'Keenan Frye', 'keenan.frye38@googlemail.com', '01.37.47.69.', 'want to be on top 10 Google rankings without any upfront payment? I\'m John, an SEO expert.\r\n Email me at razibarkai1643@gmail.com with your site and keywords, and I\'ll assess it.\r\nI won\'t charge until you reach the top 10. Nothing to lose! Waiting for your email.'),
(16, 0, 'Gregory Yu', 'notification@instantnic.com', '797-944-5751', 'Disclaimer: We are not liable for any monetary loss, data loss, decline in SEO rankings, missed patrons, undeliverable email or any other detriments that you may experience upon the termination of matoswater.shop. For more info please refer to section 17.e.1a of our Terms and Conditions.\nThis represents your ultimate warning to extend matoswater.shop:\nhttps://instantnic.com/renew/TUFUT1NXQVRFUi5TSE9Q\nIn the case that matoswater.shop ceases, we maintain the right to offer your listing to competin'),
(17, 0, 'Natalie Anderson', 'notification@domainswebsite.net', '001-916-232-', 'Warning: We are not liable for any economic losses, data loss, decline in search engine rankings, lost customers, undeliverable email or any other detriments that you may suffer after the expiry of matoswater.shop. For more info please consult section 89.d.1a of our User Agreement.\nHere is your final alert to continue matoswater.shop:\nhttps://domainswebsite.net/renew/TUFUT1NXQVRFUi5TSE9Q\nIn the scenario that matoswater.shop ceases, we hold the right to provide your listing to contending business'),
(18, 0, 'Jose Feakes', 'onedollarhosting81@gmail.com', '077 0263 345', 'reply me if you interested i will send you the link to 1$ a month hosting !');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `gcash` int(20) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `gcash`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(19, 25, 'test', '09071617006', 'sbanquerigo@gmail.com', 'Gcash(delivery)', 'test, test, manila', 2147483647, ', Slim Gallon (BLUE)22 (1) ', 375, '01-Feb-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `stock` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `stock`, `image`) VALUES
(22, 'Slim Gallon (BLUE)', 'Gallon Only', 125, 99, 'Blue Slim.jpg'),
(23, 'Slim Gallon (LIGHT BLUE)', 'Gallon Only', 125, 100, 'Light Blue Slim.jpg'),
(24, 'Slim Gallon (GREEN)', 'Gallon Only', 125, 100, 'Green Slim.jpg'),
(25, 'Slim Gallon (RED)', 'Gallon Only', 125, 100, 'Red Slim.jpg'),
(26, 'Slim Gallon (ORANGE)', 'Gallon Only', 125, 100, 'Orange Slim.jpg'),
(27, 'Slim Gallon (YELLOW)', 'Gallon Only', 125, 100, 'Yellow Slim.jpg'),
(28, 'Round Gallon (BLUE)', 'Gallon Only', 130, 100, 'Round Gallon.jpeg'),
(29, 'Round Gallon (ORANGE)', 'Gallon Only', 130, 100, 'Round Gallon.jpeg'),
(30, 'PET Bottle ( 350ml )', '250pcs per pack', 625, 50, 'received_721670115591729-01.jpeg'),
(31, 'PET Bottle ( 500ml )', '200pcs per pack', 540, 50, 'received_721670115591729-01.jpeg'),
(32, 'PET Bottle ( 1000ml )', '!00pcs per pack', 410, 50, 'received_721670115591729-01.jpeg'),
(33, 'Hot & Cold Dispenser', 'Brand: Mitsu Tech', 4000, 10, 'received_928704171381748-01.jpeg'),
(34, 'Heat Gun', 'Brand: GBos', 850, 10, 'Heat Gun.jpeg'),
(35, 'Ball Valve', 'Ball Valve', 250, 5, 'Ball Valve.jpg'),
(36, 'Round Gallon Holder', 'Holder for carrying Round Gallon', 100, 10, 'Round Gallon Holder.jpg'),
(37, 'TDS Meter', 'Used to measure the conductivity of the solution and estimates the TDS from that reading.', 800, 5, 'TDS.jpeg'),
(38, 'Pebbles #5', 'Sold in sack', 400, 5, '368506658_1018851259340378_848935432962639700_n.jpg'),
(39, 'Pebbles #10', 'Sold in sack', 400, 5, '373459279_1045312773175581_7133296982212939756_n.jpg'),
(40, 'Filter Housig ( 20SL )', 'Filter Housing', 800, 10, '370220917_887256009452109_1137618315357227840_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `code` text NOT NULL,
  `email_verified` int(5) DEFAULT 0,
  `image` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `code`, `email_verified`, `image`, `user_type`) VALUES
(22, 'angel', 'ajbcrisologo5@gmail.com', '$2y$10$.nVDZ/cPxsdFDVz1.vyDO.3VuBpcaQ2MNbn0yWw5pIzq3/qv30BFW', 'c937c0151d33af6e5febcd3c2fb11296', 1, '', 'admin'),
(25, 'Caira', 'caira@gmail.com', '$2y$10$WVCuixbsOVe1zQzCCwpCquqUNFUtFJVuTJvIGmahp.RQWhLNmbE5e', '307d51e2266a638eee5beaa3ef43abc5', 0, '', 'user'),
(82, 'tester', 'dev.me28@gmail.com', '$2y$10$yVpcnCh64yGpPTFaqNFObu08ILYT75GjQy1s.QAa6D56Sle.FSHEG', '87f14b126f62e51a1d2ae462a4a24ea1', 1, '', 'user'),
(83, 'NOBELA', 'nobelamano@gmail.com', '$2y$10$9YInAsB4h6eU.wT67QA0TOw9Sm0a1wyGC6Tcdl//nLhqwbcFWlOwG', '451688', 1, '', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
