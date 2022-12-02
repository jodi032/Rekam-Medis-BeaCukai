<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Data Obat";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $keterangan = $_POST['keterangan'];
    $kadaluarsa = $_POST['kadaluarsa'];

    $up2 = mysqli_query($conn, "UPDATE obat SET nama_obat='$nama', stok='$stok', keterangan='$keterangan', kadaluarsa='$kadaluarsa' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Obat berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
  }

  if (isset($_POST['submit2'])) {
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $keterangan = $_POST['keterangan'];
    $kadaluarsa = $_POST['kadaluarsa'];

    $add = mysqli_query($conn, "INSERT INTO obat (nama_obat, stok, keterangan, kadaluarsa) VALUES ('$nama', '$stok', '$keterangan', '$kadaluarsa')");
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Obat baru telah ditambahkan!",
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
                    <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?> 
                    <div class="card-header-action">
                    <a href="printobat.php" class="btn btn-warning">Print</a>
                      <a href="#" class="btn btn-primary" data-target="#addObat" data-toggle="modal">Tambahkan Obat Baru</a> <?php } ?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Keterangan</th>
                            <th>Tanggal Kadaluarsa Obat</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM obat ORDER BY nama_obat ASC");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo ucwords($row['nama_obat']) ?></td>
                              <td><?php echo $row['stok'] ."Unit"; ?></td>
                              <td><?php echo ucwords($row['keterangan']) ?></td>
                              <td><?php echo ucwords($row['kadaluarsa']) ?></td>
                              <td align="center">
                              <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?> 
                                <span data-target="#editObat" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_obat']; ?>" data-stok="<?php echo $row['stok']; ?>" data-keterangan="<?php echo $row['keterangan']; ?>" data-kadaluarsa="<?php echo $row['kadaluarsa']; ?>">
                                <a class="btn btn-primary btn-action mr-1" title="Edit Data Obat" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a><?php } ?>
                                
                                </span>
                                <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?> 
                                <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=obat&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a> <?php } ?>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="addObat">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Obat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Obat</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" required="" id="getNama">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Stok Obat</label>
                  <div class="form-group col-sm-9">
                    <input type="number" class="form-control" name="stok" required="" value="">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="keterangan" required="" id="getketerangan">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal Kadaluarsa Obat</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="kadaluarsa" required="" id="getkadaluarsa">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit2">Tambah</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="editObat">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Pasien</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                    <input type="text" class="form-control" name="nama" required="" id="getNama">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Stok Obat</label>
                  <div class="form-group col-sm-9">
                    <input type="number" class="form-control" name="stok" required="" id="getStok">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="keterangan" required="" id="getketerangan">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                  </div>
                </div>
              </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal Kadaluarsa Obat</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="kadaluarsa" required="" id="getkadaluarsa">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit">Edit</button>
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
    $('#editObat').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var nama = button.data('nama')
      var id = button.data('id')
      var stok = button.data('stok')
      var keterangan = button.data('keterangan')
      var kadaluarsa = button.data('kadaluarsa')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getNama').val(nama)
      modal.find('#getStok').val(stok)
      modal.find('#getketerangan').val(keterangan)
      modal.find('#getkadaluarsa').val(kadaluarsa)
    })
  </script>
</body>

</html>