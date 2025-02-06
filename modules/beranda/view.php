<section class="content-header">
  <h1><i class="fa fa-home icon-title"></i> Beranda</h1>
</section>
<script type="text/javascript">
    window.onload = function() { jam(); }
    var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    function jam() {
        var e = document.getElementById('jam'),
            d = new Date(),
            h = set(d.getHours()),
            m = set(d.getMinutes()),
            s = set(d.getSeconds()),
            dayName = days[d.getDay()],
            day = set(d.getDate()),
            monthName = months[d.getMonth()],
            year = d.getFullYear();

        var formattedTime = dayName + ', ' + day + ' ' + monthName + ' ' + year + ' ' + h + ':' + m + ':' + s;

        e.innerHTML = formattedTime;

        setTimeout(jam, 1000);
    }
    function set(e) {
        e = e < 10 ? '0'+ e : e;
        return e;
    }
</script>
<?php
  date_default_timezone_set("Asia/jakarta");
  $periode=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE status='1' ORDER BY periode DESC");
  $periode=mysqli_fetch_assoc($periode);
  $periode=$periode['periode'];
?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12 col-xs-12">
      <div class="alert alert-primary alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="jam"></span>
        <p style="font-size:15px">
            Selamat datang <strong><?php echo $_SESSION['nama_lengkap']." - ".$_SESSION['nama_sekolah']; ?></strong> di Aplikasi Layanan Digital Rekapitulasi Informasi Sertifikasi Guru (ALDRIN SERTIFIKASI) </strong>.
        </p>        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-xs-12">
      <div class="alert alert-secondary alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p style="font-size:15px">
          Diinformasikan untuk data yang tertera pada halaman Beranda adalah data pengusulan terbaru (Periode <?=$periode?>). Terima Kasih.
        </p>        
      </div>
    </div>
  </div>
  
  <div class="row">
    
    <?php
    if($_SESSION['kode_akses']==0 OR $_SESSION['kode_akses']==7){//admin
      $queryJU=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE periode='$periode'");
      $JU=mysqli_num_rows($queryJU);

      $queryJMV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Menunggu Verifikasi'");
      $JMV1=mysqli_num_rows($queryJMV1);
      
      $queryJTOLV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Ditolak'");
      $JTOLV1=mysqli_num_rows($queryJTOLV1);
      
      $queryJDRV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Telah Direvisi'");
      $JDRV1=mysqli_num_rows($queryJDRV1);
      
      $queryJMV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Menunggu Verifikasi'");
      $JMV2=mysqli_num_rows($queryJMV2);
      
      $queryJTOLV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Ditolak'");
      $JTOLV2=mysqli_num_rows($queryJTOLV2);
      
      $queryJDRV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Telah Direvisi'");
      $JDRV2=mysqli_num_rows($queryJDRV2);
      
      $queryJAST=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S3' AND periode='$periode'");
      $JAST=mysqli_num_rows($queryJAST);
      
      $queryJASB=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S4' AND periode='$periode'");
      $JASB=mysqli_num_rows($queryJASB);
      
      $queryJASPM=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S5' AND periode='$periode'");
      $JASPM=mysqli_num_rows($queryJASPM);
      
      $queryJSEL=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S6' AND periode='$periode'");
      $JSEL=mysqli_num_rows($queryJSEL);
      ?>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Semua Usulan</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JU?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Menunggu V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JMV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Ditolak V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JTOLV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Direvisi V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JDRV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Menunggu V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JMV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Ditolak V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JTOLV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Direvisi V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JDRV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SIMTUN</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JAST?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SIMBAR</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JASB?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SPM</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JASPM?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Selesai</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JSEL?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php
    }
    if($_SESSION['kode_akses']==1){//cabdin
      $cabdin=explode('-',$_SESSION['cabdin']);
      $kab1=$cabdin[0];
      if(isset($cabdin[1])){
        $kab2=$cabdin[1];
        if($kab2=='SMA' OR $kab2=='SMK' OR $kab2=='SLB'){
          $bentuk_pendidikan=$kab2;
        }else{
          $bentuk_pendidikan='';
        }
      }else{
        $kab2="";
        $bentuk_pendidikan='';
      }
      $queryJU=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE (kabupaten='$kab1' OR  kabupaten='$kab2') AND status='S1' AND periode='$periode'");
      $JU=mysqli_num_rows($queryJU);

      $queryJMV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Menunggu Verifikasi' AND (kabupaten='$kab1' OR  kabupaten='$kab2') AND bentuk_pendidikan='$bentuk_pendidikan'");
      $JMV1=mysqli_num_rows($queryJMV1);
      
      $queryJTOLV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Ditolak' AND (kabupaten='$kab1' OR  kabupaten='$kab2') AND bentuk_pendidikan='$bentuk_pendidikan'");
      $JTOLV1=mysqli_num_rows($queryJTOLV1);
      
      $queryJDRV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Telah Direvisi' AND (kabupaten='$kab1' OR  kabupaten='$kab2') AND bentuk_pendidikan='$bentuk_pendidikan'");
      $JDRV1=mysqli_num_rows($queryJDRV1);
      ?>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Semua Usulan</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JU?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Menunggu V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JMV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Ditolak V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JTOLV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Direvisi V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JDRV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php
    }
    if($_SESSION['kode_akses']==2){//gtk
      $queryJU2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE (status='S2' OR status='S3' OR status='S4' OR status='S6') AND periode='$periode'");
      $JU2=mysqli_num_rows($queryJU2);

      $queryJMV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Menunggu Verifikasi'");
      $JMV2=mysqli_num_rows($queryJMV2);
      
      $queryJTOLV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Ditolak'");
      $JTOLV2=mysqli_num_rows($queryJTOLV2);
      
      $queryJDRV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Telah Direvisi'");
      $JDRV2=mysqli_num_rows($queryJDRV2);
      
      $queryJAST=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S3' AND periode='$periode'");
      $JAST=mysqli_num_rows($queryJAST);
      
      $queryJASB=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S4' AND periode='$periode'");
      $JASB=mysqli_num_rows($queryJASB);
      
      $queryJSEL=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S6' AND periode='$periode'");
      $JSEL=mysqli_num_rows($queryJSEL);
      ?>
      <!-- VERIFIKATOR 2 -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Semua Usulan</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JU2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Menunggu V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JMV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Ditolak V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JTOLV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Direvisi V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JDRV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SIMTUN</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JAST?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SIMBAR</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JASB?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Selesai</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JSEL?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php
    }
    if($_SESSION['kode_akses']==3){//operator

      $queryJU=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND periode='$periode'");
      $JU=mysqli_num_rows($queryJU);

      $queryJMV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Menunggu Verifikasi' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JMV1=mysqli_num_rows($queryJMV1);
      
      $queryJTOLV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Ditolak' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JTOLV1=mysqli_num_rows($queryJTOLV1);
      
      $queryJDRV1=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S1' AND periode='$periode' AND keterangan='Telah Direvisi' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JDRV1=mysqli_num_rows($queryJDRV1);
      
      $queryJMV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Menunggu Verifikasi' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JMV2=mysqli_num_rows($queryJMV2);
      
      $queryJTOLV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Ditolak' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JTOLV2=mysqli_num_rows($queryJTOLV2);
      
      $queryJDRV2=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S2' AND periode='$periode' AND keterangan='Telah Direvisi' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JDRV2=mysqli_num_rows($queryJDRV2);
      
      $queryJAST=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S3' AND periode='$periode' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JAST=mysqli_num_rows($queryJAST);
      
      $queryJASB=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S4' AND periode='$periode' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JASB=mysqli_num_rows($queryJASB);
      
      $queryJASPM=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S5' AND periode='$periode' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JASPM=mysqli_num_rows($queryJASPM);
      
      $queryJSEL=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S6' AND periode='$periode' AND id_sekolah='$_SESSION[id_sekolah]'");
      $JSEL=mysqli_num_rows($queryJSEL);
      ?>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Semua Usulan</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JU?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Menunggu V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JMV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Ditolak V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JTOLV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Direvisi V1</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JDRV1?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Menunggu V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JMV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Ditolak V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JTOLV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Direvisi V2</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JDRV2?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SIMTUN</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JAST?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SIMBAR</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JASB?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SPM</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JASPM?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Selesai</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JSEL?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php
    }
    if($_SESSION['kode_akses']==4){//renkeu
      $queryJU4=mysqli_query($mysqli,"SELECT id_pengusulan_sktp FROM pengusulan_sktp WHERE status='S5' AND periode='$periode'");
      $JU4=mysqli_num_rows($queryJU4);
      ?>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Jumlah Antrian SPM</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$JASPM?></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-database fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php
    }
    ?>

  </div>
</section>