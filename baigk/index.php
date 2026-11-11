<?php
require_once 'connect.php';

// Lấy danh sách giảng viên
$sql = "SELECT * FROM GiangVien ORDER BY IDGV ASC";
$result = $conn->query($sql);

// Tính toán thống kê nhanh
$totalGV = 0;
$totalClasses = 0;
$list = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
        $totalGV++;
        $totalClasses += intval($row['SumClass']);
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản Lý Giảng Viên</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons / FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --bg-body: #0b0f19;
            --card-bg: rgba(22, 29, 47, 0.75);
            --card-border: rgba(255, 255, 255, 0.08);
            --neon-accent: #6366f1;
            --neon-glow: rgba(99, 102, 241, 0.25);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        body {
            background-color: var(--bg-body);
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.12) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(14, 165, 233, 0.08) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
        }

        .mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        }

        .stat-card {
            border-radius: 16px;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.25s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .btn-neon {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-neon:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.55);
            color: #fff;
        }

        /* Modern Table */
        .cyber-table {
            border-collapse: separate;
            border-spacing: 0 8px;
            width: 100%;
        }
        .cyber-table thead th {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px 18px;
            border: none;
        }
        .cyber-table tbody tr {
            background: rgba(255, 255, 255, 0.02);
            transition: all 0.2s ease;
            border-radius: 14px;
        }
        .cyber-table tbody tr td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }
        .cyber-table tbody tr td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }
        .cyber-table tbody tr:hover {
            background: rgba(99, 102, 241, 0.08);
            transform: scale([1.002]);
        }
        .cyber-table td {
            padding: 14px 18px;
            border: none;
            vertical-align: middle;
        }

        .avatar-wrap {
            position: relative;
            display: inline-block;
        }
        .avatar-img {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .code-badge {
            background: rgba(99, 102, 241, 0.15);
            color: #a5b4fc;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid rgba(99, 102, 241, 0.3);
            font-size: 0.85rem;
            font-weight: 600;
        }
        .class-pill {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            padding: 5px 14px;
            border-radius: 20px;
            border: 1px solid rgba(16, 185, 129, 0.25);
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .action-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.04);
            color: var(--text-main);
            transition: all 0.2s;
            text-decoration: none;
        }
        .action-btn.edit:hover {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.4);
        }
        .action-btn.delete:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.4);
        }
        .custom-alert {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <div class="container py-5" style="max-width: 1050px;">

        <!-- Header bar -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="badge rounded-pill text-bg-primary px-3 py-1" style="font-size: 0.72rem; letter-spacing: 0.8px;">QLHocPhan &bull; SYSTEM</span>
                </div>
                <h2 class="fw-bold mb-0" style="letter-spacing: -0.5px;">Quản Lý Giảng Viên</h2>
            </div>
            
            <a href="add.php" class="btn btn-neon">
                <i class="fa-solid fa-plus me-2"></i>Thêm Giảng Viên
            </a>
        </div>

        <!-- Quick Stats Overview -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(99, 102, 241, 0.2); color: #818cf8; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Tổng Giảng Viên</div>
                        <div class="fs-4 fw-bold mono"><?= $totalGV ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(52, 211, 153, 0.2); color: #34d399; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        <i class="fa-solid fa-chalkboard"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Tổng Lớp Giảng Dạy</div>
                        <div class="fs-4 fw-bold mono"><?= $totalClasses ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(236, 72, 153, 0.2); color: #f472b6; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Bảng Cơ Sở Dữ Liệu</div>
                        <div class="fw-bold mono text-truncate" style="font-size: 1rem; color: #f472b6;">GiangVien</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notifications -->
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'add_success'): ?>
                <div class="custom-alert p-3 mb-4 d-flex align-items-center justify-content-between">
                    <div><i class="fa-solid fa-circle-check me-2"></i>Thêm dữ liệu giảng viên mới thành công!</div>
                    <a href="index.php" class="text-decoration-none text-light opacity-50">&times;</a>
                </div>
            <?php elseif ($_GET['msg'] == 'edit_success'): ?>
                <div class="custom-alert p-3 mb-4 d-flex align-items-center justify-content-between" style="background: rgba(59, 130, 246, 0.15); border-color: rgba(59, 130, 246, 0.3); color: #93c5fd;">
                    <div><i class="fa-solid fa-circle-check me-2"></i>Cập nhật thông tin giảng viên thành công!</div>
                    <a href="index.php" class="text-decoration-none text-light opacity-50">&times;</a>
                </div>
            <?php elseif ($_GET['msg'] == 'delete_success'): ?>
                <div class="custom-alert p-3 mb-4 d-flex align-items-center justify-content-between" style="background: rgba(244, 63, 94, 0.15); border-color: rgba(244, 63, 94, 0.3); color: #fda4af;">
                    <div><i class="fa-solid fa-trash-can me-2"></i>Đã xóa giảng viên khỏi cơ sở dữ liệu!</div>
                    <a href="index.php" class="text-decoration-none text-light opacity-50">&times;</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Glass Table Container -->
        <div class="glass-card p-4">
            <div class="table-responsive">
                <table class="cyber-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">STT</th>
                            <th style="width: 140px;">Mã GV</th>
                            <th style="width: 90px;" class="text-center">Avatar</th>
                            <th>Họ và Tên Giảng Viên</th>
                            <th class="text-center" style="width: 180px;">Tổng Số Lớp</th>
                            <th class="text-center" style="width: 120px;">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($list) > 0): ?>
                            <?php $stt = 1; foreach ($list as $row): ?>
                                <tr>
                                    <td class="text-center mono text-secondary"><?= sprintf('%02d', $stt++) ?></td>
                                    <td>
                                        <span class="code-badge mono"><?= htmlspecialchars($row['IDGV']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="avatar-wrap">
                                            <?php 
                                                $imgSrc = (!empty($row['Image']) && file_exists("uploads/" . $row['Image'])) 
                                                    ? "uploads/" . htmlspecialchars($row['Image']) 
                                                    : "https://ui-avatars.com/api/?name=" . urlencode($row['Fullname']) . "&background=6366f1&color=fff";
                                            ?>
                                            <img src="<?= $imgSrc ?>" alt="Avatar" class="avatar-img">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-white fs-6"><?= htmlspecialchars($row['Fullname']) ?></div>
                                        <span class="text-secondary small">Giảng viên bộ môn</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="class-pill mono">
                                            <i class="fa-solid fa-book-open"></i>
                                            <?= htmlspecialchars($row['SumClass']) ?> lớp
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="edit.php?id=<?= urlencode($row['IDGV']) ?>" class="action-btn edit" title="Chỉnh sửa">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="delete.php?id=<?= urlencode($row['IDGV']) ?>" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa giảng viên <?= htmlspecialchars($row['Fullname']) ?> không?');" title="Xóa">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    <i class="fa-solid fa-layer-group fa-2x mb-3 d-block opacity-40"></i>
                                    Chưa có dữ liệu nào trong bảng GiangVien.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

</body>
</html>
