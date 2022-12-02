<?php


$judul = "SiMedis";
$pecahjudul = explode(" ", $judul);
$acronym = "";

foreach ($pecahjudul as $w) {
  $acronym .= $w[0];
}
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html"><?php echo $judul; ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html"><?php echo $acronym; ?></a>
    </div>
    <ul class="sidebar-menu">
      <li <?php echo ($page == "Dashboard") ? "class=active" : ""; ?>><a class="nav-link" href="index.php"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
      <li class="menu-header">Menu</li>

      <?php if($_SESSION['id_pegawai'] ==5 || $_SESSION['id_pegawai'] ==7 ) { ?>
      <li <?php echo ($page == "Catatan Rekam Medis") ? "class=active" : ""; ?>><a class="nav-link" href="rawat_jalan.php"><i class="fas fa-stethoscope"></i> <span>Input Rekam Medis</span></a></li> <?php } ?>
      <li <?php echo ($page == "Data Pegawai" || @$page1 == "det") ? "class=active" : ""; ?>><a class="nav-link" href="pasien.php"><i class="fas fa-book"></i> <span>Catatan Rekam Medis</span></a></li>

      <li <?php echo ($page == "Data Dokter" || @$page1 == "detrot") ? "class=active" : ""; ?>><a class="nav-link" href="dokter.php"><i class="fas fa-user"></i> <span>Dokter</span></a></li>

      <?php if($_SESSION['id_pegawai'] ==7) { ?>
      <li <?php echo ($page == "Data Users") ? "class=active" : ""; ?>><a href="pegawai.php" class="nav-link"><i class="fas fa-users"></i> <span>Users</span></a></li> <?php } ?>
        
      <li <?php echo ($page == "Data Riwayat Keluhan" || @$page1 == "detrot") ? "class=active" : ""; ?>><a class="nav-link" href="celuhan.php"><i class="fas fa-user-injured"></i> <span>Riwayat Keluhan</span></a></li>
      <li <?php echo ($page == "Data Obat") ? "class=active" : ""; ?>><a class="nav-link" href="obat.php"><i class="fas fa-briefcase-medical"></i> <span>Obat</span></a></li>
      
      
  </aside>
</div>