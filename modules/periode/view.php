<style>
    /* Styling the container */
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    /* Hiding the default checkbox */
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    /* Styling the slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: 0.4s;
      border-radius: 34px;
    }

    /* The circle inside the slider */
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      border-radius: 50%;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: 0.4s;
    }

    /* When the checkbox is checked, change the background and move the circle */
    input:checked + .slider {
      background-color: #4CAF50;
    }

    input:checked + .slider:before {
      transform: translateX(26px);
    }

    /* Add a "on" and "off" label */
    .slider:after {
      content: 'OFF';
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      font-size: 12px;
      color: white;
    }

    input:checked + .slider:after {
      content: 'ON';
      left: 35px;
    }

  </style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-cog icon-title"></i> Pengaturan Periode
  </h1>
</section>

<?php
if(isset($_GET['alert'])){
  $alert=$_GET['alert'];
  if($alert==200){
    echo '<script>alert("Permintaan berhasil diproses.")</script>';
  }elseif($alert==500){
    echo '<script>alert("Terjadi kesalahan pada saat melakukan permintaan. Silahkan coba lagi kembali.")</script>';
  }elseif($alert==409){
    echo '<script>alert("Permintaan tidak diketahui. Silahkan coba lagi kembali.")</script>';
  }elseif($alert==403){
    echo '<script>alert("Permintaan tidak diizinkan.")</script>';
  }
}
?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12 text-right">
      <a href="?module=periode&add" class="btn btn-danger text-right"><i class="fa fa-plus"></i> Periode Baru</a>
      <hr>
    </div>
    <div class="col-md-12">
      <?php 
      if(!isset($_GET['periode']) AND !isset($_GET['add'])){ 
        ?>
        <form id="form1" role="form" class="form-horizontal" method="GET" action=""  enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-sm-2 control-label">Periode</label>
            <div class="col-sm-5">
              <input type="hidden" name="module" value="periode">
              <select id="periode" name="periode" class="form-control" data-placeholder="PILIH PERIODE YANG AKAN DIUBAH" autocomplete="off" required>
                  <option disabled selected>--PILIH PERIODE YANG AKAN DIUBAH--</option>
                  <?php
                  $query=mysqli_query($mysqli, "SELECT * FROM periode_sipgtk");
                  while($data=mysqli_fetch_assoc($query)){
                  ?>
                    <option value="<?=$data['periode']?>">Periode <?=$data['periode']?> | <?= $data['status'] ? '<i class="fa fa-lock"></i> TERKUNCI' : '<i class="fa fa-unlock"></i> BELUM TERKUNCI' ?></option>
                  <?php
                  }
                  ?>
              </select>
              <p class="text-red">*Pilih periode yang akan diubah.</p>
            </div>
          </div>
          <div class="box-footer bg-btn-action">
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input id="submitButton" type="submit" class="load btn btn-danger btn-submit" name="simpan" value="Lanjutkan" disabled>
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
      }elseif(!isset($_GET['periode']) AND isset($_GET['add'])){
        ?>
        <form id="form4" role="form" class="form-horizontal" method="POST" action="modules/periode/proses.php?baru"  enctype="multipart/form-data">
          <div class="form">
            <div class="container_tabel">
              <div class="table-responsive">
                <table id="dataTables1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th width="10" class="text-center">NO.</th>
                      <th width="300" class="text-center">BERKAS</th>
                      <th width="50" class="text-center">STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td>LINK JURNAL</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle" 
                              name="jurnal"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">2</td>
                        <td>SPTJM KEPALA SEKOLAH</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle" 
                              name="pks"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">3</td>
                        <td>INFO GTK</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle-gtk" 
                              name="info_gtk"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">4</td>
                        <td>SK PEMBAGIAN TUGAS</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle-pembagian" 
                              name="sk_pembagian"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">5</td>
                        <td>SK PANGKAT AKHIR</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle" 
                              name="skpa"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">6</td>
                        <td>SK BERKALA AKHIR</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle" 
                              name="skba"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">7</td>
                        <td>PROFIL GURU</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle" 
                              name="pg"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">8</td>
                        <td>ABSEN</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle" 
                              name="absen"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">9</td>
                        <td>BERKAS LAINNYA</td>
                        <td class="text-center">
                          <label class="switch">
                            <input 
                              type="checkbox" 
                              class="toggle" 
                              name="lainnya"
                            >
                            <span class="slider round"></span>
                          </label>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <hr>
            <div class="box-footer bg-btn-action text-left">
              <div class="form-group">
                <div class="col-sm-12">
                  <button onclick="return confirm('Jika sudah disimpan masih bisa diubah tapi sudah tidak bisa dihapus. Lanjutkan?')" type="submit" class="btn btn-danger">SIMPAN</button>
                  <a href="?module=periode" class="btn btn-light">KEMBALI</a>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
      }else{
        $periode=mysqli_real_escape_string($mysqli,$_GET['periode']);
        $no=0;
        $query=mysqli_query($mysqli,"SELECT * FROM periode_sipgtk WHERE periode='$periode'");
        if(mysqli_num_rows($query)>0){
          $data=mysqli_fetch_assoc($query);
          ?>
          <div class="card p-4 rounded bg-secondary col-md-12 mb-4">
            <p class="text-light"><b>NAMA PERIODE : </b> PERIODE <?=$data['periode']?></p>
            <p class="text-light"><b>STATUS : </b> <?= $data['status'] ? '<i class="fa fa-lock"></i> TERKUNCI' : '<i class="fa fa-unlock"></i> BELUM TERKUNCI' ?></p>
          </div>
          <h3><i class="fa fa-list"></i> DAFTAR MODULE</h3>
          <form id="form3" role="form" class="form-horizontal" method="POST" action="modules/periode/proses.php?periode=<?=$periode?>"  enctype="multipart/form-data">
            <div class="form">
              <div class="container_tabel">
                <div class="table-responsive">
                  <table id="dataTables1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th width="10" class="text-center">NO.</th>
                        <th width="300" class="text-center">MODULE</th>
                        <th width="50" class="text-center">STATUS</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td class="text-center">1</td>
                          <td>USUL BARU</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="usul_baru"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['usul_baru'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">2</td>
                          <td>REVISI V1</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="revisi_v1"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['revisi_v1'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">3</td>
                          <td>REVISI V2</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle-gtk" 
                                name="revisi_v2"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['revisi_v2'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="box-footer bg-btn-action text-left">
                <div class="form-group">
                  <div class="col-sm-12">
                    <button type="submit" name="edit_module" class="btn btn-danger">SIMPAN</button>  
                    <a href="?module=periode" class="btn btn-light">KEMBALI</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <hr>
          <h3><i class="fa fa-book"></i> DAFTAR BERKAS</h3>
          <form id="form4" role="form" class="form-horizontal" method="POST" action="modules/periode/proses.php?periode=<?=$periode?>"  enctype="multipart/form-data">
            <div class="form">
              <div class="container_tabel">
                <div class="table-responsive">
                  <table id="dataTables1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th width="10" class="text-center">NO.</th>
                        <th width="300" class="text-center">BERKAS</th>
                        <th width="50" class="text-center">STATUS</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td class="text-center">1</td>
                          <td>LINK JURNAL</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="jurnal"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['jurnal'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">2</td>
                          <td>SPTJM KEPALA SEKOLAH</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="pks"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['pks'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">3</td>
                          <td>INFO GTK</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle-gtk" 
                                name="info_gtk"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['info_gtk'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">4</td>
                          <td>SK PEMBAGIAN TUGAS</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle-pembagian" 
                                name="sk_pembagian"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['sk_pembagian'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">5</td>
                          <td>SK PANGKAT AKHIR</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="skpa"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['skpa'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">6</td>
                          <td>SK BERKALA AKHIR</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="skba"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['skba'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">7</td>
                          <td>PROFIL GURU</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="pg"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['pg'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">8</td>
                          <td>ABSEN</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="absen"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['absen'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">9</td>
                          <td>BERKAS LAINNYA</td>
                          <td class="text-center">
                            <label class="switch">
                              <input 
                                type="checkbox" 
                                class="toggle" 
                                name="lainnya"
                                data-id="<?= $data['id'] ?>" 
                                <?= $data['lainnya'] ? 'checked' : '' ?>
                              >
                              <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="box-footer bg-btn-action text-left">
                <div class="form-group">
                  <i class="text-danger">* Apabila sudah TERKUNCI, maka tidak bisa diubah kembali.</i>
                  <hr>
                  <div class="col-sm-12">
                    <button type="submit" name="edit" class="btn btn-danger">SIMPAN</button>  
                    <button type="submit" onclick="return confirm('Jika sudah dikunci maka akan langsung aktif pada pengguna dan tidak dapat dihapus atau diubah lagi. Lanjutkan?')" name="kunci" class="btn btn-warning <?= $data['status'] ? 'disabled' : '' ?>" <?= $data['status'] ? 'disabled' : '' ?>>KUNCI</button>
                    <a href="?module=periode" class="btn btn-light">KEMBALI</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <?php
        }
      }
      ?>
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->