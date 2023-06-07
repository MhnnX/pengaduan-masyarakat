<?php
include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";

// Bagian Home
if ($_GET['module'] == 'home')
{
  if ($level == "Admin" || $level == "Petugas")
  {
    echo "<h2>Selamat Datang</h2>
            <p>Hai <b>$_SESSION[nama_petugas]</b>, selamat datang di halaman Administrator website Menitcom.<br> Silahkan klik menu pilihan yang berada 
            di sebelah kiri untuk mengelola content website. </p>
            <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
            <p align=right>Login : $hari_ini, ";
    echo tgl_indo(date("Y m d"));
    echo " | ";
    echo date("H:i:s");
    echo " WIB</p>";
  }
  else 
  {
    echo "<h2>Selamat Datang</h2>
            <p>Hai <b>$_SESSION[nama]</b>, selamat datang di halaman Pengaduan Masyarakat</p>
            <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
            <p align=right>Login : $hari_ini, ";
    echo tgl_indo(date("Y m d"));
    echo " | ";
    echo date("H:i:s");
    echo " WIB</p>";
  }
}

// Admin =================================
if ($_GET['module'] == 'manage-page')
{
  include "modul/mod_page/manage-page.php";
}

if ($_GET['module'] == 'data-petugas')
{
  include "modul/mod_petugas/petugas.php";
}

if ($_GET['module'] == 'data-masyarakat')
{
  include "modul/mod_masyarakat/masyarakat.php";
}

// Petugas ===============================
if ($_GET['module'] == 'show-pengaduan') {
  include "modul/mod_datapengaduan/pengaduan.php";
}

if ($_GET['module'] == 'tanggapi-pengaduan')
{
  include "modul/mod_datatanggapan/tanggapan.php";
}

// Masyarakat ===============================
if ($_GET['module'] == 'pengaduan-masyarakat')
{
  include "modul/mod_pengaduan/pengaduan.php";
}

if ($_GET['module'] == 'show-tanggapan')
{
  include "modul/mod_tanggapan/tanggapan.php";
}
