<?php
function generateRandomString($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}
function convertStatus($status){
	$s="";
	if($status=="S1"){
		$s="Tahap 1";
	}elseif($status=="S2"){
		$s="Tahap 2";
	}elseif($status=="S3"){
		$s="SKTP";
	}elseif($status=="S4"){
		$s="SIMBAR";
	}elseif($status=="S5"){
		$s="SPM";
	}elseif($status=="S6"){
		$s="Selesai";
	}
	return $s;
}
function convertKodeAkses($kode_akses){
	$s="";
	if($kode_akses=="0"){
		$s="Super Admin";
	}elseif($kode_akses=="1"){
		$s="Verifikator 1";
	}elseif($kode_akses=="2"){
		$s="Verifikator 2";
	}elseif($kode_akses=="3"){
		$s="Operator";
	}elseif($kode_akses=="4"){
		$s="Renkeu";
	}elseif($kode_akses=="7"){
		$s="Admin";
	}
	return $s;
}
function logActivity($kb,$w,$nb,$jt){
	include "database.php";
	if((!empty($kb) && !empty($w) && !empty($nb) && !empty($jt))){
		$querylog = mysqli_query($mysqli, "INSERT INTO log_aktifitas (
																	id_pengusulan_sktp,
																	waktu,
																	keterangan,
																	id_akun
																  ) VALUES (
																	'$kb',
																	'$w',
																	'$jt,$nb',
																	'$_SESSION[id_akun]'
																	)") or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
	}
}

function token_validate($token, $device_id, $app_id, $kode_akses){
	include "database.php";
	$query=mysqli_query($mysqli,"SELECT * FROM session WHERE token='$token' AND device_id='$device_id' AND app_id='$app_id' AND kode_akses='$kode_akses'");
	if(mysqli_num_rows($query)>0){
		return true;
	}else{
		return false;
	}
}
function token_by_deviceid($device_id, $ip_address){
	include "database.php";
	$query_session=mysqli_query($mysqli,"SELECT * FROM session WHERE device_id='$device_id' AND ip_address='$ip_address'");
	if(mysqli_num_rows($query_session)>0){
		$data_session=mysqli_fetch_assoc($query_session);
		$query_akun = mysqli_query($mysqli, "SELECT * FROM akun WHERE id_akun='$data_session[id_akun]' AND status='aktif'");
		if(mysqli_num_rows($query_akun)>0){
			$data_akun=mysqli_fetch_assoc($query_akun);
			$query_peran=mysqli_query($mysqli,"SELECT * FROM peran WHERE id_akun='$data_session[id_akun]' AND kode_akses='$data_session[kode_akses]'");
			if(mysqli_num_rows($query_peran)>0){
				$data_peran=mysqli_fetch_assoc($query_peran);
				session_start();
				$_SESSION['id_akun']   			= $data_akun['id_akun'];
				$_SESSION['nama_pengguna']  	= $data_akun['nama_pengguna'];
				$_SESSION['kata_sandi']  		= $data_akun['kata_sandi'];
				$_SESSION['nama_lengkap'] 		= $data_akun['nama_lengkap'];
				$_SESSION['nama_sekolah'] 		= $data_peran['nama_sekolah'];
				$_SESSION['id_sekolah'] 		= $data_peran['id_sekolah'];
				$_SESSION['kabupaten'] 			= $data_peran['kabupaten'];
				$_SESSION['bentuk_pendidikan'] 	= $data_peran['bentuk_pendidikan'];
				$_SESSION['cabdin'] 			= $data_peran['cabdin'];
				$_SESSION['kode_akses']			= $data_session['kode_akses'];
				$_SESSION['token']				= $data_session['token'];
				$_SESSION['app_id']				= 'SIPGTK-01234';

				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED']) && !empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && !empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR']) && !empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED']) && !empty($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    // Mengambil IP pertama jika terdapat banyak IP yang dipisahkan oleh koma
    $ipaddress = explode(',', $ipaddress)[0];

    return $ipaddress;
}
function get_device_type() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/mobile/i', $user_agent)) {
        return "Mobile";
    } elseif (preg_match('/tablet/i', $user_agent)) {
        return "Tablet";
    } else {
        return "Desktop";
    }
}
function get_browser_info() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser_info = array(
        'name' => 'Unknown',
        'version' => 'Unknown',
        'platform' => 'Unknown'
    );

    // Mendapatkan nama dan versi lengkap browser
    if (preg_match('/OPR\/([\d\.]+)/', $user_agent, $matches)) {
        $browser_info['name'] = 'Opera';
        $browser_info['version'] = $matches[1];
    } elseif (preg_match('/Edg\/([\d\.]+)/', $user_agent, $matches)) { // Edge menggunakan 'Edg' di user agent
        $browser_info['name'] = 'Edge';
        $browser_info['version'] = $matches[1];
    } elseif (preg_match('/Chrome\/([\d\.]+)/', $user_agent, $matches)) {
        $browser_info['name'] = 'Chrome';
        $browser_info['version'] = $matches[1];
    } elseif (preg_match('/Version\/([\d\.]+).*Safari/', $user_agent, $matches)) {
        $browser_info['name'] = 'Safari';
        $browser_info['version'] = $matches[1];
    } elseif (preg_match('/Firefox\/([\d\.]+)/', $user_agent, $matches)) {
        $browser_info['name'] = 'Firefox';
        $browser_info['version'] = $matches[1];
    } elseif (preg_match('/MSIE ([\d\.]+);/', $user_agent, $matches) || preg_match('/Trident\/7.0;.*rv:([\d\.]+)/', $user_agent, $matches)) {
        $browser_info['name'] = 'Internet Explorer';
        $browser_info['version'] = $matches[1];
    }

    // Mendapatkan platform (sistem operasi)
    if (preg_match('/linux/i', $user_agent)) {
        $browser_info['platform'] = 'Linux';
    } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
        $browser_info['platform'] = 'Mac';
    } elseif (preg_match('/windows|win32/i', $user_agent)) {
        $browser_info['platform'] = 'Windows';
    }

    return $browser_info;
}
function get_device_id() {
    // Periksa apakah cookie "device_id" sudah ada
    if (isset($_COOKIE['device_id'])) {
        return $_COOKIE['device_id'];
    } else {
        // Jika tidak ada, buat ID perangkat baru dan simpan di cookie
        $device_id = bin2hex(random_bytes(16)); // Membuat ID perangkat acak
        setcookie('device_id', $device_id, time() + (10 * 365 * 24 * 60 * 60)); // Cookie berlaku selama 10 tahun
        return $device_id;
    }
}

$ip_address = get_client_ip();
$device_type = get_device_type();
$browser_info = get_browser_info();
$version=$browser_info['version'];
$browser_name=$browser_info['name'];
$browser_info = $browser_info['name'].'-'.$browser_info['version'].'-'.$browser_info['platform'];
$device_id = get_device_id();

$url = "https://ipinfo.io/$ip_address/json";
$response_location = file_get_contents($url);
$location = json_decode($response_location, true);
if (!empty($location) && !isset($location['error'])) {
	$location = 'Coordinate (Lat,Long):'.$location['loc']." -> ".'City:'.$location['city']." -> ".'Region:'.$location['region']." -> ".'Country:'.$location['country']." -> ".'Provider:'.$location['org'];
}else{
	$location = 'Out of limit request.';
}
?>