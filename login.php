<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MASUK | ALDRIN SERTIFIKASI</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="ALDRIN SERTIFIKASI">

     <!-- favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png" />
    
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
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
            .sipgtk{
              height:20px;
            }
        }
        
    </style>
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="./" class="navbar-brand p-0">
        <header class="header">
            <img src="assets/img/favicon.png" alt="Logo" class="logo">
            <h1 class="title"><img class="ALDRIN-SERTIFIKASI" src="assets/img/ALDRIN SERTIFIKASI.png" alt="ALDRIN SERTIFIKASI"></h1>
        </header>
        </a>
        <div class="navbar-nav ms-auto py-0">
          <!-- Tampilkan teks pada desktop -->
          <a href="./" style="font-size:15px;" id="kembaliButton" class="btn btn-light py-2 px-4 ms-3 m-1 d-none d-md-inline-block">
              <i class="fa fa-arrow-left"></i> KEMBALI
          </a>

          <!-- Tampilkan ikon saja pada mobile -->
          <a href="./" id="kembaliButtonMobile" class="btn btn-light py-2 px-3 ms-3 m-1 d-inline-block d-md-none">
              <i class="fa fa-arrow-left"></i>
          </a>
        </div>

    </nav>
    <div class="d-flex justify-content-center align-items-center text-center">
      <div class="login-box col-md-3 text-left" style="color:#3B82F6;margin-top:100px;">
        <div style="color:#3B82F6;" class="login-logo text-center">
          <img src="assets/img/favicon.png" alt="" style="width:50%;margin-bottom:20px;">
        </div><!-- /.login-logo -->
        <?php  
          //alert
          if (empty($_GET['alert'])) {
            echo "";
          } 
          elseif ($_GET['alert'] == 1) {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4>  <i class='icon fa fa-times-circle'></i> Gagal Masuk!</h4>
                    Nama pengguna atau kata sandi salah.
                  </div>";
          }
          elseif ($_GET['alert'] == 2) {
            echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                    Anda telah berhasil keluar.
                  </div>";
          }
          elseif ($_GET['alert'] == 3) {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4>  <i class='icon fa fa-times-circle'></i> Gagal Masuk!</h4>
                    Akun anda telah dinonaktifkan oleh Admin. Silahkan hubungi admin terlebih dahulu.
                  </div>";
          }
        ?>
  
        <div class="login-box-primary p-4" style="background:#fff;border-radius:10px;">
          <p class="login-box-msg  text-center col-md-12"><i class="fa fa-user icon-title"></i> Silahkan Masuk</p>
          <br/>
          <form id="captchaForm"  enctype="multipart/form-data" action="login-check.php" method="POST">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="nama_pengguna" maxlength="30" placeholder="Nama Pengguna" autocomplete="off" required />
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" name="kata_sandi" maxlength="30" placeholder="Kata Sandi" id="kata_sandi" required />
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <label style="margin:0%;"><input type="checkbox" onclick="showhiddenPass()" id="textshow" style="color:#0000FF;"> Lihat Kata Sandi </p></label>
            </div>
            <div  class="d-flex justify-content-center align-items-center ">
              <div class="g-recaptcha text-center" data-sitekey="6Ldh4q0nAAAAAGlbr1Wh56UV8416hk7bORYAgut_" data-callback="enableSubmitButton"></div>
            </div>
            <hr style="border-color:#000;">
            <div class="row">
              <div class="col-xs-12 text-center" style="color:#ff0000;">
                <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Masuk" id="submitButton" disabled/><br>
            </div>
          </form>
          <script>
              // Callback function yang akan dijalankan setelah CAPTCHA diselesaikan
              function enableSubmitButton() {
                  document.getElementById("submitButton").removeAttribute("disabled");
              }
  
              // Tangkap form dengan JavaScript dan tambahkan event listener saat form dikirim
              document.getElementById("captchaForm").addEventListener("submit", function (event) {
                  // Pastikan CAPTCHA telah diselesaikan sebelum mengirim formulir
                  var isCaptchaCompleted = grecaptcha.getResponse() !== "";
                  if (!isCaptchaCompleted) {
                      event.preventDefault(); // Mencegah pengiriman formulir jika CAPTCHA belum diselesaikan
                  }
              });
          </script>
          <script src="https://www.google.com/recaptcha/api.js"></script>
  
        </div><!-- /.login-box-body -->
      </div>
    </div>
    <script>

      const form = document.getElementById('captchaForm');
      const loadingIndicator = document.getElementById('loading');
      form.addEventListener('submit', (event) => {
              loadingIndicator.classList.remove('hidden');
      });

      function showhiddenPass() {
        var x = document.getElementById("kata_sandi");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>

  </body>
</html>