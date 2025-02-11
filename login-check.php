
<?php
require_once "config/database.php";
require_once "config/helper.php";
date_default_timezone_set('Asia/Singapore');
$waktu=date('Y-m-d H:i:s');
session_start();
if(isset($_POST['kode_akses']) AND !isset($_SESSION['login_email'])){
	$query=mysqli_query($mysqli,"SELECT * FROM peran WHERE id_akun='$_SESSION[id_akun]' AND kode_akses='$_POST[kode_akses]'");
	if(mysqli_num_rows($query)>0){
		$dataun=mysqli_fetch_assoc($query);
		$token=generateRandomString(30);
		$_SESSION['id_akun'] 			= $dataun['id_akun'];
		$_SESSION['nama_sekolah'] 		= $dataun['nama_sekolah'];
		$_SESSION['id_sekolah'] 		= $dataun['id_sekolah'];
		$_SESSION['kabupaten'] 			= $dataun['kabupaten'];
		$_SESSION['bentuk_pendidikan'] 	= $dataun['bentuk_pendidikan'];
		$_SESSION['cabdin'] 			= $dataun['cabdin'];
		$_SESSION['kode_akses']			= $_POST['kode_akses'];
		$_SESSION['token']				= $token;
		$_SESSION['app_id']				= 'ALDRIN_SERTIFIKASI-01234';
		$querycreatedtoken=mysqli_query($mysqli,"INSERT INTO session (
																		token,
																		refresh_token,
																		app_id,
																		ip_address,
																		device_type,
																		browser_info,
																		device_id,
																		location,
																		id_akun,
																		kode_akses,
																		waktu
																	 ) VALUES (
																		'$_SESSION[token]',
																		'$_SESSION[token]',
																		'$_SESSION[app_id]',
																		'$ip_address',
																		'$device_type',
																		'$browser_info',
																		'$device_id',
																		'$location',
																		'$dataun[id_akun]',
																		'$_SESSION[kode_akses]',
																		'$waktu'
																	 )");
		if($querycreatedtoken){
			header("Location: ./main.php?module=beranda");
		}else{
			session_destroy();
			header("Location: ./?alert=1");
		}
	}else{
		header('location: ./logout.php');
	}
}elseif(!empty($_POST['nama_pengguna']) && !empty($_POST['kata_sandi'])){
	$nama_pengguna = mysqli_real_escape_string($mysqli, $_POST['nama_pengguna']);
	$kata_sandi = mysqli_real_escape_string($mysqli, $_POST['kata_sandi']);
	if (empty($nama_pengguna) OR empty($kata_sandi)) {
		header("Location: login.php?alert=1");
	}
	else {
		$queryun = mysqli_query($mysqli, "SELECT * FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE nama_pengguna='$nama_pengguna' AND kode_akses IN ('0','1','2','3','4','7') ORDER BY kode_akses ASC")
										or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
		$rowsun  = mysqli_num_rows($queryun);
		if($rowsun>0){
				$dataun=mysqli_fetch_assoc($queryun);
				if(password_verify($kata_sandi,$dataun['kata_sandi'])){
					$queryblokir = mysqli_query($mysqli, "SELECT * FROM akun WHERE id_akun='$dataun[id_akun]' AND status='blokir'")
											or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
					$rowsblokir  = mysqli_num_rows($queryblokir);
					$query = mysqli_query($mysqli, "SELECT * FROM akun WHERE id_akun='$dataun[id_akun]' AND status='aktif'")
											or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
					$rows  = mysqli_num_rows($query);
					if ($rows > 0) {
						$data  = mysqli_fetch_assoc($query);
						if($data['session']==0 OR $data['session']==1){	
							$id_akun=$data['id_akun'];
							$query_kode_akses = mysqli_query($mysqli, "SELECT * FROM peran WHERE id_akun='$id_akun' AND kode_akses IN ('0','1','2','3','4','7')  ORDER BY kode_akses ASC")
															or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
							session_start();
							$_SESSION['id_akun']   			= $data['id_akun'];
							$_SESSION['nama_pengguna']  	= $data['nama_pengguna'];
							$_SESSION['kata_sandi']  		= $data['kata_sandi'];
							$_SESSION['nama_lengkap'] 		= $data['nama_lengkap'];
							$querysession=mysqli_query($mysqli, "UPDATE akun SET session = 1 WHERE id_akun='$data[id_akun]'");
							if($querysession){
								header("Location: ./login-check.php?select_role");
							}
						}else{
							header("Location: login.php?alert=4");
						}
					}elseif($rowsblokir > 0){
						header("Location: login.php?alert=3");
					}else {
						header("Location: login.php?alert=1");
					}
				}else{
					header("Location: login.php?alert=1");
				}
		}else{
			header("Location: login.php?alert=1");
		}
	}
}elseif(isset($_GET['select_role'])){
	$id_akun=$_SESSION['id_akun'];
	$query_kode_akses = mysqli_query($mysqli, "SELECT * FROM peran WHERE id_akun='$id_akun' AND kode_akses IN ('0','1','2','3','7')  ORDER BY kode_akses")
									or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
	if(mysqli_num_rows($query_kode_akses)>0){
		?>
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>MASUK | ALDRIN SERTIFIKASI</title>
				<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="description" content="ALDRIN SERTIFIKASI ">
				
				<!-- favicon -->
				<link rel="shortcut icon" href="assets/img/favicon.png" />

				<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
				<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
				<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>  
				<style>
					*{
						overflow: hidden;
					}
					.gradient-bg {
						background: linear-gradient(to bottom right, #3B82F6,rgb(12, 21, 34));
						color: white;
					}
					.min-vh-100-custom {
						min-height: 100vh;
						display: flex;
						align-items: center;
					}
					.custom {
						min-height: 100vh;
						display: flex;
						align-items: center;
					}
				</style>
			</head>
			<body class="bg-dark">
					<div class="row w-40">
						<div class="col-lg-6 d-flex align-items-center justify-content-center custom">
							<div class="bg-dark shadow rounded p-4" style="width: 100%; max-width: 400px;">
								<img class="card-title text-center m-0 w-100" src="assets/img/ALDRIN SERTIFIKASI.png" alt="">
								<hr>
								<div class="card-body mt-0">
									<form class="form-group" method="POST" action='./login-check.php'>
									<div class="mb-3">
										<label for="email" class="form-label text-light"> Nama Pengguna</label>
										<input type="email" class="form-control p-2" style="border-radius:50px;" id="email" value="<?=$_SESSION['nama_pengguna']?>" readonly disabled>
									</div>
									<div class="mb-3">
										<label for="password" class="form-label text-light">Peran</label>
										<select name="kode_akses" class="form-control p-2" style="border-radius:50px;" placeholder="Pilih Peran" required>
										<option value=""></option>
										<?php
											while($peran  = mysqli_fetch_assoc($query_kode_akses)){
											?>
											<option value="<?=$peran['kode_akses']?>"><?=convertKodeAkses($peran['kode_akses'])?></option>
											<?php
											}
										?>
										</select>
									</div>
									<hr>
									<button type="submit" class="btn btn-primary w-100 mb-2" style="border-radius:50px;">LANJUT</button>
									<a class="btn btn-secondary w-100" href="./logout.php" style="border-radius:50px;">BATAL</a>
									</form>
								</div>
							</div>
						</div>
						<div class="col-lg-6 d-flex align-items-center justify-content-center gradient-bg custom p-5">
							<div class="text-center">
								<h1><b>Welcome to ALDRIN SERTIFIKASI</b></h1>
								<p class=""><b>ALDRIN SERTIFIKASI</b> adalah aplikasi yang digunakan untuk pengusulan sertifikasi guru yang berada diwilayah Dinas Pendidikan Daerah Kabupaten Minahasa Utara.</p>
							</div>
						</div>
						<p class="text-light font-italic text-bold ml-4" style="font-size: 10px; position: absolute; bottom: 0; left: 0;">
							<span>&copy; <?=date('Y')?> Dinas Pendidikan Kabupaten Minahasa Utara</span>
						</p>
					</div>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
			</body>
		</html>
		<?php
	}else{
		header("Location: ./logout.php");
	}
}else{
	header("Location: ./?alert=1");
}

?>