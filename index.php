<?php
include_once 'config/database.php';
include_once 'config/helper.php';
$result = token_by_deviceid($device_id, $ip_address);
if($result){
    header('location: ./main.php?module=beranda');
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title>ALDRIN SERTIFIKASI</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="ALDRIN SERTIFIKASI ">
    <link rel="shortcut icon" href="assets/img/favicon.png" />

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .position-fixed {
            z-index: 9999999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .boxlogin{
            display:none;
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
            background:#000;
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
        /* Mengubah latar belakang menjadi putih */
        .navbar.navbar-expand-lg.navbar-dark.px-5.py-3.py-lg-0 {
            background-color: #3B82F6;
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
        .ALDRIN-SERTIFIKASI{
            height:60px;
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
                height: 100vh; /* Menyesuaikan tinggi gambar dengan tinggi viewport */
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
            .ALDRIN SERTIFIKASI{
                height:20px;
            }
        }
        .card-fixed{
            z-index: 9999999;
            background:#fff;
            padding:50px;
            border-radius:20px;
        }
        .bg{
            position:fixed;
            z-index: 9999999;
            top:0%;
            left:0%;
            height:100%;
            width:100%;
            background:#00000090;
        }
        @media (max-width: 991.98px) {
            .card-fixed{
                z-index: 9999999;
                background:#fff;
                padding:50px;
                border-radius:20px;
            }
        }
        
    </style>
    </head>
    <?php
        if(isset($_GET['alert'])){
        $alert=$_GET['alert'];
            if($alert==1){
                echo '<script>alert("Silahkan masuk ke aplikasi terlebih dahulu. Terima kasih.")</script>';
            }
        }
    ?>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="./" class="navbar-brand p-0">
            <header class="header">
                <img src="assets/img/favicon.png" alt="Logo" class="logo">
                <h1 class="title"><img class="ALDRIN-SERTIFIKASI" src="assets/img/ALDRIN SERTIFIKASI.png" alt="ALDRIN SERTIFIKASI"></h1>
            </header>
        </a>
        <div class="navbar-nav ms-auto py-0">
            <!-- Tampilkan teks pada desktop -->
            <a href="./login.php" style="font-size:15px;" id="masukButton" class="btn btn-light py-2 px-4 ms-3 m-1 d-none d-md-inline-block">
                <i class="fa fa-sign-in"></i> MASUK
            </a>
            
            <!-- Tampilkan ikon saja pada mobile -->
            <a href="./login.php" id="masukButtonMobile" class="btn btn-light py-2 px-3 ms-3 m-1 d-inline-block d-md-none">
                <i class="fa fa-sign-in"></i>
            </a>
        </div>

    </nav>

    <div class="slideshow-container" id="desktop-slideshow">
        <!-- tambah ke atas untuk gambar selanjutnya -->
        <!-- <img class="mySlides" src="<?=$img2desk?>"> -->
        <img class="mySlides" src="assets/images/1.png">
        <button class="w3-button w3-display-left" onclick="plusDivsDesktop(-1)">&#10094;</button>
        <button class="w3-button w3-display-right" onclick="plusDivsDesktop(1)">&#10095;</button>
    </div>
    <div class="slideshow-container" id="mobile-slideshow">
        <!-- tambah ke atas untuk gambar selanjutnya -->
        <img class="mySlidesMobile" src="">
        <button class="w3-button w3-display-left" onclick="plusDivsMobile(-1)">&#10094;</button>
        <button class="w3-button w3-display-right" onclick="plusDivsMobile(1)">&#10095;</button>
    </div>
    <script>
        function checkScreenSize() {
            var screenWidth = window.innerWidth;
            var desktopSlideshow = document.getElementById("desktop-slideshow");
            var mobileSlideshow = document.getElementById("mobile-slideshow");
            var isMobile = screenWidth <= 768;
            if (isMobile) {
                mobileSlideshow.style.display = "block";
                desktopSlideshow.style.display = "none";
            } else {
                mobileSlideshow.style.display = "none";
                desktopSlideshow.style.display = "block";
            }
        }
        checkScreenSize();
        window.addEventListener("resize", checkScreenSize);
    </script>
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
    </body>
</html>
