<?php
session_start();
include "../../config/koneksi.php";

$module = $_GET['module'];
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Hapus Data Masyarakt
if ($module == 'data-masyarakat' and $act == 'hapus') {
  mysqli_query($conn, "DELETE FROM masyarakat WHERE id_masyarakat ='$_GET[id]'");
  header('location:../../media.php?module=' . $module);
}

// Input Data Masyarakat
elseif ($module == 'data-masyarakat' and $act == 'input') {
  $password = md5($_POST['password']);
  mysqli_query($conn, "INSERT INTO masyarakat (id_masyarakat, nik, nama, username, password, telp, level, blokir) VALUES ('', '$_POST[nik]', '$_POST[nama]', '$_POST[username]', '$password', '$_POST[telp]', 'Masyarakat', 'No')");
  header('location:../../media.php?module=' . $module);
}

// Update Data Masyarakat
elseif ($module == 'data-masyarakat' and $act == 'update') {
  if (empty($_POST['password']))
  {
    mysqli_query($conn, "UPDATE masyarakat SET NIK = '$_POST[nik]', Nama_Lengkap = '$_POST[nama]', Username = '$_POST[username]', Telp = '$_POST[telp]', Blokir = '$_POST[blokir]' WHERE  Id_Masyarakat = '$_POST[id]'");
  }
  else
  {
    $pass = md5($_POST['password']);
    mysqli_query($conn, "UPDATE masyarakat SET nik = '$_POST[nik]', nama = '$_POST[nama]', username = '$_POST[username]', password = '$pass', telp = '$_POST[telp]', blokir = '$_POST[blokir]' WHERE  id_masyarakat = '$_POST[id]'");
  }

  header('location:../../media.php?module=' . $module);
}
