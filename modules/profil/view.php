<section class="content-header">
  <h1>
    <i class="fa fa-user icon-title"></i> Profil Pengguna
  </h1>
</section>

<!-- Main content -->
<section class="content-body">
  <div class="row">
    <div class="card col-md-12">
        <?php
          if (isset($_GET['alert'])) {
            if ($_GET['alert'] == 2) {
              echo "<div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4>  <i class='icon fa fa-times-circle'></i> Gagal Diperbarui!</h4>
                      Nama Pengguna atau Email telah pernah terdaftar, silahkan gunakan Nama Pengguna atau Email lain.
                    </div>";
            }
          } 
          $query=mysqli_query($mysqli,"SELECT * FROM akun WHERE id_akun='$_SESSION[id_akun]'");
          if(mysqli_num_rows($query)>0){
            $data=mysqli_fetch_assoc($query);
            ?>
            <form role="form" class="" method="POST" action="?module=form_profil" enctype="multipart/form-data">
              <div class="form-group">
                  <label style="font-size:25px;margin-top:10px;" class="col-sm-8"><?php echo $data['nama_lengkap']; ?></label>
                  <label style="text-align:left" name="nip" class="col-sm-8 control-label"><?php echo $data['nama_pengguna']; ?></label>
                  <label style="text-align:left" name="nip" class="col-sm-8 control-label"><?php echo $data['email']; ?></label>
                  <input type="hidden" name="id_akun" value="<?php echo $data['id_akun']; ?>">
              </div><!-- /.box body -->
              <hr>
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary btn-submit" name="ubah" value="Ubah">
                  </div>
                </div>
              </div><!-- /.box footer -->
            </form>
            <?php
          }else{
            header('?module=beranda');
          }
        ?>
    </div>   <!-- /.row -->
  </div>
</section>