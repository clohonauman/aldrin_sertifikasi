
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
                      <?php
                      if($_SESSION['kode_akses']==0){
                        ?>
                        <option value="7">Admin</option>
                        <?php
                      }
                      ?>
                      <option value="1">Verifikator 1</option>
                      <option value="2">Verifikator 2</option>
                      <option value="3">Operator Sekolah</option>
                    </select>
                  </div>
                </div>

                <div class="form-group" id="cabang_dinas_group" style="display: none;">
                  <label class="col-sm-2 control-label">Bentuk Pendidikan</label>
                  <div class="col-sm-5">
                    <select  class="form-control" autocomplete="off" name="cabdin" id="cabang_dinas">
                      <option value=""></option>
                      <option value="Kab. Minahasa Utara-SPK SKB">SPK SKB</option>
                      <option value="Kab. Minahasa Utara-SKB">SKB</option>
                      <option value="Kab. Minahasa Utara-SPK PKBM">SPK PKBM</option>
                      <option value="Kab. Minahasa Utara-PKBM">PKBM</option>
                      <option value="Kab. Minahasa Utara-SPK KB">SPK KB</option>
                      <option value="Kab. Minahasa Utara-KB">KB</option>
                      <option value="Kab. Minahasa Utara-SPK TK">SPK TK</option>
                      <option value="Kab. Minahasa Utara-TK">TK</option>
                      <option value="Kab. Minahasa Utara-SPK SD">SPK SD</option>
                      <option value="Kab. Minahasa Utara-SD">SD</option>
                      <option value="Kab. Minahasa Utara-SPK SMP">SPK SMP</option>
                      <option value="Kab. Minahasa Utara-SMP">SMP</option>
                    </select>
                  </div>
                </div>

                <div class="form-group" id="sekolah_group" style="display: none;">
                  <label class="col-sm-2 control-label">Sekolah</label>
                  <div class="col-sm-5">
                    <select  class="form-control" name="sekolah" id="sekolah">
                      <option value="" disabled selected>-Pilih Sekolah-</option>
                      <?php
                      $query_sekolah=mysqli_query($mysqli2,"SELECT npsn, nama FROM sekolah WHERE bentuk_pendidikan IN ('PKBM', 'SPK PKBM', 'SKB', 'SPK SKB', 'KB', 'SPK KB', 'TK', 'SPK TK', 'PAUD', 'SD', 'SPK SD', 'SMP', 'SPK SMP') ORDER BY nama");
                      while($data_sekolah=mysqli_fetch_assoc($query_sekolah)){
                        ?>
                        <option value="<?=$data_sekolah['npsn']?>"><?=$data_sekolah['nama']?></option>
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

