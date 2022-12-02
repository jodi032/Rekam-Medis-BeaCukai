<?php
$page = "Print Riwayat Keluhan" ;
session_start();
include 'auth/connect.php';
include "part/head.php";


//All SQL Syntax
$sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit");

if (isset($_POST['printall'])) {
  $riwayatpenyakit = mysqli_query($conn, "SELECT * FROM riwayat_penyakit");
} else if (isset($_POST['printone']))
 
?>

  <?php { ?>
    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Riwayat Keluhan</h4>
            <div class="card-header-action">
            </div>
          </div>
          <div class="card-body">
            <div class="gallery">
              <table class="table table-striped table-sm">
                <tbody>
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
                  $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit ORDER BY tgl DESC");
                  $i = 0;
                  while ($row = mysqli_fetch_array($sql)) {
                    $idpasien = $row['id_pasien'];
                 ?>
                  <tr>

                              <td><?php echo ucwords(($row['tgl'])); ?></td>
                              <td><?php echo ucwords($row['name_pasien']); ?></td>
                              <td><?php echo ucwords($row['identitas']); ?></td>
                              <td><?php echo ucwords($row['keluhan']); ?></td>
                              <td><?php echo ucwords($row['dokter']); ?></td>
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
      Data Riwayat Keluhan penyakit
      Pegawai BEA Cukai Banjarmasin
    </div>
  </footer>';
    }
    echo '<script> window.print(); </script>';
   ?>