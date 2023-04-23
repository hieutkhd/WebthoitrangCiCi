<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class SendMail
{
    public function send($title, $content, $nTo, $mTo,$diachicc='')
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mail sử dụng SMTP
            $mail->Host = 'smtp.gmail.com';  // Chỉ định máy chủ SMTP chính và dự phòng
            $mail->SMTPAuth = true;                               // Kích hoạt xác thực SMTP
            $mail->Username = 'duocnguyenit1994@gmail.com';                 // SMTP username
            $mail->Password = 'gdmcjsdzhyoifwjn';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Kích hoạt mã TLS, `ssl` also accepted
            $mail->Port = 587;                                 // Cổng TCP để kết nối với
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //Recipients
            $mail->setFrom('duocnguyenit1994@gmail.com', 'WebthoitrangCici');
            $mail->addAddress($mTo, $nTo);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject =  "=?utf-8?b?".base64_encode($title)."?=";
            $mail->Body    = $content;
            $mail->AltBody = '';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}