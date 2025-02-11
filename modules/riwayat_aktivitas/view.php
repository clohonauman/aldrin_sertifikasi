
  <section class="content-header">
    <h1>
      <i class="fa fa-history icon-title"></i> RIWAYAT AKTIVITAS
    </h1>
  </section>
  <hr>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <div class="box box-danger" style="padding:10px;">
            <!-- disini -->
            <?php
            if($_SESSION['kode_akses']==0 OR $_SESSION['kode_akses']==7){
              ?>
              <table id="dataTable" class="table table-bordered table-striped table-hover">
                <!-- tampilan tabel header -->
                <thead>
                  <tr>
                    <th class="center">NO.</th>
                    <th class="center">KODE PENGAJUAN BERKAS</th>
                    <th class="center">WAKTU</th>
                    <th class="center">NAMA BERKAS</th>
                    <th class="center">EKSEKUTOR</th>
                    <th class="center">JENIS TINDAKAN</th>
                  </tr> 
                </thead>
                <!-- tampilan tabel body -->
                <tbody>
                <?php  
                $no = 1;
                $query = mysqli_query($mysqli, "SELECT * FROM log_aktifitas ORDER BY waktu DESC LIMIT 1000")
                                                or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

                while ($data = mysqli_fetch_assoc($query)) {
                  $queryuser = mysqli_query($mysqli, "SELECT * FROM akun INNER JOIN peran ON peran.id_akun=akun.id_akun WHERE akun.id_akun='$data[id_akun]' AND kode_akses IN (0, 1, 2, 3, 4, 7)")
                                                or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

                  if(mysqli_num_rows($queryuser)>0){
                    $datauser=mysqli_fetch_assoc($queryuser);
                    $detail=explode(",",$data['keterangan']);
                    $aksi=$detail[0];
                    if(isset($detail[1])){ $nama_file=$detail[1]; }else{ $nama_file="-"; }
                    ?>
                    <tr>
                      <td width='20' class='center'><?=$no?></td>
                      <td width='150' class='center'><?=$data['id_pengusulan_sktp']?></td>
                      <td width='200' class='center'><?=$data['waktu']?></td>
                      <td width='350' class='center'><?=$nama_file?></td>
                      <td width='150' class='center'><?=$datauser['nama_lengkap']?></td>
                      <td width='200' class='center'><?=$aksi?></td>
                    </tr>
                    <?php
                    $no++;
                  }
                }
                ?>
                </tbody>
              </table>
              <?php
            }elseif($_SESSION['kode_akses']==2){
              ?>
              <table id="dataTable" class="table table-bordered table-striped table-hover">
                <!-- tampilan tabel header -->
                <thead>
                  <tr>
                    <th class="center">No.</th>
                    <th class="center">WAKTU PENGUSULAN</th>
                    <th class="center">SEKOLAH</th>
                    <th class="center">NUPTK</th>
                    <th class="center">NAMA GURU</th>
                    <th class="center">AKSI</th>
                  </tr> 
                </thead>
                <!-- tampilan tabel body -->
                <tbody>
                <?php  
                require_once 'vendor/autoload.php';
                $no = 1;
                $query = mysqli_query($mysqli, "SELECT * FROM pengusulan_sktp WHERE status='S3' OR status='S4' ORDER BY waktu_pengusulan DESC")
                                                or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

                while ($data = mysqli_fetch_assoc($query)) { 
                  $querysklh = mysqli_query($mysqli2, "SELECT nama FROM sekolah WHERE sekolah_id='$data[id_sekolah]'")
                                                or die('Ada kesalahan pada query : '.mysqli_error($mysqli));
                  $datasklh = mysqli_fetch_assoc($querysklh);
                  ?>
                  <tr>
                    <td width='20' class='center'><?=$no?></td>
                    <td  class='center'><?=$data['waktu_pengusulan']?></td>
                    <td  class='center'><?=$datasklh['nama']?></td>
                    <td  class='center'><?=$data['nuptk']?></td>
                    <td  class='center'><?=$data['nama_guru']?></td>
                    <td class='center'>
                      <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pemeriksaan_form&id=<?=$data['nuptk']?>'>
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
              <?php
            }
            ?>
          </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!--    /.row -->
  </section><!-- /.content -->


  