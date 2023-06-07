<?php
session_start();
include "../../config/koneksi.php";

$module = $_GET['module'];
$act = isset($_GET['act']) ? $_GET['act']:'';

// Hapus modul
if ($module=='manage-page' AND $act=='deletepage'){
  mysqli_query($conn,"DELETE FROM modul WHERE id_modul='$_GET[id]'");
  header('location:../../media.php?module=' . $module);
}

elseif ($module=='manage-page' AND $act=='addpage'){
  $u = mysqli_query($conn, "SELECT Urutan FROM modul ORDER by Urutan ASC");
  $d = mysqli_fetch_array($u);
  $urutan = $d['Urutan']+1;
  
  mysqli_query($conn, "INSERT INTO modul(Nama_Modul, Link, Publish, Aktif, Akses, Urutan) VALUES ('$_POST[nama_modul]', '$_POST[link]', '$_POST[publish]', '$_POST[aktif]', '$_POST[akses]', '$urutan')");
  header('location: ../../media.php?module=' . $module);
}

// Update modul
elseif ($module=='manage-page' AND $act=='editpage'){
  mysqli_query($conn, "UPDATE modul SET Nama_Modul = '$_POST[nama_modul]', Link = '$_POST[link]', Publish = '$_POST[publish]', Aktif = '$_POST[aktif]', Akses = '$_POST[akses]', Urutan = '$_POST[urutan]' WHERE Id_Modul = '$_POST[id]'");
  header('location: ../../media.php?module=' . $module);
}
?>
