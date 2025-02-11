
  <section class="content-header">
    <h1>
      <i class="fa fa-check-square icon-title"></i> BERKAS TERVERIFIKASI
    </h1>
  </section>
  <style>
    .center-text {
      text-align: center;
      vertical-align: middle;
      align-items: center;
      justify-content: center;
    }
    .contents{
      overflow: auto;
      max-height:550px;
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
    echo '<script>alert("Berkas Gagal Diunduh, Periksa Kembali Koneksi Anda.")</script>';
  }elseif($alert==2){
    echo '<script>alert("Berkas berhasil di Konfirmasi ke SIMTUN.")</script>';
  }elseif($alert==3){
    echo '<script>alert("Berkas gagal di Konfirmasi ke SIMTUN. Periksa kembali koneksi anda.")</script>';
  }elseif($alert==4){
    // echo '<script>alert("Berkas berhasil di Konfirmasi ke SIMBAR.")</script>';
  }elseif($alert==5){
    echo '<script>alert("Tidak ada berkas yang akan diproses ke SIMBAR.")</script>';
  }elseif($alert==6){
    echo '<script>alert("Berkas berhasil di Konfirmasi Selesai SPM.")</script>';
  }elseif($alert==7){
    echo '<script>alert("Tidak ada berkas yang akan diproses Selesai SPM.")</script>';
  }
}
?>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <div class="box box-danger" style="padding:10px;">
            <!-- disini -->
            <?php
            if($_SESSION['kode_akses']==2 OR $_SESSION['kode_akses']==4){
              if(!isset($_GET['periode'])){
                ?>                    
                  <form id="form1" role="form" class="form-horizontal" method="GET" action=""  enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Periode</label>
                      <div class="col-sm-5">
                        <input type="hidden" name="module" value="berkas_terverifikasi">
                        <input type="hidden" name="k" value="<?=$_GET['k']?>">
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
                          <input id="submitButton" type="submit" class="load btn btn-primary btn-submit" name="simpan" value="Lanjutkan" disabled>
                          <a href="?module=pengajuan" class="btn btn-default btn-reset">Batal</a>
                        </div>
                      </div>
                    </div>
                    <script>
                        const periode = document.getElementById('periode');
                        const submitButton = document.getElementById('submitButton');

                        periode.addEventListener('change', () => {
                            if (periode.value) {
                                submitButton.removeAttribute('disabled');
                            } else {
                                submitButton.setAttribute('disabled', 'disabled');
                            }
                        });
                    </script>
                  </form>
                <?php
              }else{
                if(isset($_GET['k'])){
                  $kstatus=$_GET['k'];
                  if($kstatus==1){//SIMTUN
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                        <form role="form" class="form-horizontal" method="POST" action="modules/berkas_terverifikasi/proses.php?periode=<?=$_GET['periode']?>&simtun" enctype="multipart/form-data">
                          <table id="dataTables1" class="table table-bordered table-striped table-hover">
                            <!-- tampilan tabel header -->
                            <thead>
                              <tr>
                                <th class="center"><input type="checkbox" id="checkAll" onchange="toggleCheckboxes(this.checked); checkIfAnyChecked();"></th>
                                <th class="center">NAMA GURU</th>
                                <th class="center">SEKOLAH</th>
                                <th class="center">NUPTK</th>
                                <th class="center">WAKTU PENGUSULAN</th>
                                <th class="center">STATUS</th>
                                <th class="center">PERIODE</th>
                                <th class="center">AKSI</th>
                              </tr> 
                            </thead>
                            <!-- tampilan tabel body -->
                            <tbody>
                            <?php  
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE periode='$_GET[periode]' AND status='S3' ORDER BY status ASC, waktu_pengusulan DESC")
                                                            or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) { 
                              $querysklh = mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'")
                                                            or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                              $datasklh = mysqli_fetch_assoc($querysklh);
                              $status=convertStatus($data['status']); 
                              $keterangan=$data['keterangan'];
                              ?>
                              <tr>
                                <td  class='center'><input type="checkbox" name="nuptk[]" onchange="checkIfAnyChecked();" value="<?php echo $data['nuptk']; ?>"></td>
                                <td  class='center'><?=$data['nama_guru']?></td>
                                <td  class='center'><?=$datasklh['nama']?></td>
                                <td  class='center'><?=$data['nuptk']?></td>
                                <td  class='center'><?=$data['waktu_pengusulan']?></td>
                                <td  class='center'><?=$keterangan." ".$status?></td>
                                <td  class='center'><?=$data['periode']?></td>
                                <td class='center'>
                                  <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=berkas_form&id=<?=$data['nuptk']?>&periode=<?=$_GET['periode']?>'>
                                      <i style='color:#fff' class='fa fa-eye'></i>
                                  </a>
                                </td>
                              </tr>
                            <?php
                              $no++;
                            }
                            ?>
                            </tbody>
                          </table>
                          <div class="box-footer">
                            <div class="form-group">
                              <div class="col-sm-10">
                                <input type="submit" id="submitButton" class="btn btn-success" name="simpan" value="KONFIRMASI SIMTUN" onclick="return confirm('Berkas yang dipilih telah dikirim ke SIMTUN?');" style="display: none;">
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <?php
                  }elseif($kstatus==2){//SIMBAR
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                        <form role="form" class="form-horizontal" method="POST" action="modules/berkas_terverifikasi/proses.php?periode=<?=$_GET['periode']?>&simbar" enctype="multipart/form-data">
                          <table id="dataTables1" class="table table-bordered table-striped table-hover">
                            <!-- tampilan tabel header -->
                            <thead>
                              <tr>
                                <th class="center"><input type="checkbox" id="checkAll" onchange="toggleCheckboxes(this.checked); checkIfAnyChecked();"></th>
                                <th class="center">NAMA GURU</th>
                                <th class="center">SEKOLAH</th>
                                <th class="center">NUPTK</th>
                                <th class="center">WAKTU PENGUSULAN</th>
                                <th class="center">STATUS</th>
                                <th class="center">PERIODE</th>
                              </tr> 
                            </thead>
                            <!-- tampilan tabel body -->
                            <tbody>
                                <div class="box-body">
                                    <?php  
                                      $no = 1;
                                      $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE periode='$_GET[periode]' AND status='S4' ORDER BY status ASC, waktu_pengusulan DESC")
                                                                      or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

                                      while ($data = mysqli_fetch_assoc($query)) { 
                                        $querysklh = mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'")
                                                                      or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                                        $datasklh = mysqli_fetch_assoc($querysklh);
                                        $status=convertStatus($data['status']); 
                                        $keterangan=$data['keterangan']; 
                                        ?>
                                          <tr>
                                            <td  class='center'><input type="checkbox" name="nuptk[]" onchange="checkIfAnyChecked();" value="<?php echo $data['nuptk']; ?>"></td>
                                            <td  class='left'><?=$data['nama_guru']?></td>
                                            <td  class='center'><?=$datasklh['nama']?></td>
                                            <td  class='center'><?=$data['nuptk']?></td>
                                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                                            <td  class='center'><?=$keterangan." ".$status?></td>
                                            <td  class='center'><?=$data['periode']?></td>
                                          </tr>
                                        <?php
                                      }
                                    ?>
                                  </div>
                                </div>
                            </tbody>
                          </table>
                          <div class="box-footer">
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input type="submit" id="submitButton2" class="btn btn-success" name="simpan" value="KONFIRMASI SIMBAR" onclick="return confirm('Berkas yang dipilih telah dikirim ke SIMBAR?');" style="display: none;">
                                <input type="submit" id="submitButton" class="btn btn-danger" name="batal_validasi" value="MUNDUR KE SIMTUN" onclick="return confirm('Berkas yang dipilih akan dimundurkan ke SIMTUN. Lanjutkan?');" style="display: none;">
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <?php
                  }elseif($kstatus==3){//SPM
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                        <form role="form" class="form-horizontal" method="POST" action="modules/berkas_terverifikasi/proses.php?periode=<?=$_GET['periode']?>&selesai" enctype="multipart/form-data">
                          <table id="dataTables1" class="table table-bordered table-striped table-hover">
                            <!-- tampilan tabel header -->
                            <thead>
                              <tr>
                                <th class="center"><input type="checkbox" id="checkAll" onchange="toggleCheckboxes(this.checked); checkIfAnyChecked();"></th>
                                <th class="center">NAMA GURU</th>
                                <th class="center">SEKOLAH</th>
                                <th class="center">NUPTK</th>
                                <th class="center">WAKTU PENGUSULAN</th>
                                <th class="center">STATUS</th>
                                <th class="center">PERIODE</th>
                              </tr> 
                            </thead>
                            <!-- tampilan tabel body -->
                            <tbody>
                                <div class="box-body">
                                    <?php  
                                      $no = 1;
                                      $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE periode='$_GET[periode]' AND status='S5' ORDER BY status ASC, waktu_pengusulan DESC")
                                                                      or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

                                      while ($data = mysqli_fetch_assoc($query)) { 
                                        $querysklh = mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'")
                                                                      or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                                        $datasklh = mysqli_fetch_assoc($querysklh);
                                        $status=convertStatus($data['status']); 
                                        $keterangan=$data['keterangan']; 
                                        ?>
                                          <tr>
                                            <td  class='center'><input type="checkbox" name="nuptk[]" onchange="checkIfAnyChecked();" value="<?php echo $data['nuptk']; ?>"></td>
                                            <td  class='center'><?=$data['nama_guru']?></td>
                                            <td  class='center'><?=$datasklh['nama']?></td>
                                            <td  class='center'><?=$data['nuptk']?></td>
                                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                                            <td  class='center'><?=$keterangan." ".$status?></td>
                                            <td  class='center'><?=$data['periode']?></td>
                                          </tr>
                                        <?php
                                      }
                                    ?>
                                  </div>
                                </div>
                            </tbody>
                          </table>
                          <div class="box-footer">
                            <div class="form-group">
                              <div class="col-sm-10">
                                <input type="submit" id="submitButton" class="btn btn-success" name="simpan" value="KONFIRMASI SPM" onclick="return confirm('Berkas yang dipilih telah selesai di usul SPM?');" style="display: none;">
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <?php
                  }elseif($kstatus==4){//SELESAI
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                          <!-- tampilan tabel header -->
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">NAMA GURU</th>
                              <th class="center">SEKOLAH</th>
                              <th class="center">NUPTK</th>
                              <th class="center">WAKTU PENGUSULAN</th>
                              <th class="center">STATUS</th>
                              <th class="center">PERIODE</th>
                              <th class="center">AKSI</th>
                            </tr> 
                          </thead>
                          <!-- tampilan tabel body -->
                          <tbody>
                          <?php  
                          $no = 1;
                          $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE periode='$_GET[periode]' AND status='S6' ORDER BY status ASC, waktu_pengusulan DESC")
                                                          or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

                          while ($data = mysqli_fetch_assoc($query)) { 
                            $querysklh = mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'")
                                                          or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            $datasklh = mysqli_fetch_assoc($querysklh);
                            $status=convertStatus($data['status']); 
                            $keterangan=$data['keterangan'];
                            ?>
                            <tr>
                              <td width='20' class='center'><?=$no?></td>
                              <td  class='center'><?=$data['nama_guru']?></td>
                              <td  class='center'><?=$datasklh['nama']?></td>
                              <td  class='center'><?=$data['nuptk']?></td>
                              <td  class='center'><?=$data['waktu_pengusulan']?></td>
                              <td  class='center'><?=$keterangan." ".$status?></td>
                              <td  class='center'><?=$data['periode']?></td>
                              <td class='center'>
                                <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=berkas_form&id=<?=$data['nuptk']?>&periode=<?=$_GET['periode']?>'>
                                    <i style='color:#fff' class='fa fa-eye'></i>
                                </a>
                              </td>
                            </tr>
                          <?php
                            $no++;
                          }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <?php
                  }
                }
              }
            }
            ?>
        </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!--    /.row -->
</section><!-- /.content -->

<script>
  function toggleCheckboxes(checked) {
    var checkboxes = document.getElementsByName('nuptk[]');
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = checked;
    }
  }

  function checkIfAnyChecked() {
    var checkboxes = document.getElementsByName('nuptk[]');
    var submitButton = document.getElementById('submitButton');
    var submitButton2 = document.getElementById('submitButton2');
    var atLeastOneChecked = false;
    
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        atLeastOneChecked = true;
        break;
      }
    }
    
    submitButton.style.display = atLeastOneChecked ? '' : 'none';
    submitButton2.style.display = atLeastOneChecked ? '' : 'none';
  }
</script>


  