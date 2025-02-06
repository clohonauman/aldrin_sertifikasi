<?php
session_start();
date_default_timezone_set('Asia/Singapore');
$waktu=date('Y-m-d H:i:s');
require_once "../../config/database.php";
require_once "../../config/helper.php";
if (empty($_SESSION['id_akun'])){
    echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
}
else {
    if($_SESSION['kode_akses']==0){
        if(isset($_POST['edit'])){
            $periode = mysqli_real_escape_string($mysqli, $_GET['periode']);

            $query_check=mysqli_query($mysqli,"SELECT status FROM periode_sipgtk WHERE periode='$periode'");
            $data_periode=mysqli_fetch_assoc($query_check);
            $status=$data_periode['status'];
            if($status){
                header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=403');
            }else{
                $jurnal = isset($_POST['jurnal']) && $_POST['jurnal'] == 'on' ? 1 : 0;
                $pks = isset($_POST['pks']) && $_POST['pks'] == 'on' ? 1 : 0;
                $info_gtk = isset($_POST['info_gtk']) && $_POST['info_gtk'] == 'on' ? 1 : 0;
                $sk_pembagian = isset($_POST['sk_pembagian']) && $_POST['sk_pembagian'] == 'on' ? 1 : 0;
                $skpa = isset($_POST['skpa']) && $_POST['skpa'] == 'on' ? 1 : 0;
                $skba = isset($_POST['skba']) && $_POST['skba'] == 'on' ? 1 : 0;
                $pg = isset($_POST['pg']) && $_POST['pg'] == 'on' ? 1 : 0;
                $absen = isset($_POST['absen']) && $_POST['absen'] == 'on' ? 1 : 0;
                $lainnya = isset($_POST['lainnya']) && $_POST['lainnya'] == 'on' ? 1 : 0;
    
                $query=mysqli_query($mysqli,"UPDATE periode_sipgtk SET
                                                                        jurnal='$jurnal',
                                                                        pks='$pks',
                                                                        info_gtk='$info_gtk',
                                                                        sk_pembagian='$sk_pembagian',
                                                                        skpa='$skpa',
                                                                        skba='$skba',
                                                                        pg='$pg',
                                                                        absen='$absen',
                                                                        lainnya='$lainnya'
                                                                   WHERE
                                                                        periode='$periode'
                                                                    ");
                if($query){
                    header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=200');
                }else{
                    header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=500');
                }   
            }

        }elseif(isset($_GET['baru'])){
            $jurnal = isset($_POST['jurnal']) && $_POST['jurnal'] == 'on' ? 1 : 0;
            $pks = isset($_POST['pks']) && $_POST['pks'] == 'on' ? 1 : 0;
            $info_gtk = isset($_POST['info_gtk']) && $_POST['info_gtk'] == 'on' ? 1 : 0;
            $sk_pembagian = isset($_POST['sk_pembagian']) && $_POST['sk_pembagian'] == 'on' ? 1 : 0;
            $skpa = isset($_POST['skpa']) && $_POST['skpa'] == 'on' ? 1 : 0;
            $skba = isset($_POST['skba']) && $_POST['skba'] == 'on' ? 1 : 0;
            $pg = isset($_POST['pg']) && $_POST['pg'] == 'on' ? 1 : 0;
            $absen = isset($_POST['absen']) && $_POST['absen'] == 'on' ? 1 : 0;
            $lainnya = isset($_POST['lainnya']) && $_POST['lainnya'] == 'on' ? 1 : 0;

            $query_check=mysqli_query($mysqli,"SELECT periode FROM periode_sipgtk ORDER BY periode DESC LIMIT 1");
            $data_periode=mysqli_fetch_assoc($query_check);
            $periode=$data_periode['periode']+1;

            $query=mysqli_query($mysqli,"INSERT INTO periode_sipgtk 
                                                                    (
                                                                        jurnal,
                                                                        pks,
                                                                        info_gtk,
                                                                        sk_pembagian,
                                                                        skpa,
                                                                        skba,
                                                                        pg,
                                                                        absen,
                                                                        lainnya,
                                                                        periode
                                                                    ) VALUES (
                                                                        '$jurnal',
                                                                        '$pks',
                                                                        '$info_gtk',
                                                                        '$sk_pembagian',
                                                                        '$skpa',
                                                                        '$skba',
                                                                        '$pg',
                                                                        '$absen',
                                                                        '$lainnya',
                                                                        '$periode'
                                                                    )");
            if($query){
                header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=200');
            }else{
                header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=500');
            }  
        }elseif(isset($_POST['kunci'])){
            $periode = mysqli_real_escape_string($mysqli, $_GET['periode']);
            $jurnal = isset($_POST['jurnal']) && $_POST['jurnal'] == 'on' ? 1 : 0;
            $pks = isset($_POST['pks']) && $_POST['pks'] == 'on' ? 1 : 0;
            $info_gtk = isset($_POST['info_gtk']) && $_POST['info_gtk'] == 'on' ? 1 : 0;
            $sk_pembagian = isset($_POST['sk_pembagian']) && $_POST['sk_pembagian'] == 'on' ? 1 : 0;
            $skpa = isset($_POST['skpa']) && $_POST['skpa'] == 'on' ? 1 : 0;
            $skba = isset($_POST['skba']) && $_POST['skba'] == 'on' ? 1 : 0;
            $pg = isset($_POST['pg']) && $_POST['pg'] == 'on' ? 1 : 0;
            $absen = isset($_POST['absen']) && $_POST['absen'] == 'on' ? 1 : 0;
            $lainnya = isset($_POST['lainnya']) && $_POST['lainnya'] == 'on' ? 1 : 0;

            $query=mysqli_query($mysqli,"UPDATE periode_sipgtk SET
                                                                    jurnal='$jurnal',
                                                                    pks='$pks',
                                                                    info_gtk='$info_gtk',
                                                                    sk_pembagian='$sk_pembagian',
                                                                    skpa='$skpa',
                                                                    skba='$skba',
                                                                    pg='$pg',
                                                                    absen='$absen',
                                                                    lainnya='$lainnya',
                                                                    status='1'
                                                               WHERE
                                                                    periode='$periode'
                                                                ");
            if($query){
                header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=200');
            }else{
                header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=500');
            } 
        }elseif(isset($_POST['edit_module'])) {
            $periode = mysqli_real_escape_string($mysqli, $_GET['periode']);
            $usul_baru = isset($_POST['usul_baru']) && $_POST['usul_baru'] == 'on' ? 1 : 0;
            $revisi_v1 = isset($_POST['revisi_v1']) && $_POST['revisi_v1'] == 'on' ? 1 : 0;
            $revisi_v2 = isset($_POST['revisi_v2']) && $_POST['revisi_v2'] == 'on' ? 1 : 0;
            $query=mysqli_query($mysqli,"UPDATE periode_sipgtk SET
                                                                    usul_baru='$usul_baru',
                                                                    revisi_v1='$revisi_v1',
                                                                    revisi_v2='$revisi_v2'
                                                               WHERE
                                                                    periode='$periode'
                                                                ");
            if($query){
                header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=200');
            }else{
                header('location: ../../main.php?module=periode&periode='.$periode.'&simpan=Lanjutkan&alert=500');
            }   
        }
    }
}               
?>