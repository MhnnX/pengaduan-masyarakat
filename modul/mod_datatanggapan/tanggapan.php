<?php
if ($_SESSION['level'] == 'Petugas' || $_SESSION['level'] == "Admin")
{
  $aksi = "modul/mod_datatanggapan/aksi_tanggapan.php";
  switch (isset($_GET['act']) ? $_GET['act'] : '')
  {
      // Tampil User
    default:
      echo "<h2>Tanggapan</h2>
          <table>
          <tr><th>no</th><th>nama petugas</th><th>nama masyarakat</th><th>tgl pengaduan</th><th>tgl tanggapan</th><th>Judul</th><th>anggapan</th><th>aksi</th></tr>";
      if ($level == "Petugas")
      {
        $tampil = mysqli_query($conn, "SELECT * FROM tanggapan");
      }
      elseif ($level == "Admin")
      {
        $tampil = mysqli_query($conn, "SELECT * FROM tanggapan");
      }
      $no = 1;
      while ($r = mysqli_fetch_array($tampil)) {
        echo "<tr><td>$no</td>
        <td>$r[Nama_Petugas]</td>
        <td>$r[Nama_Lengkap]</td>
        <td>$r[Tanggal_Pengaduan]</td>
        <td>$r[Tanggal_Tanggapan]</td>
        <td>$r[Judul_Pengaduan]</td>
        <td>$r[Pesan_Tanggapan]</td>";

        if ($level == "Petugas")
        {
          echo "<td><a href=?module=tanggapi-pengaduan&act=update&id=$r[Id_Tanggapan]>Detail</a> | <a href=$aksi?module=tanggapi-pengaduan&act=hapus&id=$r[Id_Tanggapan] onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</a>";
        }
        else
        {
          echo "<td><a href=?module=tanggapi-pengaduan&act=update&id=$r[Id_Pengaduan]>Detail</a>";
        }
        echo "</td></tr>";
        $no++;
      }
      echo "</table>";
      break;

    case "update":
      $edit = mysqli_query($conn, "SELECT * FROM tanggapan WHERE Id_Tanggapan = '$_GET[id]'");
      $show = mysqli_query($conn, "SELECT * FROM pengaduan");
      $r = mysqli_fetch_array($edit);
      $re = mysqli_fetch_array($show);

      echo "<h2>Details</h2>
      <form method='POST' action='$aksi?module=tanggapi-pengaduan&act=update'>
        <input type='hidden' name='id_tanggapan' value='$r[Id_Tanggapan]'>
        <table>
          <tr>
            <td>Petugas</td>
            <td>: <input type='text' name='nama_petugas' size='49' value='$r[Nama_Petugas]' disabled></td>
          </tr>
          <tr>
            <td>Tanggal Pengaduan</td>
            <td>: <input type='text' name='tgl_pengaduan' size='49' value='$r[Tanggal_Pengaduan]' disabled></td>
          </tr>
          <tr>
            <td>Tanggal Tanggapan</td>
            <td>: <input type='text' name='tgl_tanggapan' size='49' value='$r[Tanggal_Tanggapan]' disabled></td>
          </tr>
          <tr>
            <td>Judul</td>
            <td>: <input type='text' name='judul' size='49' value='$r[Judul_Pengaduan]' disabled></td>
          </tr>
          <tr>
            <td>Foto</td>
            <td>: <img src='./images/pengaduan/$re[Foto_Pengaduan]' width='300'></td>
          </tr>
          <tr>
            <td>Isi Laporan</td>
            <td>: <textarea name='isi_laporan' rows='10' cols='50' disabled>$r[Pesan_Pengaduan]</textarea></td>
          </tr>
          <tr>";
      if ($level == "Petugas") {
        echo "<td>Tanggapan</td>
            <td>: <textarea name='tanggapan' rows='10' cols='50'>$r[Pesan_Tanggapan]</textarea></td>";
      } else {
        echo "<td>Tanggapan</td>
            <td>: <textarea name='tanggapan' rows='10' cols='50' disabled>$r[Pesan_Tanggapan]</textarea></td>";
      }
      echo "</tr>
          <tr>
            <td>Status</td>
            <td>: <input type='text' name='status' size='49' value='$re[Status]' disabled></td>
          </tr>
          <tr>
            <td colspan='2'>";
      if ($level == "Petugas") {
        echo "<input type='submit' value='Simpan'>";
      }
      echo " <input type='button' value='Batal' onclick='self.history.back()'>
            </td>
          </tr>
        </table>
      </form>";

      break;
  }
} else {
  echo "<p>Anda tidak berhak mengakses modul ini</p>";
}
