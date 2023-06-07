<?php
session_start();
include "../../config/koneksi.php";

$module = $_GET['module'];
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Hapus user
if ($module == 'datapetugas' and $act == 'hapus') {
  mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas ='$_GET[id]'");
  header('location:../../media.php?module=' . $module);
}

// Input user
elseif ($module == 'datapetugas' and $act == 'input') {
  // $pass=md5($_POST(password));
  $password = md5($_POST['password']);
  mysqli_query($conn, "INSERT INTO petugas (id_petugas, nama_petugas, username,
                                 password,
                                 telp,
                                 level, blokir) 
	                       VALUES('', '$_POST[nama_petugas]',
                                '$_POST[username]',
                                '$password',
                                '$_POST[telp]',
                                '$_POST[level]',
                                'No')");
  header('location:../../media.php?module=' . $module);
}

// Update user
elseif ($module == 'datapetugas' and $act == 'update') {
  if (empty($_POST['password'])) {
    mysqli_query($conn, "UPDATE petugas SET nama_petugas = '$_POST[nama_petugas]',
                                  username = '$_POST[username]',
                                  telp = '$_POST[telp]',
                                  level = '$_POST[level]',
                                  blokir = '$_POST[blokir]'   
                           WHERE  id_petugas = '$_POST[id]'");
  }
  // Apabila password diubah
  else {
    $pass = md5($_POST['password']);
    mysqli_query($conn, "UPDATE petugas SET nama_petugas = '$_POST[nama_petugas]',
                                  username = '$_POST[username]',
                                  password = '$pass',
                                  telp = '$_POST[telp]',
                                  level = '$_POST[level]',
                                  blokir = '$_POST[blokir]'   
                           WHERE  id_petugas = '$_POST[id]'");
  }
  header('location:../../media.php?module=' . $module);
}
