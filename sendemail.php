<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../../library/PHPMailer.php";
require_once "../../library/Exception.php";
require_once "../../library/OAuth.php";
require_once "../../library/POP3.php";
require_once "../../library/SMTP.php";
require_once "../../config/database.php";
require_once "../../config/helper.php";
$mail = new PHPMailer; 
$mail->SMTPDebug = 0;
$mail->isSMTP();                      
$mail->Host = "tls://smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "";         
$mail->Password = "";
$mail->SMTPSecure = "tls";     
$mail->Port = 587;                                   

$mail->From = "";
$mail->FromName = "ALDRIN SERTIFIKASI | DINAS PENDIDIKAN KABUPATEN MINAHASA UTARA";
?>