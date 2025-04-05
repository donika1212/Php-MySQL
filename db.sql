-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 01:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_name`, `price`) VALUES
(21, 'Kobe 4 Protro', 155.00),
(22, 'Kobe 4 Protro', 155.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `image`, `category`) VALUES
(1, 'Kobe 4 Protro', 155.00, 'images/kobe4protro.png', 'Mens Shoes'),
(2, 'Air Jordan 3 Retro', 172.00, 'images/airjordan3retro.png', 'Mens Shoes'),
(3, 'Nike Blazer Mid\'77', 100.00, 'images/blazermid77.png', 'Womens Shoes'),
(4, 'Nike Vapor Edge 360 DT', 195.00, 'images/vaporedge360dt.png', 'Cleats'),
(5, 'Nike Vapor Edge 360 Pro', 125.99, 'images/vaporedgepro360.png', 'Cleats'),
(6, 'Nike Alpha Menace Elite 3', 220.05, 'images/NikeAlphaMenaceElite3.png', 'Cleats'),
(7, 'SonHeung-Min Football Jersey', 140.50, 'images/sonheungminjersey.png', 'Mens Kits'),
(8, 'Sophia Smith Football Jersey', 170.90, 'images/sophiasmithjersey.png', 'Womens Kits'),
(9, 'USA Jersey', 105.05, 'images/USAjersey.png', 'Mens Kits'),
(10, 'Nike Tech Joggers Black', 100.00, 'images/niketechjoggersblack.png', 'Sportswear Joggers'),
(11, 'Nike Tech Joggers Red', 100.00, 'images/niketechjoggersred.png', 'Sportswear Joggers'),
(12, 'Nike Tech Joggers Gray', 100.00, 'images/niketechjoggersgray.png', 'Sportswear Joggers'),
(13, 'Nike Sportswear Tech Fleece Red', 110.50, 'images/niketechfleecered.png', 'Sports Joggers'),
(14, 'Nike Sportswear Tech Fleece Gray', 110.50, 'images/niketechfleecegrayblack.png', 'Sports Joggers'),
(15, 'Nike Sportswear Tech Fleece Black', 110.50, 'images/niketechfleeceblack.png', 'Sports Joggers');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(250) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'labeatbytyqi', 'labeat.bytyqi@gmail.com', '$2y$10$Oty1aAdDjrV3s46yogInDODjCifVyvbHozpqLmYwcZjSvd96w6KuC', 1),
(2, 'labeat123', 'labeat.bytyqi@hotmail.com', '$2y$10$ByGD8ZbELyGZbhtyWy/2EOlRYPnqAYL2HHX3WJ3VYG6nQWA9myejS', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
