
  <section class="content-header">
    <h1>
      <i class="fa fa-history icon-title"></i> RIWAYAT
    </h1>
  </section>
<style>
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
                
          <?php
          if(isset($_GET['guru'])){
            $k=$_GET['guru'];
            $k=explode(',',$k);
            $nuptk=$k[0];
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

            $querystatus=mysqli_query($mysqli, "SELECT status,waktu_pengusulan,keterangan FROM pengusulan_sktp WHERE nuptk='$nuptk' AND periode='$_GET[periode]'");
            $datastatus=mysqli_fetch_assoc($querystatus);
            if(!empty($datastatus)){
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
                  </tbody>
                </table>
                <hr>
                  <ol class="progress-bar1">
                    <li class="is-complete"><span></span></li> 
                    <li <?php if($datastatus['status']=="S2" OR $datastatus['status']=="S3" OR $datastatus['status']=="S4" OR $datastatus['status']=="S5" OR $datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S1"){ echo 'class="is-complete is-hovered"'; } ?>><span>V1 (<?=$datastatus['keterangan']?>)</span></li> 
                    <li <?php if($datastatus['status']=="S3" OR $datastatus['status']=="S4" OR $datastatus['status']=="S5" OR $datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S2"){ echo 'class="is-complete is-hovered"'; } ?>><span>V2 (<?=$datastatus['keterangan']?>)</span></li> 
                    <li <?php if($datastatus['status']=="S4" OR $datastatus['status']=="S5" OR $datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S3"){ echo 'class="is-complete is-hovered"'; } ?>><span>V3 (<?=$datastatus['keterangan']?>)</span></li> 
                    <li <?php if($datastatus['status']=="S5" OR $datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S4"){ echo 'class="is-complete is-hovered"'; } ?>><span>V4 (<?=$datastatus['keterangan']?>)</span></li> 
                    <li <?php if($datastatus['status']=="S6"){ echo 'class="is-complete"'; }elseif($datastatus['status']=="S5"){ echo 'class="is-complete is-hovered"'; } ?>><span>V5 (<?=$datastatus['keterangan']?>)</span></li> 
                    <li <?php if($datastatus['status']=="S6"){ echo 'class="is-complete is-hovered"'; } ?>><span>V6 (Menunggu Pembayaran ± 2 Minggu)</span></li>  
                  </ol>
                <br>
                <h2><b>KETERANGAN</b></h2>
                <h3>V1 = Verifikasi 1 (Cabang Dinas / Bidang)</h3>
                <h3>V2 = Verifikasi 2 (Bidang GTK)</h3>
                <h3>V3 = Proses Pengajuan SKTP</h3>
                <h3>V4 = Menunggu proses pada SIMBAR</h3>
                <h3>V5 = Menunggu proses SPM (Bidang Keuangan)</h3>
                <h3>V6 = Selesai Pemberkasan Administrasi (Menunggu Pembayaran ± 2 Minggu)</h3>
                <?php
                if($datastatus['keterangan']=='Ditolak'){
                  if($datastatus['status']=='S1'){
                    $query_check_file=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE periode='$_GET[periode]' AND revisi_v1='1'");
                    if(mysqli_num_rows($query_check_file)>0){
                      ?>
                      <a href="?module=pengajuan&edit&id=<?=$nuptk?>&s=<?=$datastatus['status']?>&periode=<?=$_GET['periode']?>" style="width:max-content;" class="load btn btn-danger btn-submit">Unggah Perbaikan</a>
                      <?php
                    }else{
                      ?>
                      <div class="card p-4 bg-secondary">
                        <p class="text-light">Maaf, perbaikan V1 saat ini sedang ditutup. Terimakasih.</p>
                      </div>
                      <?php
                    }
                  }elseif($datastatus['status']=='S2'){
                    $query_check_file=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE periode='$_GET[periode]' AND revisi_v2='1'");
                    if(mysqli_num_rows($query_check_file)>0){
                      ?>
                      <a href="?module=pengajuan&edit&id=<?=$nuptk?>&s=<?=$datastatus['status']?>&periode=<?=$_GET['periode']?>" style="width:max-content;" class="load btn btn-danger btn-submit">Unggah Perbaikan</a>
                      <?php
                    }else{
                      ?>
                      <div class="card p-4 bg-secondary">
                        <p class="text-light">Maaf, perbaikan V2 saat ini sedang ditutup. Terimakasih.</p>
                      </div>
                      <?php
                    }
                  }else{
                    ?>
                    <div class="card p-4 bg-secondary">
                      <p class="text-light">Maaf, data tidak dikenali.</p>
                    </div>
                    <?php
                  }
                  ?>
                  <?php
                }
                ?>
              <?php
            }else{
              echo '<script>alert("Maaf, berkas dari guru tersebut belum dikirimkan. Silahkan lengkapi berkas terlebih dahulu.")</script>';
            }
          }else{
            if(isset($_GET['k'])){
              $kriwayat=$_GET['k'];
              if($kriwayat==1){//menunggu verif 1
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S1' AND keterangan='Menunggu Verifikasi'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==2){//ditolak verif 1
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S1' AND keterangan='Ditolak'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==3){//revisi verif 1
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S1' AND keterangan='Telah Direvisi'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==4){//menunggu verif 2
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S2' AND keterangan='Menunggu Verifikasi'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==5){//ditolak verif 2
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S2' AND keterangan='Ditolak'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==6){//revisi verif 2
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S2' AND keterangan='Telah Direvisi'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==7){//menunggu SIMTUN
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S3'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==8){//menunggu SIMBAR
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S4'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==9){//menunggu SPM
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S5'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
              }elseif($kriwayat==10){//selesai
                ?>
                <div class="container_tabel">
                  <div class="table-responsive">
                      <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">No.</th>
                            <th class="center">NAMA GURU</th>
                            <th class="center">NUPTK</th>
                            <th class="center">SEKOLAH</th>
                            <th class="center">GOLONGAN</th>
                            <th class="center">WAKTU PENGUSULAN</th>
                            <th class="center">STATUS</th>
                            <th class="center">PERIODE</th>
                            <th class="center">AKSI</th>
                          </tr> 
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                        <?php  
                        require_once 'vendor/autoload.php';
                        $no = 1;
                        $query=mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE id_sekolah='$_SESSION[id_sekolah]' AND status='S6'");
                        while($data=mysqli_fetch_assoc($query)){
                          $query2=mysqli_query($mysqli2, "SELECT nuptk,nama,nuptk,riwayat_kepangkatan_pangkat_golongan FROM ptk WHERE sekolah_id='$_SESSION[id_sekolah]' AND nuptk='$data[nuptk]'");
                          $data2=mysqli_fetch_assoc($query2);
                          $status=convertStatus($data['status']);
                          
                          $sklh=mysqli_query($mysqli2,"SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'");
                          $datasklh=mysqli_fetch_assoc($sklh);
                          ?>
                          <tr>
                            <td width='20' class='center'><?=$no?></td>
                            <td  class='center'><?=$data2['nama']?></td>
                            <td  class='center'><?=$data2['nuptk']?></td>
                            <td  class='center'><?=$datasklh['nama']?></td>
                            <td  class='center'><?=$data2['riwayat_kepangkatan_pangkat_golongan']?></td>
                            <td  class='center'><?=$data['waktu_pengusulan']?></td>
                            <td  class='center'><?=$data['keterangan']." ".$status?></td>
                            <td  class='center'><?=$data['periode']?></td>
                            <td class='center'>
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='load btn btn-danger btn-sm' href='?module=riwayat&guru=<?=$data['nuptk']?>&periode=<?=$data['periode']?>'>
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
          // }
          ?>
        <!-- </div>/.box -->
      <!-- </div>/.col -->
    <!-- </div>   /.row -->
  </section><!-- /.content -->


  