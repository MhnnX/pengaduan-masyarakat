<?php
if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'Petugas') {
  $aksi = "modul/mod_datapengaduan/aksi_pengaduan.php";
  switch (isset($_GET['act']) ? $_GET['act'] : '') {
      // Tampil User
    default:
      echo "<h2>Pengaduan</h2>
          <table>
          <tr><th>no</th><th>nama</th><th>tgl pengaduan</th><th>Judul</th><th>pesan pengaduan</th><th>foto</th><th>status</th><th>aksi</th></tr>";
      $tampil = mysqli_query($conn, "SELECT * FROM pengaduan");
      $no = 1;
      while ($r = mysqli_fetch_array($tampil)) {
        echo "<tr><td>$no</td>
        <td>$r[Nama_Lengkap]</td>
        <td align=center>$r[Tanggal_Pengaduan]</td>
        <td>$r[Judul_Pengaduan]</td>
        <td>$r[Pesan_Pengaduan]</td>
        <td>$r[Foto_Pengaduan]</td>
        <td>$r[Status]</td>
        <td><a href=?module=show-pengaduan&act=detail&id=$r[Id_Pengaduan]>Tanggapi</a>
        </td></tr>";
        $no++;
      }
      echo "</table>";
      break;

    case "detail":
      $edit = mysqli_query($conn, "SELECT * FROM pengaduan WHERE Id_Pengaduan = '$_GET[id]'");
      $r = mysqli_fetch_array($edit);

      echo "<h2>Details</h2>
                <form method='POST'>
                  <input type='hidden' name='id' value='$r[Id_Pengaduan]'>
                  <table>
                    <tr>
                      <td>Dari</td>
                      <td>: <input type='text' name='judul' size='49' value='$r[Nama_Lengkap]' disabled></td>
                    </tr>
                    <tr>
                      <td>Tanggal Masuk</td>
                      <td>: <input type='text' name='judul' size='49' value='$r[Tanggal_Pengaduan]' disabled></td>
                    </tr>
                    <tr>
                      <td>Judul</td>
                      <td>: <input type='text' name='judul' size='49' value='$r[Judul_Pengaduan]' disabled></td>
                    </tr>
                    <tr>
                      <td>Foto</td>
                      <td>: <img src='./images/report/$r[Foto_Pengaduan]' width='100' height='100' disabled></td>
                    </tr>
                    <tr>
                      <td>Isi Laporan</td>
                      <td>: <textarea name='isi_laporan' rows='10' cols='50' disabled>$r[Pesan_Pengaduan]</textarea></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>: <input type='text' name='judul' size='49' value='$r[Status]' disabled></td>
                    </tr>
                    <tr>";
                    echo "</td>
                    </tr>
                  </table>
                </form>";

      $tanggapi = mysqli_query($conn, "SELECT * FROM tanggapan WHERE Id_Tanggapan");
      $re = mysqli_fetch_array($tanggapi);

      echo "<h2>Tanggapi</h2>
            <form method='POST' action='$aksi?module=show-pengaduan&act=input'>
            <input type='hidden' name='nama' size='49' value='$r[Nama_Lengkap]'>
            <input type='hidden' name='pengaduan' value='$r[Pesan_Pengaduan]'>
            <input type='hidden' name='id' value='$r[Id_Pengaduan]'>
            <input type='hidden' name='tanggal' size='49' value='$r[Tanggal_Pengaduan]'>
            <input type='hidden' name='judul' size='49' value='$r[Judul_Pengaduan]'>
            <input type='hidden' name='petugas' size='49' value='$_SESSION[nama_petugas]'>
            <table>
              <tr>
                <td>Tanggapan</td>
                <td>: <textarea name='tanggapan' rows='10' cols='50'></textarea></td>
              </tr>
              <tr>
              <td colspan='2'>
                <input type='submit' value='Tanggapi'>
              </td>";
              echo "</td>
              </tr>
            </table>
          </form>";
      break;

  }
} else {
  echo "<p>Anda tidak berhak mengakses modul ini</p>";
}
