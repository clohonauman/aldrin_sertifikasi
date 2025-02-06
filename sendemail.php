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
$mail->Username = "sipgtk.sulut@gmail.com";         
$mail->Password = "avhs kewb eluv dbnh";
$mail->SMTPSecure = "tls";     
$mail->Port = 587;                                   

$mail->From = "sipgtk.sulut@gmail.com";
$mail->FromName = "SIPGTK DINAS PENDIDIKAN DAERAH PROVINSI SULAWESI UTARA";
?>