<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-lock icon-title"></i> Ubah Kata Sandi
  </h1>
</section>

<?php
if(isset($_GET['alert'])){
  $alert=$_GET['alert'];
  if($alert==1){
    echo '<script>alert("Kata Sandi Lama Salah.")</script>';
  }elseif($alert==2){
    echo '<script>alert("Kata Sandi Baru dan Konfirmasi Kata Sandi Tidak Sama.")</script>';
  }elseif($alert==3){
    echo '<script>alert("Kata Sandi Berhasil Diubah.")</script>';
  }elseif($alert==4){
    echo '<script>alert("Kata Sandi Gagal Diubah.")</script>';
  }
}
?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

   
      <!-- form ubah Kata Sandi -->
      <div class="box box-danger">
        <!-- form start -->
        <form role="form" class="form-horizontal" method="POST" action="modules/password/proses.php">
          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-2 control-label">Kata Sandi Lama</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" name="old_pass" autocomplete="off" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Kata Sandi Baru</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" name="new_pass" autocomplete="off" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Ulangi Kata Sandi Baru</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="retype_pass" autocomplete="off" required>
              </div>
            </div>
          </div><!-- /.box-body -->
          
          <div class="box-footer bg-btn-action">
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
              </div>
            </div>
          </div>
        </form>
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->