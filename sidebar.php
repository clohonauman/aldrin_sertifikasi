<ul class="navbar-nav sidebar sidebar-dark accordion " id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img class="col-md-10 mt-4" src="./assets/img/ALDRIN Sertifikasi.png" alt="ALDRIN Sertifikasi">
            <hr class="sidebar-divider my-0">
            <p style="font-size:10px;" class="text-default"><?=convertKodeAkses($_SESSION['kode_akses'])?></p>
        </div>
    </a>
    <br>
    <!-- =============================================================================================== -->
     <?php
     if(isset($_SESSION['kode_akses'])){
        if($_SESSION['kode_akses']==0){
            ?>
            <hr class="sidebar-divider my-0 mt-4">
            <div class="sidebar-heading">
                MENU UTAMA
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'beranda') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=beranda">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                MODUL
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'berkas') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=berkas">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Berkas</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['module'] == 'riwayat_aktivitas') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=riwayat_aktivitas">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Riwayat Akivitas</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['module'] == 'manajemen_pengguna') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=manajemen_pengguna">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Pengaturan Pengguna</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['module'] == 'pengguna_aktif') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=pengguna_aktif">
                    <i class="fas fa-fw fa-globe"></i>
                    <span>Pengguna Sedang Aktif</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                PENGATURAN
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'periode') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=periode">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Periode</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['module'] == 'profil') ? 'active' : (($_GET['module'] == 'password') ? 'active' : '') ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#akun"
                    aria-expanded="true" aria-controls="akun">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Akun</span>
                </a>
                <div id="akun" class="collapse" aria-labelledby="akun" data-parent="#akun">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="main.php?module=profil">Profil</a>
                        <a class="collapse-item" href="main.php?module=password">Kata Sandi</a>
                    </div>
                </div>
            </li>
            <?php
        }elseif($_SESSION['kode_akses']==1){
            ?>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading">
                MENU UTAMA
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'beranda') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=beranda">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                MODUL
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'pemeriksaan') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#berkas"
                    aria-expanded="true" aria-controls="berkas">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Berkas</span>
                </a>
                <div id="berkas" class="collapse" aria-labelledby="berkas" data-parent="#berkas">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?module=pemeriksaan&k=1">Menunggu Verifikasi</a>
                        <a class="collapse-item" href="?module=pemeriksaan&k=2">Ditolak</a>
                        <a class="collapse-item" href="?module=pemeriksaan&k=3">Direvisi</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                PENGATURAN
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'profil') ? 'active' : (($_GET['module'] == 'password') ? 'active' : '') ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#akun"
                    aria-expanded="true" aria-controls="akun">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Akun</span>
                </a>
                <div id="akun" class="collapse" aria-labelledby="akun" data-parent="#akun">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="main.php?module=profil">Profil</a>
                        <a class="collapse-item" href="main.php?module=password">Kata Sandi</a>
                    </div>
                </div>
            </li>
            <?php
        }elseif($_SESSION['kode_akses']==2){
            ?>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading">
                MENU UTAMA
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'beranda') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=beranda">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                MODUL
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'pemeriksaan') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#berkas"
                    aria-expanded="true" aria-controls="berkas">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Berkas</span>
                </a>
                <div id="berkas" class="collapse" aria-labelledby="berkas" data-parent="#berkas">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?module=pemeriksaan&k=1">Menunggu Verifikasi</a>
                        <a class="collapse-item" href="?module=pemeriksaan&k=2">Ditolak</a>
                        <a class="collapse-item" href="?module=pemeriksaan&k=3">Direvisi</a>
                    </div>
                </div>
            </li>
            <li class="nav-item <?= ($_GET['module'] == 'berkas_terverifikasi') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#berkas_terverifikasi"
                    aria-expanded="true" aria-controls="berkas_terverifikasi">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Berkas Terverifikasi</span>
                </a>
                <div id="berkas_terverifikasi" class="collapse" aria-labelledby="berkas_terverifikasi" data-parent="#berkas_terverifikasi">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?module=berkas_terverifikasi&k=1">Pengajuan SKTP</a>
                        <a class="collapse-item" href="?module=berkas_terverifikasi&k=2">Proses SIMBAR</a>
                        <a class="collapse-item" href="?module=berkas_terverifikasi&k=3">Selesai Administrasi</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                PENGATURAN
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'profil') ? 'active' : (($_GET['module'] == 'password') ? 'active' : '') ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#akun"
                    aria-expanded="true" aria-controls="akun">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Akun</span>
                </a>
                <div id="akun" class="collapse" aria-labelledby="akun" data-parent="#akun">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="main.php?module=profil">Profil</a>
                        <a class="collapse-item" href="main.php?module=password">Kata Sandi</a>
                    </div>
                </div>
            </li>
            <?php
        }elseif($_SESSION['kode_akses']==3){
            ?>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading">
                MENU UTAMA
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'beranda') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=beranda">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                MODUL
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'pengajuan') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=pengajuan">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Usul Sertifikasi</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['module'] == 'riwayat') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#riwayat"
                    aria-expanded="true" aria-controls="riwayat">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Riwayat</span>
                </a>
                <div id="riwayat" class="collapse" aria-labelledby="riwayat" data-parent="#riwayat">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?module=riwayat&k=1">Menunggu Verif. V1</a>
                        <a class="collapse-item" href="?module=riwayat&k=2">Ditolak V1</a>
                        <a class="collapse-item" href="?module=riwayat&k=3">Direvisi V1</a>
                        <a class="collapse-item" href="?module=riwayat&k=4">Menunggu Verif. V2</a>
                        <a class="collapse-item" href="?module=riwayat&k=5">Ditolak V2</a>
                        <a class="collapse-item" href="?module=riwayat&k=6">Direvisi V2</a>
                        <a class="collapse-item" href="?module=riwayat&k=7">Pengajuan SKTP</a>
                        <a class="collapse-item" href="?module=riwayat&k=8">Proses SIMBAR</a>
                        <a class="collapse-item" href="?module=riwayat&k=9">Proses SPM</a>
                        <a class="collapse-item" href="?module=riwayat&k=10">Selesai</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                PENGATURAN
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'profil') ? 'active' : (($_GET['module'] == 'password') ? 'active' : '') ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#akun"
                    aria-expanded="true" aria-controls="akun">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Akun</span>
                </a>
                <div id="akun" class="collapse" aria-labelledby="akun" data-parent="#akun">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="main.php?module=profil">Profil</a>
                        <a class="collapse-item" href="main.php?module=password">Kata Sandi</a>
                    </div>
                </div>
            </li>
            <?php
        }elseif($_SESSION['kode_akses']==4){
            ?>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading">
                MENU UTAMA
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'beranda') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=beranda">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                MODUL
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'berkas_terverifikasi') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=berkas_terverifikasi&k=3">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Berkas Terverifikasi</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                PENGATURAN
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'profil') ? 'active' : (($_GET['module'] == 'password') ? 'active' : '') ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#akun"
                    aria-expanded="true" aria-controls="akun">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Akun</span>
                </a>
                <div id="akun" class="collapse" aria-labelledby="akun" data-parent="#akun">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="main.php?module=profil">Profil</a>
                        <a class="collapse-item" href="main.php?module=password">Kata Sandi</a>
                    </div>
                </div>
            </li>
            <?php
        }elseif($_SESSION['kode_akses']==7){
            ?>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading">
                MENU UTAMA
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'beranda') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=beranda">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                MODUL
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'berkas') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=berkas">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Berkas</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['module'] == 'riwayat_aktivitas') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=riwayat_aktivitas">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Riwayat Akivitas</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['module'] == 'manajemen_pengguna') ? 'active' : '' ?>">
                <a class="nav-link" href="main.php?module=manajemen_pengguna">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Pengaturan Pengguna</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                PENGATURAN
            </div>
            <li class="nav-item <?= ($_GET['module'] == 'profil') ? 'active' : (($_GET['module'] == 'password') ? 'active' : '') ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#akun"
                    aria-expanded="true" aria-controls="akun">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Akun</span>
                </a>
                <div id="akun" class="collapse" aria-labelledby="akun" data-parent="#akun">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="main.php?module=profil">Profil</a>
                        <a class="collapse-item" href="main.php?module=password">Kata Sandi</a>
                    </div>
                </div>
            </li>
            <?php
        }else{
            session_destroy();
            header('location: ./?alert=1');
         }
     }else{
        session_destroy();
        header('location: ./?alert=1');
     }
     ?>
    <!-- =============================================================================================== -->
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>