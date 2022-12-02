<?php
$idnama = $_POST['id'];
$page1 = "det";
$page = "Detail Pasien : " . $idnama;
session_start();
include 'auth/connect.php';
include "part/head.php";
include 'part_func/umur.php';
include 'part_func/tgl_ind.php';

//All SQL Syntax
$cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$idnama'");
$pasien = mysqli_fetch_array($cek);
$idid = $pasien['id'];

if (isset($_POST['printall'])) {
  $riwayatpenyakit = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' ORDER BY tgl DESC");
} else if (isset($_POST['printone']))
 
?>

  <?php { ?>
    <div class="row">
      <div class="col-12 col-sm-6 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Informasi Pegawai</h4>
            <div class="card-header-action">
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
                               <!-- <th scope="row">Status</th>
                              <td> : <?php echo ucwords ($pasien['status']); ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Tanggungan</th>
                              <td> : <?php echo ucwords ($pasien['tanggungan']); ?></td> 
                            </tr>  -->
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
            <h4>Catatan Riwayat Penyakit Pasien</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="table-1">
                <thead>
                  <tr>
                  <th>Tanggal Berobat</th>
                  <th>Nama Lengkap Pasien</th>
                  <th>Identitas Pasien</th>
                  <th>Keluhan</th>
                  <th>Dokter</th>
                  <th>Resep</th>
                  <th>Rujukan</th>
                  <th>Alergi Obat</th>
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
                    </tr>
                  <?php } ?>
  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php }

    {
      echo '<footer class="main-footer">
    <div class="footer-left">
      Catatan Rekam Medis ini dicetak pada tanggal ' . tgl_indo(date('Y-m-d')) . '
    </div>
  </footer>';
    }
    echo '<script> window.print(); </script>';
   ?>