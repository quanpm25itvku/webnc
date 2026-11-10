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
-- Database: `review`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhchon`
--

CREATE TABLE `binhchon` (
  `idBC` int(11) NOT NULL,
  `MoTa` varchar(255) NOT NULL,
  `idLT` int(11) DEFAULT 1,
  `SoLanChon` int(11) DEFAULT 0,
  `AnHien` tinyint(1) DEFAULT 1,
  `ThuTu` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `binhchon`
--

INSERT INTO `binhchon` (`idBC`, `MoTa`, `idLT`, `SoLanChon`, `AnHien`, `ThuTu`) VALUES
(1, 'Bạn nghĩ sao về chất lượng của trang web?', 1, 30, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phuongan`
--

CREATE TABLE `phuongan` (
  `idPA` int(11) NOT NULL,
  `MoTa` varchar(255) NOT NULL,
  `SoLanChon` int(11) DEFAULT 0,
  `idBC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `phuongan`
--

INSERT INTO `phuongan` (`idPA`, `MoTa`, `SoLanChon`, `idBC`) VALUES
(1, 'Là nơi để sinh viên có thể tự học CNTT tốt nhất', 20, 1),
(2, 'Nội dung không phong phú lắm', 7, 1),
(3, 'Chất lượng thì cũng bình thường thôi', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binhchon`
--
ALTER TABLE `binhchon`
  ADD PRIMARY KEY (`idBC`);

--
-- Indexes for table `phuongan`
--
ALTER TABLE `phuongan`
  ADD PRIMARY KEY (`idPA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binhchon`
--
ALTER TABLE `binhchon`
  MODIFY `idBC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `phuongan`
--
ALTER TABLE `phuongan`
  MODIFY `idPA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
