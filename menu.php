<?php
include "config/koneksi.php";

if (!isset($_SESSION['username']))
{
  header("Location: login.php");
  exit;
}

if ($_SESSION['level'] == 'Admin')
{
  $sql = mysqli_query($conn, "SELECT * FROM modul WHERE (Akses = 'Admin' OR Akses = 'Petugas' OR Akses = 'All') AND Aktif='Yes' ORDER BY Urutan");
}
elseif ($_SESSION['level'] == 'Petugas')
{
  $sql = mysqli_query($conn, "SELECT * FROM modul WHERE (Akses = 'Petugas' OR Akses = 'All') AND Aktif='Yes' ORDER BY Urutan");
}
elseif ($_SESSION['level'] == 'Masyarakat')
{
  $sql = mysqli_query($conn, "SELECT * FROM modul WHERE (Akses = 'Masyarakat' OR Akses = 'All') AND Aktif='Yes' ORDER BY Urutan");
}

while ($m = mysqli_fetch_array($sql))
{
  echo "<li><a href='$m[Link]'>&#187; $m[Nama_Modul]</a></li>";
}