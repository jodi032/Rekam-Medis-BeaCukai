<?php
function umur($tgl){
  $lahir = new DateTime($tgl);
  $hari_ini = new DateTime();
    
  $diff = $hari_ini->diff($lahir);
    
  echo $diff->y ." Tahun";
  if($diff->m > 0){
  echo " ". $diff->m ." Bulan";
  }
  }
?>