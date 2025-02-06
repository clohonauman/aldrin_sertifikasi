<?php
session_start();
date_default_timezone_set('Asia/Singapore');
$waktu=date('Y-m-d H:i:s');

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
require_once "../../config/helper.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['nama_pengguna']) && empty($_SESSION['id_akun'])){
    echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk ubah password
else {
    if (isset($_POST['simpan'])) {
        if (isset($_SESSION['id_akun'])) {
            // ambil data hasil submit dari form
            $old_pass    = $_POST['old_pass'];
            $new_pass    = $_POST['new_pass'];
            $retype_pass = $_POST['retype_pass'];
            $id_akun = $_SESSION['id_akun'];
            $querycekpass = mysqli_query($mysqli, "SELECT kata_sandi FROM akun WHERE id_akun='$id_akun'")
                                          or die('Ada kesalahan pada query seleksi password : '.mysqli_error($mysqli));
            $data = mysqli_fetch_assoc($querycekpass);
            if (!password_verify($old_pass,$data['kata_sandi'])){
                header("Location: ../../main.php?module=password&alert=1");
            }
            else { 
                if ($new_pass != $retype_pass){
                        header("Location: ../../main.php?module=password&alert=2");
                }
                else {
                    $kata_sandi=password_hash($new_pass, PASSWORD_DEFAULT);
                    $query = mysqli_query($mysqli, "UPDATE akun SET kata_sandi = '$kata_sandi'
                                                                  WHERE id_akun  = '$id_akun'")
                                                    or die('Ada kesalahan pada query update password : '.mysqli_error($mysqli));   
                    if ($query) {
                        logActivity('-',$waktu,'ID Akun:'.$id_akun,'UBAH KATA SANDI');
                        header("location: ../../main.php?module=password&alert=3");
                    }else{
                        header("location: ../../main.php?module=password&alert=4");
                    }   
                }
            }
        }
    }   
}               
?>