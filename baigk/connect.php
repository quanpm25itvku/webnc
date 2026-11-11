<?php
// connect.php - Kết nối cơ sở dữ liệu QLHocPhan
$host = "localhost";
$username = "root";
$password = "";
$dbname = "QLHocPhan";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

// Thiết lập bảng mã UTF-8
$conn->set_charset("utf8mb4");
?>
