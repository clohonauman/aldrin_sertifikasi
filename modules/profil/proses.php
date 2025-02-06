
<?php
	session_start();
	require_once "../../config/database.php";
	require_once "../../config/helper.php";
	date_default_timezone_set('Asia/Singapore');
	$waktu=date('Y-m-d H:i:s');

	if (empty($_SESSION['nama_pengguna']) && empty($_SESSION['id_akun'])){
		echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
	}
	else {
		if ($_GET['act']=='update') {
			if (isset($_POST['simpan'])) {
				if (isset($_POST['id_akun'])) {
					$id_akun               = mysqli_real_escape_string($mysqli, trim($_POST['id_akun']));
					$nama_pengguna         = mysqli_real_escape_string($mysqli, trim($_POST['nama_pengguna']));
					$nama_lengkap          = mysqli_real_escape_string($mysqli, trim($_POST['nama_lengkap']));
					$email          	   = $_POST['email'];
					$queryceknamapengguna=mysqli_query($mysqli,"SELECT nama_pengguna FROM akun WHERE (nama_pengguna='$nama_pengguna' OR email='$email') AND id_akun!='$id_akun'");
					$rowscek=mysqli_num_rows($queryceknamapengguna);
					if($rowscek<=0){
						$query = mysqli_query($mysqli, "UPDATE akun SET     nama_pengguna 	    = '$nama_pengguna',
																			nama_lengkap= '$nama_lengkap',
																			email= '$email'
																	  WHERE id_akun 	= '$id_akun'")
														or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
						// cek query
						if ($query) {
							logActivity('-',$waktu,'ID Akun:'.$id_akun,'MENGUBAH NAMA PENGGUNA & NAMA LENGKAP & EMAIL');
							header("location:../../logout.php");
						}else{
							header("location: ../../main.php?module=profil&alert=2");
						}
					}else{
							header("location: ../../main.php?module=profil&alert=2");
					}
				}
			}
		}
	}		
?>