<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Data Riwayat Keluhan";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  if (isset($_POST['submit'])) {
    $idpasien = $_POST['id_pasien'];
    $nameee = $_POST['name_pasien'];
    $identitas = $_POST['identitas'];
    $keluhan = $_POST['keluhan'];
    $dokter = $_POST['dokter'];
    $resep = $_POST['resep'];
    $rujukan = $_POST['rujukan'];
    $alergi_obat = $_POST['alergi_obat'];

    $up2 = mysqli_query($conn, "UPDATE riwayat_penyakit SET keluhan='$keluhan', dokter='$dokter', resep='$resep',  rujukan='$rujukan', alergi_obat='$alergi_obat', name_pasien='$nameee', identitas='$identitas' WHERE id_pasien='$idpasien'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Keluhan berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
  }
  

  if (isset($_POST['submit2'])) {
    $idpasien = $_POST['id_pasien'];
    $nameee = $_POST['name_pasien'];
    $identitas = $_POST['identitas'];
    $keluhan = $_POST['keluhan'];
    $dokter = $_POST['dokter'];
    $resep = $_POST['resep'];
    $rujukan = $_POST['rujukan'];
    $alergi_obat = $_POST['alergi_obat'];

    $add = mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, keluhan, dokter, tgl, resep, rujukan, alergi_obat, name_pasien,identitas) VALUES ('$idpasien', '$keluhan', '$dokter', '$tglnow', '$resep', '$rujukan', '$alergi_obat', '$nameee', '$identitas')");
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Data Keluhan baru telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
  }
  ?>
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
            <h1><?php echo $page; ?></h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $page; ?></h4>
                    <div class="card-header-action">
                    <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?>
                    <a href="printkeluhan.php" class="btn btn-warning">Print</a>
                    <a href="rawat_jalan.php" class="btn btn-primary">Tambahkan Keluhan</a> <?php } ?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Tanggal Periksa </th>
                            <th>Nama Pasien</th>
                            <th>Identitas Pasien</th>
                            <th>Keluhan</th>
                            <th>Dokter</th>
                            <th>Resep</th>
                            <th>Rujukan</th>
                            <th>Alergi Obat</th>
                            <th> </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit ORDER BY tgl DESC");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $idpasien = $row['id_pasien'];
                            $sqlpasien = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$idpasien'");
                            $pasien = mysqli_fetch_array($sqlpasien);
                            $sqlkeluhan = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id='$idpasien'");  
                            $keluhan = mysqli_fetch_array($sqlkeluhan);
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo ucwords(($row['tgl'])); ?></td>
                              <td><?php echo ucwords($row['name_pasien']); ?></td>
                              <td><?php echo ucwords($row['identitas']); ?></td>
                              <td><?php echo ucwords($row['keluhan']); ?></td>
                              <td><?php echo ucwords($row['dokter']); ?></td>
                              <td><?php echo ucwords($row['resep']); ?></td>
                              <td><?php echo ucwords($row['rujukan']); ?></td>
                              <td><?php echo ucwords($row['alergi_obat']); ?></td>
                              <td align="center">
                              <span data-target="#editkeluhan" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['name_pasien']; ?>" data-keluhan="<?php echo $row['keluhan']; ?>" data-dokter="<?php echo $row['dokter']; ?>" data-resep="<?php echo $row['resep']; ?>" data-rujukan="<?php echo $row['rujukan']; ?>" data-alergi_obat="<?php echo $row['alergi_obat']; ?>"> 
                             
                                <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?> 
                              <?php } ?>
                                </span>
                                <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?> 
                                 <?php } ?>
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
          </div>
        </section>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="editkeluhan">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Catatan Rekam Medis</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Pasien</label>
                  <div class="col-sm-9">
                  <input type="hidden" class="form-control" name="id_pasien" required="" id="getId">
                    <input type="text" class="form-control" name="name" required="" id="getname_pasien">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keluhan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="keluhan" required="" id="getkeluhan">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Dokter</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="dokter" required="" id="getdokter">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Resep</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="resep" required="" id="getresep">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Rujukan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="rujukan" required="" id="getrujukan">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Alergi_obat</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="alergi_obat" required="" id="getalergi_obat">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit2">Edit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>

  <script>
    $('#editkeluhan').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id_pasien = button.data('id_pasien')
      var name_pasien = button.data('name_pasien')
      var identitas = button.data('identitas')
      var keluhan = button.data('keluhan')
      var dokter = button.data('dokter')
      var resep = button.data('resep')
      var rujukan = button.data('rujukan')
      var alergi_obat = button.data('alergi_obat')
      var modal = $(this)
      modal.find('#getId').val(id_pasien)
      modal.find('#getname_pasien').val(name_pasien)
      modal.find('#getidentitas').val(identitas)
      modal.find('#getkeluhan').val(keluhan)
      modal.find('#getdokter').val(dokter)
      modal.find('#getresep').val(resep)
      modal.find('#getrujukan').val(rujukan)
      modal.find('#getalergi_obat').val(alergi_obat)
    })

  </script>
</body>


</html>