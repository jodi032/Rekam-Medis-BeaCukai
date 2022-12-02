<?php
$page = "Data Dokter" ;
session_start();
include 'auth/connect.php';
include "part/head.php";


//All SQL Syntax
$sql = mysqli_query($conn, "SELECT * FROM dokter");

if (isset($_POST['printall'])) {
  $dokter = mysqli_query($conn, "SELECT * FROM dokter");
} else if (isset($_POST['printone']))
 
?>

  <?php { ?>
    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Dokter</h4>
            <div class="card-header-action">
            </div>
          </div>
          <div class="card-body">
            <div class="gallery">
              <table class="table table-striped table-sm">
                <tbody>
                <thead>
                  <tr>
                  <th>Nama Dokter</th>
                  <th>Alamat</th>
                  <th>No Hp</th>
                  <th>Spesialis</th>
                  </tr>
                </thead>
                <tbody>
                
                <?php
                  $sql = mysqli_query($conn, "SELECT * FROM dokter ORDER BY name_dokter ASC");
                  $i = 0;
                  while ($row = mysqli_fetch_array($sql)) {
                 ?>
                  <tr>
                  <td><?php echo ucwords($row['name_dokter']) ?></td>
                  <td><?php echo ucwords($row['alamat']) ?></td>
                  <td><?php echo ucwords($row['no_hp']) ?></td>
                  <td><?php echo ucwords($row['spesialis']) ?></td>
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
      Data Dokter yang ada di BEA Cukai Banjarmasin
    </div>
  </footer>';
    }
    echo '<script> window.print(); </script>';
   ?>