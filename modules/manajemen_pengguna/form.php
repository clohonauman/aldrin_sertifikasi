
<section class="content-header">
    <h1>
      <i class="fa fa-user icon-title"></i> Manajemen Pengguna
    </h1>
  </section>
<!-- HTML !-->

<?php
if(isset($_GET['alert'])){
  $alert=$_GET['alert'];
  if($alert==1){
    echo '<script>alert("Gagal Disimpan Ada File Yang Masih Kosong.")</script>';
  }elseif($alert==2){
    echo '<script>alert("Gagal Disimpan Karena Ukuran File Lebih Dari 1MB.")</script>';
  }elseif($alert==3){
    echo '<script>alert("Berhasil Disimpan.")</script>';
  }elseif($alert==4){
    echo '<script>alert("Gagal Disimpan, Periksa Kembali Koneksi Anda.")</script>';
  }elseif($alert==5){
    echo '<script>alert("Gagal Disimpan, Terdeteksi File Tidak Sesuai.")</script>';
  }elseif($alert==6){
    echo '<script>alert("Gagal Karena Akun Telah Pernah Mengunggah Sebelumnya.")</script>';
  }elseif($alert==7){
    echo '<script>alert("Berhasil Ditambahkan.")</script>';
  }elseif($alert==8){
    echo '<script>alert("Gagal Ditambahkan, Periksa Koneksi Anda.")</script>';
  }
}
?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger" style="padding:10px;">
        <!-- form start -->
        <style>
            .center-text {
              text-align: center;
              vertical-align: middle;
              align-items: center;
              justify-content: center;
            }
            .contents{
              overflow: auto;
              max-height:450px;
            }
        </style>
          <?php
          if(isset($_GET['add'])){
            $id_akun=generateRandomString(10);
            ?>
              <h3><i class="fa fa-user-plus"></i> Tambah Pengguna</h3>
              <form role="form" class="form-horizontal" method="POST" action="modules/manajemen_pengguna/proses.php?add&id=<?=$_SESSION['id_akun']?>"  enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">ID Akun</label>
                  <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_akun" autocomplete="off" value="<?=$id_akun?>" required readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Pengguna</label>
                  <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_pengguna" autocomplete="off" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tipe Pengguna</label>
                  <div class="col-sm-5">
                    <select class="form-control" data-placeholder="Pilih Tipe Pengguna" autocomplete="off" name="kode_akses" id="tipe_pengguna" required>
                      <option value=""></option>
                      <option value="1">Verifikator 1</option>
                      <option value="2">Verifikator 2</option>
                      <option value="3">Operator Sekolah</option>
                      <option value="4">Bagian Keuangan</option>
                    </select>
                  </div>
                </div>

                <div class="form-group" id="cabang_dinas_group" style="display: none;">
                  <label class="col-sm-2 control-label">Cabang Dinas</label>
                  <div class="col-sm-5">
                    <select  class="form-control" autocomplete="off" name="cabdin" id="cabang_dinas">
                      <option value=""></option>
                      <option value="Kab. Minahasa Utara-Kota Bitung">Kab. Minahasa Utara - Kota Bitung</option>
                      <option value="Kota Tomohon-Kab. Minahasa">Kota Tomohon - Kab. Minahasa</option>
                      <option value="Kab. Minahasa Selatan-Kab. Minahasa Tenggara">Kab. Minahasa Selatan - Kab. Minahasa Tenggara</option>
                      <option value="Kab. Kepulauan Talaud">Kab. Kepulauan Talaud</option>
                      <option value="Kab. Kep. Sangihe">Kab. Kep. Sangihe</option>
                      <option value="Kab. Kepulauan Siau Tagulandang Biaro">Kab. Kepulauan Siau Tagulandang Biaro</option>
                      <option value="Kab. Bolaang Mongondow">Kab. Bolaang Mongondow</option>
                      <option value="Kab. Bolaang Mongondow Timur-Kota Kotamobagu">Kab. Bolaang Mongondow Timur - Kota Kotamobagu</option>
                      <option value="Kab. Bolaang Mongondow Selatan">Kab. Bolaang Mongondow Selatan</option>
                      <option value="Kab. Bolaang Mongondow Utara">Kab. Bolaang Mongondow Utara</option>
                      <option value="Kota Manado">Kota Manado</option>
                    </select>
                  </div>
                </div>

                <div class="form-group" id="sekolah_group" style="display: none;">
                  <label class="col-sm-2 control-label">Sekolah</label>
                  <div class="col-sm-5">
                    <select  class="form-control" name="sekolah" id="sekolah">
                      <option value="" disabled selected>-Pilih Sekolah-</option>
                      <?php
                      $query_sekolah=mysqli_query($mysqli2,"SELECT sekolah_id, nama FROM sekolah WHERE bentuk_pendidikan IN ('TK','PAUD','SD', 'SMP') AND kabupaten='Kab. Minahasa Utara' ORDER BY nama");
                      while($data_sekolah=mysqli_fetch_assoc($query_sekolah)){
                        ?>
                        <option value="<?=$data_sekolah['sekolah_id']?>"><?=$data_sekolah['nama']?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Lengkap</label>
                  <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_lengkap" autocomplete="off" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kata Sandi</label>
                  <div class="col-sm-5">
                  <input value="123456" type="text" class="form-control" name="kata_sandi" autocomplete="off" required readonly>
                  </div>
                </div>
                

              </div><!-- /.box-body -->
              
              <div class="box-footer bg-btn-action">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-danger btn-submit" name="tambah" value="Tambah">
                    <a href="?module=manajemen_pengguna" class="btn btn-default btn-reset">Batal</a>
                  </div>
                </div>
              </div>
            </form>
            <?php
          }  ?>
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Add event listener to the select input
    $('#tipe_pengguna').on('change', function() {
      // Hide both elements initially and remove required attribute from their inputs
      $("#cabang_dinas_group").hide().find('input').prop('required', false).val('');
      $("#sekolah_group").hide().find('input').prop('required', false).val('');
      
      // Show the relevant element based on the selected value and add required attribute to its inputs
      if ($(this).val() === "1") {
        $("#cabang_dinas_group").show().find('input').prop('required', true);
      } else if ($(this).val() === "3") {
        $("#sekolah_group").show().find('input').prop('required', true);
      } else {
        $("#cabang_dinas_group").hide().find('input').prop('required', false).val('');
        $("#sekolah_group").hide().find('input').prop('required', false).val('');
      }
    });
    
    // Trigger the change event on page load to set the initial state
    $('#tipe_pengguna').trigger('change');
  });
</script>

