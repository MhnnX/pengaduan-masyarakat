<?php
session_start();
include "../../config/koneksi.php";


$module = $_GET['module'];
$act = isset($_GET['act']) ? $_GET['act'] : '';
$tanggal = date("Y-m-d");

// // Proses user
// if ($module == 'pengaduan' and $act == 'proses') {
//     mysqli_query($conn, "UPDATE pengaduan SET id_petugas = '$_SESSION[id_petugas]', status = 'Proses' WHERE id_pengaduan = '$_GET[id]'");
//     header('location:../../media.php?module=' . $module);
// }
// Delete
// Input
if ($module == 'show-pengaduan' and $act == 'input') {
    mysqli_query($conn, "INSERT INTO tanggapan (Id_Tanggapan, Id_Pengaduan, Tanggal_Pengaduan, Tanggal_Tanggapan, Nama_Petugas, Nama_Lengkap, Judul_Pengaduan, Pesan_Pengaduan, Pesan_Tanggapan) VALUES ('', '$_POST[id]', '$_POST[tanggal]', '$tanggal', '$_POST[petugas]', '$_POST[nama]', '$_POST[judul]', '$_POST[pengaduan]', '$_POST[tanggapan]')");
    mysqli_query($conn, "UPDATE pengaduan SET Status = 'Selesai'");
    header('location:../../media.php?module=' . $module);
}

// Update
elseif ($module == 'pengaduan' and $act == 'update') {
    $update = mysqli_query($conn, "INSERT INTO tanggapan VALUES (NULL,'" . $_POST['id_pengaduan'] . "','" . $tanggal . "','" . $_POST['tanggapan'] . "','" . $_POST['id_petugas'] . "')");
    // if ($update) {
    //     $update = mysqli_query($conn, "UPDATE pengaduan SET status='Selesai' WHERE id_pengaduan='" . $_POST['id_pengaduan'] . "'");
    // }
    header('location:../../media.php?module=' . $module);
}
