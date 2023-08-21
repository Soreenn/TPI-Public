<?php

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Source\Constant;


class MailController extends Controller
{
    public function send(string $subject, string $body)
    {
        $mail = new PHPMailer(false);

        try {
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = Constant::MAIL_host;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = Constant::MAIL_username;                     //SMTP username
            $mail->Password   = Constant::Mail_password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = Constant::Mail_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('noreply@forumgab.mycpnv.ch', 'Yotsuba - noreply');
            $mail->addAddress($_SESSION['email']);               //Name is optional

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
