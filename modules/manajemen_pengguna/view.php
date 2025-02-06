<section class="content-header">
    <h1>
      <i class="fa fa-user icon-title"></i> Manajemen Pengguna
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
</Style>

<?php
if(isset($_GET['alert'])){
  $alert=$_GET['alert'];
  if($alert==1){
    echo '<script>alert("Akun pengguna berhasil di Blokir.")</script>';
  }elseif($alert==2){
    echo '<script>alert("Akun pengguna gagal di Blokir. Periksa kembali koneksi anda.")</script>';
  }elseif($alert==3){
    echo '<script>alert("Akun pengguna berhasil di Aktifkan kembali.")</script>';
  }elseif($alert==4){
    echo '<script>alert("Akun pengguna gagal di Aktifkan. Periksa kembali koneksi anda.")</script>';
  }elseif($alert==5){
    echo '<script>alert("Akun pengguna berhasil di Reset.")</script>';
  }elseif($alert==6){
    echo '<script>alert("Akun pengguna gagal di Reset. Periksa kembali koneksi anda.")</script>';
  }elseif($alert==7){
    echo '<script>alert("Akun pengguna berhasil di Buat.")</script>';
  }elseif($alert==8){
    echo '<script>alert("Akun pengguna gagal di Buat. Periksa kembali koneksi anda.")</script>';
  }
}
?>
          
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <a href="?module=form_manajemen_pengguna&add" class="btn btn-primary" ><i style='color:#fff' class='fa fa-user-plus'></i> TAMBAH PENGGUNA</a>
        </div>
          <div class="box box-danger" style="padding:10px;">
            <!-- disini -->
  
              <div class="container_tabel">
                <div class="table-responsive">
                  <table id="dataTable" class="table table-bordered table-striped table-hover">
                    <!-- tampilan tabel header -->
                    <thead>
                      <tr>
                        <th class="center">No.</th>
                        <th class="center">ID AKUN</th>
                        <th class="center">NAMA PENGGUNA</th>
                        <th class="center">NAMA LENGKAP</th>
                        <th class="center">TIPE PENGGUNA</th>
                        <th class="center">AKSI</th>
                      </tr> 
                    </thead>
                    <!-- tampilan tabel body -->
                    <tbody>
                    <?php  
                    $no = 1;
                    $query = mysqli_query($mysqli, "SELECT * FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE kode_akses!=0 AND kode_akses IN ('3','2','1') ORDER BY kode_akses ASC")
                                                    or die('Ada kesalahan pada query tampil Data Masuk: '.mysqli_error($mysqli));
                    while ($data = mysqli_fetch_assoc($query)) { 
                      ?>
                      <tr>
                        <td width='20' class='center'><?=$no?></td>
                        <td  class='center'><?=$data['id_akun']?></td>
                        <td  class='center'><?=$data['nama_pengguna']?> (Kata Sandi Default: 123456)</td>
                        <td  class='center'><?=$data['nama_lengkap']?></td>
                        <td  class='center'><?=convertKodeAkses($data['kode_akses'])?> <?=$data['nama_sekolah']?></td>
                        <td class='center'>
                          <?php
                          if($data['status']=='blokir'){
                            ?><a href="modules/manajemen_pengguna/proses.php?aktif&id=<?=$data['id_akun']?>" class="btn btn-success" title="Buka Blokir Akun Pengguna"><i class="fa fa-check" aria-hidden="true"></i></a><?php
                          }else{
                            ?><a href="modules/manajemen_pengguna/proses.php?blok&id=<?=$data['id_akun']?>" class="btn btn-danger" title="Blokir Akun Pengguna"><i class="fa fa-times" aria-hidden="true"></i></a><?php
                          }
                          ?>
                          <a href="modules/manajemen_pengguna/proses.php?reset&id=<?=$data['id_akun']?>" class="btn btn-primary" title="Reset Akun Pengguna"><i class="fa fa-undo" aria-hidden="true"></i></a>
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
              
          </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!--    /.row -->
  </section><!-- /.content -->


  