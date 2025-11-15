<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                 
    $mail->Host       = 'smtp.gmail.com';   // PASTE HERE
    $mail->SMTPAuth   = true;
    $mail->Username   = 'yourgmail@gmail.com'; // PASTE HERE
    $mail->Password   = 'your_app_password';   // PASTE HERE
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;                 // PASTE HERE

    $mail->setFrom('yourgmail@gmail.com', 'Your Name');
    $mail->addAddress('receiver@example.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test Mail';
    $mail->Body    = 'Mail working!';

    $mail->send();
    echo "Mail sent!";
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
