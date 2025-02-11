
  <section class="content-header">
    <h1>
      <i class="fa fa-book icon-title"></i> BERKAS
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
  </Style>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger" style="padding:10px;">
          <!-- disini -->
          <?php
          if(isset($_GET['id'])){
            $periode=$_GET['periode'];
            $nuptk=$_GET['id'];
            $queryguru=mysqli_query($mysqli2,"SELECT * FROM ptk WHERE nuptk like '%$nuptk'");
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

            $query=mysqli_query($mysqli,"SELECT * FROM pengusulan_sktp WHERE nuptk='$nuptk'");
            $data=mysqli_fetch_assoc($query);
            $query2=mysqli_query($mysqli2,"SELECT nama FROM ptk WHERE nuptk like '%$nuptk'");
            $data2=mysqli_fetch_assoc($query2);
            $status=convertStatus($data['status']);
            $cek=0;
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
              <div class="container_tabel">
                <div class="table-responsive">
                  <table id="dataTables1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th width="1" class="text-center">NO.</th>
                        <th class="text-center">BERKAS</th>
                        <th class="text-center">AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
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
                          <tr>
                            <?php 
                            $query_jurnal=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='jurnal'");
                            $data_jurnal=mysqli_fetch_assoc($query_jurnal);
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>LINK JURNAL</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=JURNAL'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                        if($data_periode['pks']){
                          $no++;
                          ?>
                          <tr>
                            <?php 
                            $query_pks=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='pks'");
                            $data_pks=mysqli_fetch_assoc($query_pks);
                            if(isset($data_pks['nama_berkas'])){
                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-check-square"></i>';
                            }else{
                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-times"></i>';
                              $belumkomplit=1;
                            }
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>SPTJM KEPALA SEKOLAH</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SPTJM KEPALA SEKOLAH'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                        if($data_periode['info_gtk']){
                          $no++;
                          ?>
                          <tr>
                            <?php 
                            $query_info_gtk=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='info_gtk'");
                            $data_info_gtk=mysqli_fetch_assoc($query_info_gtk);
                            if(isset($data_info_gtk['nama_berkas'])){
                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-check-square"></i>';
                            }else{
                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-times"></i>';
                              $belumkomplit=1;
                            }
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>INFO GTK</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=INFO GTK'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                        if($data_periode['sk_pembagian']){
                          $no++;
                          ?>
                          <tr>
                            <?php 
                            $query_sk_pembagian=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='sk_pembagian'");
                            $data_sk_pembagian=mysqli_fetch_assoc($query_sk_pembagian);
                            if(isset($data_sk_pembagian['nama_berkas'])){
                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-check-square"></i>';
                            }else{
                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-times"></i>';
                              $belumkomplit=1;
                            }
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>SK PEMBAGIAN TUGAS</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SK PEMBAGIAN TUGAS'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                        if($data_periode['skpa']){
                          $no++;
                          ?>
                          <tr>
                            <?php 
                            $query_skpa=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='skpa'");
                            $data_skpa=mysqli_fetch_assoc($query_skpa);
                            if(isset($data_skpa['nama_berkas'])){
                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-check-square"></i>';
                            }else{
                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-times"></i>';
                              $belumkomplit=1;
                            }
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>SK PANGKAT AKHIR</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SK PANGKAT AKHIR'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                        if($data_periode['skba']){
                          $no++;
                          ?>
                          <tr>
                            <?php 
                            $query_skba=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='skba'");
                            $data_skba=mysqli_fetch_assoc($query_skba);
                            if(isset($data_skba['nama_berkas'])){
                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-check-square"></i>';
                            }else{
                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-times"></i>';
                              $belumkomplit=1;
                            }
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>SK BERKALA AKHIR</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=SK BERKALA AKHIR'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                        if($data_periode['pg']){
                          $no++;
                          ?>
                          <tr>
                            <?php 
                            $query_pg=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='pg'");
                            $data_pg=mysqli_fetch_assoc($query_pg);
                            if(isset($data_pg['nama_berkas'])){
                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-check-square"></i>';
                            }else{
                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-times"></i>';
                              $belumkomplit=1;
                            }
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>PROFIL GURU</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=PROFIL GURU'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                        if($data_periode['absen']){
                          $no++;
                          ?>
                          <tr>
                            <?php 
                            $query_absen=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='absen'");
                            $data_absen=mysqli_fetch_assoc($query_absen);
                            if(isset($data_absen['nama_berkas'])){
                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-check-square"></i>';
                            }else{
                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-times"></i>';
                              $belumkomplit=1;
                            }
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>ABSEN</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=ABSEN'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                        if($data_periode['lainnya']){
                          $no++;
                          ?>
                          <tr>
                            <?php 
                            $query_lainnya=mysqli_query($mysqli,"SELECT nama_berkas FROM pengusulan_sktp_sementara WHERE periode='$periode' AND nuptk='$nuptk' AND jenis='lainnya'");
                            $data_lainnya=mysqli_fetch_assoc($query_lainnya);
                            if(isset($data_lainnya['nama_berkas'])){
                              $nama_berkas="TELAH MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-check-square"></i>';
                            }else{
                              $nama_berkas="BELUM MENGUNGGAH BERKAS";
                              $icon='<i class="fa fa-times"></i>';
                              $belumkomplit=1;
                            }
                            ?>
                            <td class="text-center" ><?=$no?></td>
                            <td>BERKAS LAINNYA</td>
                            <td class="text-center">
                              <a data-toggle='tooltip' data-placement='top' title='Lihat' class='btn btn-danger btn-sm' href='?module=pengajuan_file&id=<?=$nuptk?>&periode=<?=$periode?>&jenis=LAINNYA'>
                                  <i style='color:#fff' class='fa fa-eye'></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>

                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <?php
          }
          ?>
          <hr>
          <div class="text-right">
            <?php
              if($_SESSION['kode_akses']==2 && $data['status']=="S5"){
                ?>
                <a href="modules/berkas_terverifikasi/proses.php?periode=<?=$periode?>&selesai&id=<?=$nuptk?>" class="load btn btn-success" onclick="return confirm('Apakah Anda yakin proses pengajuan telah selesai?');"><i style='color:#fff' class='fa fa-check'></i> SELESAI</a>
                <?php
              }
            ?>  
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!--    /.row -->
  </section><!-- /.content -->



  