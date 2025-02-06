
  <section class="content-header">
    <h1>
      <i class="fa fa-globe icon-title"></i> PENGGUNA SEDANG AKTIF
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
            if($_SESSION['kode_akses']==0){
              ?>
              <div class="table-responsive">
                <table id="dataTables1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">NO.</th>
                      <th class="text-center">WAKTU MASUK</th>
                      <th class="text-center">NAMA LENGKAP</th>
                      <th class="text-center">ALAMAT IP</th>
                      <th class="text-center">JENIS PERANGKAT</th>
                      <th class="text-center">BROWSER</th>
                      <th class="text-center">LOKASI</th>
                      <th class="text-center">PERAN</th>
                    </tr> 
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                    $query=mysqli_query($mysqli,"SELECT
                                                            a.nama_lengkap AS full_name,
                                                            s.ip_address, 
                                                            s.device_type, 
                                                            s.browser_info, 
                                                            s.device_id, 
                                                            s.location,
                                                            s.token, 
                                                            s.kode_akses, 
                                                            s.waktu AS login_time
                                                        FROM 
                                                            session AS s
                                                        INNER JOIN 
                                                            akun AS a ON s.id_akun = a.id_akun
                                                        WHERE 
                                                            s.app_id='ALDRIN_SERTIFIKASI-01234'
                                                        ORDER BY s.id DESC
                                                          ");
                    while($data=mysqli_fetch_assoc($query)){
                      ?>
                      <tr>
                        <td width='20' class='text-center'><?=$no?></td>
                        <td width='200' class='text-center'><?=$data['login_time']?></td>
                        <td width='150' class='text-center'><?=$data['full_name']?></td>
                        <td width='150' class='text-center'><?=$data['ip_address']?></td>
                        <td width='150' class='text-center'><?=$data['device_type']?></td>
                        <td width='150' class='text-center'><?=$data['browser_info']?></td>
                        <td width='300' class='text-left'><?=$data['location'] = str_replace("->", "<br>", $data['location'])?></td>
                        <td width='150' class='text-center'><?=convertKodeAkses($data['kode_akses'])?></td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                  </tbody>                
                </table>
              </div>
              <?php
              }
            ?>
          </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!--    /.row -->
  </section><!-- /.content -->


  