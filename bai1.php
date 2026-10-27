<?php
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

$mail = new PHPMailer\PHPMailer\PHPMailer(true);

try {
    // Cấu hình SMTP
    $mail->isSMTP();
    $mail->CharSet   = "utf-8";
    $mail->Host      = 'smtp.gmail.com';
    $mail->SMTPAuth  = true;

    // Thông tin tài khoản gửi
    $nguoigui    = 'pmwuann207@gmail.com';
    $matkhau     = 'alkp upmh nivu dkvv';
    $tennguoigui = 'PHAM MINH QUAN';

    $mail->Username   = $nguoigui;
    $mail->Password   = $matkhau;
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Người gửi và Người nhận
    $mail->setFrom($nguoigui, $tennguoigui);

    $to      = "quanpm.25it@vku.udn.vn";          // Email người nhận cố định
    $to_name = "minhquan";
    $mail->addAddress($to, $to_name);

    // Nội dung Email
    $mail->isHTML(true);
    $mail->Subject = 'Gửi thư từ PHP';
    $mail->Body    = "<b>Chào bạn!</b><br>Chúc an lành!";

    // Đính kèm tệp (nếu có tệp 4.jpg cùng thư mục)
    if (file_exists("4.jpg")) {
        $mail->addAttachment("4.jpg", "picture.jpg");
    }

    $mail->smtpConnect([
        "ssl" => [
            "verify_peer"       => false,
            "verify_peer_name"  => false,
            "allow_self_signed" => true
        ]
    ]);

    $mail->send();
    echo 'Đã gửi mail thành công!';
} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
?>