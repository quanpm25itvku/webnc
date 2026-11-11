<?php
require_once 'connect.php';

$idgv = $_GET['id'] ?? '';
if (empty($idgv)) {
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM GiangVien WHERE IDGV = ?");
$stmt->bind_param("s", $idgv);
$stmt->execute();
$res = $stmt->get_result();
$gv = $res->fetch_assoc();

if (!$gv) {
    die("Không tìm thấy giảng viên!");
}

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname'] ?? '');
    $sumclass = intval($_POST['sumclass'] ?? 0);
    $currentImage = $gv['Image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $newImageName = time() . "_" . uniqid() . "." . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $newImageName)) {
                if ($currentImage != "default.png" && file_exists("uploads/" . $currentImage)) {
                    unlink("uploads/" . $currentImage);
                }
                $currentImage = $newImageName;
            }
        } else {
            $message = "Chỉ chấp nhận file ảnh (jpg, png, gif, webp)!";
            $messageType = "warning";
        }
    }

    if (empty($message)) {
        $updateSql = "UPDATE GiangVien SET Fullname = ?, Image = ?, SumClass = ? WHERE IDGV = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssis", $fullname, $currentImage, $sumclass, $idgv);

        if ($updateStmt->execute()) {
            header("Location: index.php?msg=edit_success");
            exit();
        } else {
            $message = "Lỗi: " . $conn->error;
            $messageType = "danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Giảng Viên</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --bg-body: #0b0f19;
            --card-bg: rgba(22, 29, 47, 0.85);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }
        body {
            background-color: var(--bg-body);
            background-image: 
                radial-gradient(at 0% 0%, rgba(245, 158, 11, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.15) 0px, transparent 50%);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
        }
        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }
        .form-control, .form-control:focus {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff;
            border-radius: 10px;
            padding: 10px 14px;
        }
        .form-control:disabled {
            background: rgba(255, 255, 255, 0.08);
            color: #94a3b8;
        }
        .form-control:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.25);
        }
        .form-label {
            color: #cbd5e1;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .btn-update {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            color: #fff;
            border: none;
            padding: 11px 24px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.35);
            transition: all 0.2s;
        }
        .btn-update:hover {
            transform: translateY(-2px);
            color: #fff;
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.5);
        }
        .img-avatar-preview {
            width: 70px;
            height: 70px;
            border-radius: 14px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.15);
        }
    </style>
</head>
<body>

    <div class="container py-5" style="max-width: 580px;">
        
        <div class="glass-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <span class="badge text-bg-warning rounded-pill px-3 py-1 mb-2 text-dark" style="font-size: 0.7rem;">UPDATE &bull; GIANGVIEN</span>
                    <h3 class="fw-bold mb-0">Sửa Giảng Viên</h3>
                </div>
                <a href="index.php" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-color: rgba(255,255,255,0.15);">
                    <i class="fa-solid fa-arrow-left me-1"></i> Trở về
                </a>
            </div>

            <?php if (!empty($message)): ?>
                <div class="alert alert-<?= $messageType ?> py-2 small mb-4" style="border-radius: 10px;"><?= $message ?></div>
            <?php endif; ?>

            <form action="edit.php?id=<?= urlencode($idgv) ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Mã Giảng Viên (IDGV)</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($gv['IDGV']) ?>" disabled>
                    <small class="text-secondary" style="font-size: 0.78rem;">Khóa chính IDGV không được phép thay đổi.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ và Tên (Fullname) <span class="text-danger">*</span></label>
                    <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($gv['Fullname']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tổng Số Lớp (SumClass) <span class="text-danger">*</span></label>
                    <input type="number" name="sumclass" class="form-control" min="0" value="<?= htmlspecialchars($gv['SumClass']) ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Hình ảnh hiện tại</label>
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <?php 
                            $imgPath = (!empty($gv['Image']) && file_exists("uploads/" . $gv['Image'])) 
                                ? "uploads/" . $gv['Image'] 
                                : "https://ui-avatars.com/api/?name=" . urlencode($gv['Fullname']) . "&background=f59e0b&color=fff";
                        ?>
                        <img id="currentThumb" src="<?= $imgPath ?>" class="img-avatar-preview">
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImg(event)">
                    </div>
                    <small class="text-secondary" style="font-size: 0.78rem;">Chọn ảnh mới nếu muốn thay đổi, hoặc để trống để giữ ảnh cũ.</small>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-update">
                        <i class="fa-solid fa-check me-2"></i>Cập Nhật Thông Tin
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function previewImg(e) {
            const [file] = e.target.files;
            if (file) {
                const thumb = document.getElementById('currentThumb');
                thumb.src = URL.createObjectURL(file);
            }
        }
    </script>
</body>
</html>
