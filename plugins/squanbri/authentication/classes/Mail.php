<?php namespace Squanbri\Authentication\Classes;

// var_dump(dirname(__DIR__.'/../vendor'), "<br>", scandir(__DIR__."/../vendor"));

use Db;
use Hash;
use Crypt;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/../libraries/PHPMailer/src/Exception.php';
require __DIR__.'/../libraries/PHPMailer/src/PHPMailer.php';
require __DIR__.'/../libraries/PHPMailer/src/SMTP.php';

class Mail 
{ 
  public function sendToActivateMail($email, $code, $type) 
  {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings 
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->CharSet = "utf-8";
        $mail->SMTPAuth = true;
        $mail->Username = 'archk.rab@gmail.com';
        $mail->Password = '5e7Y2BDATk';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = '587';                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($email);
        $mail->addAddress($email); 

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = '<h1>Активация аккаунта в archk</h1>';
        $mail->Body = '<div>Чтобы акктиворать свою учётную заись перейдите по <a href='."rab.archksakhalin.ru?activate=$code&email=$email&type=$type".'>ссылке</a></div>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        var_dump("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
  }
}
?>