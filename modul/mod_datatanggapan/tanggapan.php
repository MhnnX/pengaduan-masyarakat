<?php
if ($_SESSION['level'] == 'Petugas' || $_SESSION['level'] == "Admin")
{
  $aksi = "modul/mod_tanggapan/aksi_tanggapan.php";
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
      $edit = mysqli_query($conn, "SELECT tanggapan.*, pengaduan.tgl_pengaduan, pengaduan.judul, pengaduan.foto, pengaduan.isi_laporan, pengaduan.status, petugas.nama_petugas FROM tanggapan  INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas WHERE tanggapan.id_tanggapan = '$_GET[id]'");
      $r = mysqli_fetch_array($edit);

      echo "<h2>Details</h2>
      <form method='POST' action='$aksi?module=tanggapi-pengaduan&act=update'>
        <input type='hidden' name='id_tanggapan' value='$r[Id_Tanggapan]'>
        <table>
          <tr>
            <td>Petugas</td>
            <td>: <input type='text' name='nama_petugas' size='49' value='$r[nama_petugas]' disabled></td>
          </tr>
          <tr>
            <td>Tanggal Pengaduan</td>
            <td>: <input type='text' name='tgl_pengaduan' size='49' value='$r[tgl_pengaduan]' disabled></td>
          </tr>
          <tr>
            <td>Tanggal Tanggapan</td>
            <td>: <input type='text' name='tgl_tanggapan' size='49' value='$r[tgl_tanggapan]' disabled></td>
          </tr>
          <tr>
            <td>Judul</td>
            <td>: <input type='text' name='judul' size='49' value='$r[judul]' disabled></td>
          </tr>
          <tr>
            <td>Foto</td>
            <td>: <img src='./images/report/$r[foto]' width='100' height='100'></td>
          </tr>
          <tr>
            <td>Isi Laporan</td>
            <td>: <textarea name='isi_laporan' rows='10' cols='50' disabled>$r[isi_laporan]</textarea></td>
          </tr>
          <tr>";
      if ($level == "Petugas") {
        echo "<td>Tanggapan</td>
            <td>: <textarea name='tanggapan' rows='10' cols='50'>$r[tanggapan]</textarea></td>";
      } else {
        echo "<td>Tanggapan</td>
            <td>: <textarea name='tanggapan' rows='10' cols='50' disabled>$r[tanggapan]</textarea></td>";
      }
      echo "</tr>
          <tr>
            <td>Status</td>
            <td>: <input type='text' name='status' size='49' value='$r[status]' disabled></td>
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
