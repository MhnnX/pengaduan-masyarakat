<?php
session_start();
include "../../config/koneksi.php";


$module = $_GET['module'];
$act = isset($_GET['act']) ? $_GET['act'] : '';
$tanggal = date("Y-m-d");

// Hapus
if ($module == 'pengaduan-masyarakat' and $act == 'hapus')
{
    mysqli_query($conn, "DELETE FROM pengaduan WHERE Id_Pengaduan ='$_GET[id]'");
    header('location:../../media.php?module=' . $module);
}

// Input
elseif ($module == 'pengaduan-masyarakat' and $act == 'input')
{
    $judul          = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi_laporan    = mysqli_real_escape_string($conn, $_POST['isi_laporan']);
    mysqli_query($conn, "INSERT INTO pengaduan (Id_Pengaduan, Tanggal_Pengaduan, Nama_Lengkap, Judul_Pengaduan, Pesan_Pengaduan, Foto_Pengaduan, Status) VALUES ('', '$tanggal', '$_SESSION[nama]', '$judul', '$isi_laporan', '$_POST[foto]', 'Proses')");
    header('location:../../media.php?module=' . $module);
}

// Update   
elseif ($module == 'pengaduan-masyarakat' and $act == 'update')
{
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi_laporan = mysqli_real_escape_string($conn, $_POST['isi_laporan']);
    mysqli_query($conn, "UPDATE pengaduan SET Judul_Pengaduan = '$judul', Pesan_Pengaduan = '$isi_laporan' WHERE Id_Pengaduan = '$_POST[id]'");
    header('location:../../media.php?module=' . $module);
}
