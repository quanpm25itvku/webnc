<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>DEMO GỬI EMAIL</title>
    <!-- Nhúng Bootstrap 4 để làm giao diện đẹp giống bài lab -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4" style="max-width: 600px;">
    <h2>Email tới bạn</h2>
    <!-- Thuộc tính action="mail.php" sẽ chuyển dữ liệu sang file mail.php khi bấm Gửi -->
    <form action="mail.php" enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Nhập email người nhận" required>
        </div>
        <div class="form-group">
            <label>Subject:</label>
            <input type="text" class="form-control" name="tieude" placeholder="Nhập tiêu đề" required>
        </div>
        <div class="form-group">
            <label>Nội dung:</label>
            <textarea name="content" id="editor" class="form-control" rows="5" placeholder="Nhập nội dung thư" required></textarea>
        </div>
        <div class="form-group">
            <label>File đính kèm:</label>
            <input type="file" class="form-control-file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>
</body>
</html>