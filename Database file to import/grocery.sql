-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2017 at 11:50 PM
-- Server version: 10.0.32-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dibukhan_grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `postalAddress` varchar(100) NOT NULL,
  `itemOrderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `name`, `phone`, `postalAddress`, `itemOrderId`) VALUES
(1, 'Customer', '03120000000', 'H1 St1 I-8 Islamabad', 1),
(2, 'NoName', '03315679942', '156', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `image` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(1, 'Flour', 'uploads/1flour.jpg'),
(2, 'Oil', 'uploads/2oil.jpg'),
(3, 'Sugar', 'uploads/4sugar.jpg'),
(4, 'Rice', 'uploads/3rice.jpg'),
(5, 'Beans', 'uploads/5beans.jpg'),
(6, 'Beverages', 'uploads/6beverages.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` mediumtext NOT NULL,
  `price` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `datePosted` date NOT NULL,
  `orderId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `detail`, `price`, `category`, `datePosted`, `orderId`) VALUES
(2, 'Rice', 'detail detail detail detail detail detail detail detail detail detail detail detail detail', '100', 'Rice', '2017-10-19', NULL),
(3, 'testname3', 'test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail', '200', 'flour', '2017-10-19', 2),
(4, 'testname4', 'test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail test detail', '300', 'rice', '2017-10-18', 2),
(5, 'newItem', 'this is test detail', '340', 'Oil', '2017-10-19', NULL),
(6, 'anotherIte', 'hello world', '1000', 'flour', '2017-10-19', 2),
(7, 'asd', 'czxc', '23', 'rice', '2017-10-19', 1),
(8, 'Basmati', 'Basmati D98', '5600', 'Rice', '2017-10-20', NULL),
(9, 'Rice Punja', 'IRRI-6', '400', 'Rice', '2017-10-20', NULL),
(10, 'Rice Bangl', 'Rice Bangladesh', '4500', 'Flour', '2017-10-20', NULL),
(11, 'Flou fasfa', 'Deatils of ad fasfa Flour', '500', 'Flour', '2017-10-20', NULL),
(12, 'flour', 'Hello World hey hello Hello World hey hello Hello World hey hello Hello World hey hello Hello World', '320', 'Flour', '2017-10-21', NULL),
(13, 'Flour KPK', 'Sindh Flour', '220', 'Flour', '2017-10-21', NULL),
(14, 'Grain IRRI', 'Long Grain IRRI-6 White Rice', '455.5', 'Flour', '2017-10-21', NULL),
(15, 'Flour Daa', 'Daa flour Punjab Special material', '210', 'Flour', '2017-10-21', NULL),
(16, 'Long Grain', 'Long Grain PK 386 Rice', '3000', 'Rice', '2017-10-24', NULL),
(17, 'Oil Punjab', 'Oil change Punjab', '400', 'Oil', '2017-10-24', NULL),
(18, 'Oil Kpk', 'Oil from pathans', '3400', 'Oil', '2017-10-24', NULL),
(19, 'Oil Sindh', 'Oil Sindh close to your heart', '10000', 'Oil', '2017-10-24', NULL),
(20, 'Oil', 'oil for change', '8900', 'Flour', '2017-10-24', NULL),
(21, 'Oil Baloch', 'Oil from Quetta', '4334', 'Flour', '2017-10-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itemImage`
--

CREATE TABLE `itemImage` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `itemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemImage`
--

INSERT INTO `itemImage` (`id`, `url`, `type`, `itemId`) VALUES
(7, 'uploads/2017-10-24 05:09:23pm.jpg', 'jpg', 5),
(8, 'uploads/2017-10-24 05:19:20pm.jpg', 'jpg', 2),
(9, 'uploads/2017-10-24 05:39:46pm.jpg', 'jpg', 8),
(10, 'uploads/2017-10-24 05:41:32pm.jpg', 'jpg', 16),
(11, 'uploads/2017-10-24 05:43:05pm.jpg', 'jpg', 14),
(12, 'uploads/2017-10-24 05:45:01pm.png', 'png', 9),
(13, 'uploads/2017-10-24 05:46:19pm.jpg', 'jpg', 10),
(14, 'uploads/2017-10-24 05:52:00pm.jpg', 'jpg', 11),
(15, 'uploads/2017-10-24 05:52:55pm.jpg', 'jpg', 12),
(17, 'uploads/2017-10-24 05:54:18pm.jpg', 'jpg', 15),
(18, 'uploads/2017-10-24 05:54:42pm.jpg', 'jpg', 13),
(19, 'uploads/2017-10-24 06:10:43pm.jpg', 'jpg', 17),
(20, 'uploads/2017-10-24 06:11:37pm.png', 'png', 18),
(21, 'uploads/2017-10-24 06:12:29pm.jpg', 'jpg', 19),
(22, 'uploads/2017-10-24 06:13:06pm.jpg', 'jpg', 20),
(23, 'uploads/2017-10-24 06:14:55pm.jpg', 'jpg', 21);

-- --------------------------------------------------------

--
-- Table structure for table `itemOrder`
--

CREATE TABLE `itemOrder` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateOrdered` date NOT NULL,
  `dateReceived` date DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemOrder`
--

INSERT INTO `itemOrder` (`id`, `userId`, `dateOrdered`, `dateReceived`, `status`, `remarks`) VALUES
(1, 2, '2017-10-19', '2017-10-21', 'received', 'i have recieved!!'),
(2, 3, '2017-10-21', NULL, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `type`) VALUES
(1, 'admin', 'admin@gmail.com', '123', 'admin'),
(2, 'Mr User', 'abc@gmail.com', '123', 'user'),
(3, 'Miss Customer', 'miss@gmail.com', '123', 'user'),
(4, 'qweqe', 'qwe@gmail.com', '123', 'user'),
(5, 'MyName', 'abcabc@gmail.com', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemImage`
--
ALTER TABLE `itemImage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemOrder`
--
ALTER TABLE `itemOrder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `itemImage`
--
ALTER TABLE `itemImage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `itemOrder`
--
ALTER TABLE `itemOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
