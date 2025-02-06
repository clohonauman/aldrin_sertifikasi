<section class="content-header">
  <h1>
    <i class="fa fa-search icon-title"></i> BERKAS
  </h1>
</section>
<style>
  .styled-link {
    margin-left:20px;
    display: inline-block;
    padding: 5px 10px;
    background-color: #ff0000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
  }

  .styled-link:hover {
    background-color: #ff000090;
    color: #fff;
  }
  :root {
    --color-white: #fff;
    --color-black: #333;
    --color-gray: #75787b;
    --color-gray-light: #bbb;
    --color-gray-disabled: #e8e8e8;
    --color-red: #ff0000;
    --color-green-dark: #383;
    --font-size-small: .75rem;
    --font-size-default: .875rem;
  }

  * {
    box-sizing: border-box;
  }

  h2 {
    color: var(--color-black);
    font-size: 15px;
    line-height: 1.5;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 3px;
  }

  h3 {
    color: var(--color-black);
    font-size: 15px;
    line-height: 1.5;
    font-weight: 400;
    text-transform: ;
    letter-spacing: 3px;
  }
  section {
    margin-bottom: 2rem;
  }

  .progress-bar1 {
    display: flex;
    justify-content: space-between;
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
  }
  .progress-bar1 li {
    flex: 2;
    position: relative;
    padding: 0 0 14px 0;
    font-size: 15px;
    line-height: 1.5;
    color: var(--color-green);
    font-weight: 600;
    white-space: nowrap;
    overflow: visible;
    min-width: 0;
    text-align: center;
    border-bottom: 2px solid var(--color-gray-disabled);
  }
  .progress-bar1 li:first-child,
  .progress-bar1 li:last-child {
    flex: 1;
  }
  .progress-bar1 li:last-child {
    text-align: right;
  }
  .progress-bar1 li:before {
    content: "";
    display: block;
    width: 8px;
    height: 8px;
    background-color: var(--color-gray-disabled);
    border-radius: 50%;
    border: 2px solid var(--color-white);
    position: absolute;
    left: calc(50% - 6px);
    bottom: -7px;
    z-index: 3;
    transition: all .2s ease-in-out;
  }
  .progress-bar1 li:first-child:before {
    left: 0;
  }
  .progress-bar1 li:last-child:before {
    right: 0;
    left: auto;
  }
  .progress-bar1 span {
    transition: opacity .3s ease-in-out;
  }
  .progress-bar1 li:not(.is-active) span {
    opacity: 0;
  }
  .progress-bar1 .is-complete:not(:first-child):after,
  .progress-bar1 .is-active:not(:first-child):after {
    content: "";
    display: block;
    width: 100%;
    position: absolute;
    bottom: -2px;
    left: -50%;
    z-index: 2;
    border-bottom: 2px solid var(--color-red);
  }
  .progress-bar1 li:last-child span {
    width: 200%;
    display: inline-block;
    position: absolute;
    left: -100%;
  }

  .progress-bar1 .is-complete:last-child:after,
  .progress-bar1 .is-active:last-child:after {
    width: 200%;
    left: -100%;
  }

  .progress-bar1 .is-complete:before {
    background-color: var(--color-red);
  }

  .progress-bar1 .is-active:before,
  .progress-bar1 li:hover:before,
  .progress-bar1 .is-hovered:before {
    background-color: var(--color-white);
    border-color: var(--color-red);
  }
  .progress-bar1 li:hover:before,
  .progress-bar1 .is-hovered:before {
    transform: scale(1.33);
  }

  .progress-bar1 li:hover span,
  .progress-bar1 li.is-hovered span {
    opacity: 1;
  }

  .progress-bar1:hover li:not(:hover) span {
    opacity: 0;
  }

  .x-ray .progress-bar1,
  .x-ray .progress-bar1 li {
    border: 1px dashed red;
  }

  .progress-bar1 .has-changes {
    opacity: 1 !important;
  }
  .progress-bar1 .has-changes:before {
    content: "";
    display: block;
    width: 8px;
    height: 8px;
    position: absolute;
    left: calc(50% - 4px);
    bottom: -20px;
  }
</style>
<?php
if(isset($_GET['alert'])){
  $alert=$_GET['alert'];
  if($alert==1){
    echo '<script>alert("Berkas berhasil di Terima.")</script>';
  }elseif($alert==2){
    echo '<script>alert("Tidak ada berkas yang di Tolak.")</script>';
  }elseif($alert==3){
    echo '<script>alert("Berkas berhasil di Tolak.")</script>';
  }elseif($alert==4){
    echo '<script>alert("Berkas berhasil di lanjutkan ke tahap selanjutnya.")</script>';
  }
}
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger" style="padding:10px;">
        <?php
          if(isset($_GET['id'])){
              $periode=$_GET['periode'];
              $nuptk=$_GET['id'];
              $queryguru=mysqli_query($mysqli2,"SELECT * FROM ptk WHERE nuptk='$nuptk'");
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
              $query=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$periode'");
              $data=mysqli_fetch_assoc($query);
              $query2=mysqli_query($mysqli2,"SELECT nama FROM ptk WHERE nuptk='$nuptk'");
              $data2=mysqli_fetch_assoc($query2);
              $cek=0;
              $i=0;
              $rev=0;
              $querygetstatus=mysqli_query($mysqli,"SELECT status,keterangan FROM pengusulan_sktp WHERE nuptk='$_GET[id]' AND periode='$periode'");
              $status_pengajuan=mysqli_fetch_assoc($querygetstatus);
              $status=$status_pengajuan['status'];
              $status_pengajuan=$status_pengajuan['keterangan']." ".convertStatus($status_pengajuan['status']);
            ?>
            <table class="table">
              <tbody>
                  <tr>
                      <td width='350'><strong>Nama Lengkap</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['nama']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>NUPTK</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['nuptk']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>Kabupaten</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['kabupaten']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>Email</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['email']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>Status Kepegawaian</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['status_kepegawaian']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>TMT Pengangkatan</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['tmt_pengangkatan']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>Riwayat Fungsional TMT Jabatan</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['riwayat_fungsional_tmt_jabatan']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>Jenis Sertifikasi</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['riwayat_sertifikasi_jenis_sertifikasi']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>Riwayat Kepangkatan Golongan</strong></td>
                      <td width='10'>:</td>
                      <td><?=$dataguru['riwayat_kepangkatan_pangkat_golongan']?></td>
                  </tr>
                  <tr>
                      <td width='350'><strong>Riwayat Gaji Pokok </strong></td>
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
            <hr>
            <div id="accordion">
              <div class="card">
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
                      <div class="card-header" id="section1">
                        <h5 class="mb-0">
                          <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse"  data-target="#jurnal">
                          <?php if($data['komentar_jurnal']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_jurnal']=='Telah di Revisi' OR $data['komentar_jurnal']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_jurnal']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT JURNAL
                          </button>
                          <?php if($data['komentar_jurnal']!=''){ $i++; } 
                          if(  $data['komentar_jurnal']=='Telah di Revisi' ){ $rev++; }
                          ?>
                        </h5>
                      </div>
                      <div id="jurnal" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                        <div class="card-body">
                          <a href="<?=$data['jurnal']?>" target="_blank" rel="noopener noreferrer" class="styled-link">
                            <i class="fa fa-file-pdf-o"></i> Akses Berkas
                          </a>
                          <hr>
                          <?php 
                          if($data['komentar_jurnal']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                            ?>
                            <p><b>Komentar Sebelumnya : </b><?=$data['komentar_jurnal']?></p>
                            <?php if($data['keterangan']!='Ditolak'){ ?>
                            <div class="text-right" id="">
                              <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&jurnal&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                              <button id="btnTolak_jurnal" class="btn btn-danger">TOLAK</button>
                            </div>
                            <?php } ?>
                            <form role="form" class="form-horizontal" id="formPenolakan_jurnal" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA CAP"> TIDAK ADA CAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA TANDA TANGAN (KEPALA SEKOLAH)"> TIDAK ADA TANDA TANGAN (KEPALA SEKOLAH) </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA TANDA TANGAN (PENGAWAS)"> TIDAK ADA TANDA TANGAN (PENGAWAS) </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="FOTO BERULANG"> FOTO BERULANG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK AKURAT/TIDAK SESUAI"> TIDAK AKURAT/TIDAK SESUAI </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERINDIKASI PLAGIASI/COPY-PASTE"> TERINDIKASI PLAGIASI/COPY-PASTE </label>
                                  <label class='col-sm-12 form-control'>
                                  <input name="lainnya" type="checkbox" value="" id="jurnalCheckbox"> ALASAN LAINNYA
                                </label>
                                <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="komentarTolakjurnal" cols="30" rows="10" style="display:none;"></textarea>
    
                                <script>
                                  // Mendapatkan referensi ke checkbox dan textarea menggunakan ID
                                  const jurnalCheckbox = document.getElementById("jurnalCheckbox");
                                  const komentarTolakjurnal = document.getElementById("komentarTolakjurnal");
    
                                  // Menambahkan event listener untuk memantau perubahan pada checkbox
                                  jurnalCheckbox.addEventListener("change", function() {
                                    // Jika checkbox dicentang, tampilkan textarea, jika tidak, sembunyikan
                                    if (jurnalCheckbox.checked) {
                                      komentarTolakjurnal.style.display = "block";
                                    } else {
                                      komentarTolakjurnal.style.display = "none";
                                    }
                                  });
                                </script>
    
                                </div>
                              </div>
                              <div class="box-footer bg-btn-action  text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_jurnal" value="KONFIRMASI PENOLAKAN">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <script>
                              const btnTolak_jurnal = document.getElementById("btnTolak_jurnal");
                              const formPenolakan_jurnal = document.getElementById("formPenolakan_jurnal");
                              btnTolak_jurnal.addEventListener("click", function() {
                                formPenolakan_jurnal.style.display = "block";
                              });
                            </script>
                            <?php
                          }else{
                            $cek=$cek+1;
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>

                    <?php
                    if($data_periode['pks']){
                      $no++;
                      ?>
                      <div class="card-header" id="section1">
                        <h5 class="mb-0">
                          <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse" data-target="#sk_kepala_sekolah">
                          <?php if($data['komentar_sk_kepsek']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_sk_kepsek']=='Telah di Revisi' OR $data['komentar_sk_kepsek']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_sk_kepsek']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT SPTJM KEPALA SEKOLAH
                          </button>
                          <?php if($data['komentar_sk_kepsek']!=''){ $i++; } 
                          if(  $data['komentar_sk_kepsek']=='Telah di Revisi' ){ $rev++; }
                          ?>
                        </h5>
                      </div>
                      <div id="sk_kepala_sekolah" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                        <div class="card-body">
                          <embed src="berkas/<?=$data['pengantar_kepsek']?>" style="width:100%;" height="500">
                          <hr>
                          <?php
                          if($data['komentar_sk_kepsek']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                            ?>
                            <p><b>Komentar Sebelumnya : </b><?=$data['komentar_sk_kepsek']?></p>
                            <?php if($data['keterangan']!='Ditolak'){ ?>
                            <div class="text-right" id="">
                              <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&sk_kepala_sekolah&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                              <button id="btnTolak_sk_kepala_sekolah" class="btn btn-danger">TOLAK</button>
                            </div>
                              <?php } ?>
                            <form role="form" class="form-horizontal" id="formPenolakan_sk_kepala_sekolah" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA TANDA TANGAN"> TIDAK ADA TANDA TANGAN </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA CAP"> TIDAK ADA CAP </label>
                                  <label class='col-sm-12 form-control'>
                                  <input name="lainnya" type="checkbox" value="" id="skkepCheckbox"> ALASAN LAINNYA
                                </label>
                                <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="komentarTolakskkep" cols="30" rows="10" style="display:none;"></textarea>
    
                                <script>
                                  // Mendapatkan referensi ke checkbox dan textarea menggunakan ID
                                  const skkepCheckbox = document.getElementById("skkepCheckbox");
                                  const komentarTolakskkep = document.getElementById("komentarTolakskkep");
    
                                  // Menambahkan event listener untuk memantau perubahan pada checkbox
                                  skkepCheckbox.addEventListener("change", function() {
                                    // Jika checkbox dicentang, tampilkan textarea, jika tidak, sembunyikan
                                    if (skkepCheckbox.checked) {
                                      komentarTolakskkep.style.display = "block";
                                    } else {
                                      komentarTolakskkep.style.display = "none";
                                    }
                                  });
                                </script>
    
                                </div>
                              </div>
                              <div class="box-footer bg-btn-action text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_sk_kepala_sekolah" value="KONFIRMASI PENOLAKAN">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <script>
                              const btnTolak_sk_kepala_sekolah = document.getElementById("btnTolak_sk_kepala_sekolah");
                              const formPenolakan_sk_kepala_sekolah = document.getElementById("formPenolakan_sk_kepala_sekolah");
                              btnTolak_sk_kepala_sekolah.addEventListener("click", function() {
                                formPenolakan_sk_kepala_sekolah.style.display = "block";
                              });
                            </script>
                            <?php 
                          } else{
                            $cek=$cek+1;
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>

                    <?php
                    if($data_periode['info_gtk']){
                      $no++;
                      ?>
                      <div class="card-header" id="section1">
                        <h5 class="mb-0">
                          <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse" data-target="#info_gtk">
                          <?php if($data['komentar_info_gtk']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_info_gtk']=='Telah di Revisi' OR $data['komentar_info_gtk']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_info_gtk']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT INFO GTK
                          </button>
                          <?php if($data['komentar_info_gtk']!=''){ $i++; } 
                          if(  $data['komentar_info_gtk']=='Telah di Revisi' ){ $rev++; }
                          ?>
                        </h5>
                      </div>
                      <div id="info_gtk" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                        <div class="card-body">
                          <embed src="berkas/<?=$data['info_gtk']?>" style="width:100%;" height="500">
                          <hr>
                          <?php 
                          if($data['komentar_info_gtk']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                            ?>
                            <p><b>Komentar Sebelumnya : </b><?=$data['komentar_info_gtk']?></p>
                            <?php if($data['keterangan']!='Ditolak'){ ?>
                              <div class="text-right" id="">
                                <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&info_gtk&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                                <button id="btnTolak_info_gtk" class="btn btn-danger">TOLAK</button>
                              </div>
                            <?php } ?>
                            <form role="form" class="form-horizontal" id="formPenolakan_info_gtk" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                  <label class='col-sm-12 form-control'>
                                  <input name="lainnya" type="checkbox" value="" id="infogtkCheckbox"> ALASAN LAINNYA
                                </label>
                                <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="komentarTolakinfogtk" cols="30" rows="10" style="display:none;"></textarea>

                                <script>
                                  // Mendapatkan referensi ke checkbox dan textarea menggunakan ID
                                  const infogtkCheckbox = document.getElementById("infogtkCheckbox");
                                  const komentarTolakinfogtk = document.getElementById("komentarTolakinfogtk");

                                  // Menambahkan event listener untuk memantau perubahan pada checkbox
                                  infogtkCheckbox.addEventListener("change", function() {
                                    // Jika checkbox dicentang, tampilkan textarea, jika tidak, sembunyikan
                                    if (infogtkCheckbox.checked) {
                                      komentarTolakinfogtk.style.display = "block";
                                    } else {
                                      komentarTolakinfogtk.style.display = "none";
                                    }
                                  });
                                </script>

                                </div>
                              </div>
                              <div class="box-footer bg-btn-action  text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_info_gtk" value="KONFIRMASI PENOLAKAN">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <script>
                              const btnTolak_info_gtk = document.getElementById("btnTolak_info_gtk");
                              const formPenolakan_info_gtk = document.getElementById("formPenolakan_info_gtk");
                              btnTolak_info_gtk.addEventListener("click", function() {
                              formPenolakan_info_gtk.style.display = "block";
                              });
                            </script>
                            <?php
                          }else{
                            $cek=$cek+1;
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>

                    <?php
                    if($data_periode['sk_pembagian']){
                      $no++;
                      ?>
                      <div class="card-header" id="section1">
                        <h5 class="mb-0">
                          <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse" data-target="#sk_pembagian">
                          <?php if($data['komentar_sk_pembagian']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_sk_pembagian']=='Telah di Revisi' OR $data['komentar_sk_pembagian']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_sk_pembagian']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT SK PEMBAGIAN TUGAS
                          </button>
                          <?php if($data['komentar_sk_pembagian']!=''){ $i++; } 
                          if(  $data['komentar_sk_pembagian']=='Telah di Revisi' ){ $rev++; }
                          ?>
                        </h5>
                      </div>
                      <div id="sk_pembagian" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                        <div class="card-body">
                          <embed src="berkas/<?=$data['sk_pembagian']?>" style="width:100%;" height="500">
                          <hr>
                          <?php 
                          if($data['komentar_sk_pembagian']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                            ?>
                            <p><b>Komentar Sebelumnya : </b><?=$data['komentar_sk_pembagian']?></p>
                            <?php if($data['keterangan']!='Ditolak'){ ?>
                              <div class="text-right" id="">
                                <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&sk_pembagian&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                                <button id="btnTolak_sk_pembagian" class="btn btn-danger">TOLAK</button>
                              </div>
                            <?php } ?>
                            <form role="form" class="form-horizontal" id="formPenolakan_sk_pembagian" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                  <label class='col-sm-12 form-control'>
                                  <input name="lainnya" type="checkbox" value="" id="skpemCheckbox"> ALASAN LAINNYA
                                </label>
                                <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="komentarTolakskpem" cols="30" rows="10" style="display:none;"></textarea>
  
                                <script>
                                  // Mendapatkan referensi ke checkbox dan textarea menggunakan ID
                                  const skpemCheckbox = document.getElementById("skpemCheckbox");
                                  const komentarTolakskpem = document.getElementById("komentarTolakskpem");
  
                                  // Menambahkan event listener untuk memantau perubahan pada checkbox
                                  skpemCheckbox.addEventListener("change", function() {
                                    // Jika checkbox dicentang, tampilkan textarea, jika tidak, sembunyikan
                                    if (skpemCheckbox.checked) {
                                      komentarTolakskpem.style.display = "block";
                                    } else {
                                      komentarTolakskpem.style.display = "none";
                                    }
                                  });
                                </script>
  
                                </div>
                              </div>
                              <div class="box-footer bg-btn-action  text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_sk_pembagian" value="KONFIRMASI PENOLAKAN">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <script>
                              const btnTolak_sk_pembagian = document.getElementById("btnTolak_sk_pembagian");
                              const formPenolakan_sk_pembagian = document.getElementById("formPenolakan_sk_pembagian");
                              btnTolak_sk_pembagian.addEventListener("click", function() {
                              formPenolakan_sk_pembagian.style.display = "block";
                              });
                            </script>
                            <?php
                          }else{
                            $cek=$cek+1;
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>

                    <?php
                    if($data_periode['skpa']){
                      $no++;
                      ?>
                      <div class="card-header" id="section1">
                        <h5 class="mb-0">
                          <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse" data-target="#skpa">
                          <?php if($data['komentar_sk_pangkat_akhir']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_sk_pangkat_akhir']=='Telah di Revisi' OR $data['komentar_sk_pangkat_akhir']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_sk_pangkat_akhir']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT SK PANGKAT AKHIR
                          </button>
                          <?php if($data['komentar_sk_pangkat_akhir']!=''){ $i++; } 
                          if(  $data['komentar_sk_pangkat_akhir']=='Telah di Revisi' ){ $rev++; }
                          ?>
                        </h5>
                      </div>
                      <div id="skpa" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                        <div class="card-body">
                        <?php
                          if($data['sk_pangkat_akhir']==''){
                            ?><h3>Maaf Berkas tidak di Unggah</h3><?php
                          }else{
                            ?>
                            <embed src="berkas/<?=$data['sk_pangkat_akhir']?>" style="width:100%;" height="500">
                            <?php
                          }
                          ?>
                          <hr>
                          <?php 
                          if($data['komentar_sk_pangkat_akhir']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                            ?>
                            <p><b>Komentar Sebelumnya : </b><?=$data['komentar_sk_pangkat_akhir']?></p>
                            <?php if($data['keterangan']!='Ditolak'){ ?>
                              <div class="text-right" id="">
                                <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&sk_pangkat_akhir&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                                <button id="btnTolak_sk_pangkat_akhir" class="btn btn-danger">TOLAK</button>
                              </div>
                              <?php } ?>
                            <form role="form" class="form-horizontal" id="formPenolakan_sk_pangkat_akhir" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                  <label class='col-sm-12 form-control'>
                                  <input name="lainnya" type="checkbox" value="" id="skpaCheckbox"> ALASAN LAINNYA
                                </label>
                                <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="komentarTolakskpa" cols="30" rows="10" style="display:none;"></textarea>
  
                                <script>
                                  // Mendapatkan referensi ke checkbox dan textarea menggunakan ID
                                  const skpaCheckbox = document.getElementById("skpaCheckbox");
                                  const komentarTolakskpa = document.getElementById("komentarTolakskpa");
  
                                  // Menambahkan event listener untuk memantau perubahan pada checkbox
                                  skpaCheckbox.addEventListener("change", function() {
                                    // Jika checkbox dicentang, tampilkan textarea, jika tidak, sembunyikan
                                    if (skpaCheckbox.checked) {
                                      komentarTolakskpa.style.display = "block";
                                    } else {
                                      komentarTolakskpa.style.display = "none";
                                    }
                                  });
                                </script>
  
                                </div>
                              </div>
                              <div class="box-footer bg-btn-action  text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_sk_pangkat_akhir" value="KONFIRMASI PENOLAKAN">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <script>
                              const btnTolak_sk_pangkat_akhir = document.getElementById("btnTolak_sk_pangkat_akhir");
                              const formPenolakan_sk_pangkat_akhir = document.getElementById("formPenolakan_sk_pangkat_akhir");
                              btnTolak_sk_pangkat_akhir.addEventListener("click", function() {
                                formPenolakan_sk_pangkat_akhir.style.display = "block";
                              });
                            </script>
                            <?php
                          }else{
                            $cek=$cek+1;
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>

                    <?php
                    if($data_periode['skba']){
                      $no++;
                      ?>
                      <div class="card-header" id="section1">
                        <h5 class="mb-0">
                          <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse" data-target="#skba">
                          <?php if($data['komentar_sk_berkala_akhir']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_sk_berkala_akhir']=='Telah di Revisi' OR $data['komentar_sk_berkala_akhir']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_sk_berkala_akhir']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT SK BERKALA AKHIR
                          </button>
                          <?php if($data['komentar_sk_berkala_akhir']!=''){ $i++; } 
                          if(  $data['komentar_sk_berkala_akhir']=='Telah di Revisi' ){ $rev++; }
                          ?>
                        </h5>
                      </div>
                      <div id="skba" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                        <div class="card-body">
                        <?php
                          if($data['sk_berkala_akhir']==''){
                            ?><h3>Maaf Berkas tidak di Unggah</h3><?php
                          }else{
                            ?>
                            <embed src="berkas/<?=$data['sk_berkala_akhir']?>" style="width:100%;" height="500">
                            <?php
                          }
                          ?>
                          <hr>
                          <?php 
                          if($data['komentar_sk_berkala_akhir']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                            ?>
                            <p><b>Komentar Sebelumnya : </b><?=$data['komentar_sk_berkala_akhir']?></p>
                            <?php if($data['keterangan']!='Ditolak'){ ?>
                              <div class="text-right" id="">
                                <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&sk_berkala_akhir&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                                <button id="btnTolak_sk_berkala_akhir" class="btn btn-danger">TOLAK</button>
                              </div>
                            <?php } ?>
                            <form role="form" class="form-horizontal" id="formPenolakan_sk_berkala_akhir" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                  <label class='col-sm-12 form-control'>
                                  <input name="lainnya" type="checkbox" value="" id="skbaCheckbox"> ALASAN LAINNYA
                                </label>
                                <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="komentarTolakskba" cols="30" rows="10" style="display:none;"></textarea>

                                <script>
                                  // Mendapatkan referensi ke checkbox dan textarea menggunakan ID
                                  const skbaCheckbox = document.getElementById("skbaCheckbox");
                                  const komentarTolakskba = document.getElementById("komentarTolakskba");

                                  // Menambahkan event listener untuk memantau perubahan pada checkbox
                                  skbaCheckbox.addEventListener("change", function() {
                                    // Jika checkbox dicentang, tampilkan textarea, jika tidak, sembunyikan
                                    if (skbaCheckbox.checked) {
                                      komentarTolakskba.style.display = "block";
                                    } else {
                                      komentarTolakskba.style.display = "none";
                                    }
                                  });
                                </script>

                                </div>
                              </div>
                              <div class="box-footer bg-btn-action  text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_sk_berkala_akhir" value="KONFIRMASI PENOLAKAN">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <script>
                              const btnTolak_sk_berkala_akhir = document.getElementById("btnTolak_sk_berkala_akhir");
                              const formPenolakan_sk_berkala_akhir = document.getElementById("formPenolakan_sk_berkala_akhir");
                              btnTolak_sk_berkala_akhir.addEventListener("click", function() {
                                formPenolakan_sk_berkala_akhir.style.display = "block";
                              });
                            </script>
                            <?php
                          }else{
                            $cek=$cek+1;
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>

                    <?php
                    if($data_periode['pg']){
                      $no++;
                      ?>
                      <div class="card-header" id="section1">
                        <h5 class="mb-0">
                          <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse" data-target="#pg">
                          <?php if($data['komentar_profil_guru']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_profil_guru']=='Telah di Revisi' OR $data['komentar_profil_guru']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_profil_guru']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT PROFIL GURU
                          </button>
                          <?php if($data['komentar_profil_guru']!=''){ $i++; } 
                          if(  $data['komentar_profil_guru']=='Telah di Revisi' ){ $rev++; }
                          ?>
                        </h5>
                      </div>
                      <div id="pg" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                        <div class="card-body">
                          <embed src="berkas/<?=$data['profil_guru']?>" style="width:100%;" height="500">
                          <hr>
                          <?php 
                          if($data['komentar_profil_guru']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                            ?>
                            <p><b>Komentar Sebelumnya : </b><?=$data['komentar_profil_guru']?></p>
                            <?php if($data['keterangan']!='Ditolak'){ ?>
                              <div class="text-right" id="">
                                <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&profil_guru&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                                <button id="btnTolak_profil_guru" class="btn btn-danger">TOLAK</button>
                              </div>
                            <?php } ?>
                            <form role="form" class="form-horizontal" id="formPenolakan_profil_guru" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                  <label class='col-sm-12 form-control'>
                                  <input name="lainnya" type="checkbox" value="" id="pgCheckbox"> ALASAN LAINNYA
                                </label>
                                <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="komentarTolakpg" cols="30" rows="10" style="display:none;"></textarea>
  
                                <script>
                                  // Mendapatkan referensi ke checkbox dan textarea menggunakan ID
                                  const pgCheckbox = document.getElementById("pgCheckbox");
                                  const komentarTolakpg = document.getElementById("komentarTolakpg");
  
                                  // Menambahkan event listener untuk memantau perubahan pada checkbox
                                  pgCheckbox.addEventListener("change", function() {
                                    // Jika checkbox dicentang, tampilkan textarea, jika tidak, sembunyikan
                                    if (pgCheckbox.checked) {
                                      komentarTolakpg.style.display = "block";
                                    } else {
                                      komentarTolakpg.style.display = "none";
                                    }
                                  });
                                </script>
  
                                </div>
                              </div>
                              <div class="box-footer bg-btn-action  text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_profil_guru" value="KONFIRMASI PENOLAKAN">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <script>
                              const btnTolak_profil_guru = document.getElementById("btnTolak_profil_guru");
                              const formPenolakan_profil_guru = document.getElementById("formPenolakan_profil_guru");
                              btnTolak_profil_guru.addEventListener("click", function() {
                                formPenolakan_profil_guru.style.display = "block";
                              });
                            </script>
                          <?php
                          }else{
                            $cek=$cek+1;
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>

                    <?php
                    if($data_periode['absen']){
                      $no++;
                      ?>
                      <div class="card-header" id="section1">
                        <h5 class="mb-0">
                          <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse" data-target="#absen">
                          <?php if($data['komentar_absen']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_absen']=='Telah di Revisi' OR $data['komentar_absen']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_absen']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT ABSEN
                          </button>
                          <?php if($data['komentar_absen']!=''){ $i++; } 
                          if(  $data['komentar_absen']=='Telah di Revisi' ){ $rev++; }
                          ?>
                        </h5>
                      </div>
                      <div id="absen" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                        <div class="card-body">
                          <embed src="berkas/<?=$data['absen']?>" style="width:100%;" height="500">
                          <hr>
                          <?php 
                          if($data['komentar_absen']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                            ?>
                            <p><b>Komentar Sebelumnya : </b><?=$data['komentar_absen']?></p>
                            <?php if($data['keterangan']!='Ditolak'){ ?>
                              <div class="text-right" id="">
                                <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&absen&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                                <button id="btnTolak_absen" class="btn btn-danger">TOLAK</button>
                              </div>
                            <?php } ?>
                            <form role="form" class="form-horizontal" id="formPenolakan_absen" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA TANDA TANGAN"> TIDAK ADA TANDA TANGAN </label>
                                  <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA CAP"> TIDAK ADA CAP </label>
                                  <label class='col-sm-12 form-control'>
                                  <input name="lainnya" type="checkbox" value="" id="absenCheckbox"> ALASAN LAINNYA
                                </label>
                                <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="komentarTolakabsen" cols="30" rows="10" style="display:none;"></textarea>
    
                                <script>
                                  // Mendapatkan referensi ke checkbox dan textarea menggunakan ID
                                  const absenCheckbox = document.getElementById("absenCheckbox");
                                  const komentarTolakabsen = document.getElementById("komentarTolakabsen");
    
                                  // Menambahkan event listener untuk memantau perubahan pada checkbox
                                  absenCheckbox.addEventListener("change", function() {
                                    // Jika checkbox dicentang, tampilkan textarea, jika tidak, sembunyikan
                                    if (absenCheckbox.checked) {
                                      komentarTolakabsen.style.display = "block";
                                    } else {
                                      komentarTolakabsen.style.display = "none";
                                    }
                                  });
                                </script>
    
                                </div>
                              </div>
                              <div class="box-footer bg-btn-action  text-right">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_absen" value="KONFIRMASI PENOLAKAN">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <script>
                              const btnTolak_absen = document.getElementById("btnTolak_absen");
                              const formPenolakan_absen = document.getElementById("formPenolakan_absen");
                              btnTolak_absen.addEventListener("click", function() {
                                formPenolakan_absen.style.display = "block";
                              });
                            </script>
                          <?php
                          }else{
                            $cek=$cek+1;
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>

                    <?php
                    if($data_periode['lainnya']){
                      if(!empty($data['lainnya'])){
                        $no++;
                        ?>
                        <div class="card-header" id="section1">
                          <h5 class="mb-0">
                            <button style="margin:5px;padding:5px;text-align:left;width:100%;" class="btn" data-toggle="collapse" data-target="#lainnya">
                            <?php if($data['komentar_lainnya']=="1234567890terima"){ ?> <i class='fa fa-check btn-success' style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php }elseif($data['komentar_lainnya']=='Telah di Revisi' OR $data['komentar_lainnya']==''){ ?> <i class="fa fa-clock-o btn-primary" style="padding:2px;border-radius:50%;font-size:15px;"></i> <?php } elseif($data['komentar_lainnya']==''){  }else{ ?> <i class="fa fa-times btn-danger" style="width:18px;text-align:center;padding:2px;border-radius:50%;font-size:15px;"></i> <?php }?> LIHAT BERKAS LAINNYA
                            </button>
                            <?php if($data['komentar_lainnya']!=''){ $i++; } 
                            if(  $data['komentar_lainnya']=='Telah di Revisi' ){ $rev++; }
                            ?>
                          </h5>
                        </div>
                        <div id="lainnya" class="collapse" aria-labelledby="section1" data-parent="#accordion">
                          <div class="card-body">
                            <a href="<?=$data['lainnya']?>" target="_blank" rel="noopener noreferrer" class="styled-link">
                              <i class="fa fa-file-pdf-o"></i> Akses Berkas
                            </a>
                            <hr>
                            <?php 
                            if($data['komentar_lainnya']!="1234567890terima" AND $_SESSION['kode_akses']!=2){
                              ?>
                              <p><b>Komentar Sebelumnya : </b><?=$data['komentar_lainnya']?></p>
                              <?php if($data['keterangan']!='Ditolak'){ ?>
                                <div class="text-right" id="">
                                  <a href="modules/pemeriksaan/proses.php?terima&periode=<?=$periode?>&lainnya&id=<?=$nuptk?>&s=<?=$data['status']?>" class=" btn btn-primary" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">TERIMA</a>
                                  <button id="btnTolak_lainnya" class="btn btn-danger">TOLAK</button>
                                </div>
                              <?php } ?>
                              <form role="form" class="form-horizontal" id="formPenolakan_lainnya" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                                <hr>
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK LENGKAP"> TIDAK LENGKAP </label>
                                    <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK TERBACA"> TIDAK TERBACA </label>
                                    <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TERPOTONG"> TERPOTONG </label>
                                    <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="KABUR"> KABUR </label>
                                    <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="RUSAK"> RUSAK </label>
                                    <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="SALAH MENGUNGGAH BERKAS"> SALAH MENGUNGGAH BERKAS </label>
                                    <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA TANDA TANGAN (DAFTAR HADIR)"> TIDAK ADA TANDA TANGAN (DAFTAR HADIR) </label>
                                    <label class='col-sm-12 form-control'><input name="komentar_tolak_select[]" type="checkbox" value="TIDAK ADA CAP (DAFTAR HADIR)"> TIDAK ADA CAP (DAFTAR HADIR) </label>
                                    <p>Alasan Lainnya</p>
                                    <textarea name="komentar_tolak" class="form-control" placeholder="Tuliskan komentar anda disini..." id="" cols="30" rows="10"></textarea>
                                  </div>
                                </div>
                                <div class="box-footer bg-btn-action  text-right">
                                  <div class="form-group">
                                    <div class="col-sm-12">
                                      <input type="submit" style="width:max-content;" class=" btn btn-danger btn-submit" name="tolak_lainnya" value="KONFIRMASI PENOLAKAN">
                                    </div>
                                  </div>
                                </div>
                              </form>
                              <script>
                                const btnTolak_lainnya = document.getElementById("btnTolak_lainnya");
                                const formPenolakan_lainnya = document.getElementById("formPenolakan_lainnya");
                                btnTolak_lainnya.addEventListener("click", function() {
                                  formPenolakan_lainnya.style.display = "block";
                                });
                              </script>
                            <?php
                            }else{
                              $cek=$cek+1;
                            }
                            ?>
                          </div>
                        </div>
                        <?php
                      }
                    }
                    ?>

                    <?php
                  }
                ?>
                  <hr>
                  <div class="col-md-12 text-left">
                    <?php
                    if($_SESSION['kode_akses']==1){
                      if($cek==$no AND $i==$no){
                        ?>
                        <a href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-success" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                        <a href="modules/pemeriksaan/proses.php?konfirmasi_tolak&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-danger disabled" onclick="return confirm('Anda yakin menolak berkas ini?');">BERKAS BMS</a>
                        <?php
                      }elseif($cek!=$no AND $i==$no){
                        if($data['keterangan']=='Menunggu Verifikasi'){
                          ?>
                          <a href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-success disabled" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                          <a href="modules/pemeriksaan/proses.php?konfirmasi_tolak&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-danger" onclick="return confirm('Anda yakin menolak berkas ini?');">BERKAS BMS</a>
                          <?php
                        }elseif($data['keterangan']=='Ditolak'){
                          ?>
                          <a href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-success disabled" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                          <a href="modules/pemeriksaan/proses.php?konfirmasi_tolak&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-danger disabled" onclick="return confirm('Anda yakin menolak berkas ini?');">BERKAS BMS</a>
                          <?php
                        }elseif($data['keterangan']=='Telah Direvisi'){
                          if($cek!=$no AND $i==$no AND $rev<=0){//ada yang ditolak tapi sudah selesai periksa semua dan status revisi
                            ?>
                            <a href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-success disabled" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                            <a href="modules/pemeriksaan/proses.php?konfirmasi_tolak&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-danger" onclick="return confirm('Anda yakin menolak berkas ini?');">BERKAS BMS</a>
                            <?php
                          }else{
                            ?>
                            <a href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-success disabled" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                            <a href="modules/pemeriksaan/proses.php?konfirmasi_tolak&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-danger disabled" onclick="return confirm('Anda yakin menolak berkas ini?');">BERKAS BMS</a>
                            <?php

                          }
                        }
                      }else{
                        ?>
                        <a href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-success disabled" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                        <a href="modules/pemeriksaan/proses.php?konfirmasi_tolak&id=<?=$nuptk?>&periode=<?=$periode?>" class=" btn btn-danger disabled" onclick="return confirm('Anda yakin menolak berkas ini?');">BERKAS BMS</a>
                        <?php
                      }
                    }elseif($_SESSION['kode_akses']==2){//untuk verifikator 2
                      if($data['keterangan']=='Menunggu Verifikasi'){
                        ?>
                        <a id="btnTerima_komentar_umum" href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class="  btn btn-success" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                        <button id="btnTolak_komentar_umum" class="btn btn-danger">BERKAS BMS</button>
                        <?php
                      }elseif($data['keterangan']=='Ditolak'){
                        ?>
                        <a disabled id="btnTerima_komentar_umum" href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class="  btn btn-success" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                        <button disabled id="btnTolak_komentar_umum" class="btn btn-danger">BERKAS BMS</button>
                        <?php
                      }elseif($data['keterangan']=='Telah Direvisi'){
                        if($cek!=$no AND $i==$no){//ada yang ditolak tapi sudah selesai periksa semua dan status revisi
                          ?>
                          <a disabled id="btnTerima_komentar_umum" href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class="  btn btn-success" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                          <button id="btnTolak_komentar_umum" class=" btn btn-danger">BERKAS BMS</button>
                          <?php
                        }else{//done semua
                          ?>
                          <a id="btnTerima_komentar_umum" href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class="  btn btn-success" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                          <button id="btnTolak_komentar_umum" class="btn btn-danger">BERKAS BMS</button>
                          <?php
                        }
                      }else{
                        ?>
                        <a disabled id="btnTerima_komentar_umum" href="modules/pemeriksaan/proses.php?lanjut&id=<?=$nuptk?>&periode=<?=$periode?>" class="  btn btn-success" onclick="return confirm('Berkas yang telah diterima tidak dapat dibatalkan lagi. Lanjutkan?');">BERKAS MS</a>
                        <button disabled id="btnTolak_komentar_umum" class="btn btn-danger">BERKAS BMS</button>
                        <?php
                      }
                      ?>
                      <p><b>Komentar Umum Sebelumnya : </b><?=$data['komentar_umum']?></p><hr>
                      <form role="form" class="form-horizontal" id="formPenolakan_komentar_umum" action="modules/pemeriksaan/proses.php?tolak&s=<?=$data['status']?>&periode=<?=$periode?>&id=<?=$_GET['id']?>" method="POST" style="display: none;">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <textarea name="komentar_tolak" class="form-control" placeholder="Kenapa Anda menolak pengajuan ini?" id="" cols="30" rows="10" required></textarea>
                          </div>
                        </div>
                        <div class="box-footer bg-btn-action  text-right">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="submit" style="width:max-content;" class="  btn btn-danger btn-submit" name="tolak_komentar_umum" value="KONFIRMASI PENOLAKAN" onclick="return confirm('Anda yakin menolak berkas ini?');">
                              <a style="width:max-content;" class="btn btn-default btn-reset" id="btnBatal_komentar_umum">BATAL</a>
                            </div>
                          </div>
                        </div>
                      </form>
                      <?php
                    }
                    ?>
                  </div>
                  <?php
                  ?>
              </div>
            </div>
            <?php
          }
        ?>
      </div>
    </div>
  </div>
</section>
<script>
  const btnTolak_komentar_umum = document.getElementById("btnTolak_komentar_umum");
  const btnBatal_komentar_umum = document.getElementById("btnBatal_komentar_umum");
  const btnTerima_komentar_umum = document.getElementById("btnTerima_komentar_umum");
  const formPenolakan_komentar_umum = document.getElementById("formPenolakan_komentar_umum");

  btnTolak_komentar_umum.addEventListener("click", function() {
    formPenolakan_komentar_umum.style.display = "block";
    btnTolak_komentar_umum.style.display = "none";
    btnTerima_komentar_umum.style.display = "none";
  });

  btnBatal_komentar_umum.addEventListener("click", function() {
    formPenolakan_komentar_umum.style.display = "none";
    btnTolak_komentar_umum.style.display = "inline";
    btnTerima_komentar_umum.style.display = "inline";
  });
</script>



  