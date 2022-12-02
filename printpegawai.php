<?php
$page = "Data Pegawai" ;
session_start();
include 'auth/connect.php';
include "part/head.php";


//All SQL Syntax
$sql = mysqli_query($conn, "SELECT * FROM pasien");

if (isset($_POST['printall'])) {
  $pegawai = mysqli_query($conn, "SELECT * FROM pasien");
} else if (isset($_POST['printone']))
 
?>

  <?php { ?>
    <div class="row">
      <div class="col-12 col-sm-10 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Pegawai BEA Cukai Banjarmasin</h4>
            <div class="card-header-action">
            </div>
          </div>
          <div class="card-body">
            <div class="gallery">
              <table class="table table-striped table-sm">
                <tbody>
                <thead>
                  <tr>
                  <th>Nama Pegawai</th>
                  <th>Tanggal Lahir</th>
                  <th>NIP</th>
                  <th>Jabatan</th>
                  </tr>
                </thead>
                <tbody>
                
                <?php
                  $sql = mysqli_query($conn, "SELECT * FROM pasien");
                  $i = 0;
                  while ($row = mysqli_fetch_array($sql)) {
                 ?>
                  <tr>
                  <th><?php echo ucwords($row['nama_pasien']); ?>
                  <td><?php echo ucwords($row['tgl']); ?></td>
                  <td><?php echo ucwords ($row['nip']); ?></td>
                  <td><?php echo ucwords ($row['jabatan']); ?></td>
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
    Data Pegawai yang ada di BEA Cukai Banjarmasin
    </div>
  </footer>';
    }
    echo '<script> window.print(); </script>';
   ?>