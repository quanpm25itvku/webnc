-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2026 at 05:25 PM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rating`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `img_url`) VALUES
(1, 'MB Gigabyte G1.Sniper B5', 'template/img/products/1.jpg'),
(2, 'Asus MeMo pad ME102A', 'template/img/products/2.jpg'),
(3, 'LCD Philips 27 273G3 DHSW', 'template/img/products/3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `product_id` int(10) NOT NULL,
  `rate_1` int(10) NOT NULL DEFAULT 0,
  `rate_2` int(10) NOT NULL DEFAULT 0,
  `rate_3` int(10) NOT NULL DEFAULT 0,
  `rate_4` int(10) NOT NULL DEFAULT 0,
  `rate_5` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `rating_info`
--

INSERT INTO `rating_info` (`product_id`, `rate_1`, `rate_2`, `rate_3`, `rate_4`, `rate_5`) VALUES
(1, 1, 4, 3, 1, 5),
(2, 12, 23, 21, 22, 11),
(3, 2, 2, 1, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
