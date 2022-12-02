<?php
$page = "Data Users" ;
session_start();
include 'auth/connect.php';
include "part/head.php";


//All SQL Syntax
$sql = mysqli_query($conn, "SELECT * FROM pegawai");

if (isset($_POST['printall'])) {
  $pegawai = mysqli_query($conn, "SELECT * FROM pegawai");
} else if (isset($_POST['printone']))
 
?>

  <?php { ?>
    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Users Sistem Informasi Rekam Medis BEA Cukai Banjarmasin</h4>
            <div class="card-header-action">
            </div>
          </div>
          <div class="card-body">
            <div class="gallery">
              <table class="table table-striped table-sm">
                <tbody>
                <thead>
                  <tr>
                  <th>Nama Users</th>
									<th>Alamat</th>
									<th>Pekerjaan</th>
                  <th>Username</th>
                  </tr>
                </thead>
                <tbody>
                
                <?php
                  $sql = mysqli_query($conn, "SELECT * FROM pegawai");
                  $i = 0;
                  while ($row = mysqli_fetch_array($sql)) {
                 ?>
                  <tr>
															<td><?php echo ucwords($row['nama_pegawai']); ?></td>
															<td><?php echo ucwords($row['alamat']); ?></td>
															<td><?php
																if ($row['pekerjaan'] == '1') 
																{
																	echo 'Kepala Bea Cukai';
																} 
																if ($row['pekerjaan'] == '2') 
																{
																	echo 'Pegawai';
																}
																if ($row['pekerjaan'] == '3') 
																{
																	echo 'Dokter';
															    }
																if ($row['pekerjaan'] == '4') 
																{
																	echo 'Admin';
																} ?>
                                <td><?php echo ucwords($row['username']); ?></td>
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
    Data Users yang mempunyai hak akses Sistem Informasi Rekam Medis BEA Cukai Banjarmasin
    </div>
  </footer>';
    }
    echo '<script> window.print(); </script>';
   ?>