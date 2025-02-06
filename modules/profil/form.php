
<?php
require_once "config/database.php";  
if (isset($_POST['id_akun'])) {
  // fungsi query untuk menampilkan data dari tabel user
  $query = mysqli_query($mysqli, "SELECT * FROM akun WHERE id_akun='$_POST[id_akun]'") 
                                  or die('Ada kesalahan pada query tampil data user : '.mysqli_error($mysqli));
  $data  = mysqli_fetch_assoc($query);
}	
?>
	<!-- tampilkan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Profil Pengguna
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/profil/proses.php?act=update" enctype="multipart/form-data">
            <div class="box-body">

              <input type="hidden" name="id_akun" value="<?php echo $data['id_akun']; ?>" required>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pengguna</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_pengguna" autocomplete="off" value="<?php echo $data['nama_pengguna']; ?>" required>
                  <i>* digunakan pada saat masuk ke aplikasi.</i>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Lengkap</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_lengkap" autocomplete="off" value="<?php echo $data['nama_lengkap']; ?>" required readonly>
                  <i>* hubungi admin untuk mengubah nama lengkap.</i>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-5">
                  <input type="email" class="form-control" name="email" autocomplete="off" value="<?php echo $data['email']; ?>" required>
                </div>
              </div>
              <hr>
              <div class="ml-2">
                <b>Catatan:</b>
                <i>Jika berhasil diubah anda akan diarahkan ke halaman masuk aplikasi/login dan silahkan masuk menggunakan nama pengguna yang baru.</i>
              </div>

            </div><!-- /.box body -->
            <hr>
            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=profil" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->