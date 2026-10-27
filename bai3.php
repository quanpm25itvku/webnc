<?php
// 1. Nhúng thư viện PHPMailer vào bài
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

$mail = new PHPMailer\PHPMailer\PHPMailer(true);

try {
    // 2. Cấu hình Máy chủ SMTP của Gmail
    $mail->isSMTP();
    $mail->CharSet   = "utf-8";
    $mail->Host      = 'smtp.gmail.com';
    $mail->SMTPAuth  = true;

    $nguoigui    = 'pmwuann207@gmail.com';
    $matkhau     = 'alkp upmh nivu dkvv';

    $mail->Username   = $nguoigui;
    $mail->Password   = $matkhau;
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // 3. Cài đặt tên & email người gửi
    $mail->setFrom($nguoigui, 'Hệ Thống Thông Báo');

    // ---------------------------------------------------------------------
    // 4. XỬ LÝ GỬI CHO NHIỀU EMAIL
    // ---------------------------------------------------------------------

    // Chuỗi chứa danh sách email cách nhau bằng dấu phẩy
    $recipients = "quanpm.25it@vku.udn.vn, minwuan207@gmail.com, tvjenky@gmail.com";

    // Cắt chuỗi thành mảng các email riêng biệt
    $email_array = explode(",", $recipients);

    // Dùng vòng lặp foreach để nạp từng email vào danh sách nhận
    foreach ($email_array as $email) {
        $to = trim($email); // trim() để xóa khoảng trắng thừa ở 2 đầu (nếu có)
        $mail->addAddress($to); // Thêm người nhận vào danh sách gửi
    }

    // 5. Nội dung email gửi đi
    $mail->isHTML(true);
    $mail->Subject = 'Thông báo gửi thư hàng loạt';
    $mail->Body    = '<b>Xin chào!</b><br>Đây là email tự động gửi cùng lúc cho nhiều người.';

    // Bỏ qua kiểm tra chứng chỉ SSL để chạy mượt trên Localhost
    $mail->smtpConnect([
        "ssl" => [
            "verify_peer"       => false,
            "verify_peer_name"  => false,
            "allow_self_signed" => true
        ]
    ]);

    // 6. Tiến hành gửi mail
    $mail->send();
    echo 'Đã gửi mail hàng loạt thành công!';

} catch (Exception $e) {
    echo 'Lỗi không gửi được mail: ', $mail->ErrorInfo;
}
?>