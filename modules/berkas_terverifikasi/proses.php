<?php
session_start();
require_once "../../sendemail.php";
require_once "../../config/database.php";
require_once "../../config/helper.php";

if (empty($_SESSION['nama_pengguna']) OR empty($_SESSION['id_akun'])){
    echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
}else {
    date_default_timezone_set('Asia/Singapore');
    $waktu=date('Y-m-d H:i:s');
    $periode=$_GET['periode'];
    if(isset($_GET['simtun'])){
        $status="S4";
        if (isset($_POST["nuptk"]) && is_array($_POST["nuptk"])) {
            $nuptkArray = $_POST["nuptk"];
            foreach ($nuptkArray as $nuptk) {
                $getidsekolah=mysqli_query($mysqli,"SELECT id_sekolah FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                $id_sekolah=mysqli_fetch_assoc($getidsekolah);
                $id_sekolah=$id_sekolah['id_sekolah'];
                $getemail=mysqli_query($mysqli,"SELECT email FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE id_sekolah='$id_sekolah' AND kode_akses='3'");
                $email=mysqli_fetch_assoc($getemail);
                $email=$email['email'];
                $mail->addAddress($email, "");
                $mail->isHTML(true);
                $mail->Subject = "BERKAS TELAH LANJUT KE TAHAP BERIKUT";
                $mail->Body    = "Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda usulkan untuk Guru dengan NUPTK ".$nuptk." telah melewati proses pengajuan SIMTUN dan saat ini sedang menunggu verifikasi SIMBAR. Terima Kasih.";
                $mail->AltBody = "#ALDRIN SERTIFIKASI";
                
                if($mail->send()){
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET status='$status' WHERE periode='$periode' AND nuptk='$nuptk'");
                    $queryget=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,'Semua Berkas','Konfirmasi Kirim SIMTUN');
                    header('location:../../main.php?module=berkas_terverifikasi&alert=2&k=1');
                }else{
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET status='$status' WHERE periode='$periode' AND nuptk='$nuptk'");
                    $queryget=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,'Semua Berkas','Konfirmasi Kirim SIMTUN');
                    header('location:../../main.php?module=berkas_terverifikasi&alert=2&k=1');
                }
            }
        } else {
            header('location:../../main.php?module=berkas_terverifikasi&alert=3&k=2');
        }
    }elseif(isset($_GET['simbar'])){
        if (isset($_POST["nuptk"]) && is_array($_POST["nuptk"])) {
            $nuptkArray = $_POST["nuptk"];
            foreach ($nuptkArray as $nuptk) {
                if(isset($_POST['batal_validasi'])){
                    $status="S3";
                    $subjek="BERKAS DIMUNDURKAN KE TAHAP SEBELUMNYA";
                    $body="Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda usulkan untuk Guru dengan NUPTK ".$nuptk." dibatalkan dan kembali ke tahap Menunggu Verifikasi SIMTUN. Untuk info lebih lanjut dapat menghubungi Admin ALDRIN SERTIFIKASI. Terima Kasih.";
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET status='$status' WHERE periode='$periode' AND nuptk='$nuptk'");
                    $queryget=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,'Semua Berkas','Batalkan Validasi SIMBAR ke SIMTUN');
                }else{
                    $status="S5";
                    $subjek="BERKAS TELAH LANJUT KE TAHAP BERIKUT";
                    $body="Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda usulkan untuk Guru dengan NUPTK ".$nuptk." telah selesai proses SIMBAR dan saat ini sedang menunggu verifikasi SPM. Terima Kasih.";
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET status='$status' WHERE periode='$periode' AND nuptk='$nuptk'");
                    $queryget=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,'Semua Berkas','Konfirmasi Kirim SIMBAR');
                }
                $getidsekolah=mysqli_query($mysqli,"SELECT id_sekolah FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                $id_sekolah=mysqli_fetch_assoc($getidsekolah);
                $id_sekolah=$id_sekolah['id_sekolah'];
                $getemail=mysqli_query($mysqli,"SELECT email FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun  WHERE id_sekolah='$id_sekolah' AND kode_akses='3'");
                $email=mysqli_fetch_assoc($getemail);
                $email=$email['email'];
                $mail->addAddress($email, "");
                $mail->isHTML(true);
                $mail->Subject = $subjek;
                $mail->Body    = $body;
                $mail->AltBody = "#SIPGTK";
                if($mail->send()){    
                    header('location:../../main.php?module=berkas_terverifikasi&alert=4&k=2');
                }else{
                    header('location:../../main.php?module=berkas_terverifikasi&alert=4&k=2');
                }
            }
        } else {
            header('location:../../main.php?module=berkas_terverifikasi&alert=5&k=2');
        }
    }elseif(isset($_GET['selesai'])){
        $status="S6";
        if (isset($_POST["nuptk"]) && is_array($_POST["nuptk"])) {
            $nuptkArray = $_POST["nuptk"];
            foreach ($nuptkArray as $nuptk) {
                $getidsekolah=mysqli_query($mysqli,"SELECT id_sekolah FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                $id_sekolah=mysqli_fetch_assoc($getidsekolah);
                $id_sekolah=$id_sekolah['id_sekolah'];
                $getemail=mysqli_query($mysqli,"SELECT email FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE id_sekolah='$id_sekolah' AND kode_akses='3'");
                $email=mysqli_fetch_assoc($getemail);
                $email=$email['email'];
                $mail->addAddress($email, "");
                $mail->isHTML(true);
                $mail->Subject = "BERKAS TELAH SELESAI ADMINISTRASI";
                $mail->Body    = "Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda usulkan untuk Guru dengan NUPTK ".$nuptk." telah selesai secara pemberkasan (administrasi). Mohon untuk menunggu pembayaran ± 2 Minggu. Terima Kasih.";
                $mail->AltBody = "#ALDRIN SERTIFIKASI";

                if($mail->send()){    
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET status='$status', keterangan='' WHERE periode='$periode' AND nuptk='$nuptk'");
                    $queryget=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,'Semua Berkas','Konfirmasi Selesai SPM');
                    header('location:../../main.php?module=berkas_terverifikasi&alert=6&k=3');
                }else{    
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET status='$status', keterangan='' WHERE periode='$periode' AND nuptk='$nuptk'");
                    $queryget=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE periode='$periode' AND nuptk='$nuptk'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,'Semua Berkas','Konfirmasi Selesai SPM');
                    header('location:../../main.php?module=berkas_terverifikasi&alert=6&k=3');
                }
            }
        } else {
            header('location:../../main.php?module=berkas_terverifikasi&alert=7&k=3');
        }
    }
}
?>