<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Dashboard";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include 'part_func/tgl_ind.php';

  $pegawai = mysqli_query($conn, "SELECT * FROM pegawai");
  $jumlahpegawai = mysqli_num_rows($pegawai);
  $pasien = mysqli_query($conn, "SELECT * FROM pasien");
  $jumpasien = mysqli_num_rows($pasien);
  $obat = mysqli_query($conn, "SELECT * FROM obat WHERE id IS NOT NULL");
  $jumobat = mysqli_num_rows($obat);
  $keluhan = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien");
  $jumlahkeluhan = mysqli_num_rows($keluhan);
  ?>
  <style>
    #link-no {
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/navbar.php';
      include 'part/sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Users</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahpegawai; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-user-injured"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Data Pegawai</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumpasien; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-briefcase-medical"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Obat</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumobat; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-diagnoses"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Riwayat Keluhan</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahkeluhan; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Status Stok Obat</h4>
                  <div class="card-header-action">
                    <a href="obat.php">Detail</a>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  $sqlobat = mysqli_query($conn, "SELECT * FROM obat ORDER BY nama_obat ASC");
                  while ($showobat = mysqli_fetch_array($sqlobat)) {
                    $defpasien = $showobat['id'];
                  ?>
                    <ul class="list-unstyled list-unstyled-border">
                      <li class="media">
                        <div class="media-body">
                          <?php
                          if ($showobat["stok"] == "1") {
                            echo '<div class="badge badge-pill badge-warning mb-1 float-right">';
                            echo '<i class="ion-checkmark-round"></i> HAMPIR HABIS';
                          } elseif ($showobat["stok"] == "0") {
                            echo '<div class="badge badge-pill badge-danger mb-1 float-right">';
                            echo '<i class="ion-close"></i> KOSONG';
                          } else {
                            echo '<div class="badge badge-pill badge-success mb-1 float-right">';
                            echo '<i class="ion-checkmark-round"></i>  TERSEDIA';
                          } ?>
                        </div>
                        <h6 class="media-title"><a href="#">Obat <?php echo $showobat["nama_obat"]; ?></a></h6>
                        <div class="text-small text-muted">
                          <?php
                          if ($showobat["stok"] == "0") {
                            echo 'kosong';
                          } elseif ($showobat["stok"] == "1") {
                            $sqlnama = mysqli_query($conn, "SELECT * FROM obat WHERE id='stok'");
                            $namaobat = mysqli_fetch_array($sqlobat);
                            echo ucwords($showobat["stok"]);
                            echo '<div class=""></div> <span class="text-primary"></span></div>';
                          } else {
                            echo ucwords($showobat["stok"]);
                            echo '<div class=""></div> <span class="text-primary"></span></div>';
                          } ?>
                        </div>
                      </li>
                    </ul>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Menu Utama</h4>
                </div>
                <div class="card-body">
                  <div class="col-lg-12">
                    <div class="card card-large-icons">
                      <div class="card-icon bg-danger text-white">
                        <i class="fas fa-user-injured"></i>
                      </div>
                      <div class="card-body">
                        <h4>Cek Data Pegawai</h4>
                        <a href="pasien.php" class="card-cta">Detail <i class="fas fa-chevron-right"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="card card-large-icons">
                      <div class="card-icon bg-success text-white">
                        <i class="fas fa-diagnoses"></i>
                      </div>
                      <div class="card-body">
                        <h4>Cek Riwayat Keluhan</h4>
                        <a href="Celuhan.php" class="card-cta">Detail <i class="fas fa-chevron-right"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="card card-large-icons">
                      <div class="card-icon bg-warning text-white">
                        <i class="fas fa-briefcase-medical"></i>
                      </div>
                      <div class="card-body">
                        <h4>Data Obat</h4>
                        <a href="obat.php" class="card-cta">Detail <i class="fas fa-chevron-right"></i></a>
                      </div>
                    </div>
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
</body>

</html>