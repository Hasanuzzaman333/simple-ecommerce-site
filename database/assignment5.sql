-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2017 at 05:58 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment5`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`) VALUES
(1, 'Cell Phone'),
(3, 'Laptop'),
(4, 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `cat_id`, `name`, `price`) VALUES
(1, 1, 'Apple iPhone Y', 500),
(2, 1, 'Samsung Galaxy Note 8', 80000),
(6, 1, 'Nokia 8', 34444),
(7, 1, 'Nokia 6', 12000),
(8, 3, 'Microsoft Surface', 123000),
(10, 4, 'Bed', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `item_id`, `user_id`, `qty`, `total_price`, `date_time`) VALUES
(1, 1, 5, 1, '100000', '2017-12-23 12:15:28'),
(2, 1, 5, 1, '100000', '2017-12-23 12:19:49'),
(3, 1, 5, 1, '100000', '2017-12-23 12:22:32'),
(4, 1, 5, 1, '100000', '2017-12-23 01:41:23'),
(5, 2, 5, 1, '80000', '2017-12-23 01:41:23'),
(7, 1, 5, 5, '500000', '2017-12-23 01:58:04'),
(11, 1, 5, 1, '100000', '2017-12-23 02:19:15'),
(12, 2, 5, 2, '160000', '2017-12-23 02:19:15'),
(14, 1, 5, 7, '700000', '2017-12-23 02:30:02'),
(16, 1, 5, 4, '400000', '2017-12-23 02:55:03'),
(17, 2, 5, 3, '240000', '2017-12-23 02:55:03'),
(20, 1, 5, 1, '100000', '2017-12-23 02:59:19'),
(21, 2, 5, 1, '80000', '2017-12-23 02:59:20'),
(24, 2, 5, 1, '80000', '2017-12-23 03:05:21'),
(25, 1, 5, 1, '100000', '2017-12-23 03:05:21'),
(28, 1, 5, 1, '100000', '2017-12-23 03:06:50'),
(29, 1, 5, 2, '200000', '2017-12-23 01:02:03'),
(30, 1, 5, 8, '800000', '2017-12-23 05:54:29'),
(31, 2, 5, 1, '80000', '2017-12-23 05:54:29'),
(34, 1, 5, 1, '500', '2017-12-23 06:28:01'),
(35, 2, 5, 89, '7120000', '2017-12-23 06:28:01'),
(36, 7, 9, 3, '36000', '2017-12-23 06:48:24'),
(38, 1, 9, 3, '1500', '2017-12-24 07:23:47'),
(40, 1, 9, 4, '2000', '2017-12-24 08:03:52'),
(41, 1, 9, 6, '3000', '2017-12-24 08:08:58'),
(42, 2, 9, 2, '160000', '2017-12-24 08:08:58'),
(43, 1, 5, 1, '500', '2017-12-24 09:16:35'),
(44, 2, 5, 1, '80000', '2017-12-24 09:16:36'),
(45, 7, 5, 8, '96000', '2017-12-24 09:16:36'),
(46, 10, 5, 1, '10000', '2017-12-24 09:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `is_guest` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `address`, `is_guest`) VALUES
(2, NULL, NULL, NULL, NULL, 1),
(3, 'Ashq', 'pass', 'ashq@mail', 'BD', 0),
(4, NULL, NULL, NULL, NULL, 1),
(5, 'Hasanuzzaman', 'hasan2', 'hasanuzzaman333@gmail.com', 'Dhaka, BD', 2),
(6, NULL, NULL, NULL, NULL, 1),
(7, NULL, NULL, NULL, NULL, 1),
(8, 'Ashik', 'ashik', 'ashik@gmail', 'Dhaka', 0),
(9, 'Hasan', 'hasan', 'hasanuzzaman333@yahoo.com', 'Dhaka', 2),
(10, NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
