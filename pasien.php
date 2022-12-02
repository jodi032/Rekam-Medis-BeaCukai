<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Data Pegawai";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include "part_func/tgl_ind.php";
  include "part_func/umur.php";
  

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $tgl = $_POST['tgl'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    // $status = $_POST['status'];
    // $tanggungan = $_POST['tanggungan'];
    

    $up2 = mysqli_query($conn, "UPDATE pasien SET jabatan='$jabatan',  nip='$nip', tgl='$tgl',nama_pasien='$nama' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Pasien berhasil diubah!",
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
                    <h4>Pegawai yang telah terdaftar</h4>
                    <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?> 
                    <div class="card-header-action">
                    <a href="printpegawai.php" class="btn btn-warning">Print</a>
                      <a href="rawat_jalan.php" class="btn btn-primary">Tambah Catatan Rekam Medis</a> <?php } ?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Usia</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM pasien ORDER BY nama_pasien ASC");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $idpasien = $row['id'];
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <th><?php echo ucwords($row['nama_pasien']); ?>
                                <div class="table-links">
                                  <?php
                                  $rekam = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idpasien'");
                                  $cekrekam = mysqli_num_rows($rekam);
                                  if ($cekrekam == 0) {
                                    echo '<a>Pasien belum memiliki catatan medis</a>';
                                  } else { ?>
                                    <form method="POST" action="detail_pasien.php">
                                      <input type="hidden" name="id" value="<?php echo $row['nama_pasien']; ?>">
                                      <button type="submit" id="btn-link">Pasien memiliki <?php echo $cekrekam; ?> catatan medis</button>
                                    </form>
                                  <?php }
                                  ?>
                                </div>
                              </th>
                              <td><?php if ($row['tgl'] == "") {
                                    echo "-";
                                  } else {
                                    echo tgl_indo($row['tgl']);
                                  } ?></td>
                              <td><?php if ($row['tgl'] == "") {
                                    echo "-";
                                  } else {
                                    umur($row['tgl']);
                                  } ?></td>
                              <td align="center">
                                <form method="POST" action="detail_pasien.php">
                                <?php if($_SESSION['id_pegawai'] ==3 || $_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7) { ?> 
                                  <span data-target="#editPasien" data-toggle="modal" data-id="<?php echo $idpasien; ?>" data-nama="<?php echo $row['nama_pasien']; ?>" data-tgl="<?php echo $row['tgl']; ?>" data-nip="<?php echo $row['nip']; ?>" data-jabatan="<?php echo $row['jabatan']; ?>">
                                    <a class="btn btn-primary btn-action mr-1" title="Edit Data Pasien" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a> <?php } ?>
                                  </span> 
                                  <?php if($_SESSION['id_pegawai'] ==3 || $_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7) { ?> 
                                  <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=pasien&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a> <?php } ?>
                                  <input type="hidden" name="id" value="<?php echo $row['nama_pasien']; ?>">
                                  <button type="submit" class="btn btn-info btn-action mr-1" title="Detail Pasien" data-toggle="tooltip" name="submit"><i class="fas fa-info-circle"></i></button> 
                                </form>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="editPasien">
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
                  <label class="col-sm-3 col-form-label">Tanggal lahir</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control datepicker" id="getTgl" name="tgl">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">NIP</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nip" required="" id="getnip">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jabatan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="jabatan" required="" id="getjabatan">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <!-- <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                  <select class="form-control selectric" name="status" required="" id="getstatus"> 
		                 <option value="Status Pegawai Organik">Organik</option>
		                 <option value="Status Pegawai Tenaga Penunjang">Tenaga Penunjang</option>
		                 </select>
                   <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
              <div class="form-group row">  
                <label class="col-sm-3 col-form-label">Tanggungan</label>
                <div class="col-sm-9">
                <select class="form-control selectric" name="tanggungan" required="" id="gettanggungan"> 
                  <option value="Suami">Suami</option>
                  <option value="Istri">Istri</option>
                  <option value="Anak 1">Anak 1</option>
                  <option value="Anak 2">Anak 2</option>
                  <option value="Anak 3">Anak 3</option>
                  <option value="Pegawai">Pegawai</option>
                  </select>
                  <div class="invalid-feedback">
                  Mohon data diisi!
                  </div>
                </div>
              </div>
            </div>  -->
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
    $('#editPasien').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var nama = button.data('nama')
      var id = button.data('id')
      var tgl = button.data('tgl')
      var nip = button.data('nip')
      var jabatan = button.data('jabatan')
      var status = button.data('status')
      var tanggungan = button.data('tanggungan')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getNama').val(nama)
      modal.find('#getTgl').val(tgl)
      modal.find('#getnip').val(nip)
      modal.find('#getjabatan').val(jabatan)
      modal.find('#getstatus').val(status)
      modal.find('#gettanggungan').val(tanggungan)
    })
  </script>
</body>

</html>