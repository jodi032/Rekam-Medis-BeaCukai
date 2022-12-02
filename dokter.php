<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Data Dokter";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name_dokter = $_POST['name_dokter'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $spesialis = $_POST['spesialis'];

    $up2 = mysqli_query($conn, "UPDATE dokter SET name_dokter='$name_dokter', alamat='$alamat', no_hp='$no_hp', spesialis='$spesialis' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Dokter berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
  }

  if (isset($_POST['submit2'])) {
    $name_dokter = $_POST['name_dokter'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $spesialis = $_POST['spesialis'];

    $add = mysqli_query($conn, "INSERT INTO dokter (name_dokter, alamat, no_hp, spesialis) VALUES ('$name_dokter', '$alamat', '$no_hp', '$spesialis')");
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Dokter baru telah ditambahkan!",
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
                    <a href="printdokter.php" class="btn btn-warning">Print</a>
                      <a href="#" class="btn btn-primary" data-target="#adddokter" data-toggle="modal">Tambahkan Dokter Baru</a> <?php } ?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>No</th> 
                            <th>Nama Dokter</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Spesialis</th>
                            <th class="text-center">Action</th>
                          </tr>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM dokter ORDER BY name_dokter ASC");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $i++;
                          ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                              <td><?php echo ucwords($row['name_dokter']) ?></td>
                              <td><?php echo ucwords($row['alamat']) ?></td>
                              <td><?php echo ucwords($row['no_hp']) ?></td>
                              <td><?php echo ucwords($row['spesialis']) ?></td>
                              <td align="center">
                              <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?> 
                                <span data-target="#editdokter" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-name_dokter="<?php echo $row['name_dokter']; ?>" data-alamat="<?php echo $row['alamat']; ?>" data-no_hp="<?php echo $row['no_hp']; ?>" data-spesialis="<?php echo $row['spesialis']; ?>">
                                <a class="btn btn-primary btn-action mr-1" title="Edit Data Dokter" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a><?php } ?>
                                
                                </span>
                                <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?> 
                                <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=dokter&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a> <?php } ?>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="adddokter">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Dokter</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Dokter</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="name_dokter" required="" id="getname_dokter">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Alamat</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="alamat" required="" value="" id="getalamat">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">No hp</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="no_hp" required="" id="getno_hp">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Spesialis</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="spesialis" required="" id="getspesialis">
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

      <div class="modal fade" tabindex="-1" role="dialog" id="editdokter">
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
                  <label class="col-sm-3 col-form-label">Nama Dokter</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                    <input type="text" class="form-control" name="name_dokter" required="" id="getname_dokter">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Alamat</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="alamat" required="" id="getalamat">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">No_hp</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="no_hp" required="" id="getno_hp">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                  </div>
                </div>
              </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Spesialis</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="spesialis" required="" id="getspesialis">
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
    $('#editdokter').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var name_dokter = button.data('name_dokter')
      var id = button.data('id')
      var alamat = button.data('alamat')
      var no_hp = button.data('no_hp')
      var spesialis = button.data('spesialis')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getname_dokter').val(name_dokter)
      modal.find('#getalamat').val(alamat)
      modal.find('#getno_hp').val(no_hp)
      modal.find('#getspesialis').val(spesialis)
    })
  </script>
</body>

</html>