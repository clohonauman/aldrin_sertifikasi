
<?php  
session_start();
include 'config/helper.php';
include 'config/database.php';

if(isset($_SESSION['kode_akses']) AND isset($_SESSION['token']) AND isset($_SESSION['app_id'])){
    $result_token=token_validate($_SESSION['token'], $device_id, $_SESSION['app_id'], $_SESSION['kode_akses']);
    if(!$result_token){
        $result = token_by_deviceid($device_id, $ip_address);
        if(!$result){
            session_destroy();
            header('location:./?alert=1');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ALDRIN SERTIFIKASI</title>
        <link rel="shortcut icon" href="assets/img/favicon.png" />
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <style>
            .sidebar-dark {
                background-color: #3B82F6 !important;
            }
        </style>
        
    </head>
    <body id="page-top">
        <div id="wrapper">
            <?php include_once './sidebar.php'; ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php include_once './navbar.php'; ?>
                    <div class="container-fluid">
                        <?php include_once './content.php'; ?>
                    </div>
    
                </div>
                <?php include_once './footer.php'; ?>
            </div>
        </div>
    
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Silahkan tekan Keluar jika yakin ingin mengakhiri sesi saat ini.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="logout.php">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="assets/js/sb-admin-2.min.js"></script>
        <script src="assets/vendor/chart.js/Chart.min.js"></script>
        <script src="assets/js/demo/chart-area-demo.js"></script>
        <script src="assets/js/demo/chart-pie-demo.js"></script>
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/demo/datatables-demo.js"></script>
        <script>
            document.querySelectorAll('.content').forEach(element => {
                element.classList.add('card', 'p-2', 'rounded');
                element.classList.remove('content');
            });
            document.querySelectorAll('#dataTables1').forEach(element => {
                element.id = 'dataTable';
            });
        </script>
    
    </body>
</html>