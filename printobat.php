<?php
$page = "Data Obat" ;
session_start();
include 'auth/connect.php';
include "part/head.php";


//All SQL Syntax
$sql = mysqli_query($conn, "SELECT * FROM obat");

if (isset($_POST['printall'])) {
  $riwayatpenyakit = mysqli_query($conn, "SELECT * FROM obat");
} else if (isset($_POST['printone']))
 
?>

  <?php { ?>
    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Obat</h4>
            <div class="card-header-action">
            </div>
          </div>
          <div class="card-body">
            <div class="gallery">
              <table class="table table-striped table-sm">
                <tbody>
                <thead>
                  <tr>
                  <th>Nama Obat</th>
                  <th>Stok Obat</th>
                  <th>Keterangan Obat</th>
                  <th>Tanggal Kadaluarsa Obat</th>
                  </tr>
                </thead>
                <tbody>
                
                <?php
                  $sql = mysqli_query($conn, "SELECT * FROM obat ORDER BY nama_obat ASC");
                  $i = 0;
                  while ($row = mysqli_fetch_array($sql)) {
                 ?>
                  <tr>
                  <td><?php echo ucwords($row['nama_obat']) ?></td>
                  <td><?php echo $row['stok'] ."Unit"; ?></td>
                  <td><?php echo ucwords($row['keterangan']) ?></td>
                  <td><?php echo ucwords($row['kadaluarsa']) ?></td>
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
      Data Obat yang ada di BEA Cukai Banjarmasin
    </div>
  </footer>';
    }
    echo '<script> window.print(); </script>';
   ?>