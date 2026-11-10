-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2026 at 05:24 PM
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
-- Database: `phantrang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tintuc`
--

CREATE TABLE `tintuc` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tintuc`
--

INSERT INTO `tintuc` (`id`, `title`) VALUES
(1, 'Tin tức 01: Học lập trình PHP căn bản'),
(2, 'Tin tức 02: Hướng dẫn kết nối MySQL'),
(3, 'Tin tức 03: Xử lý Session và Cookie'),
(4, 'Tin tức 04: Kỹ thuật upload ảnh an toàn'),
(5, 'Tin tức 05: Giới thiệu vòng lặp for trong PHP'),
(6, 'Tin tức 06: Giải thuật toán phương trình bậc 2'),
(7, 'Tin tức 07: Switch-case ứng dụng đọc số'),
(8, 'Tin tức 08: Phân biệt mảng tuần tự và kết hợp'),
(9, 'Tin tức 09: Sử dụng CKEditor soạn thảo văn bản'),
(10, 'Tin tức 10: Xây dựng CAPTCHA chống spam'),
(11, 'Tin tức 11: Thiết kế hệ thống bình chọn online'),
(12, 'Tin tức 12: Xuất dữ liệu ra RSS Feed'),
(13, 'Tin tức 13: Xử lý bảo mật SQL Injection cơ bản'),
(14, 'Tin tức 14: Kỹ thuật tạo mảng ngẫu nhiên và tìm max min'),
(15, 'Tin tức 15: Phân trang dữ liệu MySQL bằng LIMIT'),
(16, 'Tin tức 16: CSS Flexbox và Grid căn bản'),
(17, 'Tin tức 17: Làm quen với Apache và XAMPP'),
(18, 'Tin tức 18: Tối ưu truy vấn MySQL với Index'),
(19, 'Tin tức 19: Debug lỗi Undefined index trong PHP'),
(20, 'Tin tức 20: Tự học thiết kế Web chuẩn responsive'),
(21, 'Tin tức 21: Bài viết bổ sung 1'),
(22, 'Tin tức 22: Bài viết bổ sung 2'),
(23, 'Tin tức 23: Bài viết bổ sung 3'),
(24, 'Tin tức 24: Bài viết bổ sung 4'),
(25, 'Tin tức 25: Bài viết bổ sung 5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
