<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $idnama = $_POST['id'];
  $page1 = "det";
  $page = "Detail Pasien : " . $idnama;
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$idnama'");
  $pasien = mysqli_fetch_array($cek);
  $idid = $pasien['id'];
  ?>


</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/navbar.php';
      include 'part/sidebar.php';
      include 'part_func/umur.php';
      include 'part_func/tgl_ind.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Detail Pegawai</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="pasien.php">Data Pegawai</a></div>
              <div class="breadcrumb-item">Detail Pasien : <?php echo ucwords($idnama); ?></div>
            </div>
          </div>

          <div class="section-body">
            <?php include 'part/info_pasien.php'; ?>

            <div class="section-body">
              <div class="row">
                <div class="col-12 col-sm-6 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Info Pasien</h4>
                      <div class="card-header-action">
                        <form method="POST" action="print.php" target="_blank">
                          <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                          <?php
                          $cekrekam = mysqli_num_rows($rekam);
                          if ($cekrekam == 0) {
                            echo '';
                          } else {
                            echo '<button type="submit" class="btn btn-primary" name="printall">Print Semua</button> &emsp;';
                          } ?>
                          
                        </form>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="gallery">
                        <table class="table table-striped table-sm">
                          <tbody>
                            <tr>
                              <th scope="row">Nama Lengkap</th>
                              <td> : <?php echo ucwords($idnama); ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Tanggal Lahir</th>
                              <td> : <?php echo tgl_indo($pasien['tgl']); ?></td>
                            </tr>
                            <tr>
                              <th scope="row">NIP</th>
                              <td> : <?php echo ucwords ($pasien['nip']); ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Jabatan</th>
                              <td> : <?php echo ucwords ($pasien['jabatan']); ?></td>
                            </tr>
                            <tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h6>Catatan Riwayat Penyakit Pasien</h6> 
                      
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1">
                          <thead>
                            <tr>
                              <th>Tanggal Berobat</th>
                              <th>Nama Pasien</th>
                              <th>Identitas Pasien</th>
                              <th>Keluhan</th>
                              <th>Dokter</th>
                              <th>Resep</th>
                              <th>Rujukan</th>
                              <th>Alergi Obat</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' ORDER BY tgl DESC");
                            $i = 0;
                            while ($row = mysqli_fetch_array($sql)) {
                              $idpasien = $row['id_pasien'];
                            ?>
                              <tr>
                                <td><?php echo ucwords(tgl_indo($row['tgl'])); ?></td>
                                <td><?php echo ucwords($row['name_pasien']); ?></td>
                                <td><?php echo ucwords($row['identitas']); ?></td>
                                <td><?php echo ucwords($row['keluhan']); ?></td>
                                <td><?php echo ($row['dokter']); ?></td>
                                <td><?php echo ucwords($row['resep']); ?></td>
                                <td><?php echo ucwords($row['rujukan']); ?></td>
                                <td><?php echo ucwords($row['alergi_obat']); ?></td>
                                <td>
                                  <form method="POST" action="print.php" target="_blank">
                                    <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                                    <input type="hidden" name="idriwayat" value="<?php echo $idpasien ?>">
                                    <div class="btn-group">
                                    <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7) { ?> 
                                      <!-- <button type="submit" class="btn btn-warning" name="editPasien" title="Edit Data Pasien" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button> <?php } ?> -->
                                    </div>
                                      </div>
                                      <button type="submit" class="btn btn-primary" name="print" title="Print" data-toggle="tooltip"><i class="fas fa-print"></i></button>
                                    </div>
                                  </form>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

        
        </section>
      </div>

      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>

  <script>
    $('#editObat').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var nama_pasien = button.data('nama_pasien')
      var id = button.data('id')
      var name_pasien = button.data('name_pasien')
      var identitas = button.data('identitas')
      var keluhan = button.data('keluhan')
      var dokter = button.data('dokter')
      var resep = button.data('resep')
      var rujukan = button.data('rujukan')
      var alergi_obat = button.data('alergi_obat')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getnama_pasien').val(nama_pasien)
      modal.find('#getname_pasien').val(name_pasien)
      modal.find('#getidentitas').val(identitas)
      modal.find('#getkeluhan').val(keluhan)
      modal.find('#getdokter').val(dokter)
      modal.find('#getresep').val(resep)
      modal.find('#getrujukan').val(rujukan)
      modal.find('#getalergi_obat').val(alergi_obat)
    })
</body>

</html>