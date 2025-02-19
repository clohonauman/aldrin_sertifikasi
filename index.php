<?php
include_once 'config/database.php';
include_once 'config/helper.php';
$result = token_by_deviceid($device_id, $ip_address);
if ($result) {
    header('location: ./main.php?module=beranda');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ALDRIN SERTIFIKASI</title>
        <link rel="shortcut icon" href="assets/img/favicon.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <style>
            body {
                background: url('assets/images/1.png') no-repeat center center fixed;
                background-size: cover;
            }
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
            }
            .logo {
                height: 45px;
            }
            @media (max-width: 768px) {
                body {
                    background: url('assets/images/2.png') no-repeat center center fixed;
                    background-size: cover;
                }
            }
        </style>
    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-primary border-primary">
                <div class="container-fluid d-flex justify-content-between align-items-center w-100">
                    <a href="./" class="navbar-brand">
                        <img src="assets/img/ALDRIN Sertifikasi.png" alt="Logo" class="logo">
                    </a>
                    <a href="./login.php" class="btn btn-light ml-auto">
                        <i class="fa fa-sign-in"></i> MASUK
                    </a>
                </div>
            </nav>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    </body>
</html>
