<?php
session_start();
include "../../config/koneksi.php";


$module = $_GET['module'];
$act = isset($_GET['act']) ? $_GET['act'] : '';
$id_masyarakat = $_SESSION['id_masyarakat'];
$tanggal = date("Y-m-d");

// Hapus user
if ($module == 'tmasyarakat' and $act == 'hapus') {
    // Menghapus entri pengaduan dari database
    mysqli_query($conn, "DELETE FROM tanggapan WHERE id_tanggapan ='$_GET[id]'");
    header('location:../../media.php?module=' . $module);
}
