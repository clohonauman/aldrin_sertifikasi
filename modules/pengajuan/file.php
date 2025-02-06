
  <section class="content-header">
    <h1>
      <i class="fa fa-book icon-title"></i> LIHAT BERKAS <?=$_GET['jenis']?>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
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
      function convertJenis($s){
        if($s=="JURNAL"){
          $jenis="jurnal";
        }
        if($s=="SPTJM KEPALA SEKOLAH"){
          $jenis="pks";
        }
        if($s=="INFO GTK"){
          $jenis="info_gtk";
        }
        if($s=="SK PEMBAGIAN TUGAS"){
          $jenis="sk_pembagian";
        }
        if($s=="SK PANGKAT AKHIR"){
          $jenis="skpa";
        }
        if($s=="SK BERKALA AKHIR"){
          $jenis="skba";
        }
        if($s=="PROFIL GURU"){
          $jenis="pg";
        }
        if($s=="ABSEN"){
          $jenis="absen";
        }
        if($s=="LAINNYA"){
          $jenis="lainnya";
        }
        return $jenis;
      }
      $jenis=convertJenis($_GET['jenis']);
      $id=$_GET['id'];
      $querysementara=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]'");
      $datasementara=mysqli_fetch_assoc($querysementara);
      if(!empty($datasementara)){//belum simpan tapi sudah upload beberapa berkas
        if($jenis=='jurnal'){
          $queryjurnal=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $datajurnal=mysqli_fetch_assoc($queryjurnal);
          ?>
          <div class="text-right">
            <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='<?=$datajurnal['nama_berkas']?>' target="_blank">
                <i style='color:#fff' class='fa fa-eye'></i> LIHAT JURNAL
            </a>
          </div>
          <hr>
          <div style="width: 100%; height: 500px; display: flex; justify-content: center; align-items: center;">
            <p>Maaf browser tidak dapat mengakses link secara langsung, silakan klik Lihat Jurnal untuk mengakses berkas secara langsung.</p>
          </div>
          <?php
        }
        if($jenis=='lainnya'){
          $querylainnya=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $datalainnya=mysqli_fetch_assoc($querylainnya);
          ?>
          <div class="text-right">
            <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='<?=$datalainnya['nama_berkas']?>' target="_blank">
                <i style='color:#fff' class='fa fa-eye'></i> LIHAT BERKAS
            </a>
          </div>
          <hr>
          <div style="width: 100%; height: 500px; display: flex; justify-content: center; align-items: center;">
            <p>Maaf browser tidak dapat mengakses link secara langsung, silakan klik Lihat Jurnal untuk mengakses berkas secara langsung.</p>
          </div>
          <?php
        }
        if($jenis=='pks'){
          $querypks=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $datapks=mysqli_fetch_assoc($querypks);
          ?>
          <embed src="berkas/<?=$datapks['nama_berkas']?>" style="width:100%;" height="610">
          <?php
        }
        if($jenis=='info_gtk'){
          $queryinfo_gtk=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $datainfo_gtk=mysqli_fetch_assoc($queryinfo_gtk);
          ?>
          <embed src="berkas/<?=$datainfo_gtk['nama_berkas']?>" style="width:100%;" height="610">
          <?php
        }
        if($jenis=='sk_pembagian'){
          $querysk_pembagian=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $datask_pembagian=mysqli_fetch_assoc($querysk_pembagian);
          ?>
          <embed src="berkas/<?=$datask_pembagian['nama_berkas']?>" style="width:100%;" height="610">
          <?php
        }
        if($jenis=='skpa'){
          $queryskpa=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $dataskpa=mysqli_fetch_assoc($queryskpa);
          if($dataskpa['nama_berkas']==''){
            ?>
            <div class="card">
                <p class="card-text">FILE BELUM PERNAH DI UNGGAH.</p>
              </div>
            <?php
          }else{
            ?>
            <embed src="berkas/<?=$dataskpa['nama_berkas']?>" style="width:100%;" height="610">
            <?php
          }
          ?>
          <?php
        }
        if($jenis=='skba'){
          $queryskba=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $dataskba=mysqli_fetch_assoc($queryskba);
          if($dataskba['nama_berkas']==''){
            ?>
            <div class="card">
                <p class="card-text">FILE BELUM PERNAH DI UNGGAH.</p>
              </div>
            <?php
          }else{
            ?>
            <embed src="berkas/<?=$dataskba['nama_berkas']?>" style="width:100%;" height="610">
            <?php
          }
          ?>
          <?php
        }
        if($jenis=='pg'){
          $querypg=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $datapg=mysqli_fetch_assoc($querypg);
          ?>
          <embed src="berkas/<?=$datapg['nama_berkas']?>" style="width:100%;" height="610">
          <?php
        }
        if($jenis=='absen'){
          $queryabsen=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE nuptk='$id' AND periode='$_GET[periode]' AND jenis='$jenis'");
          $dataabsen=mysqli_fetch_assoc($queryabsen);
          ?>
          <embed src="berkas/<?=$dataabsen['nama_berkas']?>" style="width:100%;" height="610">
          <?php
        }
      }else{//sudah simpan dan akan diproses lebih lanjut
        $querysktp=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$id' AND periode='$_GET[periode]'");
        $datasktp=mysqli_fetch_assoc($querysktp);
        if(!empty($datasktp)){
          if($jenis=='jurnal'){
            ?>
            <div class="text-right">
              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='<?=$datasktp['jurnal']?>' target="_blank">
                  <i style='color:#fff' class='fa fa-eye'></i> LIHAT JURNAL
              </a>
            </div>
            <hr>
            <div style="width: 100%; height: 500px; display: flex; justify-content: center; align-items: center;">
              <p>Maaf browser tidak dapat mengakses link secara langsung, silakan klik Lihat Jurnal untuk mengakses berkas secara langsung.</p>
            </div>

            <?php
          }
          if($jenis=='lainnya'){
            ?>
            <div class="text-right">
              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='<?=$datasktp['lainnya']?>' target="_blank">
                  <i style='color:#fff' class='fa fa-eye'></i> LIHAT BERKAS
              </a>
            </div>
            <hr>
            <div style="width: 100%; height: 500px; display: flex; justify-content: center; align-items: center;">
              <p>Maaf browser tidak dapat mengakses link secara langsung, silakan klik Lihat Jurnal untuk mengakses berkas secara langsung.</p>
            </div>

            <?php
          }
          if($jenis=='pks'){
            ?>
            <embed src="berkas/<?=$datasktp['pengantar_kepsek']?>" style="width:100%;" height="610">
            <?php
          }
          if($jenis=='info_gtk'){
            ?>
            <embed src="berkas/<?=$datasktp['info_gtk']?>" style="width:100%;" height="610">
            <?php
          }
          if($jenis=='sk_pembagian'){
            ?>
            <embed src="berkas/<?=$datasktp['sk_pembagian']?>" style="width:100%;" height="610">
            <?php
          }
          if($jenis=='skpa'){
            if($datasktp['sk_pangkat_akhir']==''){
              ?>
              <div class="card">
                <p class="card-text">FILE BELUM PERNAH DI UNGGAH.</p>
              </div>
              <?php
            }else{
              ?>
              <embed src="berkas/<?=$datasktp['sk_pangkat_akhir']?>" style="width:100%;" height="610">
              <?php
            }
          }
          if($jenis=='skba'){
            if($datasktp['sk_berkala_akhir']==''){
              ?>
              <div class="card">
                <p class="card-text">FILE BELUM PERNAH DI UNGGAH.</p>
              </div>
              <?php
            }else{
              ?>
              <embed src="berkas/<?=$datasktp['sk_berkala_akhir']?>" style="width:100%;" height="610">
              <?php
            }
          }
          if($jenis=='pg'){
            ?>
            <embed src="berkas/<?=$datasktp['profil_guru']?>" style="width:100%;" height="610">
            <?php
          }
          if($jenis=='absen'){
            ?>
            <embed src="berkas/<?=$datasktp['absen']?>" style="width:100%;" height="610">
            <?php
          }
        }else{
          ?>
          <div class="card">
            <p class="card-text">FILE BELUM PERNAH DI UNGGAH.</p>
          </div>
          <?php
        }
      }
      ?>
    </div><!-- /.box -->
  </section><!-- /.content -->