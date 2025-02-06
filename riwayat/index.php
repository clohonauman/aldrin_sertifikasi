<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['nuptk'])){
    header('Location: ../login.php?alert=1');
}
?>
<html>
  <head>
    <title>SIPGTK</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="SIPGTK ">
    <link rel="shortcut icon" href="../assets/img/favicon.png" />
    
    <!-- Bootstrap 3.3.2 -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="../assets/plugins/iCheck/square/red.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/skins/skin-green.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        :root {
            --color-white: #fff;
            --color-black: #333;
            --color-gray: #75787b;
            --color-gray-light: #bbb;
            --color-gray-disabled: #e8e8e8;
            --color-red: #ff0000;
            --color-green-dark: #383;
            --font-size-small: .75rem;
            --font-size-default: .875rem;
        }

        * {
            box-sizing: border-box;
        }

        h2 {
            color: var(--color-black);
            font-size: 15px;
            line-height: 1.5;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        h3 {
            color: var(--color-black);
            font-size: 15px;
            line-height: 1.5;
            font-weight: 400;
            text-transform: ;
            letter-spacing: 3px;
        }
        section {
            margin-bottom: 2rem;
        }

        .progress-bar1 {
            display: flex;
            justify-content: space-between;
            list-style: none;
            padding: 0;
            margin: 0 0 1rem 0;
        }
        .progress-bar1 li {
            flex: 2;
            position: relative;
            padding: 0 0 10px 0;
            font-size: 15px;
            line-height: 1.5;
            color: var(--color-green);
            font-weight: 600;
            white-space: nowrap;
            overflow: visible;
            min-width: 0;
            text-align: center;
            border-bottom: 2px solid var(--color-gray-disabled);
        }
        .progress-bar1 li:first-child,
        .progress-bar1 li:last-child {
            flex: 1;
        }
        .progress-bar1 li:last-child {
            text-align: right;
        }
        .progress-bar1 li:before {
            content: "";
            display: block;
            width: 8px;
            height: 8px;
            background-color: var(--color-gray-disabled);
            border-radius: 50%;
            border: 2px solid var(--color-white);
            position: absolute;
            left: calc(50% - 6px);
            bottom: -7px;
            z-index: 3;
            transition: all .2s ease-in-out;
        }
        .progress-bar1 li:first-child:before {
            left: 0;
        }
        .progress-bar1 li:last-child:before {
            right: 0;
            left: auto;
        }
        .progress-bar1 span {
            transition: opacity .3s ease-in-out;
        }
        .progress-bar1 li:not(.is-active) span {
            opacity: 0;
        }
        .progress-bar1 .is-complete:not(:first-child):after,
        .progress-bar1 .is-active:not(:first-child):after {
            content: "";
            display: block;
            width: 100%;
            position: absolute;
            bottom: -2px;
            left: -50%;
            z-index: 2;
            border-bottom: 2px solid var(--color-red);
        }
        .progress-bar1 li:last-child span {
            width: 200%;
            display: inline-block;
            position: absolute;
            left: -100%;
        }
        .progress-bar1 .is-complete:last-child:after,
        .progress-bar1 .is-active:last-child:after {
            width: 200%;
            left: -100%;
        }
        .progress-bar1 .is-complete:before {
            background-color: var(--color-red);
        }
        .progress-bar1 .is-active:before,
        .progress-bar1 li:hover:before,
        .progress-bar1 .is-hovered:before {
            background-color: var(--color-white);
            border-color: var(--color-red);
        }
        .progress-bar1 li:hover:before,
        .progress-bar1 .is-hovered:before {
            transform: scale(1.33);
        }
        .progress-bar1 li:hover span,
        .progress-bar1 li.is-hovered span {
            opacity: 1;
        }
        .progress-bar1:hover li:not(:hover) span {
            opacity: 0;
        }
        .x-ray .progress-bar1,
        .x-ray .progress-bar1 li {
            border: 1px dashed red;
        }
        .progress-bar1 .has-changes {
            opacity: 1 !important;
        }
        .progress-bar1 .has-changes:before {
            content: "";
            display: block;
            width: 8px;
            height: 8px;
            position: absolute;
            left: calc(50% - 4px);
            bottom: -20px;
        }
        .header {
            display: flex;
            align-items: center;
        }
        .logo {
            height: 45px;
            margin-right: 10px;
        }
        .title {
            font-size: 25px;
            margin: 0;
            font-weight:bold;
        }
        body {
          background:#fff;
          overflow-y:auto;
        }
        .slideshow-container {
            position: relative;
            width: 100%;
            margin: 0;
            margin-top:50px;
        }
        .mySlides {
            display: none;
            width: 100%;
            /* height: 100vh; */
            object-fit: cover;
            animation: fade 0.5s;
        }
        .w3-button {
            background-color: #00000000;
            border-color: #00000000;
            color: white;
            padding: 8px 16px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 50px;
            z-index: 1;
            cursor: pointer;
            position:fixed;
        }
        .w3-button:hover {
            background-color: #00000000;
        }
        .w3-display-left {
            left: 0;
        }
        .w3-display-right {
            right: 0;
        }
        .navbar.navbar-expand-lg.navbar-dark.px-5.py-3.py-lg-0 {
            background-color: #6f0104;
            border-radius:0px;
            shadow:black 20px;

        }
        /* Mengubah warna teks menjadi hitam */
        .navbar.navbar-expand-lg.navbar-dark.px-5.py-3.py-lg-0 .navbar-brand .title {
            color: #000; /* Warna teks hitam */
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .sipgtk{
          height:30px;
        }
        /* Animasi fade */
        @keyframes fade {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .mySlidesMobile {
                width: 100%;
            }
            .w3-button {
                font-size: 30px;
            }
            
            .logo {
                height: 50px;
            }

            .title {
                font-size: 20px;
                font-weight:bold;
            }
            .sipgtk{
              height:20px;
            }
        }
    </style>
  </head>
  <body class="login-page bg-login">
    <div id="loading" class="page-loader-wrapper hidden">
        <div class="loader">
            <div class="m-t-30"><img src="../assets/img/favicon.png" width="100" height="100" alt="DIKDA SULUT"></div>
            <p>Mohon Menunggu...</p>        
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="../" class="navbar-brand p-0">
        <header class="header">
            <img src="../img/logodinaspendidikan.png" alt="Logo" class="logo">
            <h1 class="title"><img class="sipgtk" src="../images/sipgtk.png" alt="SIPGTK"></h1>
        </header>
        </a>
        <div class="navbar-nav ms-auto py-0">
            <a href="../logout.php" style="font-size:15px;" class="btn btn-danger py-2 px-4 ms-3"><i class="fa fa-sign-out"></i> KELUAR</a>
        </div>
    </nav>
    
    <div class="col-12" style="text-align:center;color:#ff0000;margin-top:50px;width:100%;">
        <?php
        if(isset($_SESSION['nuptk'])){
            include '../config/database.php';
            include '../config/helper.php';
            $queryperiode=mysqli_query($mysqli, "SELECT periode FROM periode_sipgtk ORDER BY periode DESC");
            $periode=mysqli_fetch_assoc($queryperiode);
            $periode=$periode['periode'];
            $querystatus=mysqli_query($mysqli, "SELECT id_pengusulan_sktp,status,waktu_pengusulan,keterangan,nama_guru,id_sekolah FROM pengusulan_sktp WHERE nuptk='$_SESSION[nuptk]' AND periode='$periode'");
            $datastatus=mysqli_fetch_assoc($querystatus);
            if(!empty($datastatus)){
                $querysklh=mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE sekolah_id='$datastatus[id_sekolah]'");
                $datasklh=mysqli_fetch_assoc($querysklh);
                ?>
                <div class="progres" style="text-align:center;width:100%;">
                    <br><br>
                    <h1><b>STATUS PENGAJUAN<br>TUNJANGAN PROFESI GURU</b></h1>
                    <hr>
                    <h3>NUPTK : <b><?=$_SESSION['nuptk']?></b></h3>
                    <h3>NAMA : <b><?=$datastatus['nama_guru']?></b></h3>
                    <h3>SEKOLAH : <b><?=$datasklh['nama']?></b></h3>
                    <hr>
                    <div style="margin-left:5%;margin-right:5%;width:90%;text-align:center;">
                        <ol class="progress-bar1">
                            <li class="is-complete"><span></span></li> 
                            <li <?php if($datastatus['status']=="S2" OR $datastatus['status']=="S3" OR $datastatus['status']=="S4" OR $datastatus['status']=="S5" OR $datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S1"){ echo 'class="is-complete is-hovered"'; } ?>><span>V1 (<?=$datastatus['keterangan']?>)</span></li> 
                            <li <?php if($datastatus['status']=="S3" OR $datastatus['status']=="S4" OR $datastatus['status']=="S5" OR $datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S2"){ echo 'class="is-complete is-hovered"'; } ?>><span>V2 (<?=$datastatus['keterangan']?>)</span></li> 
                            <li <?php if($datastatus['status']=="S4" OR $datastatus['status']=="S5" OR $datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S3"){ echo 'class="is-complete is-hovered"'; } ?>><span>V3 (<?=$datastatus['keterangan']?>)</span></li> 
                            <li <?php if($datastatus['status']=="S5" OR $datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S4"){ echo 'class="is-complete is-hovered"'; } ?>><span>V4 (<?=$datastatus['keterangan']?>)</span></li> 
                            <li <?php if($datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S5"){ echo 'class="is-complete is-hovered"'; } ?>><span>V5 (<?=$datastatus['keterangan']?>)</span></li> 
                            <li <?php if($datastatus['status']=="S6"){ echo 'class="is-complete is-hovered"'; } ?>><span>V6</span></li>  
                        </ol>
                        <br>
                        <i> <b>*Jika ditolak segera hubungi Operator SIPGTK di Sekolah anda untuk mengunggah perbaikan.</b></i><br>
                        <hr>
                        <a href="../detail_pengajuan/?id=<?=$datastatus['id_pengusulan_sktp']?>" class="btn btn-danger">LIHAT DETAIL</a>
                        <hr>
                        <h2><b>KETERANGAN</b></h2><hr>
                        <div class="text-center">
                          <div class="text-left text-black">
                              <h4><b>V1 = Verifikasi 1 (Cabang Dinas)</b></h4><hr>
                              <h4><b>V2 = Verifikasi 2 (Bidang GTK)</b></h4><hr>
                              <h4><b>V3 = Proses Pengajuan Surat Keputusan Tunjangan Profesi (SKTP) melalui SIMTUN</b></h4><hr>
                              <h4><b>V4 = Menunggu proses pada SIMBAR</b></h4><hr>
                              <h4><b>V5 = Menunggu proses SPM (Bidang Keuangan)</b></h4><hr>
                              <h4><b>V6 = Selesai Pemberkasan Administrasi (Menunggu Pembayaran ± 2 Minggu)</b></h4><hr>
                          </div>
                          <b>Catatan: V3 dan V4 berproses di Kementerian sehingga membutuhkan waktu yang lama.</b>
                        </div>
                    </div>
                </div>
                <?php
            }else{
            ?>
                <br><br><hr>
                <h1>STATUS PENGAJUAN TUNJANGAN PROFESI GURU</h1>
                <h3>NUPTK : <?=$_SESSION['nuptk']?></h3>
                <hr>
                <h1 style="margin:10px;">Maaf, data anda tidak ditemukan sebagai guru yang sedang diajukan pada SIPGTK. Silahkan hubungi <b>Operator SIPGTK</b> di Sekolah anda untuk pengecekkan lebih lanjut.</h1>
            <?php
            }
        }
        ?>
    </div>
    <script>
        var slideIndexDesktop = 1;
        showDivsDesktop(slideIndexDesktop);

        function plusDivsDesktop(n) {
            showDivsDesktop(slideIndexDesktop += n);
        }

        function showDivsDesktop(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {slideIndexDesktop = 1}
            if (n < 1) {slideIndexDesktop = x.length} ;
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndexDesktop-1].style.display = "block";
        }
        
        function carouselDesktop() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            slideIndexDesktop++;
            if (slideIndexDesktop > x.length) {slideIndexDesktop = 1}
            x[slideIndexDesktop-1].style.display = "block";
            // setTimeout(carouselDesktop, 10000);
        }
        carouselDesktop();
    </script>
    <script>
        var slideIndexMobile = 1;
        showDivsMobile(slideIndexMobile);

        function plusDivsMobile(n) {
            showDivsMobile(slideIndexMobile += n);
        }

        function showDivsMobile(n) {
            var i;
            var x = document.getElementsByClassName("mySlidesMobile");
            if (n > x.length) {slideIndexMobile = 1}
            if (n < 1) {slideIndexMobile = x.length} ;
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndexMobile-1].style.display = "block";
        }
        
        function carouselMobile() {
            var i;
            var x = document.getElementsByClassName("mySlidesMobile");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            slideIndexMobile++;
            if (slideIndexMobile > x.length) {slideIndexMobile = 1}
            x[slideIndexMobile-1].style.display = "block";
            // setTimeout(carouselMobile, 10000);
        }
        carouselMobile();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      const buttons = document.querySelectorAll('.load');
      const loadingIndicator = document.getElementById('loading');
      buttons.forEach(button => {
            button.addEventListener('click', () => {
                const action = button.getAttribute('data-action');
                loadingIndicator.classList.remove('hidden');
                setTimeout(() => {
                    loadingIndicator.classList.add('hidden');
                    console.log(`Button ${action} clicked.`);
                }, 5000);
            });
        });
    </script>
  </body>
</html>
