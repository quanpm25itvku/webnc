<?php
require_once 'connect.php';

$idgv = $_GET['id'] ?? '';

if (!empty($idgv)) {
    // Tìm ảnh để xóa file
    $stmt = $conn->prepare("SELECT Image FROM GiangVien WHERE IDGV = ?");
    $stmt->bind_param("s", $idgv);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if ($row = $res->fetch_assoc()) {
        $img = $row['Image'];
        if ($img != 'default.png' && file_exists("uploads/" . $img)) {
            unlink("uploads/" . $img);
        }
    }

    // Xóa record trong DB
    $delStmt = $conn->prepare("DELETE FROM GiangVien WHERE IDGV = ?");
    $delStmt->bind_param("s", $idgv);
    $delStmt->execute();

    header("Location: index.php?msg=delete_success");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
