-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2019 at 03:15 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'my brand'),
(2, 'Brand_name_001'),
(3, 'Brand_name_002');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Men', 0),
(2, 'Women', 0),
(3, 'Boys', 0),
(4, 'Girls', 0),
(5, 'Shirts', 1),
(6, 'Pants', 1),
(7, 'Shoes', 1),
(8, 'Accessories', 1),
(9, 'Shirts', 2),
(10, 'Pants', 2),
(11, 'Shirts', 3),
(12, 'Pants', 3),
(13, 'Dresses', 4),
(14, 'Shoes', 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Product_001', '220.00', '250.00', 2, '5', '/tutorial/images/products/fa36e14d00ee8f57c1707e41792e1697.jpg', 'We have this new one for men. This is very stylish and comfortable shirts for men', 1, 'small:10,large:10,Medium:20,Extra-large:5', 0),
(2, 'Product_002', '800.00', '890.00', 3, '10', '/tutorial/images/products/615c37a9f920c50a3c7457539bb47f60.jpg', 'Women beautiful pants', 1, 'Small:5,Large:10', 0),
(3, 'sifat', '500.00', '550.00', 2, '6', '/tutorial/images/products/a49e30f2a26b2ee5edd9f41866133ba5.jpg', 'Its gift for sifat', 1, 'small:5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `each_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `date`, `name`, `phone`, `email`, `address`, `password`, `product_id`, `product_title`, `size`, `quantity`, `each_price`, `total_price`) VALUES
(3, '2019-02-13 19:44:11', 'rimon', '01862117112', 'rimonronycste11@gmail.com', 'keranigonj', '123', 2, 'Product_002', ' Small,5 ', 3, '800.00', '2400.00'),
(4, '2019-01-16 19:44:11', 'rimon', '01862117112', 'rimonronycste11@gmail.com', 'keranigonj', '123', 2, 'Product_002', ' Small,5 ', 3, '800.00', '2400.00'),
(5, '2019-02-23 19:44:11', 'rimon', '01862117112', 'rimonronycste11@gmail.com', 'keranigonj', '123', 2, 'Product_002', ' Small,5 ', 3, '800.00', '2400.00'),
(6, '2019-02-23 22:42:33', 'rimon', '01234567', 'rimonronycste11@gmail.com', 'dhaka', '123123', 1, 'Product_001', ' small,10 ', 4, '220.00', '880.00'),
(7, '2019-02-23 22:47:33', 'rimon', '456', 'rimonronycste11@gmail.com', 'dfvdfvfd', '123', 2, 'Product_002', ' Small,5 ', 3, '800.00', '2400.00'),
(8, '2019-02-24 00:10:57', 'sifatul islam', '018775985697', 'sifatuislam359@gmail.com', 'Borguna , Barishal', '12345', 1, 'Product_001', ' small,10 ', 3, '220.00', '660.00'),
(9, '2019-02-24 00:16:29', 'sifatul islam', '018775985697', 'sifatuislam359@gmail.com', 'Borguna , Barishal', '12345', 1, 'Product_001', ' small,10 ', 3, '220.00', '660.00'),
(10, '2019-02-24 01:41:30', 'test1', '1111', 'test@test.com', 'test1', 'test', 2, 'Product_002', ' Small,5 ', 4, '800.00', '3200.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'Rimon', 'rimon@rimon.com', '1234567', '2019-02-23 00:00:00', '2019-03-02 11:27:50', 'admin,aditor'),
(2, 'sumaiya', 'sumaiya@sumaiya.sumaiya', '123456', '2019-02-23 01:03:09', '2019-02-23 15:27:43', 'editor'),
(3, 'lamiya', 'lamiya@lamiya.lamiya', '123456', '2019-02-23 01:04:28', '2019-02-22 20:05:01', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
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
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
