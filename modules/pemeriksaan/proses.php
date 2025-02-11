<?php
session_start();
require_once "../../sendemail.php";
require_once "../../config/database.php";
require_once "../../config/helper.php";
if (empty($_SESSION['id_akun'])){
    echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
}
else {
    date_default_timezone_set('Asia/Singapore');
    $waktu=date('Y-m-d H:i:s');
    if(isset($_GET['terima_check'])){
        $periode=$_GET['periode'];
        if (isset($_POST["nuptk"]) && is_array($_POST["nuptk"])) {
            $nuptkArray = $_POST["nuptk"];
            foreach ($nuptkArray as $nuptk) {
                $getidsekolah=mysqli_query($mysqli,"SELECT id_sekolah FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                $id_sekolah=mysqli_fetch_assoc($getidsekolah);
                $id_sekolah=$id_sekolah['id_sekolah'];
                $getemail=mysqli_query($mysqli,"SELECT email FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE id_sekolah='$id_sekolah' AND kode_akses='3'");
                $email=mysqli_fetch_assoc($getemail);
                $email=$email['email'];
                $mail->addAddress($email, "");
                $mail->isHTML(true);
                $mail->Subject = "BERKAS TELAH LANJUT KE TAHAP BERIKUT";
                $mail->Body    = "Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda usulkan untuk Guru dengan NUPTK ".$nuptk." telah disetujui oleh Verifikator 2. Terima Kasih.";
                $mail->AltBody = "#ALDRIN SERTIFIKASI";
                $status='S3';
                $komentar='';

                if($mail->send()){    
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_jurnal='$komentar', 
                                                                        komentar_sk_kepsek='$komentar', 
                                                                        komentar_info_gtk='$komentar', 
                                                                        komentar_sk_pembagian='$komentar', 
                                                                        komentar_sk_pangkat_akhir='$komentar', 
                                                                        komentar_sk_berkala_akhir='$komentar', 
                                                                        komentar_profil_guru='$komentar', 
                                                                        komentar_absen='$komentar', 
                                                                        komentar_lainnya='$komentar', 
                                                                        status='$status',
                                                                        keterangan='Menunggu Verifikasi'
                                                                  WHERE nuptk='$nuptk' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,'SEMUA BERKAS','Selesai Verifikasi 2');
                    header('location:../../main.php?module=pemeriksaan&k=1&alert=4');
                }else{    
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_jurnal='$komentar', 
                                                                        komentar_sk_kepsek='$komentar', 
                                                                        komentar_info_gtk='$komentar', 
                                                                        komentar_sk_pembagian='$komentar', 
                                                                        komentar_sk_pangkat_akhir='$komentar', 
                                                                        komentar_sk_berkala_akhir='$komentar', 
                                                                        komentar_profil_guru='$komentar', 
                                                                        komentar_absen='$komentar', 
                                                                        komentar_lainnya='$komentar', 
                                                                        status='$status',
                                                                        keterangan='Menunggu Verifikasi'
                                                                  WHERE nuptk='$nuptk' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,'SEMUA BERKAS','Selesai Verifikasi 2');
                    header('location:../../main.php?module=pemeriksaan&k=1&alert=5');
                }
            }
        } else {
            header('location:../../main.php?module=pemeriksaan&k=1');
        }
    }elseif(isset($_GET['terima'])){
        $periode=$_GET['periode'];
        if(isset($_GET['jurnal'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_jurnal='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['jurnal'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
        elseif(isset($_GET['sk_kepala_sekolah'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_kepsek='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['pengantar_kepsek'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
        elseif(isset($_GET['info_gtk'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_info_gtk='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['info_gtk'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
        elseif(isset($_GET['sk_pembagian'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_pembagian='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_pembagian'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
        elseif(isset($_GET['sk_pangkat_akhir'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_pangkat_akhir='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_pangkat_akhir'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
        elseif(isset($_GET['sk_berkala_akhir'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_berkala_akhir='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_berkala_akhir'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
        elseif(isset($_GET['profil_guru'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_profil_guru='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['profil_guru'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
        elseif(isset($_GET['absen'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_absen='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['absen'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
        elseif(isset($_GET['lainnya'])){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_lainnya='1234567890terima' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,$data['lainnya'],'TERIMA');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=1');
        }
    }elseif(isset($_GET['tolak'])){
        $periode=$_GET['periode'];
        $getidsekolah=mysqli_query($mysqli,"SELECT id_sekolah FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
        $id_sekolah=mysqli_fetch_assoc($getidsekolah);
        $id_sekolah=$id_sekolah['id_sekolah'];
        $getemail=mysqli_query($mysqli,"SELECT email FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE id_sekolah='$id_sekolah' AND kode_akses='3'");
        $email=mysqli_fetch_assoc($getemail);
        $email=$email['email'];
        
        $mail->addAddress($email, "");
        $mail->isHTML(true);
        $mail->Subject = "BERKAS DITOLAK";
        if(!isset($_POST['tolak_jurnal']) && !isset($_POST['tolak_sk_kepala_sekolah']) && !isset($_POST['tolak_info_gtk']) && !isset($_POST['tolak_sk_pembagian']) && !isset($_POST['tolak_sk_pangkat_akhir']) && !isset($_POST['tolak_sk_berkala_akhir']) && !isset($_POST['tolak_profil_guru']) && !isset($_POST['tolak_komentar_umum']) && !isset($_POST['tolak_lainnya']) && !isset($_POST['tolak_absen'])){
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=2');
        }elseif(isset($_POST['tolak_komentar_umum'])){
            $komentar=$_POST['komentar_tolak'];
            $keterangan="Ditolak";
            if($_SESSION['kode_akses']==1){
                $s="S1";
            }elseif($_SESSION['kode_akses']==2){
                $s="S2";
                $mail->Body    = "Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda ajukan untuk guru dengan NUPTK ".$_GET['id']." telah ditolak oleh Verifikator 2. Silahkan lakukan perbaikan secepatnya sesuai dengan alasan penolakan yang diberikan. Terima Kasih.";
                $mail->AltBody = "#ALDRIN SERTIFIKASI";
            }

            if($mail->send()){
                $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET 
                                                                        keterangan='$keterangan',
                                                                        komentar_jurnal='', 
                                                                        komentar_sk_kepsek='', 
                                                                        komentar_info_gtk='', 
                                                                        komentar_sk_pembagian='', 
                                                                        komentar_sk_pangkat_akhir='', 
                                                                        komentar_sk_berkala_akhir='', 
                                                                        komentar_profil_guru='', 
                                                                        komentar_lainnya='', 
                                                                        komentar_umum='$komentar', 
                                                                        status='$s' 
                                                                  WHERE 
                                                                        nuptk='$_GET[id]' AND periode='$periode'");
                $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                $data=mysqli_fetch_assoc($queryget);
                logActivity($data['id_pengusulan_sktp'],$waktu,'Semua Berkas','TOLAK');
                header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
            }else{
                $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET 
                                                                        keterangan='$keterangan',
                                                                        komentar_jurnal='', 
                                                                        komentar_sk_kepsek='', 
                                                                        komentar_info_gtk='', 
                                                                        komentar_sk_pembagian='', 
                                                                        komentar_sk_pangkat_akhir='', 
                                                                        komentar_sk_berkala_akhir='', 
                                                                        komentar_profil_guru='', 
                                                                        komentar_lainnya='', 
                                                                        komentar_umum='$komentar', 
                                                                        status='$s' 
                                                                  WHERE 
                                                                        nuptk='$_GET[id]' AND periode='$periode'");
                $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                $data=mysqli_fetch_assoc($queryget);
                logActivity($data['id_pengusulan_sktp'],$waktu,'Semua Berkas','TOLAK');
                header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
            }
        }else{
            if(empty($_POST['komentar_tolak']) && !isset($_POST['komentar_tolak_select'])){
                //tidak memilih dan tidak mengisi.
                header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=2');                
            }elseif(!empty($_POST['komentar_tolak']) && !isset($_POST['komentar_tolak_select'])){
                //tidak memilih tapi telah mengisi.
                if(isset($_POST['tolak_jurnal'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $ket="Menunggu Verifikasi";
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_jurnal='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['jurnal'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_kepala_sekolah'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_kepsek='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['pengantar_kepsek'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_info_gtk'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_info_gtk='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['info_gtk'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_pembagian'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_pembagian='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_pembagian'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_pangkat_akhir'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_pangkat_akhir='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_pangkat_akhir'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_berkala_akhir'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_berkala_akhir='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_berkala_akhir'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_profil_guru'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_profil_guru='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['profil_guru'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }                
                elseif(isset($_POST['tolak_absen'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_absen='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['absen'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }                
                elseif(isset($_POST['tolak_lainnya'])){
                    $komentar=$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_lainnya='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['lainnya'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }                
            }elseif(!empty($_POST['komentar_tolak']) && isset($_POST['komentar_tolak_select'])){
                //memilih dan mengisi.
                if(isset($_POST['tolak_jurnal'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $ket="Menunggu Verifikasi";
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_jurnal='$komentar', status='$s' WHERE nuptk='$_GET[id]' AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['jurnal'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_kepala_sekolah'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_kepsek='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['pengantar_kepsek'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_info_gtk'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_info_gtk='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['info_gtk'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_pembagian'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_pembagian='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_pembagian'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_pangkat_akhir'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_pangkat_akhir='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_pangkat_akhir'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_berkala_akhir'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_berkala_akhir='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_berkala_akhir'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_profil_guru'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_profil_guru='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['profil_guru'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_absen'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_absen='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['absen'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_lainnya'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara.", ".$_POST['komentar_tolak'];
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_lainnya='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['lainnya'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
            }elseif(empty($_POST['komentar_tolak']) && isset($_POST['komentar_tolak_select'])){
                //memilih tapi tidak mengisi.
                if(isset($_POST['tolak_jurnal'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $ket="Menunggu Verifikasi";
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_jurnal='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['jurnal'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_kepala_sekolah'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_kepsek='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['pengantar_kepsek'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_info_gtk'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_info_gtk='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['info_gtk'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_pembagian'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_pembagian='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_pembagian'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_pangkat_akhir'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_pangkat_akhir='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_pangkat_akhir'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_sk_berkala_akhir'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_sk_berkala_akhir='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['sk_berkala_akhir'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_profil_guru'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_profil_guru='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['profil_guru'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_absen'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_absen='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['absen'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
                elseif(isset($_POST['tolak_lainnya'])){
                    $komentar=$_POST['komentar_tolak_select'];
                    $komentar_sementara="";
                    $rowceklist=0;
                    foreach ($komentar as $k) {
                        if($rowceklist==0){
                            $komentar_sementara=$k;
                            $rowceklist++;
                        }else{
                            $komentar_sementara=$komentar_sementara.", ".$k;
                        }
                    }
                    $komentar=$komentar_sementara;
                    if($_SESSION['kode_akses']==1){
                        $s="S1";
                    }elseif($_SESSION['kode_akses']==2){
                        $s="S2";
                    }
                    $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET komentar_lainnya='$komentar', status='$s' WHERE nuptk=$_GET[id] AND periode='$periode'");
                    $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk=$_GET[id]");
                    $data=mysqli_fetch_assoc($queryget);
                    logActivity($data['id_pengusulan_sktp'],$waktu,$data['lainnya'],'TOLAK');
                    header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
                }
            }
        }
    }elseif(isset($_GET['lanjut'])){
        $periode=$_GET['periode'];
        $getidsekolah=mysqli_query($mysqli,"SELECT id_sekolah FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
        $id_sekolah=mysqli_fetch_assoc($getidsekolah);
        $id_sekolah=$id_sekolah['id_sekolah'];
        $getemail=mysqli_query($mysqli,"SELECT email FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE id_sekolah='$id_sekolah' AND kode_akses='3'");
        $email=mysqli_fetch_assoc($getemail);
        $email=$email['email'];

        $mail->addAddress($email, "");
        $mail->isHTML(true);
        $mail->Subject = "BERKAS TELAH LANJUT KE TAHAP BERIKUT";
        if($_SESSION['kode_akses']==1){
            $mail->Body    = "Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda usulkan untuk Guru dengan NUPTK ".$_GET['id']." telah disetujui oleh Verifikator 1. Terima Kasih.";
            $mail->AltBody = "#ALDRIN SERTIFIKASI";
            $s="S2";
        }elseif($_SESSION['kode_akses']==2){
            $mail->Body    = "Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda usulkan untuk Guru dengan NUPTK ".$_GET['id']." telah disetujui oleh Verifikator 2. Terima Kasih.";
            $mail->AltBody = "#ALDRIN SERTIFIKASI";
            $s="S3";
        }
        $komentar="";
        $ket="Menunggu Verifikasi";
        if(isset($s)){
            if($_SESSION['kode_akses']==1){
                $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET 
                                                                        komentar_jurnal='$komentar', 
                                                                        komentar_sk_kepsek='$komentar', 
                                                                        komentar_info_gtk='$komentar', 
                                                                        komentar_sk_pembagian='$komentar', 
                                                                        komentar_sk_pangkat_akhir='$komentar', 
                                                                        komentar_sk_berkala_akhir='$komentar', 
                                                                        komentar_profil_guru='$komentar', 
                                                                        komentar_absen='$komentar', 
                                                                        komentar_lainnya='$komentar', 
                                                                        status='$s',
                                                                        keterangan='$ket'
                                                                    WHERE nuptk=$_GET[id] AND periode='$periode'");
                $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                $data=mysqli_fetch_assoc($queryget);
                logActivity($data['id_pengusulan_sktp'],$waktu,'SEMUA BERKAS','Selesai Verifikasi 1');
                if($mail->send()){
                    header('location:../../main.php?module=pemeriksaan&k=1&alert=4');//berhasil kirim email
                }else{
                    header('location:../../main.php?module=pemeriksaan&k=1&alert=5');//gagal kirim email
                }
            }elseif($_SESSION['kode_akses']==2){
                $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET 
                                                                        komentar_jurnal='$komentar', 
                                                                        komentar_sk_kepsek='$komentar', 
                                                                        komentar_info_gtk='$komentar', 
                                                                        komentar_sk_pembagian='$komentar', 
                                                                        komentar_sk_pangkat_akhir='$komentar', 
                                                                        komentar_sk_berkala_akhir='$komentar', 
                                                                        komentar_profil_guru='$komentar', 
                                                                        komentar_absen='$komentar', 
                                                                        komentar_lainnya='$komentar', 
                                                                        status='$s',
                                                                        keterangan='$ket'
                                                                    WHERE nuptk='$_GET[id]' AND periode='$periode' ");
                $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
                $data=mysqli_fetch_assoc($queryget);
                logActivity($data['id_pengusulan_sktp'],$waktu,'SEMUA BERKAS','Selesai Verifikasi 2');
                if($mail->send()){
                    header('location:../../main.php?module=pemeriksaan&k=1&alert=4');//berhasil kirim email
                }else{
                    header('location:../../main.php?module=pemeriksaan&k=1&alert=5');//gagal kirim email
                }
            }
        }
    }elseif(isset($_GET['konfirmasi_tolak'])){
        $periode=$_GET['periode'];
        $getidsekolah=mysqli_query($mysqli,"SELECT id_sekolah FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
        $id_sekolah=mysqli_fetch_assoc($getidsekolah);
        $id_sekolah=$id_sekolah['id_sekolah'];
        $getemail=mysqli_query($mysqli,"SELECT email FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE id_sekolah='$id_sekolah' AND kode_akses='3'");
        $email=mysqli_fetch_assoc($getemail);
        $email=$email['email'];

        $mail->addAddress($email, "");
        $mail->isHTML(true);
        $mail->Subject = "BERKAS DITOLAK";

        if($_SESSION['kode_akses']==1){
            $mail->Body    = "Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda ajukan untuk guru dengan NUPTK ".$_GET['id']." telah ditolak oleh Verifikator 1. Terima Kasih.";
            $mail->AltBody = "#ALDRIN SERTIFIKASI";
        }elseif($_SESSION['kode_akses']==2){
            $mail->Body    = "Hallo Operator ALDRIN SERTIFIKASI. Berkas yang anda ajukan untuk guru dengan NUPTK ".$_GET['id']." telah ditolak oleh Verifikator 2. Terima Kasih.";
            $mail->AltBody = "#ALDRIN SERTIFIKASI";
        }
        if($mail->send()){
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET keterangan='Ditolak' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,'SEMUA BERKAS','TOLAK');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
        }else{
            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp SET keterangan='Ditolak' WHERE nuptk='$_GET[id]' AND periode='$periode' ");
            $queryget=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
            $data=mysqli_fetch_assoc($queryget);
            logActivity($data['id_pengusulan_sktp'],$waktu,'SEMUA BERKAS','TOLAK');
            header('location:../../main.php?module=pemeriksaan_form&id='.$_GET['id'].'&periode='.$_GET['periode'].'&alert=3');
        }


    }
}         
?>