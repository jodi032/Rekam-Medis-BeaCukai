<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Catatan Rekam Medis";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  @$nama = $_POST['nama'];
  @$namamu = $_POST['name_pasien'];
  $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$nama' OR id='$nama' OR nama_pasien='$namamu' OR id='$namamu'");
  $cekrow = mysqli_num_rows($cek);
  $tokne = mysqli_fetch_array($cek);
  $tglnow = date('Y-m-d');

  if (isset($_POST['jalan1'])) {
    if ($cekrow == 0) {
      mysqli_query($conn, "INSERT INTO pasien (nama_pasien,nip,jabatan) VALUES ('$nama', '$nip', '$jabatan')");
      echo '<script> location.reload(); </script>';
    } else {
      echo '<script>
				setTimeout(function() {
					swal({
						title: "Pegawai Telah Terdaftar!",
						text: "Pegawai yang bernama ' . ucwords($tokne['nama_pasien']) . ' sudah terdaftar, silahkan lanjutkan ke menu selanjutnya",
						icon: "success"
						});
					}, 500);
			</script>';
    }
  }

  if (isset($_POST['jalan2'])) {
    $namamu = $_POST['nama'];
    @$tgl = $_POST['tgl'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    // $status = $_POST['status'];
    // $tanggungan = $_POST['tanggungan'];

    mysqli_query($conn, "UPDATE pasien SET jabatan='$jabatan', nip='$nip', tgl='$tgl' WHERE nama_pasien='$namamu'");
  }

  if (isset($_POST['jalan3'])) {
    $idpasien = $_POST['id'];
    $nameee = $_POST['name_pasien'];
    $identitas = $_POST['identitas'];
    $keluhan = $_POST['keluhan'];
    $dokter = $_POST['dokter'];
    $resep = $_POST['resep'];
    $rujukan = $_POST['rujukan'];
    $alergi_obat = $_POST['alergi_obat'];

    mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, keluhan, dokter, tgl, resep, rujukan, alergi_obat, name_pasien,identitas) VALUES ('$idpasien', '$keluhan', '$dokter', '$tglnow', '$resep', '$rujukan', '$alergi_obat', '$nameee', '$identitas')");
  }

  
  
    if (isset($_POST["riwayat_penyakit"])) {
    $nameee = $_POST['name_pasien'];
    $identitas = $_POST['identitas'];

        mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, keluhan, dokter, tgl, resep, rujukan, alergi_obat, medis, name_pasien,identitas) VALUES ('$idpasien', '$keluhan', '$dokter', '$tglnow', '$resep', '$rujukan', '$alergi_obat', '$nameee', '$identitas')");
    }
    
  if (isset($_POST['print'])) {
    $idpasien = $_POST['id'];
    $keluhan = $_POST['keluhan'];
    
    $tolologi = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE keluhan='$keluhan' AND id_pasien='$idpasien' ORDER BY id DESC LIMIT 1");
    $lol = mysqli_fetch_array($tolologi);
    $tolologi2 = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$idpasien'");
    $lol2 = mysqli_fetch_array($tolologi2);
    $penyyy = $lol['id'];
    $passs = $lol2['nama_pasien'];
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
                    <h4>Input Catatan Rekam Medis</h4>
                  </div>
                  <div class="card-body">
                    <div class="row mt-4">
                      <div class="col-12 col-lg-8 offset-lg-1">
                        <div class="wizard-steps">
                          <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                              <i class="far fa-user"></i>
                            </div>
                            <div class="wizard-step-label">
                              Identitas Pasien
                            </div>
                          </div>
                          <div class="wizard-step <?php echo (isset($_POST['jalan1']) || isset($_POST['jalan2']) || isset($_POST['jalan4']) || isset($_POST['jalan3']) || isset($_POST['submitfoto']) || isset($_POST['rawatinap']) || isset($_POST['pesanobat']) || isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
                            <div class="wizard-step-icon">
                              <i class="fas fa-server"></i>
                            </div>
                            <div class="wizard-step-label">
                              Informasi Pribadi
                            </div>
                          </div>
                          <div class="wizard-step <?php echo (isset($_POST['jalan2']) || isset($_POST['jalan3']) || isset($_POST['submitfoto']) || isset($_POST['rawatinap']) || isset($_POST['pesanobat']) || isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
                            <div class="wizard-step-icon">
                              <i class="fas fa-stethoscope"></i>
                            </div>
                            <div class="wizard-step-label">
                              Keluhan
                            </div>
                          </div>
                          <div class="wizard-step <?php echo (isset($_POST['jalan3']) || isset($_POST['submitfoto']) || isset($_POST['rawatinap']) || isset($_POST['pesanobat']) || isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
                            <div class="wizard-step-icon">
                              <i class="fas fa-list"></i>
                            </div>
                            <div class="wizard-step-label">
                            Informasi Tambahan
                            </div>
                            <!-- <div class="wizard-step-icon">
                              <i class="fas fa-print"></i>
                            </div>
                            <div class="wizard-step-label">
                              Cetak 
                            </div> -->
                          </div>
                          <div class="wizard-step <?php echo (isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
                            <div class="wizard-step-icon">
                              <i class="fas fa-print"></i>
                            </div>
                            <div class="wizard-step-label">
                              Cetak 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <form class="wizard-content mt-2 needs-validation" novalidate="" method="POST" autocomplete="off" enctype="multipart/form-data">
                      <div class="wizard-pane">
                        <?php if (empty($_POST)) { ?>

                          <!-- PART 1 -->

                          <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left">Nama Lengkap / ID</label>
                            <div class="col-lg-4 col-md-6">
                              <input id="myInput" type="text" class="form-control" name="nama" placeholder="Nama / ID Calon Pasien">
                              <div class="invalid-feedback">
                                Mohon data diisi!
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                              <button class="btn btn-icon icon-right btn-primary" name="jalan1">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                            </div>
                          </div>
                        <?php }
                        if (isset($_POST['jalan1'])) { ?>

                          <!-- PART 2 -->

                          <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left">Nama Lengkap</label>
                            <div class="col-lg-4 col-md-6">
                              <input type="hidden" name="nama" class="form-control" required="" value="<?php echo $tokne['nama_pasien']; ?>">
                              <input type="text" class="form-control" required="" value="<?php echo $tokne['nama_pasien']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-4 text-md-right text-left">Tanggal lahir</label>
                            <div class="col-lg-4 col-md-6">
                              <input type="text" class="form-control datepicker" name="tgl" required="" value="<?php echo $tokne['tgl']; ?>">
                            </div>
                          </div>
                          <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left col-form-label">NIP</label>
                            <div class="col-lg-4 col-md-6">
                              <input type="text" class="form-control" name="nip" required="" value="<?php echo $tokne['nip']; ?>">
                              <div class="invalid-feedback">
                                Mohon data diisi!
                            </div>
                          </div>
                       </div>
                          <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left col-form-label">Jabatan</label>
                            <div class="col-lg-4 col-md-6">
                              <input type="text" class="form-control" name="jabatan" value="<?php echo $tokne['jabatan']; ?>">
                              <div class="invalid-feedback">
                                Mohon data diisi!
                            </div>
                          </div>
                       </div>
                          <!-- <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left col-form-label">Status</label>
                            <div class="col-lg-4 col-md-6">
                            <select class="form-control selectric" name="status">
									              <option value="Pegawai Organik">Organik</option>
									              <option value="Pegawai Tenaga Penunjang">Tenaga Penunjang</option>
								                </select>
                              <div class="invalid-feedback">
                                Mohon data diisi!
                            </div>
                          </div>
                       </div> -->
                          <!-- <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left">Tanggungan</label>
                            <div class="col-lg-4 col-md-6">
                            <select class="form-control selectric" name="tanggungan">
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
                          </div> -->
                          <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                              <button class="btn btn-icon icon-right btn-primary" name="jalan2">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                            </div>
                          </div>
                        <?php }

if (isset($_POST['jalan4'])) { ?>

  <!-- PART 2 -->

  <div class="form-group row align-items-center">
    <label class="col-md-4 text-md-right text-left">Nama Lengkap</label>
    <div class="col-lg-4 col-md-6">
      <input type="hidden" name="nama" class="form-control" required="" value="<?php echo $tokne['nama_pasien']; ?>">
      <input type="text" class="form-control" required="" value="<?php echo $tokne['nama_pasien']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4 text-md-right text-left">Tanggal lahir</label>
    <div class="col-lg-4 col-md-6">
      <input type="text" class="form-control datepicker" name="tgl" required="" value="<?php echo $tokne['tgl']; ?>">
    </div>
  </div>
  <div class="form-group row align-items-center">
    <label class="col-md-4 text-md-right text-left col-form-label">NIP</label>
    <div class="col-lg-4 col-md-6">
      <input type="text" class="form-control" name="nip" required="" value="<?php echo $tokne['nip']; ?>">
      <div class="invalid-feedback">
        Mohon data diisi!
    </div>
  </div>
</div>
  <div class="form-group row align-items-center">
    <label class="col-md-4 text-md-right text-left col-form-label">Jabatan</label>
    <div class="col-lg-4 col-md-6">
      <input type="text" class="form-control" name="jabatan" value="<?php echo $tokne['jabatan']; ?>">
      <div class="invalid-feedback">
        Mohon data diisi!
    </div>
  </div>
</div>
  <!-- <div class="form-group row align-items-center">
    <label class="col-md-4 text-md-right text-left col-form-label">Status</label>
    <div class="col-lg-4 col-md-6">
    <select class="form-control selectric" name="status" required="" value="<?php echo $tokne['status']; ?>">
        <option value="Pegawai Organik">Organik</option>
        <option value="Pegawai Tenaga Penunjang">Tenaga Penunjang</option>
        </select>
      <div class="invalid-feedback">
        Mohon data diisi!
    </div>
  </div>
</div>
  <div class="form-group row align-items-center">
    <label class="col-md-4 text-md-right text-left">Tanggungan</label>
    <div class="col-lg-4 col-md-6">
    <select class="form-control selectric" name="tanggungan" required="" value="<?php echo $tokne['tanggungan']; ?>">
        <option value="Suami">Suami</option>
        <option value="Istri">Istri</option>
        <option value="Anak 1">Anak 1</option>
        <option value="Anak 2">Anak 2</option>
        <option value="Anak 3">Anak 3</option>
        </select>
      <div class="invalid-feedback">
        Mohon data diisi!
      </div>
    </div>
  </div> --> 
  <div class="form-group row">
    <div class="col-md-4"></div>
    <div class="col-lg-4 col-md-6 text-right">
      <button class="btn btn-icon icon-right btn-primary" name="jalan2">Selanjutnya <i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
<?php }

                        if (isset($_POST['jalan2'])) { ?>

                          <!-- PART 3 -->
                          <div class="card-body">
                              <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pasien</label>
                              <div class="col-sm-4 col-md-6">
                              <textarea type="text" class="form-control" name="name_pasien" required=""></textarea>
                                <div class="invalid-feedback">
                                  Mohon data diisi!
                                </div>
                              </div> 
                           </div>
                           <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Identitas Pasien</label>
                              <div class="col-sm-4 col-md-6">
                              <textarea type="text" class="form-control" name="identitas" required=""></textarea>
                                <div class="invalid-feedback">
                                  Mohon data diisi!
                                </div>
                              </div> 
                           </div>
                            <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keluhan</label>
                              <div class="col-sm-4 col-md-6">
                                <input type="hidden" class="form-control" name="id" required="" value="<?php echo $tokne['id']; ?>">
                                <textarea class="form-control" name="keluhan" required=""></textarea>
                                <div class="invalid-feedback">
                                  Mohon data diisi!
                                </div>
                              </div>
                           </div>
                            <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dokter</label>
                              <div class="col-sm-4 col-md-6">
                              <input type="text" class="form-control" name="dokter" required="">
                                <div class="invalid-feedback">
                                  Mohon data diisi!
                                </div>
                              </div>
                           </div>
                              <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Resep</label>
                              <div class="col-sm-4 col-md-6">
                              <textarea type="text" class="form-control" name="resep" required=""></textarea>
                                <div class="invalid-feedback">
                                  Mohon data diisi!
                                </div>
                              </div> 
                           </div>
                              <div class="form-group row mb-6">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rujukan</label>
                              <div class="col-sm-4 col-md-6">
                              <textarea type="text" class="form-control" name="rujukan" required=""></textarea>
                                <div class="invalid-feedback">
                                  Mohon data diisi!
                                </div>
                              </div> 
                           </div>  
                              <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alergi Obat</label>
                              <div class="col-sm-4 col-md-6">
                              <textarea type="text" class="form-control" name="alergi_obat" required=""></textarea>
                                <div class="invalid-feedback">
                                  Mohon data diisi!
                                </div>
                              </div>   
                           </div> 
                            <div class="form-group row">
                              <div class="col-md-6"></div>
                              <div class="col-lg-4 col-md-6 text-right">
                              <!-- <button class="btn btn-icon icon-left btn-warning" name="jalan4">Kembali <i class="fas fa-arrow-left"></i></button> -->
                                <button class="btn btn-icon icon-right btn-primary" name="jalan3">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                              </div>
                            </div>
                            <?php }
                        if (isset($_POST['jalan3']) || isset($_POST['submitfoto']) || isset($_POST['rawatinap']) || isset($_POST['pesanobat'])) { ?>

                            <!-- PART 4 -->

                                    <div class="form-group row align-items-center">
                                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Catatan</label>
                                       <div class="col-sm-4 col-md-6">
                                       <textarea type="text" class="form-control" name="alergi_obat" required=""></textarea>
                                        <!-- <div class="invalid-feedback">
                                          Mohon data diisi! -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-12 col-md-3 col-lg-5"></div>
                                      <div class="col-lg-4 col-md-6 text-right">
                                        <input type="submit" class="btn btn-icon icon-right btn-success" name="print" value="Selesai">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                    <div class="card-body">
                                      <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih Foto</label>
                                        <div class="col-sm-12 col-md-7">
                                          <input type="hidden" class="form-control" name="id" required="" value="<?php echo $idpasien; ?>">
                                          <input type="hidden" class="form-control" name="keluhan" required="" value="<?php echo $keluhan; ?>">
                                          <input id='upload' class="form-control" name="upload[]" type="file" multiple="multiple" />
                                          <div class="invalid-feedback">
                                            Mohon data diisi!
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Total Biaya</label>
                                        <div class="input-group col-sm-12 col-md-7">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text">
                                              Rp
                                            </div>
                                          </div>
                                          <input type="number" class="form-control" name="biaya" required="" value="0">
                                          <div class="invalid-feedback">
                                            Mohon data diisi!
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="col-md-6"></div>
                                        <div class="col-lg-4 col-md-6 text-right">
                                          <input type="submit" class="btn btn-icon icon-right btn-primary" name="submitfoto" value="Upload Foto">
                                          <input type="submit" class="btn btn-icon icon-right btn-success" name="print" value="Selesai">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="wizard-pane text-center">
                      <form method="POST" action="print.php" target="_blank">
                        <input type="hidden" name="id_" value="<?php echo $passs; ?>">
                        <input type="hidden" name="idriwayat" value="<?php echo $penyyy; ?>">
                        <div class="btn-group">
                          <a href="index.php" class="btn btn-info" title="Ke Menu Utama" data-toggle="tooltip">Ke Menu Utama</a>
                          <button type="submit" class="btn btn-primary" name="printone" title="Print" data-toggle="tooltip"><i class="fas fa-print"></i> Print Catatan Rekam Medis</button>
                        </div>
                      </form>
                      </div> -->
                                  <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                    <div class="table-responsive">
                                      <?php
                                      $kepake = mysqli_query($conn, "SELECT * FROM ruang_inap WHERE id_pasien='$idpasien'");
                                      $sql = mysqli_query($conn, "SELECT * FROM ruang_inap WHERE status='0'");
                                      if (mysqli_num_rows($sql) == 0) {
                                        echo "Kamar sudah penuh";
                                      } else {
                                        $kapakegak = mysqli_num_rows($kepake);
                                        if ($kapakegak == 0) {
                                      ?>
                                          <table class="table table-striped" id="table-1">
                                            <thead>
                                              <tr>
                                                <th>Nama Ruangan</th>
                                                <th>Harga per hari</th>
                                                <th>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                              while ($row = mysqli_fetch_array($sql)) {
                                              ?>
                                                <tr>
                                                  <th><?php echo ucwords($row['nama_ruang']); ?></th>
                                                  <td>Rp. <?php echo number_format($row['biaya'], 0, ".", "."); ?></td>
                                                  <td>
                                                    <input type="hidden" name="id" required="" value="<?php echo $idpasien; ?>">
                                                    <input type="hidden" name="namaruang" required="" value="<?php echo $row['nama_ruang']; ?>">
                                                    <input type="hidden" name="ruang" value="<?php echo $row['id'] ?>" required="">
                                                    <button class="btn btn-primary btn-action mr-1" name="rawatinap"><i class="fas fa-arrow-right"></i></button>
                                                    <input type="submit" class="btn btn-icon icon-right btn-success" name="print" value="Selesai">
                                                  <?php }
                                                  ?>
                                                  </td>
                                                </tr>
                                            </tbody>
                                          </table>
                                      <?php } else {
                                          echo 'Pasien sudah memesan kamar';
                                        }
                                      } ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                          </div>
                    </form>
                    <?php if (isset($_POST['print'])) { ?>

                      <!-- PART 5 -->
                      <div class="wizard-pane text-center">
                      <form method="POST" action="print.php" target="_blank">
                        <input type="hidden" name="id" value="<?php echo $passs; ?>">
                        <input type="hidden" name="idriwayat" value="<?php echo $penyyy; ?>">
                        <div class="btn-group">
                          <a href="index.php"class="btn btn-info" title="Ke Menu Utama" data-toggle="tooltip">Ke Menu Utama</a>
                          <button type="submit" class="btn btn-primary" name="printone" title="Print" data-toggle="tooltip"><i class="fas fa-print"></i> Print Catatan Rekam Medis</button>
                        </div>
                      </form>
                      </div>
                    <?php } ?>
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
  <?php include "part/all-js.php";
  include "part/autocomplete.php"; ?>
</body>

</html>