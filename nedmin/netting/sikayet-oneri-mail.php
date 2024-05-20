<?php

include '../../PHPMailer/src/SMTP.php';
include '../../PHPMailer/src/PHPMailer.php';
include '../../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\Exception;


$isim = $_POST['isim'];
$soyisim = $_POST['soyisim'];
$email = $_POST['email'];
$mesaj = $_POST['mesaj'];

$mail = new PHPMailer();
$mail->Host = "smtp.gmail.com";
$mail->Username = 'eatingmakeriletisim@gmail.com';
$mail->Password = 'deneme123';
$mail->Port = 587;
$mail->SMTPsecure = 'tls';
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->isHTML(true);
$mail->CharSet = "UTF-8";
$mail->setLanguage('tr', 'PHPMailer/language//');
$mail->setFrom('eatingmakeriletisim@gmail.com', "Eating Maker");
$mail->addAddress('eatingmakeriletisim@gmail.com', "Ulaş Demir");
$mail->Subject = "Şikayet/Öneri Formu";

$icerik = "<h3 style='text-transform: capitalize;  font-weight: normal;'>" . "Merhaba Eating Maker," . "</h3>"  . "<h4 style='padding-left:70px; text-transform: capitalize;  font-weight: normal;'>" . $mesaj . "</h4>"  . "<h4 style='text-transform: capitalize;  font-weight: normal;'>" . $isim . " " . $soyisim . "." . "</h4>" . "<h3 style='text-transform: capitalize;  font-weight: normal;'>" . "$email" . "</h3>";

$mail->MsgHTML($icerik);
$mail_gonder = $mail->send();
if ($mail_gonder) {
    header("Location:../../sikayet-oneri.php?durum=ok");
} else {
    header("Location:../../sikayet-oneri.php?durum=no");
}
