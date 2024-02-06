-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 09:14 AM
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
-- Database: `spareparts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(50) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `phoneNumber` int(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `addressLine1` varchar(200) NOT NULL,
  `addressLine2` varchar(200) NOT NULL,
  `addressLine3` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstName`, `lastName`, `phoneNumber`, `email`, `password`, `addressLine1`, `addressLine2`, `addressLine3`) VALUES
(1, 'kamal', 'fernando', 345678908, 'sevindu@email.com', '$2y$10$g.9qBasw96tTpvxIrcaXA.L6IFbnn6oq6ft5sdSMC2AVyGlTZhl7C', 'no2', 'colombo rd', 'galle');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(50) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `image_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `image_address`) VALUES
(3, 'ducati', 'brands/ducati-motorcycle-logo.png'),
(4, 'Honda', 'brands/honda-bike-vector.jpg'),
(5, 'Suzuki', 'brands/suzuki-eps-vector-logo.png'),
(6, 'Yamaha', 'brands/yamaha-motor-vector-logo.png'),
(7, 'Royal Enfield', 'brands/royal-enfield-eps-vector-logo.png'),
(8, 'Triumph', 'brands/triumph-motorcycles-vector-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `product_count` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `order_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `count` int(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered_items`
--

INSERT INTO `ordered_items` (`order_id`, `user_id`, `product_id`, `count`, `status`) VALUES
(15, 3, 15, 1, 'shipped'),
(15, 3, 16, 1, 'shipped'),
(16, 1, 16, 1, 'process');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `customer` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `province` varchar(200) NOT NULL,
  `postal_code` int(50) NOT NULL,
  `total` int(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `customer`, `email`, `address`, `province`, `postal_code`, `total`, `date`) VALUES
(15, 3, 'chami', 'punsara456@proton.me', '3194 Bingamon Branch Road,Dobson', 'south', 60007, 10500, '2024-01-06'),
(16, 1, 'dileeban', 'pasan@gmail.com', 'medawatta,thibbotuwawa,akuressa', 'north', 1234, 8000, '2024-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_ID` int(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `bike` varchar(200) NOT NULL,
  `price` int(50) NOT NULL,
  `brand` varchar(200) NOT NULL,
  `quantity` int(200) NOT NULL,
  `image_addresse` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_ID`, `name`, `bike`, `price`, `brand`, `quantity`, `image_addresse`) VALUES
(11, 'starter motor assembly', 'R1', 8000, '6', 20, 'part_IMG/yamaha-r1-2004-2008-starter-motor-assembly.jpg'),
(13, 'Air Filter', 'R1', 1500, '6', 20, 'part_IMG/kawasaki-zx10r-2016-2020-high-performance-washablereusable-air-filter.jpg'),
(14, 'Rear Suspension', 'R1', 12000, '6', 0, 'part_IMG/benelli-tnt600i-gt600-rear-suspension-assembly.jpg'),
(15, 'Signal Indicator', 'CBR 600', 2500, '4', 25, 'part_IMG/turn-signal-indicator-for-honda-cbr600rr-cbr600-2007-2013.jpg'),
(16, 'magnet coil', 'CBR 250', 8000, '4', 10, 'part_IMG/honda-cbr954-2001-2003-magnet-coil.jpg'),
(17, 'Fork Oil Seal', 'R1', 1500, '6', 20, 'part_IMG/front-fork-oil-seal-for-yamaha-r1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `rId` int(20) NOT NULL,
  `reviewerName` varchar(50) NOT NULL,
  `review` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`rId`, `reviewerName`, `review`) VALUES
(2, 'sevindu', 'nice'),
(12, 'dileeban', 'cool nice'),
(15, 'chami', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(50) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `phoneNumber` int(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `addressLine1` varchar(200) NOT NULL,
  `addressLine2` varchar(200) NOT NULL,
  `addressLine3` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstName`, `lastName`, `phoneNumber`, `email`, `password`, `addressLine1`, `addressLine2`, `addressLine3`) VALUES
(1, 'dileeban', 'shankar', 2147483647, 'pasan@gmail.com', '$2y$10$g.9qBasw96tTpvxIrcaXA.L6IFbnn6oq6ft5sdSMC2AVyGlTZhl7C', 'medawatta', 'thibbotuwawa', 'akuressa'),
(2, 'chami', 'k', 2147483647, 'sevindupunsara@gmail.com', '$2y$10$0zQ2kx3y2yGaGALUzICez.HjnXkIUOhfBPuajoXCSjkK0PXzmttP6', 'dssfd', 'zczxczxc', 'xczxczx'),
(3, 'chami', 'k', 2147483647, 'punsara456@proton.me', '$2y$10$iOZGiwjsOmZdtwGHB67DB.ZH2BHcCD45f1DJba5L2FSloYxrio8s.', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `product_id`, `email`) VALUES
(1, 0, 'sevindu@email.com'),
(1, 0, 'sevindu@email.com'),
(1, 0, 'sevindu@email.com'),
(1, 0, 'sevindu@email.com'),
(1, 0, 'sevindu@email.com'),
(1, 0, 'pasan@gmail.com'),
(2, 12, 'sevindupunsara@gmail.com'),
(3, 15, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`rId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `rId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
