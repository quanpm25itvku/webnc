<?php
require_once 'connect.php';

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idgv = trim($_POST['idgv'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $sumclass = intval($_POST['sumclass'] ?? 0);

    // Kiểm tra trùng mã IDGV
    $checkSql = "SELECT IDGV FROM GiangVien WHERE IDGV = ?";
    $stmtCheck = $conn->prepare($checkSql);
    $stmtCheck->bind_param("s", $idgv);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();

    if ($resCheck->num_rows > 0) {
        $message = "Mã giảng viên $idgv đã tồn tại trong hệ thống!";
        $messageType = "danger";
    } else {
        // Xử lý upload ảnh
        $imageName = "default.png";
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $filename = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($ext, $allowed)) {
                $imageName = time() . "_" . uniqid() . "." . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
            } else {
                $message = "Chỉ chấp nhận file ảnh (jpg, png, gif, webp)!";
                $messageType = "warning";
            }
        }

        if (empty($message)) {
            $sql = "INSERT INTO GiangVien (IDGV, Fullname, Image, SumClass) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $idgv, $fullname, $imageName, $sumclass);

            if ($stmt->execute()) {
                header("Location: index.php?msg=add_success");
                exit();
            } else {
                $message = "Lỗi: " . $conn->error;
                $messageType = "danger";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Mới Giảng Viên</title>
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
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.12) 0px, transparent 50%);
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
        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        }
        .form-label {
            color: #cbd5e1;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .btn-neon {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            color: #fff;
            border: none;
            padding: 11px 24px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
            transition: all 0.2s;
        }
        .btn-neon:hover {
            transform: translateY(-2px);
            color: #fff;
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
        }
        .upload-zone {
            border: 2px dashed rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            background: rgba(255, 255, 255, 0.02);
            cursor: pointer;
        }
        .preview-avatar {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.2);
            display: none;
        }
    </style>
</head>
<body>

    <div class="container py-5" style="max-width: 580px;">
        
        <div class="glass-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <span class="badge text-bg-primary rounded-pill px-3 py-1 mb-2" style="font-size: 0.7rem;">CREATE &bull; GIANGVIEN</span>
                    <h3 class="fw-bold mb-0">Thêm Giảng Viên</h3>
                </div>
                <a href="index.php" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-color: rgba(255,255,255,0.15);">
                    <i class="fa-solid fa-arrow-left me-1"></i> Trở về
                </a>
            </div>

            <?php if (!empty($message)): ?>
                <div class="alert alert-<?= $messageType ?> py-2 small mb-4" style="border-radius: 10px;"><?= $message ?></div>
            <?php endif; ?>

            <form action="add.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Mã Giảng Viên (IDGV) <span class="text-danger">*</span></label>
                    <input type="text" name="idgv" class="form-control" placeholder="Ví dụ: GV01, GV02..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ và Tên (Fullname) <span class="text-danger">*</span></label>
                    <input type="text" name="fullname" class="form-control" placeholder="Ví dụ: TS. Trần Văn Minh" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tổng Số Lớp (SumClass) <span class="text-danger">*</span></label>
                    <input type="number" name="sumclass" class="form-control" min="0" value="1" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Ảnh đại diện (Image)</label>
                    <div class="upload-zone mb-2">
                        <input type="file" name="image" id="imgInp" class="form-control" accept="image/*" onchange="previewImg(event)">
                        <div class="mt-3 text-center" id="imgBox">
                            <img id="previewThumb" src="" class="preview-avatar mx-auto">
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-neon">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Lưu Giảng Viên
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function previewImg(e) {
            const [file] = e.target.files;
            if (file) {
                const thumb = document.getElementById('previewThumb');
                thumb.src = URL.createObjectURL(file);
                thumb.style.display = 'block';
            }
        }
    </script>
</body>
</html>
