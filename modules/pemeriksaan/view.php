
  <?php
  if(isset($_GET['k'])){
    if($_GET['k']==1){
      $s="MENUNGGU VERIFIKASI";
    }elseif($_GET['k']==2){
      $s="DITOLAK";
    }elseif($_GET['k']==3){
      $s="TELAH DIREVISI";
    }else{
      $s="";
    }
  }
  ?>
  <section class="content-header">
    <h1>
      <i class="fa fa-book icon-title"></i> BERKAS <?=$s?>
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

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <div class="box box-danger" style="padding:10px;">
            <!-- disini -->
            <?php
            if(!isset($_GET['periode'])){
              ?>                    
                <form id="form1" role="form" class="form-horizontal" method="GET" action=""  enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Periode</label>
                    <div class="col-sm-5">
                      <input type="hidden" name="module" value="pemeriksaan">
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
              if($_SESSION['kode_akses']==1){
                if(isset($_GET['k'])){
                  if($_GET['k']==1){//(Keterangan) Menunggu Verifikasi
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                          <!-- tampilan tabel header -->
                          <thead>
                            <tr>
                              <th class="center">NO.</th>
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
                          $cabdin=explode('-',$_SESSION['cabdin']);
                          $kab1=$cabdin[0];
                          if(isset($cabdin[1])){
                            $query_tambahan="AND bentuk_pendidikan='$cabdin[1]'";
                          }else{
                            $query_tambahan="";
                          }
                          $no = 1;
                          $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE 
                                                                                            periode='$_GET[periode]' AND 
                                                                                            status='S1' AND 
                                                                                            keterangan='Menunggu Verifikasi' AND
                                                                                            kabupaten='$kab1'
                                                                                            ORDER BY waktu_pengusulan ASC")
                                                          or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));
                          while($data=mysqli_fetch_assoc($query)){
                            $status=convertStatus($data['status']);
                            $query2=mysqli_query($mysqli,"SELECT nama FROM sekolah WHERE npsn='$data[id_sekolah]' $query_tambahan");
                            if(mysqli_num_rows($query2)>0){
                              $data2=mysqli_fetch_assoc($query2);
                              ?>
                              <tr>
                                <td width='20' class='center'><?=$no?></td>
                                <td  class='center'><?=$data['nama_guru']?></td>
                                <td  class='center'><?=$data2['nama']?></td>
                                <td  class='center'><?=$data['nuptk']?></td>
                                <td  class='center'><?=$data['waktu_pengusulan']?></td>
                                <td  class='center'><?=$data['keterangan']." ".$status?></td>
                                <td  class='center'><?=$data['periode']?></td>
                                <td class='center'>
                                  <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pemeriksaan_form&id=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
                                      <i style='color:#fff' class='fa fa-eye'></i>
                                  </a>
                                </td>
                              </tr>      
                              <?php
                              $no++;
                            }
                          }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <?php
                  }elseif($_GET['k']==2){//(Keterangan) Ditolak
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                          <!-- tampilan tabel header -->
                          <thead>
                            <tr>
                              <th class="center">NO.</th>
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
                          $cabdin=explode('-',$_SESSION['cabdin']);
                          $kab1=$cabdin[0];
                          if(isset($cabdin[1])){
                            $query_tambahan="AND bentuk_pendidikan='$cabdin[1]'";
                          }else{
                            $query_tambahan="";
                          }
                          $no = 1;
                          $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE 
                                                                                            periode='$_GET[periode]' 
                                                                                            AND status='S1'
                                                                                            AND keterangan='Ditolak' 
                                                                                        ORDER BY waktu_pengusulan ASC")
                                                          or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));
                          while($data=mysqli_fetch_assoc($query)){
                            $status=convertStatus($data['status']);
                            $query2=mysqli_query($mysqli,"SELECT nama FROM sekolah WHERE npsn='$data[id_sekolah]' $query_tambahan");
                            if(mysqli_num_rows($query2)>0){
                              $data2=mysqli_fetch_assoc($query2);
                              ?>
                              <tr>
                                <td width='20' class='center'><?=$no?></td>
                                <td  class='center'><?=$data['nama_guru']?></td>
                                <td  class='center'><?=$data2['nama']?></td>
                                <td  class='center'><?=$data['nuptk']?></td>
                                <td  class='center'><?=$data['waktu_pengusulan']?></td>
                                <td  class='center'><?=$data['keterangan']." ".$status?></td>
                                <td  class='center'><?=$data['periode']?></td>
                                <td class='center'>
                                  <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pemeriksaan_form&id=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
                                      <i style='color:#fff' class='fa fa-eye'></i>
                                  </a>
                                </td>
                              </tr>      
                              <?php
                              $no++;
                            }
                          }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <?php
                  }elseif($_GET['k']==3){//(Keterangan) Direvisi
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
                              <th class="center">GOLONGAN</th>
                              <th class="center">WAKTU PENGUSULAN</th>
                              <th class="center">STATUS</th>
                              <th class="center">AKSI</th>
                            </tr> 
                          </thead>
                          <!-- tampilan tabel body -->
                          <tbody>
                          <?php  
                          $cabdin=explode('-',$_SESSION['cabdin']);
                          $kab1=$cabdin[0];
                          if(isset($cabdin[1])){
                            $query_tambahan="AND bentuk_pendidikan='$cabdin[1]'";
                          }else{
                            $query_tambahan="";
                          }
                          $no = 1;
                          $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE 
                                                                                              periode='$_GET[periode]' 
                                                                                              AND status='S1'
                                                                                              AND keterangan='Telah Direvisi' 
                                                                                        ORDER BY waktu_pengusulan ASC")
                                                          or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));
                          while($data=mysqli_fetch_assoc($query)){
                            $status=convertStatus($data['status']);
                            $query2=mysqli_query($mysqli,"SELECT nama FROM sekolah WHERE npsn='$data[id_sekolah]' $query_tambahan");
                            if(mysqli_num_rows($query2)>0){
                              $data2=mysqli_fetch_assoc($query2);
                              ?>
                              <tr>
                                <td width='20' class='center'><?=$no?></td>
                                <td  class='center'><?=$data['nama_guru']?></td>
                                <td  class='center'><?=$data2['nama']?></td>
                                <td  class='center'><?=$data['nuptk']?></td>
                                <td  class='center'><?=$data['waktu_pengusulan']?></td>
                                <td  class='center'><?=$data['keterangan']." ".$status?></td>
                                <td  class='center'><?=$data['periode']?></td>
                                <td class='center'>
                                  <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pemeriksaan_form&id=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
                                      <i style='color:#fff' class='fa fa-eye'></i>
                                  </a>
                                </td>
                              </tr>      
                              <?php
                              $no++;
                            }
                          }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <?php
                  }
                }
              }elseif($_SESSION['kode_akses']==2){
                if(isset($_GET['k'])){
                  if($_GET['k']==1){//(Keterangan) Menunggu Verifikasi
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                      <form role="form" class="form-horizontal" method="POST" action="modules/pemeriksaan/proses.php?terima_check&periode=<?=$_GET['periode']?>" enctype="multipart/form-data">
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                          <!-- tampilan tabel header -->
                          <thead>
                            <tr>
                              <th class="text-center"><input type="checkbox" id="checkAll" onchange="toggleCheckboxes(this.checked); checkIfAnyChecked();"></th>
                              <th class="text-center">NAMA GURU</th>
                              <th class="text-center">SEKOLAH</th>
                              <th class="text-center">NUPTK</th>
                              <th class="text-center">WAKTU PENGUSULAN</th>
                              <th class="text-center">STATUS</th>
                              <th class="text-center">PERIODE</th>
                              <th class="text-center">AKSI</th>
                            </tr> 
                          </thead>
                          <!-- tampilan tabel body -->
                          <tbody>
                          <?php  
                          $no = 1;
                          $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE periode='$_GET[periode]' AND status='S2' AND (keterangan='Menunggu Verifikasi') ORDER BY waktu_pengusulan DESC")
                                                          or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));
      
                          while ($data = mysqli_fetch_assoc($query)) {
                            $status=convertStatus($data['status']); 
                            $keterangan=$data['keterangan']; 
                            $querysklh = mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE npsn='$data[id_sekolah]'")
                                                          or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            $datasklh = mysqli_fetch_assoc($querysklh);
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
                                <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pemeriksaan_form&id=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
                              <input type="submit" id="submitButton" class="btn btn-success" name="simpan" value="TERIMA BERKAS" onclick="return confirm('Berkas yang dipilih akan diterima. Lanjutkan?');" style="display: none;">
                            </div>
                          </div>
                        </div>
                      </form>
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
                          var atLeastOneChecked = false;
                          
                          for (var i = 0; i < checkboxes.length; i++) {
                            if (checkboxes[i].checked) {
                              atLeastOneChecked = true;
                              break;
                            }
                          }
                          
                          submitButton.style.display = atLeastOneChecked ? 'block' : 'none';
                        }
                      </script>
                      </div>
                    </div>
                    <?php
                  }elseif($_GET['k']==2){//(Keterangan) Ditolak
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                          <!-- tampilan tabel header -->
                          <thead>
                            <tr>
                              <th class="center">NO.</th>
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
                          $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE periode='$_GET[periode]' AND status='S2' AND (keterangan='Ditolak') ORDER BY waktu_pengusulan DESC")
                                                          or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));
      
                          while ($data = mysqli_fetch_assoc($query)) {
                            $status=convertStatus($data['status']); 
                            $keterangan=$data['keterangan']; 
                            $querysklh = mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE npsn='$data[id_sekolah]'")
                                                          or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            $datasklh = mysqli_fetch_assoc($querysklh);
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
                                <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pemeriksaan_form&id=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
                  }elseif($_GET['k']==3){//(Keterangan) Direvisi
                    ?>
                    <div class="container_tabel">
                      <div class="table-responsive">
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                          <!-- tampilan tabel header -->
                          <thead>
                            <tr>
                              <th class="center">NO.</th>
                              <th class="center">NAMA GURU</th>
                              <th class="center">SEKOLAH</th>
                              <th class="center">NUPTK</th>
                              <th class="center">GOLONGAN</th>
                              <th class="center">WAKTU PENGUSULAN</th>
                              <th class="center">STATUS</th>
                              <th class="center">AKSI</th>
                            </tr> 
                          </thead>
                          <!-- tampilan tabel body -->
                          <tbody>
                          <?php  
                          $no = 1;
                          $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE periode='$_GET[periode]' AND status='S2' AND (keterangan='Telah Direvisi') ORDER BY waktu_pengusulan DESC")
                                                          or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));
      
                          while ($data = mysqli_fetch_assoc($query)) {
                            $status=convertStatus($data['status']); 
                            $keterangan=$data['keterangan']; 
                            $querysklh = mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE npsn='$data[id_sekolah]'")
                                                          or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                            $datasklh = mysqli_fetch_assoc($querysklh);
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
                                <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-primary btn-sm' href='?module=pemeriksaan_form&id=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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


  