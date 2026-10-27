<?php
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Cấu hình Server
        $mail->isSMTP();
        $mail->CharSet   = "utf-8";
        $mail->Host      = 'smtp.gmail.com';
        $mail->SMTPAuth  = true;

        $nguoigui    = 'pmwuann207@gmail.com';
        $matkhau     = 'alkp upmh nivu dkvv';
        $tennguoigui = 'Hệ Thống Website';

        $mail->Username   = $nguoigui;
        $mail->Password   = $matkhau;
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Cấu hình người gửi & nhận
        $mail->setFrom($nguoigui, $tennguoigui);

        $to      = $_POST['email'];
        $to_name = "Khách hàng";
        $tieude  = $_POST['tieude'];

        $mail->addAddress($to, $to_name);

        // Định dạng Nội dung Email
        $mail->isHTML(true);
        $mail->Subject = $tieude;

        $noidungthu = '
        <div class="card" style="border: 1px solid #ccc; padding: 15px;">
            <div class="card-body">
                <h5 class="card-title"><b>Xin chào ' . htmlspecialchars($to_name) . '</b></h5>
                <p class="card-text">' . nl2br(htmlspecialchars($_POST['content'])) . '</p>
            </div>
        </div>';
        $mail->Body = $noidungthu;

        // Xử lý tệp đính kèm
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $mail->addAttachment($uploadfile, $_FILES['file']['name']);
            }
        }

        // Bỏ qua xác thực SSL khi test trên Localhost
        $mail->smtpConnect([
            "ssl" => [
                "verify_peer"       => false,
                "verify_peer_name"  => false,
                "allow_self_signed" => true
            ]
        ]);

        if ($mail->send()) {
            echo "<script>alert('Gửi email thành công!'); window.location.href='index.php';</script>";
        }
    } catch (Exception $e) {
        echo "Mail không gửi được. Lỗi: {$mail->ErrorInfo}";
    }
}
?>