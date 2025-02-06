
<?php
// panggil file untuk koneksi ke database
require_once "config/database.php";
require_once "config/helper.php";
date_default_timezone_set('Asia/Singapore');
$waktu=date('Y-m-d H:i:s');
session_start();
$querysession=mysqli_query($mysqli, "DELETE FROM session WHERE 
                                                                id_akun='$_SESSION[id_akun]' AND
                                                                device_id='$device_id'");
if($querysession){
    logActivity('-',$waktu,'ID Akun:'.$_SESSION['id_akun'],'KELUAR APLIKASI');
    session_start();
    session_destroy();
    header('Location: ./');
}
?>