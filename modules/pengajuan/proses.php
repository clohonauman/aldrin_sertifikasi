<?php
session_start();
require_once "../../config/database.php";
require_once "../../config/helper.php";
if (empty($_SESSION['nama_pengguna']) OR empty($_SESSION['id_akun'])){
    echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
}
else {
    try {
        date_default_timezone_set('Asia/Singapore');
        $waktu=date('Y-m-d H:i:s');
        if (isset($_POST['unggah'])) {
            $periode=$_GET['periode'];
            $jenis=$_GET['jenis'];
            $nuptk=$_GET['id'];
            $pattern = '/^%PDF-/';
            $pattern_jpg = '/^\xFF\xD8\xFF/';

            if($jenis=='jurnal'){//link
                $link=$_POST['file'];
                if (strpos($link, 'drive.google.com') !== false) {
                    $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                    $rowscek=mysqli_num_rows($querycek);
                    if($rowscek<=0){
                        $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$link','$jenis','$nuptk','$periode') ");
                        if($query){
                            logActivity('-',$waktu,$link.'-'.$nuptk,'UNGGAH BERKAS');
                            header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                        }else{
                            header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                        }
                    }else{
                        $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$link' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                        if($query){
                            logActivity('-',$waktu,$link.'-'.$nuptk,'UBAH BERKAS YANG DIUNGGAH');
                            header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                        }else{
                            header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                        }
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=12');
                }
            }
            if($jenis=='lainnya'){//link
                $link=$_POST['file'];
                if (strpos($link, 'drive.google.com') !== false) {
                    $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                    $rowscek=mysqli_num_rows($querycek);
                    if($rowscek<=0){
                        $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$link','$jenis','$nuptk','$periode') ");
                        if($query){
                            logActivity('-',$waktu,$link.'-'.$nuptk,'UNGGAH BERKAS');
                            header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                        }else{
                            header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                        }
                    }else{
                        $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$link' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                        if($query){
                            logActivity('-',$waktu,$link.'-'.$nuptk,'UBAH BERKAS YANG DIUNGGAH');
                            header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                        }else{
                            header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                        }
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=12');
                }
            }
            if($jenis=='info_gtk'){//pdf
                $file=$_FILES['file']['name'];
                $tmp_namafile = $_FILES['file']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran=$_FILES['file']['size'];//<-------
                    $ukuran=$ukuran / (1024 * 1024);
                    if($ukuran<=1){
                        $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                        $rowscek=mysqli_num_rows($querycek);
                        if($rowscek<=0){
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-GTK-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$nama','$jenis','$nuptk','$periode') ");
                            if($query){
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                logActivity('-',$waktu,$nama,'UNGGAH BERKAS');
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                            }
                        }else{
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-GTK-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$nama' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                            if($query){
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                logActivity('-',$waktu,$nama,'UBAH BERKAS YANG DIUNGGAH');
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=3');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=4');
                            }
                        }
                    }else{
                        header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                }
            }
            if($jenis=='skpa'){//pdf
                $file=$_FILES['file']['name'];
                $tmp_namafile = $_FILES['file']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran=$_FILES['file']['size'];//<-------
                    $ukuran=$ukuran / (1024 * 1024);
                    if($ukuran<=1){
                        $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                        $rowscek=mysqli_num_rows($querycek);
                        if($rowscek<=0){
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKPA-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$nama','$jenis','$nuptk','$periode') ");
                            if($query){
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                logActivity('-',$waktu,$nama,'UNGGAH BERKAS');
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                            }
                        }else{
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKPA-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$nama' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                            if($query){
                                logActivity('-',$waktu,$nama,'UBAH BERKAS YANG DIUNGGAH');
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=3');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=4');
                            }
                        }
                    }else{
                        header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                }
            }
            if($jenis=='sk_pembagian'){//pdf
                $file=$_FILES['file']['name'];
                $tmp_namafile = $_FILES['file']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran=$_FILES['file']['size'];//<-------
                    $ukuran=$ukuran / (1024 * 1024);
                    if($ukuran<=1){
                        $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                        $rowscek=mysqli_num_rows($querycek);
                        if($rowscek<=0){
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-PEM-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$nama','$jenis','$nuptk','$periode') ");
                            if($query){
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                logActivity('-',$waktu,$nama,'UNGGAH BERKAS');
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                            }
                        }else{
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-PEM-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$nama' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                            if($query){
                                logActivity('-',$waktu,$nama,'UBAH BERKAS YANG DIUNGGAH');
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=3');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=4');
                            }
                        }
                    }else{
                        header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=6');
                }
            }
            if($jenis=='pks'){//pdf
                $file=$_FILES['file']['name'];
                $tmp_namafile = $_FILES['file']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran=$_FILES['file']['size'];//<-------
                    $ukuran=$ukuran / (1024 * 1024);
                    if($ukuran<=1){
                        $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                        $rowscek=mysqli_num_rows($querycek);
                        if($rowscek<=0){
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-PKS-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$nama','$jenis','$nuptk','$periode') ");
                            if($query){
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                logActivity('-',$waktu,$nama,'UNGGAH BERKAS');
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                            }
                        }else{
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-PKS-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$nama' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                            if($query){
                                logActivity('-',$waktu,$nama,'UBAH BERKAS YANG DIUNGGAH');
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=3');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=4');
                            }
                        }
                    }else{
                        header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=6');
                }
            }
            if($jenis=='skba'){//pdf
                $file=$_FILES['file']['name'];
                $tmp_namafile = $_FILES['file']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran=$_FILES['file']['size'];//<-------
                    $ukuran=$ukuran / (1024 * 1024);
                    if($ukuran<=1){
                        $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                        $rowscek=mysqli_num_rows($querycek);
                        if($rowscek<=0){
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKBA-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$nama','$jenis','$nuptk','$periode') ");
                            if($query){
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                logActivity('-',$waktu,$nama,'UNGGAH BERKAS');
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                            }
                        }else{
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKBA-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$nama' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                            if($query){
                                logActivity('-',$waktu,$nama,'UBAH BERKAS YANG DIUNGGAH');
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=3');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=4');
                            }
                        }
                    }else{
                        header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=6');
                }
            }
            if($jenis=='pg'){//pdf
                $file=$_FILES['file']['name'];
                $tmp_namafile = $_FILES['file']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran=$_FILES['file']['size'];//<-------
                    $ukuran=$ukuran / (1024 * 1024);
                    if($ukuran<=1){
                        $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                        $rowscek=mysqli_num_rows($querycek);
                        if($rowscek<=0){
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-PG-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$nama','$jenis','$nuptk','$periode') ");
                            if($query){
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                logActivity('-',$waktu,$nama,'UNGGAH BERKAS');
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                            }
                        }else{
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-PG-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$nama' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                            if($query){
                                logActivity('-',$waktu,$nama,'UBAH BERKAS YANG DIUNGGAH');
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=3');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=4');
                            }
                        }
                    }else{
                        header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=6');
                }                
            }
            if($jenis=='absen'){//pdf
                $file=$_FILES['file']['name'];
                $tmp_namafile = $_FILES['file']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran=$_FILES['file']['size'];//<-------
                    $ukuran=$ukuran / (1024 * 1024);
                    if($ukuran<=1){
                        $querycek=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='$jenis' AND periode='$periode'");
                        $rowscek=mysqli_num_rows($querycek);
                        if($rowscek<=0){
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-ABSEN-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp_sementara (nama_berkas,jenis,nuptk,periode) VALUES ('$nama','$jenis','$nuptk','$periode') ");
                            if($query){
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                logActivity('-',$waktu,$nama,'UNGGAH BERKAS');
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=1');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=2');
                            }
                        }else{
                            $x               = explode('.',$file);
                            $ekstensi        = strtolower(end($x));
                            $temp            =$_FILES['file']['tmp_name'];
                            $nama            =$nuptk.'-'.$_SESSION['nama_sekolah'].'-ABSEN-PERIODE'.$periode.'.'.$ekstensi;//<--------
                            $query=mysqli_query($mysqli,"UPDATE pengusulan_sktp_sementara SET nama_berkas='$nama' WHERE nuptk='$nuptk' AND jenis='$jenis' ");
                            if($query){
                                logActivity('-',$waktu,$nama,'UBAH BERKAS YANG DIUNGGAH');
                                move_uploaded_file($temp, '../../berkas/'.$nama);
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=3');
                            }else{
                                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=4');
                            }
                        }
                    }else{
                        header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=5');
                    }
                }else{
                    header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=6');
                }
            }
        }elseif(isset($_POST['simpan'])){
            $id=generateRandomString(10);
            $nuptk=$_GET['id'];
            $bentuk_pendidikan=$_SESSION['bentuk_pendidikan'];
            $kabupaten=$_SESSION['kabupaten'];
            $keterangan="Menunggu Verifikasi";
            $status="S1";
            $operator=$_SESSION['id_akun'];
            $id_sekolah=$_SESSION['id_sekolah'];
            $periode=$_GET['periode'];

            
            $queryguru=mysqli_query($mysqli2,"SELECT nama FROM ptk WHERE nuptk='$nuptk'");
            $nama_guru=mysqli_fetch_assoc($queryguru);

            $nama_guru=mysqli_real_escape_string($mysqli,$nama_guru['nama']);
            
            $querysementara=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode'");
            while($datasementara=mysqli_fetch_assoc($querysementara)){
                if($datasementara['jenis']=='jurnal'){
                    $jurnal=$datasementara['nama_berkas'];
                }
                if($datasementara['jenis']=='info_gtk'){
                    $info_gtk=$datasementara['nama_berkas'];
                }
                if($datasementara['jenis']=='skpa'){
                    $skpa=$datasementara['nama_berkas'];
                }
                if($datasementara['jenis']=='skba'){
                    $skba=$datasementara['nama_berkas'];
                }
                if($datasementara['jenis']=='pks'){
                    $pks=$datasementara['nama_berkas'];
                }
                if($datasementara['jenis']=='sk_pembagian'){
                    $sk_pembagian=$datasementara['nama_berkas'];
                }
                if($datasementara['jenis']=='pg'){
                    $pg=$datasementara['nama_berkas'];
                }
                if($datasementara['jenis']=='absen'){
                    $absen=$datasementara['nama_berkas'];
                }

                $querylainnya=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND jenis='lainnya' AND periode='$periode'");
                $datalainnya=mysqli_fetch_assoc($querylainnya);
                if(!empty($datalainnya)){
                    $lainnya=$datasementara['nama_berkas'];
                }else{
                    $lainnya="";
                }
            }
            if(!isset($skpa)){
                $skpa='';
            }
            if(!isset($skba)){
                $skba='';
            }
            $queryinsert=mysqli_query($mysqli,"INSERT INTO pengusulan_sktp
                                                                        (
                                                                            id_pengusulan_sktp,
                                                                            nuptk,
                                                                            nama_guru,
                                                                            id_sekolah,
                                                                            bentuk_pendidikan,
                                                                            kabupaten,
                                                                            operator,
                                                                            pengantar_kepsek,
                                                                            info_gtk,
                                                                            jurnal,
                                                                            sk_pembagian,
                                                                            sk_pangkat_akhir,
                                                                            sk_berkala_akhir,
                                                                            profil_guru,
                                                                            absen,
                                                                            lainnya,
                                                                            status,
                                                                            keterangan,
                                                                            waktu_pengusulan,
                                                                            periode
                                                                        )
                                                                VALUES
                                                                        (
                                                                            '$id',
                                                                            '$nuptk',
                                                                            '$nama_guru',
                                                                            '$id_sekolah',
                                                                            '$bentuk_pendidikan',
                                                                            '$kabupaten',
                                                                            '$operator',
                                                                            '$pks',
                                                                            '$info_gtk',
                                                                            '$jurnal',
                                                                            '$sk_pembagian',
                                                                            '$skpa',
                                                                            '$skba',
                                                                            '$pg',
                                                                            '$absen',
                                                                            '$lainnya',
                                                                            '$status',
                                                                            '$keterangan',
                                                                            '$waktu',
                                                                            '$periode'
                                                                        )");
            if($queryinsert){
                logActivity($id,$waktu,'SEMUA BERKAS:'.$nuptk,'MELAKUKAN PENGAJUAN, PERIODE '.$periode);
                $delsementara=mysqli_query($mysqli,"DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk'");
                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=7');
            }else{
                header('location:../../main.php?module=pengajuan&id='.$nuptk.'&periode='.$periode.'&alert=8');
            }
        }elseif(isset($_POST['edit'])) {
            $status=mysqli_real_escape_string($mysqli,$_GET['s']);
            $periode=$_GET['periode'];
            $nuptk=$_POST['nuptk'];
            $pattern = '/^%PDF-/';
            $i=0;
            if(!empty($_FILES['pengantar_kepala_sekolah']['name'])){
                $namafile =$_FILES['pengantar_kepala_sekolah']['name'];//<-------
                $tmp_namafile =$_FILES['pengantar_kepala_sekolah']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran              =$_FILES['pengantar_kepala_sekolah']['size'];//<-------
                    $ukuran              =$ukuran / (1024 * 1024);
                    if($ukuran>1){
                        header("Location: ../../main.php?module=pengajuan&alert=5");
                    }else{
                        $i++;
                        $x               = explode('.',$namafile);
                        $ekstensi        = strtolower(end($x));
                        $temp            =$_FILES['pengantar_kepala_sekolah']['tmp_name'];//<-------
                        unlink('../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-PKS-PERIODE'.$periode.'.'.$ekstensi);
                        move_uploaded_file($temp, '../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-PKS-PERIODE'.$periode.'.'.$ekstensi);//<-------
                        $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET pengantar_kepsek='$nuptk-$_SESSION[nama_sekolah]-PKS-PERIODE$periode.$ekstensi',
                                                                                komentar_sk_kepsek='Telah di Revisi',
                                                                                keterangan='Telah Direvisi'
                                                                            WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                    }
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=5");
                }
            }
            if(isset($_POST['jurnal'])){
                $jurnal=$_POST['jurnal'];
                if (strpos($jurnal, 'drive.google.com') !== false) {
                    $jurnal=$_POST['jurnal'];
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=12");
                }
            }
            if(isset($_POST['lainnya'])){
                $lainnya=$_POST['lainnya'];
                if (strpos($lainnya, 'drive.google.com') !== false) {
                    $lainnya=$_POST['lainnya'];
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=12");
                }
            }
            if(!empty($_FILES['info_gtk']['name'])){
                $namafile =$_FILES['info_gtk']['name'];//<-------
                $tmp_namafile =$_FILES['info_gtk']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran              =$_FILES['info_gtk']['size'];//<-------
                    $ukuran              =$ukuran / (1024 * 1024);
                    if($ukuran>1){
                        header("Location: ../../main.php?module=pengajuan&alert=2");
                    }else{
                        $i++;
                        $x               = explode('.',$namafile);
                        $ekstensi        = strtolower(end($x));
                        $temp            =$_FILES['info_gtk']['tmp_name'];//<-------
                        unlink('../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-GTK-PERIODE'.$periode.'.'.$ekstensi);
                        move_uploaded_file($temp, '../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-GTK-PERIODE'.$periode.'.'.$ekstensi);//<-------
                        $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET info_gtk='$nuptk-$_SESSION[nama_sekolah]-GTK-PERIODE$periode.$ekstensi',
                                                                                komentar_info_gtk='Telah di Revisi',
                                                                                keterangan='Telah Direvisi'
                                                                            WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                    }
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=5");
                }
            }
            if(!empty($_FILES['sk_pembagian']['name'])){
                $namafile =$_FILES['sk_pembagian']['name'];//<-------
                $tmp_namafile = $_FILES['sk_pembagian']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran              =$_FILES['sk_pembagian']['size'];//<-------
                    $ukuran              =$ukuran / (1024 * 1024);
                    if($ukuran>1){
                        header("Location: ../../main.php?module=pengajuan&alert=2");
                    }else{
                        $i++;
                        $x               = explode('.',$namafile);
                        $ekstensi        = strtolower(end($x));
                        $temp            =$_FILES['sk_pembagian']['tmp_name'];//<-------
                        unlink('../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-PEM-PERIODE'.$periode.'.'.$ekstensi);
                        move_uploaded_file($temp, '../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-PEM-PERIODE'.$periode.'.'.$ekstensi);//<-------
                        $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET sk_pembagian='$nuptk-$_SESSION[nama_sekolah]-PEM-PERIODE$periode.$ekstensi',
                                                                                komentar_sk_pembagian='Telah di Revisi',
                                                                                keterangan='Telah Direvisi'
                                                                            WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                    }
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=5");
                }
            }
            if(!empty($_FILES['sk_pangkat_akhir']['name'])){
                $namafile =$_FILES['sk_pangkat_akhir']['name'];//<-------
                $tmp_namafile =$_FILES['sk_pangkat_akhir']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran              =$_FILES['sk_pangkat_akhir']['size'];//<-------
                    $ukuran              =$ukuran / (1024 * 1024);
                    if($ukuran>1){
                        header("Location: ../../main.php?module=pengajuan&alert=2");
                    }else{
                        $i++;
                        $x               = explode('.',$namafile);
                        $ekstensi        = strtolower(end($x));
                        $temp            =$_FILES['sk_pangkat_akhir']['tmp_name'];//<-------
                        unlink('../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKPA-PERIODE'.$periode.'.'.$ekstensi);
                        move_uploaded_file($temp, '../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKPA-PERIODE'.$periode.'.'.$ekstensi);//<-------
                        $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET sk_pangkat_akhir='$nuptk-$_SESSION[nama_sekolah]-SKPA-PERIODE$periode.$ekstensi',
                                                                                komentar_sk_pangkat_akhir='Telah di Revisi',
                                                                                keterangan='Telah Direvisi'
                                                                            WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                    }
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=5");
                }
            }
            if(!empty($_FILES['sk_berkala_akhir']['name'])){
                $namafile =$_FILES['sk_berkala_akhir']['name'];//<-------
                $tmp_namafile =$_FILES['sk_berkala_akhir']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran              =$_FILES['sk_berkala_akhir']['size'];//<-------
                    $ukuran              =$ukuran / (1024 * 1024);
                    if($ukuran>1){
                        header("Location: ../../main.php?module=pengajuan&alert=2");
                    }else{
                        $i++;
                        $x               = explode('.',$namafile);
                        $ekstensi        = strtolower(end($x));
                        $temp            =$_FILES['sk_berkala_akhir']['tmp_name'];//<-------
                        unlink('../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKBA-PERIODE'.$periode.'.'.$ekstensi);
                        move_uploaded_file($temp, '../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKBA-PERIODE'.$periode.'.'.$ekstensi);//<-------
                        $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET sk_berkala_akhir='$nuptk-$_SESSION[nama_sekolah]-SKBA-PERIODE$periode.$ekstensi',
                                                                                komentar_sk_berkala_akhir='Telah di Revisi', 
                                                                                keterangan='Telah Direvisi'
                                                                                WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                    }
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=5");
                }
            }
            if(!empty($_FILES['profil_guru']['name'])){
                $namafile =$_FILES['profil_guru']['name'];//<-------
                $tmp_namafile =$_FILES['profil_guru']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran              =$_FILES['profil_guru']['size'];//<-------
                    $ukuran              =$ukuran / (1024 * 1024);
                    if($ukuran>1){
                        header("Location: ../../main.php?module=pengajuan&alert=2");
                    }else{
                        $i++;
                        $x               = explode('.',$namafile);
                        $ekstensi        = strtolower(end($x));
                        $temp            =$_FILES['profil_guru']['tmp_name'];//<-------
                        unlink('../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-PG-PERIODE'.$periode.'.'.$ekstensi);
                        move_uploaded_file($temp, '../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-PG-PERIODE'.$periode.'.'.$ekstensi);//<-------
                        $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET profil_guru='$nuptk-$_SESSION[nama_sekolah]-PG-PERIODE$periode.$ekstensi',
                                                                                komentar_profil_guru='Telah di Revisi',
                                                                                keterangan='Telah Direvisi'
                                                                            WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                    }
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=5");
                }
            }
            if(!empty($_FILES['absen']['name'])){
                $namafile =$_FILES['absen']['name'];//<-------
                $tmp_namafile =$_FILES['absen']['tmp_name'];
                $tmp_namafile = file_get_contents($tmp_namafile);
                if(preg_match($pattern, $tmp_namafile)){
                    $ukuran              =$_FILES['absen']['size'];//<-------
                    $ukuran              =$ukuran / (1024 * 1024);
                    if($ukuran>1){
                        header("Location: ../../main.php?module=pengajuan&alert=2");
                    }else{
                        $i++;
                        $x               = explode('.',$namafile);
                        $ekstensi        = strtolower(end($x));
                        $temp            =$_FILES['absen']['tmp_name'];//<-------
                        unlink('../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-ABSEN-PERIODE'.$periode.'.'.$ekstensi);
                        move_uploaded_file($temp, '../../berkas/'.$nuptk.'-'.$_SESSION['nama_sekolah'].'-ABSEN-PERIODE'.$periode.'.'.$ekstensi);//<-------
                        $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET absen='$nuptk-$_SESSION[nama_sekolah]-ABSEN-PERIODE$periode.$ekstensi',
                                                                                komentar_absen='Telah di Revisi',
                                                                                keterangan='Telah Direvisi'
                                                                            WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                    }
                }else{
                    header("Location: ../../main.php?module=pengajuan&alert=5");
                }
            }
            if(!empty($jurnal)){
                $i++;
                $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET jurnal='$jurnal',komentar_jurnal='Telah di Revisi',keterangan='Telah Direvisi'
                                    WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
            }
            if(!empty($lainnya)){
                $i++;
                $query = mysqli_query($mysqli, "UPDATE pengusulan_sktp SET lainnya='$lainnya',komentar_lainnya='Telah di Revisi',keterangan='Telah Direvisi'
                                    WHERE periode='$periode' AND nuptk='$nuptk'") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
            }
            if($i>0){
                logActivity($id,$waktu,'SEMUA BERKAS:'.$nuptk,'MELAKUKAN REVISI BERKAS');
                header("Location: ../../main.php?module=pengajuan&alert=9");
            }else{
                header("Location: ../../main.php?module=pengajuan&alert=2");
            }
        }elseif(isset($_GET['hapus'])) {
            $periode=$_GET['periode'];
            if(isset($_GET['jenis'])){
                if($_GET['jenis']=="pks"){
                    $nuptk=$_GET['id'];
                    if($periode!=3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PKS-PERIODE'.$periode.'.pdf';
                    }elseif($periode==3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PKS.pdf';
                        $namafile2=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PKS-PERIODE'.$periode.'.pdf';
                        $path2='../../berkas/'.$namafile2;
                        $unlink2=unlink($path2);//<-------
                    }
                    $path='../../berkas/'.$namafile;
                    $unlink=unlink($path);//<-------
                    if(isset($unlink2)){
                        if($unlink2){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }else{
                        if($unlink){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }
                }
                if($_GET['jenis']=="info_gtk"){
                    $nuptk=$_GET['id'];
                    if($periode!=3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-GTK-PERIODE'.$periode.'.pdf';
                    }elseif($periode==3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-GTK.pdf';
                        $namafile2=$nuptk.'-'.$_SESSION['nama_sekolah'].'-GTK-PERIODE'.$periode.'.pdf';
                        $path2='../../berkas/'.$namafile2;
                        $unlink2=unlink($path2);//<-------
                    }
                    $path='../../berkas/'.$namafile;
                    $unlink=unlink($path);//<-------
                    if(isset($unlink2)){
                        if($unlink2){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }else{
                        if($unlink){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }
                }
                if($_GET['jenis']=="sk_pembagian"){
                    $nuptk=$_GET['id'];
                    if($periode!=3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PEM-PERIODE'.$periode.'.pdf';
                    }elseif($periode==3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PEM.pdf';
                        $namafile2=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PEM-PERIODE'.$periode.'.pdf';
                        $path2='../../berkas/'.$namafile2;
                        $unlink2=unlink($path2);//<-------
                    }
                    $path='../../berkas/'.$namafile;
                    $unlink=unlink($path);//<-------
                    if(isset($unlink2)){
                        if($unlink2){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }else{
                        if($unlink){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }
                }
                if($_GET['jenis']=="skpa"){
                    $nuptk=$_GET['id'];
                    if($periode!=3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKPA-PERIODE'.$periode.'.pdf';
                    }elseif($periode==3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKPA.pdf';
                        $namafile2=$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKPA-PERIODE'.$periode.'.pdf';
                        $path2='../../berkas/'.$namafile2;
                        $unlink2=unlink($path2);//<-------
                    }
                    $path='../../berkas/'.$namafile;
                    $unlink=unlink($path);//<-------
                    if(isset($unlink2)){
                        if($unlink2){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }else{
                        if($unlink){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }
                }
                if($_GET['jenis']=="skba"){
                    $nuptk=$_GET['id'];
                    if($periode!=3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKBA-PERIODE'.$periode.'.pdf';
                    }elseif($periode==3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKBA.pdf';
                        $namafile2=$nuptk.'-'.$_SESSION['nama_sekolah'].'-SKBA-PERIODE'.$periode.'.pdf';
                        $path2='../../berkas/'.$namafile2;
                        $unlink2=unlink($path2);//<-------
                    }
                    $path='../../berkas/'.$namafile;
                    $unlink=unlink($path);//<-------
                    if(isset($unlink2)){
                        if($unlink2){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }else{
                        if($unlink){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }
                }
                if($_GET['jenis']=="pg"){
                    $nuptk=$_GET['id'];
                    if($periode!=3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PG-PERIODE'.$periode.'.pdf';
                    }elseif($periode==3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PG.pdf';
                        $namafile2=$nuptk.'-'.$_SESSION['nama_sekolah'].'-PG-PERIODE'.$periode.'.pdf';
                        $path2='../../berkas/'.$namafile2;
                        $unlink2=unlink($path2);//<-------
                    }
                    $path='../../berkas/'.$namafile;
                    $unlink=unlink($path);//<-------
                    if(isset($unlink2)){
                        if($unlink2){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }else{
                        if($unlink){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }
                }
                if($_GET['jenis']=="absen"){
                    $nuptk=$_GET['id'];
                    if($periode!=3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-ABSEN-PERIODE'.$periode.'.pdf';
                    }elseif($periode==3){
                        $namafile=$nuptk.'-'.$_SESSION['nama_sekolah'].'-ABSEN.pdf';
                        $namafile2=$nuptk.'-'.$_SESSION['nama_sekolah'].'-ABSEN-PERIODE'.$periode.'.pdf';
                        $path2='../../berkas/'.$namafile2;
                        $unlink2=unlink($path2);//<-------
                    }
                    $path='../../berkas/'.$namafile;
                    $unlink=unlink($path);//<-------
                    if(isset($unlink2)){
                        if($unlink2){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }else{
                        if($unlink){
                            $query = mysqli_query($mysqli, "DELETE FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND (nama_berkas='$namafile' OR nama_berkas='$namafile2') AND periode='$periode'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            if($query){
                                logActivity('-',$waktu,$namafile,'MENGHAPUS BERKAS');
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=10");
                            }else{
                                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                            }
                        }else{
                            header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=11");
                        }
                    }
                }
            }
            else{
                header("Location: ../../main.php?module=pengajuan&id=".$nuptk."&periode=".$periode."&alert=12");
            }
        }
    }catch (Exception $e) {
        // Code to handle the exception
        echo "An exception occurred: " . $e->getMessage();
    }
}         
?>