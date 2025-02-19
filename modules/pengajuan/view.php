
<section class="content-header">
    <h1>
      <i class="fa fa-book icon-title"></i> PENGUSULAN SERTIFIKASI
    </h1>
  </section>
  <script>
    function validateFile() {
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.pdf)$/i;
        
        // Periksa apakah file yang dipilih memiliki ekstensi yang diizinkan
        if (!allowedExtensions.exec(filePath)) {
            alert('Hanya file PDF yang diizinkan!');
            fileInput.value = ''; // Mengosongkan nilai inputan jika ekstensi tidak diizinkan
            return false;
        } else {
            return true;
        }
    }
  </script>
<!-- HTML !-->
<?php
if(isset($_GET['alert'])){
  $alert=$_GET['alert'];
  if($alert==1){
    echo '<script>alert("Berkas berhasil di Unggah.")</script>';
  }elseif($alert==2){
    echo '<script>alert("Berkas gagal di Unggah. Periksa koneksi anda.")</script>';
  }elseif($alert==3){
    echo '<script>alert("Berkas berhasil di perbarui.")</script>';
  }elseif($alert==4){
    echo '<script>alert("Berkas gagal di perbarui. Periksa Kembali Koneksi Anda.")</script>';
  }elseif($alert==5){
    echo '<script>alert("Berkas gagal di Unggah karena ukuran > 1 MB.")</script>';
  }elseif($alert==6){
    echo '<script>alert("Berkas gagal di Unggah karena format tidak sesuai.")</script>';
  }elseif($alert==7){
    echo '<script>alert("Berkas berhasil diproses lebih lanjut.")</script>';
  }elseif($alert==8){
    echo '<script>alert("Berkas gagal diproses lebih lanjut. Periksa koneksi anda.")</script>';
  }elseif($alert==9){
    echo '<script>alert("Berkas berhasil diperbaiki.")</script>';
  }elseif($alert==10){
    echo '<script>alert("Berkas berhasil dihapus. Tekan CTRL + SHIFT + R atau Hapus Cache Browser anda sebelum mengunggah kembali")</script>';
  }elseif($alert==11){
    echo '<script>alert("Berkas gagal dihapus.")</script>';
  }elseif($alert==12){
    echo '<script>alert("Hanya menerima link Google Drive.")</script>';
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
              .blur-background {
                  position: fixed;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  background-color: #00000010; /* Warna latar belakang dan tingkat transparansi */
                  backdrop-filter: blur(2px); /* Efek blur, ubah nilai sesuai preferensi Anda */
                  z-index: 9998; /* Lebih tinggi dari konten modal */
                  display: grid; /* Sembunyikan awalnya */
              }

              .modal-form {
                  position: fixed;
                  top: 50%;
                  left: 50%;
                  transform: translate(-50%, -50%);
                  z-index: 9999; /* Lebih tinggi dari latar belakang */
                  background-color: #fff;
                  padding: 20px;
                  width:80%;
                  border-radius: 10px;
                  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
              }
          </style>
            <?php
            if(!isset($_GET['edit'])){
              ?>
              <div class="box-body">
                <?php 
                if(!isset($_GET['id'])){ 
                  ?>
                  <form id="form1" role="form" class="form-horizontal" method="GET" action=""  enctype="multipart/form-data">
                    <input type="hidden" name="module" value="pengajuan">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Guru</label>
                      <div class="col-sm-5">
                        <select id="guruSelect" name="id" class="form-control" data-placeholder="Pilih Guru" autocomplete="off" required>
                            <option value=""></option>
                            <?php
                            $query = mysqli_query($mysqli2, "SELECT nama, nuptk, status_kepegawaian FROM ptk WHERE 
                                                                                                              sekolah_id = '$_SESSION[id_sekolah]'
                                                                                                              AND nuptk IS NOT NULL 
                                                                                                              AND nuptk != '' 
                                                                                                              AND LOWER(nuptk) != ' null'
                                                                                                              AND nuptk NOT LIKE '%null%'
                                                                                                            ORDER BY nama ASC");

                            while($data=mysqli_fetch_assoc($query)){
                            ?>
                              <option value="<?= mysqli_real_escape_string($mysqli,$data['nuptk']) ?>"><?php echo $data['nuptk']?> | <?php echo $data['nama']?> | <?php echo $data['status_kepegawaian']?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <p class="text-red">* Jika guru tidak ditemukan, silahkan perbarui data guru pada aplikasi ALDRIN TERPADU.</p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Periode</label>
                      <div class="col-sm-5">
                        <select id="periode" name="periode" class="form-control" data-placeholder="Pilih Periode" autocomplete="off" required>
                            <option value=""></option>
                            <?php
                            $query2=mysqli_query($mysqli, "SELECT periode FROM periode_sipgtk WHERE status='1' ORDER BY periode ASC");
                            while($data2=mysqli_fetch_assoc($query2)){
                            ?>
                              <option value="<?=$data2['periode']?>">Periode <?php echo $data2['periode']?></option>
                            <?php
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="box-footer bg-btn-action">
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <input id="submitButton" type="submit" class="load btn btn-primary btn-submit" name="simpan" value="Lanjutkan">
                          <a href="?module=pengajuan" class="btn btn-default btn-reset">Batal</a>
                        </div>
                      </div>
                    </div>

                  </form>
                  <?php 
                }elseif(isset($_GET['id'])){ 
                  $nuptk=mysqli_real_escape_string($mysqli,$_GET['id']);
                  $nuptk = preg_replace("/[^0-9]/", "", $nuptk);
                  $periode=$_GET['periode'];
                  $periode = preg_replace("/[^0-9]/", "", $periode);
                  if (ctype_digit($nuptk) AND ctype_digit($periode)) {
                    $queryguru=mysqli_query($mysqli2,"SELECT * FROM ptk WHERE nuptk LIKE '%$nuptk' AND sekolah_id='$_SESSION[id_sekolah]'");
                    if(mysqli_num_rows($queryguru)>0){
                      $dataguru=mysqli_fetch_assoc($queryguru);
                      $riwayat_kepangkatan_pangkat_golongan=$dataguru['riwayat_kepangkatan_pangkat_golongan'];
                      $riwayat_sertifikasi_jenis_sertifikasi=$dataguru['riwayat_sertifikasi_jenis_sertifikasi'];
                      $riwayat_fungsional_tmt_jabatan=$dataguru['riwayat_fungsional_tmt_jabatan'];
                      $tmt_pengangkatan=$dataguru['tmt_pengangkatan'];
                      $status_kepegawaian=$dataguru['status_kepegawaian'];
                      $email=$dataguru['email'];
                      $kabupaten=$dataguru['kabupaten'];
                      $riwayat_gaji_berkala_gaji_pokok=$dataguru['riwayat_gaji_berkala_gaji_pokok'];
                      $riwayat_gaji_berkala_gaji_pokok=format_rupiah($riwayat_gaji_berkala_gaji_pokok);
                      $querycek=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                      $rowscek=mysqli_num_rows($querycek);
                      $querygetstatus=mysqli_query($mysqli,"SELECT status,keterangan FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                      if($rowscek<=0){//jika belum pernah disimpan
                        $query_check_status=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE periode='$periode' AND usul_baru='1'");
                        if(mysqli_num_rows($query_check_status)>0){
                        ?>
                        <form role="form" class="form-horizontal" method="POST" action="modules/pengajuan/proses.php?id=<?=$nuptk?>&periode=<?=$periode?>"  enctype="multipart/form-data">
                          <div class="form" >
                            <table class="table">
                              <tbody>
                                  <tr>
                                      <td width='350'><strong>Nama Lengkap:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['nama']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>NUPTK:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['nuptk']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>Kabupaten:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['kabupaten']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>Email:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['email']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>Status Kepegawaian:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['status_kepegawaian']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>TMT Pengangkatan:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['tmt_pengangkatan']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>Riwayat Fungsional TMT Jabatan:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['riwayat_fungsional_tmt_jabatan']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>Jenis Sertifikasi:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['riwayat_sertifikasi_jenis_sertifikasi']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>Riwayat Kepangkatan Golongan:</strong></td>
                                      <td width='10'>:</td>
                                      <td><?=$dataguru['riwayat_kepangkatan_pangkat_golongan']?></td>
                                  </tr>
                                  <tr>
                                      <td width='350'><strong>Riwayat Gaji Pokok :</strong></td>
                                      <td width='10'>:</td>
                                      <td>Rp.<?=$riwayat_gaji_berkala_gaji_pokok?>,-</td>
                                  </tr>
                              </tbody>
                            </table>
                            <!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
                            <hr>
                            <div class="container_tabel">
                              <div class="table-responsive">
                                <table id="dataTables1" class="table table-bordered table-striped table-hover">
                                  <thead>
                                    <tr>
                                      <th width="50" class="center-text">NO.</th>
                                      <th width="200" class="center-text">BERKAS</th>
                                      <th width="10" class="center-text"></th>
                                      <th width="300" class="center-text">STATUS</th>
                                      <th width="150" class="center-text">AKSI</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $query_check_file=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE periode='$periode'");
                                      if(mysqli_num_rows($query_check_file)>0){
                                        $no=0;
                                        $data_periode=mysqli_fetch_assoc($query_check_file);
                                        ?>

                                        <?php
                                        if($data_periode['jurnal']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_jurnal=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='jurnal'");
                                            $data_jurnal=mysqli_fetch_assoc($query_jurnal);
                                            if(!empty($data_jurnal['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>LINK JURNAL<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=JURNAL'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=jurnal&unggah'>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['pks']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_pks=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='pks'");
                                            $data_pks=mysqli_fetch_assoc($query_pks);
                                            if(!empty($data_pks['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                              $btnUnggah="";
                                              $btnhps="<a title='Hapus' id='hapusCache1' class='load btn btn-danger btn-sm' href='modules/pengajuan/proses.php?id=$nuptk&jenis=pks&periode=$periode&hapus'>
                                              <i style='color:#fff' class='fa fa-trash'></i>
                                              </a>";
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $btnhps="";
                                              $btnUnggah="<a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=$nuptk&jenis=pks&periode=$periode&unggah'>
                                                              <i style='color:#fff' class='fa fa-upload'></i>
                                                          </a>";
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <?=$btnUnggah?>
                                              <?=$btnhps?>
                                              <script>
                                                document.getElementById("hapusCache1").addEventListener("click", function() {
                                                  location.reload(true);
                                                });
                                              </script>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['info_gtk']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_info_gtk=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='info_gtk'");
                                            $data_info_gtk=mysqli_fetch_assoc($query_info_gtk);
                                            if(!empty($data_info_gtk['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                              $btnUnggah="";
                                              $btnhps="<a title='Hapus' id='hapusCache2' class='load btn btn-danger btn-sm' href='modules/pengajuan/proses.php?id=$nuptk&jenis=info_gtk&periode=$periode&hapus'>
                                              <i style='color:#fff' class='fa fa-trash'></i>
                                              </a>";
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $btnhps="";
                                              $btnUnggah="<a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=$nuptk&jenis=info_gtk&periode=$periode&unggah'>
                                                              <i style='color:#fff' class='fa fa-upload'></i>
                                                          </a>";
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>INFO GTK<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=INFO GTK'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <?=$btnUnggah?>
                                              <?=$btnhps?>
                                              <script>
                                                document.getElementById("hapusCache2").addEventListener("click", function() {
                                                  location.reload(true);
                                                });
                                              </script>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['sk_pembagian']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_sk_pembagian=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='sk_pembagian'");
                                            $data_sk_pembagian=mysqli_fetch_assoc($query_sk_pembagian);
                                            if(!empty($data_sk_pembagian['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                              $btnUnggah="";
                                              $btnhps="<a title='Hapus' id='hapusCache3' class='load btn btn-danger btn-sm' href='modules/pengajuan/proses.php?id=$nuptk&jenis=sk_pembagian&periode=$periode&hapus'>
                                              <i style='color:#fff' class='fa fa-trash'></i>
                                              </a>";
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $btnhps="";
                                              $btnUnggah="<a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=$nuptk&jenis=sk_pembagian&periode=$periode&unggah'>
                                                              <i style='color:#fff' class='fa fa-upload'></i>
                                                          </a>";
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SK PEMBAGIAN TUGAS<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SK PEMBAGIAN TUGAS'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <?=$btnUnggah?>
                                              <?=$btnhps?>
                                              <script>
                                                document.getElementById("hapusCache3").addEventListener("click", function() {
                                                  location.reload(true);
                                                });
                                              </script>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['skpa']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_skpa=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='skpa'");
                                            $data_skpa=mysqli_fetch_assoc($query_skpa);
                                            if(!empty($data_skpa['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $btnUnggah="";
                                              $btnhps="<a title='Hapus' id='hapusCache4' class='load btn btn-danger btn-sm' href='modules/pengajuan/proses.php?id=$nuptk&jenis=skpa&periode=$periode&hapus'>
                                              <i style='color:#fff' class='fa fa-trash'></i>
                                              </a>";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $btnhps="";
                                              $btnUnggah="<a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=$nuptk&jenis=skpa&periode=$periode&unggah'>
                                                              <i style='color:#fff' class='fa fa-upload'></i>
                                                          </a>";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SURAT PERNYATAAN PRIBADI DIATAS METERAI<span style="color:#f00;font-size:20px;"></span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT PERNYATAAN PRIBADI DIATAS METERAI'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <?=$btnUnggah?>
                                              <?=$btnhps?>
                                              <script>
                                                document.getElementById("hapusCache4").addEventListener("click", function() {
                                                  location.reload(true);
                                                });
                                              </script>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>
                                        <?php
                                        if($data_periode['skba']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_skba=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='skba'");
                                            $data_skba=mysqli_fetch_assoc($query_skba);
                                            if(!empty($data_skba['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $btnUnggah="";
                                              $btnhps="<a title='Hapus' id='hapusCache5' class='load btn btn-danger btn-sm' href='modules/pengajuan/proses.php?id=$nuptk&jenis=skba&periode=$periode&hapus'>
                                              <i style='color:#fff' class='fa fa-trash'></i>
                                              </a>";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $btnhps="";
                                              $btnUnggah="<a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=$nuptk&jenis=skba&periode=$periode&unggah'>
                                                              <i style='color:#fff' class='fa fa-upload'></i>
                                                          </a>";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SASARAN KINERJA PEGAWAI<span style="color:#f00;font-size:20px;"></span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SASARAN KINERJA PEGAWAI'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <?=$btnUnggah?>
                                              <?=$btnhps?>
                                              <script>
                                                document.getElementById("hapusCache5").addEventListener("click", function() {
                                                  location.reload(true);
                                                });
                                              </script>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['pg']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_pg=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='pg'");
                                            $data_pg=mysqli_fetch_assoc($query_pg);
                                            if(!empty($data_pg['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                              $btnUnggah="";
                                              $btnhps="<a title='Hapus' id='hapusCache6' class='load btn btn-danger btn-sm' href='modules/pengajuan/proses.php?id=$nuptk&jenis=pg&periode=$periode&hapus'>
                                              <i style='color:#fff' class='fa fa-trash'></i>
                                              </a>";
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $btnhps="";
                                              $btnUnggah="<a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=$nuptk&jenis=pg&periode=$periode&unggah'>
                                                              <i style='color:#fff' class='fa fa-upload'></i>
                                                          </a>";
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SURAT PENGANTAR DARI KEPSEK<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT PENGANTAR DARI KEPSEK'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <?=$btnUnggah?>
                                              <?=$btnhps?>
                                              <script>
                                                document.getElementById("hapusCache6").addEventListener("click", function() {
                                                  location.reload(true);
                                                });
                                              </script>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['absen']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_absen=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='absen'");
                                            $data_absen=mysqli_fetch_assoc($query_absen);
                                            if(!empty($data_absen['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                              $btnUnggah="";
                                              $btnhps="<a title='Hapus' id='hapusCache7' class='load btn btn-danger btn-sm' href='modules/pengajuan/proses.php?id=$nuptk&jenis=absen&periode=$periode&hapus'>
                                              <i style='color:#fff' class='fa fa-trash'></i>
                                              </a>";
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $btnhps="";
                                              $btnUnggah="<a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=$nuptk&jenis=absen&periode=$periode&unggah'>
                                                              <i style='color:#fff' class='fa fa-upload'></i>
                                                          </a>";
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>ABSEN<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=ABSEN'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <?=$btnUnggah?>
                                              <?=$btnhps?>
                                              <script>
                                                document.getElementById("hapusCache7").addEventListener("click", function() {
                                                  location.reload(true);
                                                });
                                              </script>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['lainnya']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_lainnya=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='lainnya'");
                                            $data_lainnya=mysqli_fetch_assoc($query_lainnya);
                                            if(!empty($data_lainnya['nama_berkas'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="SILAHKAN MENGUNGGAH JIKA ADA BERKAS TAMBAHAN";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>BERKAS LAINNYA</td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=LAINNYA'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=lainnya&unggah'>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                      }
                                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="box-footer bg-btn-action text-left">
                              <div class="form-group">
                                <span><b>Catatan: </b>
                                <br>-Anda masih dapat mengubah data selama belum klik KIRIM
                                <br>-Untuk berkas dengan simbol ( <span class="text-red">*</span> ) <b>WAJIB UNGGAH</b>.</span><hr>
                                <div class="col-sm-12">
                                  <input type="submit" class="load btn btn-primary btn-submit" name="simpan" value="KIRIM" <?php if(isset($belumkomplit)){ echo 'disabled'; } ?>>
                                  <a href="?module=pengajuan" class="btn btn-default btn-reset">KEMBALI</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <?php 
                        }else{
                          ?>
                          <div class="card rounded p-2 bg-secondary">
                            <p class="text-light"><b>Maaf, saat ini pengusulan untuk Periode <?=$periode?> masih ditutup atau sudah ditutup. Terimakasih.</b></p>
                          </div>
                          <?php
                        }
                      }else{//jika sudah pernah disimpan
                        $status_pengajuan=mysqli_fetch_assoc($querygetstatus);
                        $status=$status_pengajuan['status'];
                        $status_pengajuan=$status_pengajuan['keterangan']." ".convertStatus($status_pengajuan['status']);
                        if($status!='S3' OR $status!='S4' OR $status!='S5' OR $status!='S6'){
                          ?>
                          <form id="form3" role="form" class="form-horizontal" method="POST" action="modules/pengajuan/proses.php?id=<?=$nuptk?>"  enctype="multipart/form-data">
                            <div class="form" >
                              <table class="table">
                                <tbody>
                                    <tr>
                                        <td width='350'><strong>Nama Lengkap:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['nama']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>NUPTK:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['nuptk']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>Kabupaten:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['kabupaten']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>Email:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['email']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>Status Kepegawaian:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['status_kepegawaian']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>TMT Pengangkatan:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['tmt_pengangkatan']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>Riwayat Fungsional TMT Jabatan:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['riwayat_fungsional_tmt_jabatan']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>Jenis Sertifikasi:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['riwayat_sertifikasi_jenis_sertifikasi']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>Riwayat Kepangkatan Golongan:</strong></td>
                                        <td width='10'>:</td>
                                        <td><?=$dataguru['riwayat_kepangkatan_pangkat_golongan']?></td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong>Riwayat Gaji Pokok :</strong></td>
                                        <td width='10'>:</td>
                                        <td>Rp.<?=$riwayat_gaji_berkala_gaji_pokok?>,-</td>
                                    </tr>
                                    <tr>
                                        <td width='350'><strong style="font-size:20px;">Status Pengajuan Berkas</strong></td>
                                        <td width='10'>:</td>
                                        <td style="font-size:20px;"><?=$status_pengajuan?></td>
                                    </tr>
                                </tbody>
                              </table>
                              <!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
                              <hr>
                              <div class="container_tabel">
                                <div class="table-responsive">
                                  <table id="dataTables1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                      <tr>
                                        <th width="50" class="center-text">NO.</th>
                                        <th width="200" class="center-text">BERKAS</th>
                                        <th width="10" class="center-text"></th>
                                        <th width="300" class="center-text">STATUS</th>
                                        <th width="150" class="center-text">AKSI</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $query_check_file=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE periode='$periode'");
                                      if(mysqli_num_rows($query_check_file)>0){
                                        $no=0;
                                        $data_periode=mysqli_fetch_assoc($query_check_file);
                                        ?>

                                        <?php
                                        if($data_periode['jurnal']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php
                                            $querygetfile=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                                            $datafile=mysqli_fetch_assoc($querygetfile);
      
                                            if(!empty($datafile['jurnal'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                                <td class="center-text" ><?=$no?></td>
                                            <td>LINK JURNAL<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=JURNAL'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['pks']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['pengantar_kepsek'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                                <td class="center-text" ><?=$no?></td>
                                            <td>SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['info_gtk']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['info_gtk'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                              <td class="center-text" ><?=$no?></td>
                                            <td>INFO GTK<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=INFO GTK'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['sk_pembagian']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_pembagian'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                              <td class="center-text" ><?=$no?></td>
                                            <td>SK PEMBAGIAN TUGAS<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SK PEMBAGIAN TUGAS'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['skpa']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_pangkat_akhir'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                              <td class="center-text" ><?=$no?></td>
                                            <td>SURAT PERNYATAAN PRIBADI DIATAS METERAI<span style="color:#f00;font-size:20px;"></span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT PERNYATAAN PRIBADI DIATAS METERAI'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>
                                        <?php
                                        if($data_periode['skba']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_berkala_akhir'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >6</td>
                                            <td>SASARAN KINERJA PEGAWAI<span style="color:#f00;font-size:20px;"></span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SASARAN KINERJA PEGAWAI'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['pg']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_pg=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='pg'");
                                            $data_pg=mysqli_fetch_assoc($query_pg);
                                            if(!empty($datafile['profil_guru'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >7</td>
                                            <td>SURAT PENGANTAR DARI KEPSEK<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT PENGANTAR DARI KEPSEK'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['absen']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_absen=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='absen'");
                                            $data_absen=mysqli_fetch_assoc($query_absen);
                                            if(!empty($datafile['absen'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >7</td>
                                            <td>ABSEN<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=ABSEN'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                        if($data_periode['lainnya']){
                                          $no++;
                                          ?>
                                          <tr>
                                            <?php 
                                            $query_lainnya=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='lainnya'");
                                            $data_lainnya=mysqli_fetch_assoc($query_lainnya);
                                            if(!empty($datafile['lainnya'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="SILAHKAN MENGUNGGAH JIKA ADA BERKAS TAMBAHAN";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >8</td>
                                            <td>BERKAS LAINNYA</td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=LAINNYA'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                        ?>

                                        <?php
                                      }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="box-footer bg-btn-action text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <a href="?module=pengajuan" class="btn btn-default btn-reset">KEMBALI</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                          <?php
                        }else{
                          if($status_pengajuan['keterangan']!='Menunggu Konfirmasi' && $status_pengajuan['keterangan']!=''){
                            ?>
                            <form id="form4" role="form" class="form-horizontal" method="POST" action="modules/pengajuan/proses.php?id=<?=$nuptk?>"  enctype="multipart/form-data">
                              <div class="form" >
                                <table class="table">
                                  <tbody>
                                      <tr>
                                          <td width='350'><strong>Nama Lengkap:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['nama']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>NUPTK:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['nuptk']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Kabupaten:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['kabupaten']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Email:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['email']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Status Kepegawaian:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['status_kepegawaian']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>TMT Pengangkatan:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['tmt_pengangkatan']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Riwayat Fungsional TMT Jabatan:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['riwayat_fungsional_tmt_jabatan']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Jenis Sertifikasi:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['riwayat_sertifikasi_jenis_sertifikasi']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Riwayat Kepangkatan Golongan:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['riwayat_kepangkatan_pangkat_golongan']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Riwayat Gaji Pokok :</strong></td>
                                          <td width='10'>:</td>
                                          <td>Rp.<?=$riwayat_gaji_berkala_gaji_pokok?>,-</td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong style="font-size:20px;">Status Pengajuan Berkas</strong></td>
                                          <td width='10'>:</td>
                                          <td style="font-size:20px;"><?=$status_pengajuan?></td>
                                      </tr>
                                  </tbody>
                                </table>
                                <!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
                                <hr>
                                <div class="container_tabel">
                                  <div class="table-responsive">
                                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th width="50" class="center-text">NO.</th>
                                          <th width="200" class="center-text">BERKAS</th>
                                          <th width="10" class="center-text"></th>
                                          <th width="300" class="center-text">STATUS</th>
                                          <th width="150" class="center-text">AKSI</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                            <?php
                                            $querygetfile=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                                            $datafile=mysqli_fetch_assoc($querygetfile);
  
                                            if(!empty($datafile['jurnal'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>LINK JURNAL<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=JURNAL'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['pengantar_kepsek'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['info_gtk'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>INFO GTK<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=INFO GTK'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_pembagian'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SK PEMBAGIAN TUGAS<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SK PEMBAGIAN TUGAS'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_pangkat_akhir'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SURAT PERNYATAAN PRIBADI DIATAS METERAI<span style="color:#f00;font-size:20px;"></span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT PERNYATAAN PRIBADI DIATAS METERAI'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_berkala_akhir'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >6</td>
                                            <td>SASARAN KINERJA PEGAWAI<span style="color:#f00;font-size:20px;"></span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SASARAN KINERJA PEGAWAI'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            $query_pg=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='pg'");
                                            $data_pg=mysqli_fetch_assoc($query_pg);
                                            if(!empty($datafile['profil_guru'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >7</td>
                                            <td>SURAT PENGANTAR DARI KEPSEK<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT PENGANTAR DARI KEPSEK'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            $query_absen=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='absen'");
                                            $data_absen=mysqli_fetch_assoc($query_absen);
                                            if(!empty($datafile['absen'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >7</td>
                                            <td>ABSEN<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=ABSEN'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            $query_lainnya=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='lainnya'");
                                            $data_lainnya=mysqli_fetch_assoc($query_lainnya);
                                            if(!empty($datafile['lainnya'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="SILAHKAN MENGUNGGAH JIKA ADA BERKAS TAMBAHAN";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >8</td>
                                            <td>BERKAS LAINNYA</td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=LAINNYA'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                            </td>
                                          </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="box-footer bg-btn-action text-right">
                                  <div class="form-group">
                                    <div class="col-sm-12">
                                      <a href="?module=pengajuan" class="btn btn-default btn-reset">KEMBALI</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                            <?php
                          }else{
                            ?>
                            <form id="form5" role="form" class="form-horizontal" method="POST" action="modules/pengajuan/proses.php?id=<?=$nuptk?>"  enctype="multipart/form-data">
                              <div class="form" >
                                <table class="table">
                                  <tbody>
                                      <tr>
                                          <td width='350'><strong>Nama Lengkap:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['nama']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>NUPTK:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['nuptk']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Kabupaten:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['kabupaten']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Email:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['email']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Status Kepegawaian:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['status_kepegawaian']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>TMT Pengangkatan:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['tmt_pengangkatan']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Riwayat Fungsional TMT Jabatan:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['riwayat_fungsional_tmt_jabatan']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Jenis Sertifikasi:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['riwayat_sertifikasi_jenis_sertifikasi']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Riwayat Kepangkatan Golongan:</strong></td>
                                          <td width='10'>:</td>
                                          <td><?=$dataguru['riwayat_kepangkatan_pangkat_golongan']?></td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong>Riwayat Gaji Pokok :</strong></td>
                                          <td width='10'>:</td>
                                          <td>Rp.<?=$riwayat_gaji_berkala_gaji_pokok?>,-</td>
                                      </tr>
                                      <tr>
                                          <td width='350'><strong style="font-size:20px;">Status Pengajuan Berkas</strong></td>
                                          <td width='10'>:</td>
                                          <td style="font-size:20px;"><?=$status_pengajuan?></td>
                                      </tr>
                                  </tbody>
                                </table>
                                <!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
                                <hr>
                                <div class="container_tabel">
                                  <div class="table-responsive">
                                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th width="50" class="center-text">NO.</th>
                                          <th width="200" class="center-text">BERKAS</th>
                                          <th width="10" class="center-text"></th>
                                          <th width="300" class="center-text">STATUS</th>
                                          <th width="150" class="center-text">AKSI</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                            <?php
                                            $querygetfile=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                                            $datafile=mysqli_fetch_assoc($querygetfile);
  
                                            if(!empty($datafile['jurnal'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>LINK JURNAL<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=JURNAL'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=jurnal&unggah'  <?php if($datafile['status']=='S1'){ echo 'disabled'; } ?>>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['pengantar_kepsek'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=pks&unggah'  <?php if($datafile['status']=='S1'){ echo 'disabled'; } ?>>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['info_gtk'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>INFO GTK<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=INFO GTK'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=info_gtk&unggah'  <?php if($datafile['status']=='S1'){ echo 'disabled'; } ?>>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_pembagian'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SK PEMBAGIAN TUGAS<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SK PEMBAGIAN TUGAS'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=sk_pembagian&unggah'  <?php if($datafile['status']=='S1'){ echo 'disabled'; } ?>>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_pangkat_akhir'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                              $belumkomplit=1;
                                            }
                                            ?>
                                            <td class="center-text" ><?=$no?></td>
                                            <td>SURAT PERNYATAAN PRIBADI DIATAS METERAI<span style="color:#f00;font-size:20px;"></span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT PERNYATAAN PRIBADI DIATAS METERAI'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=skpa&unggah'  <?php if($datafile['status']=='S1'){ echo 'disabled'; } ?>>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            if(!empty($datafile['sk_berkala_akhir'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >6</td>
                                            <td>SASARAN KINERJA PEGAWAI<span style="color:#f00;font-size:20px;"></span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SASARAN KINERJA PEGAWAI'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=skba&unggah'  <?php if($datafile['status']=='S1'){ echo 'disabled'; } ?>>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            $query_pg=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='pg'");
                                            $data_pg=mysqli_fetch_assoc($query_pg);
                                            if(!empty($datafile['profil_guru'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >7</td>
                                            <td>SURAT PENGANTAR DARI KEPSEK<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SURAT PENGANTAR DARI KEPSEK'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=pg&unggah'  <?php if($datafile['status']=='S1'){ echo 'disabled'; } ?>>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            $query_absen=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='absen'");
                                            $data_absen=mysqli_fetch_assoc($query_absen);
                                            if(!empty($datafile['absen'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >7</td>
                                            <td>ABSEN<span style="color:#f00;font-size:20px;">*</span></td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=ABSEN'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=absen&unggah'  <?php if($datafile['status']=='S1'){ echo 'disabled'; } ?>>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php 
                                            $query_lainnya=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$nuptk' AND periode='$periode' AND jenis='lainnya'");
                                            $data_lainnya=mysqli_fetch_assoc($query_lainnya);
                                            if(!empty($datafile['lainnya'])){
                                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                                              $icon='<i class="fa fa-check btn-success"></i>';
                                            }else{
                                              $nama_berkas="SILAHKAN MENGUNGGAH JIKA ADA BERKAS TAMBAHAN";
                                              $icon='<i class="fa fa-times" style="color:#f00;"></i>';
                                            }
                                            ?>
                                            <td class="center-text" >8</td>
                                            <td>BERKAS LAINNYA</td>
                                            <td class="center-text"><?=$icon?></td>
                                            <td class="center-text"><?=$nama_berkas?></td>
                                            <td class="center-text">
                                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=LAINNYA'>
                                                  <i style='color:#fff' class='fa fa-eye'></i>
                                              </a>
                                              <a data-toggle='tooltip' data-placement='top' title='Unggah/Ganti Berkas' class='load btn btn-success btn-sm' href='?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=lainnya&unggah'>
                                                  <i style='color:#fff' class='fa fa-upload'></i>
                                              </a>
                                            </td>
                                          </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="box-footer bg-btn-action text-right">
                                  <div class="form-group">
                                    <div class="col-sm-12">
                                      <a href="?module=pengajuan" class="btn btn-default btn-reset">KEMBALI</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                            <?php
                          }
                        }
                      }
                      
                      if(isset($_GET['jenis'])){
                        ?>
                        <div class="blur-background"></div>
                        <form id="form6" role="form" class="form-horizontal modal-form" method="POST" action="modules/pengajuan/proses.php?id=<?=$nuptk?>&jenis=<?=$_GET['jenis']?>&periode=<?=$periode?>" enctype="multipart/form-data">
                            <?php
                            if($_GET['jenis']!='jurnal' && $_GET['jenis']!='info_gtk' && $_GET['jenis']!='lainnya'){
                              ?>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Unggah File</label>
                                  <div class="col-sm-5">
                                      <input type="file" id='file' class="form-control" name="file" accept=".pdf" class="form-control" required>
                                      <i><b>Format Didukung: </b>(.pdf < 1 MB)</i>
                                  </div>
                              </div>
                              <?php
                            }elseif($_GET['jenis']=='jurnal'){
                              ?>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Link Jurnal<span style="color:#f00;font-size:20px;">*</span></label>
                                  <div class="col-sm-5">
                                      <input type="text" class="form-control" name="file" class="form-control" required><i><b>Format: </b>Google Drive (Mohon dalam mengupload jurnal link google drive nya di buka ijin aksesnya. Mohon dicoba buka dulu. V1 akan menolak jika memerlukan ijin akses).</i>
                                  </div>
                              </div>
                              <?php
                            }elseif($_GET['jenis']=='info_gtk'){
                              ?>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Unggah File</label>
                                  <div class="col-sm-5">
                                      <input type="file" id='file' class="form-control" name="file" accept=".pdf" class="form-control" required>
                                      <i><b>Format Didukung: </b>(.pdf < 1 MB)</i>
                                  </div>
                              </div>
                              <?php
                            }elseif($_GET['jenis']=='lainnya'){
                              ?>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Link Berkas Lainnya</label>
                                  <div class="col-sm-5">
                                      <input type="text" class="form-control" name="file" class="form-control" required><i><b>Format: </b>Google Drive (Harap pastikan link yang diupload dapat diakses secara publik karena jika tidak link akan langsung ditolak.).</i>
                                  </div>
                              </div>
                              <?php
                            }
                            ?>
                            <div class="box-footer bg-btn-action text-right">
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <input type="submit" class="load btn btn-primary btn-submit" name="unggah" value="Unggah">
                                  <a href="?module=pengajuan&id=<?=$nuptk?>&periode=<?=$periode?>" class="btn btn-default btn-reset">Batal</a>
                                </div>
                              </div>
                            </div>
                          </form>
                        <?php
                      }
                    }else{
                      include "404.php";
                    }
                  }else{
                    include "404.php";
                  }
                }
                ?>
              </div>
              <?php
            } else { 
              $nuptk=mysqli_real_escape_string($mysqli,$_GET['id']);
              $nuptk = preg_replace("/[^0-9]/", "", $nuptk);
              $periode=$_GET['periode'];
              $periode = preg_replace("/[^0-9]/", "", $periode);
              ?>
              <h3><i class="fa fa-edit"></i> Perbaiki Usulan SKTP</h3>
              <form id="form7" role="form" class="form-horizontal" method="POST" action="modules/pengajuan/proses.php?edit&s=<?=$_GET['s']?>&periode=<?=$periode?>"  enctype="multipart/form-data">
                <div class="box-body">
                  <?php
                  $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
                  $data=mysqli_fetch_assoc($query);
                  ?>
                  <input type="hidden" class="form-control" name="nuptk" autocomplete="off" required value="<?=$data['nuptk']?>">

                  <?php
                  if($data['status']=='S1'){
                    $query_check_file=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE periode='$periode' AND revisi_v1='1'");
                    if(mysqli_num_rows($query_check_file)>0){
                      $no=0;
                      $data_periode=mysqli_fetch_assoc($query_check_file);
                      ?>
  
                      <?php
                      if($data_periode['jurnal']){
                        $no++;
                        if(($data['komentar_jurnal']!='1234567890terima' AND $data['komentar_jurnal']!='Telah di Revisi' AND $data['komentar_jurnal']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Link Jurnal</label>
                            <div class="col-sm-5">
                            <input type="hidden" class="form-control" name="status" autocomplete="off" required value="<?=$_GET['s']?>">
                            <input type="link" class="form-control" name="jurnal" autocomplete="off" value="<?php if($data['status']!='S2'){ echo $data['jurnal']; } ?>" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>Google Drive</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_jurnal']?> <?php } ?>
                            </div>
                          </div>
                          <hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['pks']){
                        $no++;
                        if(($data['komentar_sk_kepsek']!='1234567890terima' AND $data['komentar_sk_kepsek']!='Telah di Revisi' AND $data['komentar_sk_kepsek']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="pengantar_kepala_sekolah" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_sk_kepsek']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['info_gtk']){
                        $no++;
                        if(($data['komentar_info_gtk']!='1234567890terima' AND $data['komentar_info_gtk']!='Telah di Revisi' AND $data['komentar_info_gtk']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Info GTK</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="info_gtk" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_info_gtk']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        } 
                      }
                      ?>
  
                      <?php
                      if($data_periode['sk_pembagian']){
                        $no++;
                        if(($data['komentar_sk_pembagian']!='1234567890terima' AND $data['komentar_sk_pembagian']!='Telah di Revisi' AND $data['komentar_sk_pembagian']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SK Pembagian Tugas</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="sk_pembagian" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_sk_pembagian']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['skpa']){
                        $no++;
                        if(($data['komentar_sk_pangkat_akhir']!='1234567890terima' AND $data['komentar_sk_pangkat_akhir']!='Telah di Revisi' AND $data['komentar_sk_pangkat_akhir']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SURAT PERNYATAAN PRIBADI DIATAS METERAI</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="sk_pangkat_akhir" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_sk_pangkat_akhir']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['skba']){
                        $no++;
                        if(($data['komentar_sk_berkala_akhir']!='1234567890terima' AND $data['komentar_sk_berkala_akhir']!='Telah di Revisi' AND $data['komentar_sk_berkala_akhir']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SASARAN KINERJA PEGAWAI</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="sk_berkala_akhir" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_sk_berkala_akhir']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['pg']){
                        $no++;
                        if(($data['komentar_profil_guru']!='1234567890terima' AND $data['komentar_profil_guru']!='Telah di Revisi' AND $data['komentar_profil_guru']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SURAT PENGANTAR DARI KEPSEK</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="profil_guru" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_profil_guru']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['absen']){
                        $no++;
                        if(($data['komentar_absen']!='1234567890terima' AND $data['komentar_absen']!='Telah di Revisi' AND $data['komentar_absen']!="") OR $data['komentar_umum']!=""){?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Absen</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="absen" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_absen']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['lainnya']){
                        $no++;
                        if(($data['komentar_lainnya']!='1234567890terima' AND $data['komentar_lainnya']!='Telah di Revisi' AND $data['komentar_lainnya']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Berkas Lainnya</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="lainnya" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>Google Drive</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_lainnya']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php if(($data['komentar_umum']!='1234567890terima' AND $data['komentar_umum']!='Telah di Revisi' AND $data['komentar_umum']!="" AND $data['status']=='S2') OR $data['komentar_umum']!=""){?>
                        <div class="form-group">
                          <div class="col-sm-12">
                          <h4><b>Komentar:</b></h4>
                          <p><?=$data['komentar_umum']?></p>
                          </div>
                        </div>
                      <?php } ?>
                      <?php
                    }else{
                      ?>
                      <div class="card rounded p-4 bg-secondary">
                        <p class="text-light">Maaf, proses perbaikan/revisi tahap 1 pada Periode <?=$periode?> saat ini sedang ditutup. Terimakasih.</p>
                      </div>
                      <?php
                    }
                  }elseif($data['status']=='S2'){
                    $query_check_file=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE periode='$periode' AND revisi_v2='1'");
                    if(mysqli_num_rows($query_check_file)>0){
                      $no=0;
                      $data_periode=mysqli_fetch_assoc($query_check_file);
                      ?>
  
                      <?php
                      if($data_periode['jurnal']){
                        $no++;
                        if(($data['komentar_jurnal']!='1234567890terima' AND $data['komentar_jurnal']!='Telah di Revisi' AND $data['komentar_jurnal']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Link Jurnal</label>
                            <div class="col-sm-5">
                            <input type="hidden" class="form-control" name="status" autocomplete="off" required value="<?=$_GET['s']?>">
                            <input type="link" class="form-control" name="jurnal" autocomplete="off" value="<?php if($data['status']!='S2'){ echo $data['jurnal']; } ?>" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>Google Drive</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_jurnal']?> <?php } ?>
                            </div>
                          </div>
                          <hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['pks']){
                        $no++;
                        if(($data['komentar_sk_kepsek']!='1234567890terima' AND $data['komentar_sk_kepsek']!='Telah di Revisi' AND $data['komentar_sk_kepsek']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SURAT MELAKSANAKAN TUGAS KEPSEK MENGETAHUI PENGAWAS</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="pengantar_kepala_sekolah" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_sk_kepsek']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['info_gtk']){
                        $no++;
                        if(($data['komentar_info_gtk']!='1234567890terima' AND $data['komentar_info_gtk']!='Telah di Revisi' AND $data['komentar_info_gtk']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Info GTK</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="info_gtk" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_info_gtk']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        } 
                      }
                      ?>
  
                      <?php
                      if($data_periode['sk_pembagian']){
                        $no++;
                        if(($data['komentar_sk_pembagian']!='1234567890terima' AND $data['komentar_sk_pembagian']!='Telah di Revisi' AND $data['komentar_sk_pembagian']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SK Pembagian Tugas</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="sk_pembagian" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_sk_pembagian']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['skpa']){
                        $no++;
                        if(($data['komentar_sk_pangkat_akhir']!='1234567890terima' AND $data['komentar_sk_pangkat_akhir']!='Telah di Revisi' AND $data['komentar_sk_pangkat_akhir']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SURAT PERNYATAAN PRIBADI DIATAS METERAI</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="sk_pangkat_akhir" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_sk_pangkat_akhir']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['skba']){
                        $no++;
                        if(($data['komentar_sk_berkala_akhir']!='1234567890terima' AND $data['komentar_sk_berkala_akhir']!='Telah di Revisi' AND $data['komentar_sk_berkala_akhir']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SASARAN KINERJA PEGAWAI</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="sk_berkala_akhir" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_sk_berkala_akhir']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['pg']){
                        $no++;
                        if(($data['komentar_profil_guru']!='1234567890terima' AND $data['komentar_profil_guru']!='Telah di Revisi' AND $data['komentar_profil_guru']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">SURAT PENGANTAR DARI KEPSEK</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="profil_guru" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_profil_guru']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['absen']){
                        $no++;
                        if(($data['komentar_absen']!='1234567890terima' AND $data['komentar_absen']!='Telah di Revisi' AND $data['komentar_absen']!="") OR $data['komentar_umum']!=""){?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Absen</label>
                            <div class="col-sm-5">
                            <input type="file" class="form-control" name="absen" accept=".pdf" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>(.pdf < 1 MB) - Tetap Kosongkan Jika Tidak Akan Mengubah.</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_absen']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php
                      if($data_periode['lainnya']){
                        $no++;
                        if(($data['komentar_lainnya']!='1234567890terima' AND $data['komentar_lainnya']!='Telah di Revisi' AND $data['komentar_lainnya']!="") OR $data['komentar_umum']!=""){
                          ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Berkas Lainnya</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="lainnya" autocomplete="off" <?php if($data['status']!='S2'){ echo 'required'; } ?>>
                            <i><b>Format Didukung: </b>Google Drive</i>
                            <?php if($data['status']!="S2"){ ?><br><hr><b>Catatan</b> : <?=$data['komentar_lainnya']?> <?php } ?>
                            </div>
                          </div><hr>
                          <?php 
                        }
                      }
                      ?>
  
                      <?php if(($data['komentar_umum']!='1234567890terima' AND $data['komentar_umum']!='Telah di Revisi' AND $data['komentar_umum']!="" AND $data['status']=='S2') OR $data['komentar_umum']!=""){?>
                        <div class="form-group">
                          <div class="col-sm-12">
                          <h4><b>Komentar:</b></h4>
                          <p><?=$data['komentar_umum']?></p>
                          </div>
                        </div>
                      <?php } ?>
                      <?php
                    }else{
                      ?>
                      <div class="card rounded p-4 bg-secondary">
                        <p class="text-light">Maaf, proses perbaikan/revisi tahap 2 pada Periode <?=$periode?> saat ini sedang ditutup. Terimakasih.</p>
                      </div>
                      <?php
                    }
                  }else{
                    ?>
                    <div class="card rounded p-4 bg-secondary">
                      <p class="text-light">Maaf, data tidak ditemukan pada bagian ini. Terimakasih.</p>
                    </div>
                    <?php
                  }
                  ?>
                </div><!-- /.box-body -->
                
                <div class="box-footer bg-btn-action">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" class="load btn btn-primary btn-submit" name="edit" value="Simpan">
                      <a href="?module=pengajuan" class="btn btn-default btn-reset">Batal</a>
                    </div>
                  </div>
                </div>
              </form>
              <?php
            } 
            ?>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
  <script>
    $(document).ready(function() {
        $('.modal-form').css('display', 'block'); // Tampilkan modal
        $('.blur-background').css('display', 'block'); // Tampilkan latar belakang blur

        // Tutup modal saat mengklik latar belakang atau tombol Batal
        $('.blur-background, .btn-reset').click(function() {
            $('.modal-form, .blur-background').css('display', 'none');
        });
    });
  </script>