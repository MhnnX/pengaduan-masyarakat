<?php
session_start();
include "../../config/koneksi.php";


$module = $_GET['module'];
$act = isset($_GET['act']) ? $_GET['act'] : '';
$tanggal = date("Y-m-d");


// Hapus user
if ($module == 'tanggapan' and $act == 'update') {
    $tanggapan = mysqli_real_escape_string($conn, $_POST['tanggapan']);
    $result = mysqli_query($conn, "UPDATE tanggapan SET tanggapan = '$tanggapan' WHERE id_tanggapan ='$_POST[id_tanggapan]'");
    header('location:../../media.php?module=' . $module);
}

if ($module == 'tanggapan' and $act == 'hapus') {
    // Menghapus entri pengaduan dari database
    mysqli_query($conn, "DELETE FROM tanggapan WHERE id_tanggapan ='$_GET[id]'");
    header('location:../../media.php?module=' . $module);
}
