<?php
session_start();
require_once "../../config/database.php";
require_once "../../config/helper.php";
if (empty($_SESSION['id_akun'])){
    echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
}
else {
    date_default_timezone_set('Asia/Singapore');
    $waktu=date('Y-m-d H:i:s');
    if(isset($_GET['id'])){
        $id_akun=$_GET['id'];
        if(isset($_GET['blok'])){
            $query=mysqli_query($mysqli,"UPDATE akun SET status='blokir' WHERE id_akun='$id_akun'");
            if($query){
                $querylog=mysqli_query($mysqli,"INSERT INTO log_aktifitas (id_pengusulan_sktp,id_akun,keterangan,waktu) VALUES ('','$_SESSION[id_akun]','BLOKIR AKUN,ID Akun:$id_akun','$waktu')");
                header('location:../../main.php?module=manajemen_pengguna&alert=1');
            }else{
                header('location:../../main.php?module=manajemen_pengguna&alert=2');
            }
        }elseif(isset($_GET['aktif'])){
            $query=mysqli_query($mysqli,"UPDATE akun SET status='aktif' WHERE id_akun='$id_akun'");
            if($query){
                $querylog=mysqli_query($mysqli,"INSERT INTO log_aktifitas (id_pengusulan_sktp,id_akun,keterangan,waktu) VALUES ('','$_SESSION[id_akun]','BUKA BLOKIR AKUN,ID Akun:$id_akun','$waktu')");
                header('location:../../main.php?module=manajemen_pengguna&alert=3');
            }else{
                header('location:../../main.php?module=manajemen_pengguna&alert=4');
            }
        }elseif(isset($_GET['reset'])){
            $queryakun=mysqli_query($mysqli,"SELECT akun.id_akun,kode_akses,id_sekolah FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE akun.id_akun='$id_akun'");
            $data=mysqli_fetch_assoc($queryakun);

            $querysekolah=mysqli_query($mysqli2,"SELECT npsn FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
            $datasekolah=mysqli_fetch_assoc($querysekolah);
            $ks=password_hash("123456", PASSWORD_DEFAULT);
            $ka=$data['kode_akses'];
            if($ka==1){
                $un="verifikator1".$data['id_akun'];
            }elseif($ka==2){
                $un="verifikator2".$data['id_akun'];
            }elseif($ka==3){
                $un="operator".$datasekolah['npsn'];
            }elseif($ka==4){
                $un="renkeu".$data['id_akun'];
            }elseif($ka==5){
                $un="kepsek".$data['id_akun'];
            }elseif($ka==0){
                $un="Admin123456";
            }
            $query=mysqli_query($mysqli,"UPDATE akun SET nama_pengguna='$un', kata_sandi='$ks' WHERE id_akun='$id_akun'");
            if($query){
                logActivity('-',$waktu,'ID Akun:'.$id_akun,'RESET AKUN');
                header('location:../../main.php?module=manajemen_pengguna&alert=5');
            }else{
                header('location:../../main.php?module=manajemen_pengguna&alert=6');
            }
        }elseif(isset($_GET['add'])){
            $id_akun                = $_POST['id_akun'];
            $nama_pengguna          = $_POST['nama_pengguna'];
            $kode_akses             = $_POST['kode_akses'];
            $nama_lengkap           = $_POST['nama_lengkap'];
            $katasandi              = $_POST['kata_sandi'];
            $katasandi              = password_hash($katasandi,PASSWORD_DEFAULT);
            if(!empty($_POST['cabdin']) AND empty($_POST['sekolah'])){
                $cabdin=$_POST['cabdin'];
                $query = mysqli_query($mysqli, "INSERT INTO akun (id_akun, nama_pengguna, kata_sandi, nama_lengkap, status, session) VALUES ('$id_akun','$nama_pengguna','$katasandi','$nama_lengkap','aktif','0')") or die('Ada kesalahan pada query : '. mysqli_error($mysqli));
                $query2 = mysqli_query($mysqli, "INSERT INTO peran (id_akun, kode_akses, cabdin, waktu) VALUES ('$id_akun','$kode_akses','$cabdin','$waktu')") or die('Ada kesalahan pada query : '. mysqli_error($mysqli));
                if ($query AND $query2) {
                    logActivity('-',$waktu,'ID Akun:'.$id_akun,'BUAT AKUN PENGGUNA BARU');
                    header("Location: ../../main.php?module=manajemen_pengguna&alert=7");
                }else{
                    header("Location: ../../main.php?module=manajemen_pengguna&alert=8");
                }
            }elseif(!empty($_POST['sekolah']) AND empty($_POST['cabdin'])){
                $id_sekolah=$_POST['sekolah'];
                $query_data_sekolah=mysqli_query($mysqli2,"SELECT sekolah_id, nama, kabupaten FROM sekolah WHERE sekolah_id='$id_sekolah'");
                if(mysqli_num_rows($query_data_sekolah)>0){
                    $data_sekolah=mysqli_fetch_assoc($query_data_sekolah);
                    $nama_sekolah=$data_sekolah['nama'];
                    $kabupaten=$data_sekolah['kabupaten'];
                    $query = mysqli_query($mysqli, "INSERT INTO akun (id_akun, nama_pengguna, kata_sandi, nama_lengkap, status, session) VALUES ('$id_akun','$nama_pengguna','$katasandi','$nama_lengkap','aktif','0')") or die('Ada kesalahan pada query : '. mysqli_error($mysqli));
                    $query2 = mysqli_query($mysqli, "INSERT INTO peran (id_akun, kode_akses, id_sekolah, nama_sekolah, kabupaten, waktu) VALUES ('$id_akun','$kode_akses','$id_sekolah','$nama_sekolah','$kabupaten','$waktu')") or die('Ada kesalahan pada query : '. mysqli_error($mysqli));
                    if ($query AND $query2) {
                        logActivity('-',$waktu,'ID Akun:'.$id_akun,'BUAT AKUN PENGGUNA BARU');
                        header("Location: ../../main.php?module=manajemen_pengguna&alert=7");
                    }else{
                        header("Location: ../../main.php?module=manajemen_pengguna&alert=8");
                    }
                }else{
                    header("Location: ../../main.php?module=manajemen_pengguna&alert=8");
                }
            }else{
                $query = mysqli_query($mysqli, "INSERT INTO akun (id_akun, nama_pengguna, kata_sandi, nama_lengkap, status, session) VALUES ('$id_akun','$nama_pengguna','$katasandi','$nama_lengkap','aktif','0')") or die('Ada kesalahan pada query : '. mysqli_error($mysqli));
                $query2 = mysqli_query($mysqli, "INSERT INTO peran (id_akun, kode_akses, waktu) VALUES ('$id_akun','$kode_akses','$waktu')") or die('Ada kesalahan pada query : '. mysqli_error($mysqli));
                if ($query AND $query2) {
                    logActivity('-',$waktu,'ID Akun:'.$id_akun,'BUAT AKUN PENGGUNA BARU');
                    header("Location: ../../main.php?module=manajemen_pengguna&alert=7");
                }else{
                    header("Location: ../../main.php?module=manajemen_pengguna&alert=8");
                }
            }
        }else{
            header('location:../../main.php?module=manajemen_pengguna');
        }
    }else{
        header('location:../../main.php?module=manajemen_pengguna');
    }
}         
?>