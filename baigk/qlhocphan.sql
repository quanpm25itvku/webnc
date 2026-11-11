-- Tạo cơ sở dữ liệu QLHocPhan
CREATE DATABASE IF NOT EXISTS `QLHocPhan` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `QLHocPhan`;

-- Tạo bảng GiangVien
CREATE TABLE IF NOT EXISTS `GiangVien` (
    `IDGV` VARCHAR(20) PRIMARY KEY,
    `Fullname` VARCHAR(100) NOT NULL,
    `Image` VARCHAR(255) NOT NULL,
    `SumClass` INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm dữ liệu mẫu ban đầu
INSERT INTO `GiangVien` (`IDGV`, `Fullname`, `Image`, `SumClass`) VALUES
('GV01', 'Nguyễn Văn An', 'default.png', 5),
('GV02', 'Trần Thị Bích', 'default.png', 3),
('GV03', 'Lê Hoàng Long', 'default.png', 6)
ON DUPLICATE KEY UPDATE `Fullname`=VALUES(`Fullname`);
