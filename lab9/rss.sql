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
-- Database: `rss`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `link`, `description`) VALUES
(1, 'Bài 1: Làm quen với môi trường PHP', 'http://localhost/bai1.php', 'Cài đặt XAMPP, cấu hình Apache và chạy file PHP đầu tiên.'),
(2, 'Bài 2: Sử dụng hàm IF giải phương trình bậc 1', 'http://localhost/bai2.php', 'Cú pháp rẽ nhánh if else trong lập trình PHP căn bản.'),
(3, 'Bài 3: Đọc số thành chữ dùng Switch-Case', 'http://localhost/bai3.php', 'Ứng dụng cấu trúc điều khiển switch-case để chuyển đổi số nguyên.'),
(4, 'Bài 11: Phân trang danh sách bài viết', 'http://localhost/bai11.php', 'Hướng dẫn kỹ thuật phân trang kết hợp câu lệnh SQL LIMIT.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
