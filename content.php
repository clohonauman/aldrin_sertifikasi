
<?php
require_once "config/database.php";
require_once "config/fungsi_tanggal.php";
require_once "config/fungsi_rupiah.php";
if (empty($_SESSION['id_akun'])){
    echo "<meta http-equiv='refresh' content='0; url=./?alert=1'>";
}
else {
	if($_SESSION['kode_akses']==0){
		if ($_GET['module'] == 'beranda') {
			include "modules/beranda/view.php";
		}elseif ($_GET['module'] == 'password') {
			include "modules/password/view.php";
		}elseif ($_GET['module'] == 'manajemen_pengguna') {
			include "modules/manajemen_pengguna/view.php";
		}elseif ($_GET['module'] == 'form_manajemen_pengguna') {
			include "modules/manajemen_pengguna/form.php";
		}elseif ($_GET['module'] == 'riwayat') {
			include "modules/riwayat/view.php";
		}elseif ($_GET['module'] == 'berkas') {
			include "modules/berkas/view.php";
		}elseif ($_GET['module'] == 'riwayat_aktivitas') {
			include "modules/riwayat_aktivitas/view.php";
		}elseif ($_GET['module'] == 'berkas_form') {
			include "modules/berkas/form.php";
		}elseif ($_GET['module'] == 'profil') {
			include "modules/profil/view.php";
		}elseif ($_GET['module'] == 'form_profil') {
			include "modules/profil/form.php";
		}elseif ($_GET['module'] == 'pengajuan_file') {
			include "modules/pengajuan/file.php";
		}elseif ($_GET['module'] == 'periode') {
			include "modules/periode/view.php";
		}elseif ($_GET['module'] == 'pengguna_aktif') {
			include "modules/pengguna_aktif/view.php";
		}else{
			include "./404.php";
		}
	}elseif($_SESSION['kode_akses']==1){
		if ($_GET['module'] == 'beranda') {
			include "modules/beranda/view.php";
		}elseif ($_GET['module'] == 'pemeriksaan') {
			include "modules/pemeriksaan/view.php";
		}elseif ($_GET['module'] == 'pemeriksaan_form') {
			include "modules/pemeriksaan/form.php";
		}elseif ($_GET['module'] == 'password') {
			include "modules/password/view.php";
		}elseif ($_GET['module'] == 'profil') {
			include "modules/profil/view.php";
		}elseif ($_GET['module'] == 'form_profil') {
			include "modules/profil/form.php";
		}elseif ($_GET['module'] == 'pengajuan_file') {
			include "modules/pengajuan/file.php";
		}else{
			include "./404.php";
		}
	}elseif($_SESSION['kode_akses']==2){
		if ($_GET['module'] == 'beranda') {
			include "modules/beranda/view.php";
		}elseif ($_GET['module'] == 'pemeriksaan') {
			include "modules/pemeriksaan/view.php";
		}elseif ($_GET['module'] == 'pemeriksaan_form') {
			include "modules/pemeriksaan/form.php";
		}elseif ($_GET['module'] == 'berkas') {
			include "modules/berkas/view.php";
		}elseif ($_GET['module'] == 'berkas_terverifikasi') {
			include "modules/berkas_terverifikasi/view.php";
		}elseif ($_GET['module'] == 'berkas_form') {
			include "modules/berkas/form.php";
		}elseif ($_GET['module'] == 'password') {
			include "modules/password/view.php";
		}elseif ($_GET['module'] == 'profil') {
			include "modules/profil/view.php";
		}elseif ($_GET['module'] == 'form_profil') {
			include "modules/profil/form.php";
		}elseif ($_GET['module'] == 'pengajuan_file') {
			include "modules/pengajuan/file.php";
		}else{
			include "./404.php";
		}
	}elseif($_SESSION['kode_akses']==3){
		if ($_GET['module'] == 'beranda') {
			include "modules/beranda/view.php";
		}elseif ($_GET['module'] == 'pengajuan') {
			include "modules/pengajuan/view.php";
		}elseif ($_GET['module'] == 'riwayat') {
			include "modules/riwayat/view.php";
		}elseif ($_GET['module'] == 'berkas') {
			include "modules/berkas/view.php";
		}elseif ($_GET['module'] == 'berkas_form') {
			include "modules/berkas/form.php";
		}elseif ($_GET['module'] == 'password') {
			include "modules/password/view.php";
		}elseif ($_GET['module'] == 'profil') {
			include "modules/profil/view.php";
		}elseif ($_GET['module'] == 'form_profil') {
			include "modules/profil/form.php";
		}elseif ($_GET['module'] == 'pengajuan_file') {
			include "modules/pengajuan/file.php";
		}else{
			include "./404.php";
		}
	}elseif($_SESSION['kode_akses']==4){
		if ($_GET['module'] == 'beranda') {
			include "modules/beranda/view.php";
		}elseif ($_GET['module'] == 'berkas_terverifikasi') {
			include "modules/berkas_terverifikasi/view.php";
		}elseif ($_GET['module'] == 'password') {
			include "modules/password/view.php";
		}elseif ($_GET['module'] == 'profil') {
			include "modules/profil/view.php";
		}elseif ($_GET['module'] == 'form_profil') {
			include "modules/profil/form.php";
		}else{
			include "./404.php";
		}
	}elseif($_SESSION['kode_akses']==7){
		if ($_GET['module'] == 'beranda') {
			include "modules/beranda/view.php";
		}elseif ($_GET['module'] == 'password') {
			include "modules/password/view.php";
		}elseif ($_GET['module'] == 'manajemen_pengguna') {
			include "modules/manajemen_pengguna/view.php";
		}elseif ($_GET['module'] == 'form_manajemen_pengguna') {
			include "modules/manajemen_pengguna/form.php";
		}elseif ($_GET['module'] == 'riwayat') {
			include "modules/riwayat/view.php";
		}elseif ($_GET['module'] == 'berkas') {
			include "modules/berkas/view.php";
		}elseif ($_GET['module'] == 'riwayat_aktivitas') {
			include "modules/riwayat_aktivitas/view.php";
		}elseif ($_GET['module'] == 'berkas_form') {
			include "modules/berkas/form.php";
		}elseif ($_GET['module'] == 'profil') {
			include "modules/profil/view.php";
		}elseif ($_GET['module'] == 'form_profil') {
			include "modules/profil/form.php";
		}elseif ($_GET['module'] == 'pengajuan_file') {
			include "modules/pengajuan/file.php";
		}else{
			include "./404.php";
		}
	}else{
		include "./403.php";
	}
}
?>