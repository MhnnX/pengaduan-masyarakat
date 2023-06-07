<?php
if ($_SESSION['level'] == 'Masyarakat') {
  $aksi = "modul/mod_pengaduan/aksi_pengaduan.php";
  switch (isset($_GET['act']) ? $_GET['act'] : '') {
      // Tampil User
    default:
      echo "<h2>Pengaduan</h2>
          <input type=button value='Tambah Pengaduan' onclick=\"window.location.href='?module=pengaduan-masyarakat&act=input';\">
          <table>
          <tr><th>no</th><th>nama</th><th>tgl pengaduan</th><th>Judul</th><th>Pesan</th><th>foto</th><th>status</th><th>aksi</th></tr>";
      $tampil = mysqli_query($conn, "SELECT * FROM pengaduan WHERE Nama_Lengkap = '$_SESSION[nama]'");
      $no = 1;
      while ($r = mysqli_fetch_array($tampil))
      {
        echo "<tr><td>$no</td>
              <td>$r[Nama_Lengkap]</td>
              <td align=center>$r[Tanggal_Pengaduan]</td>
              <td>$r[Judul_Pengaduan]</td>
              <td>$r[Pesan_Pengaduan]</td>
              <td>$r[Foto_Pengaduan]</td>
              <td>$r[Status]</td>
              <td><a href=?module=pengaduan-masyarakat&act=update&id=$r[Id_Pengaduan]>Edit</a> | 
              <a href=?module=pengaduan-masyarakat&act=detail&id=$r[Id_Pengaduan]>Detail</a> | 
              <a href=$aksi?module=pengaduan-masyarakat&act=hapus&id=$r[Id_Pengaduan] onclick=\"return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?');\">Hapus</a>
              </td></tr>";
        $no++;
      }
      echo "</table>";

      break;

    case "input":
      echo "<h2>Tambah</h2>
          <form method='POST' action='$aksi?module=pengaduan-masyarakat&act=input' enctype='multipart/form-data'>
            <table>
              <tr>
                <td>Judul</td>
                <td>: <input type='text' name='judul' size='49' required></td>
              </tr>
              <tr>
                <td>Isi Laporan</td>
                <td>: <textarea name='isi_laporan' rows='10' cols='50' required></textarea></td>
              </tr>
                <td>Foto</td>
                <td>: <input type='file' name='foto_pengaduan' accept='image/png, image/jpeg'></td>
              </tr>
              <tr>
                <td colspan='2'>
                  <input type='submit' value='Simpan'>
                  <input type='button' value='Batal' onclick='self.history.back()'>
                </td>
              </tr>
            </table>
          </form>";
      break;

    case "update":
      $edit = mysqli_query($conn, "SELECT * FROM pengaduan WHERE Id_Pengaduan ='$_GET[id]'");
      $r = mysqli_fetch_array($edit);

      echo "<h2>Edit</h2>
            <form method='POST' action='$aksi?module=pengaduan-masyarakat&act=update'>
              <input type='hidden' name='id' value='$r[Id_Pengaduan]'>
              <table>
                <tr>
                  <td>Judul</td>
                  <td>: <input type='text' name='judul' size='49' value='$r[Judul_Pengaduan]'></td>
                </tr>
                <tr>
                  <td>Foto</td>
                  <td>: <img src='pengaduan_masyarakat/images/pengaduan/$r[Foto_Pengaduan]' width='100' height='100'></td>
                </tr>
                </tr>
                <td></td>
                <td>: <input type='file' name='foto' accept='image/png, image/jpeg'></td>
                <tr>
                  <td>Isi Laporan</td>
                  <td>: <textarea name='isi_laporan' rows='10' cols='50'>$r[Pesan_Pengaduan]</textarea></td>
                </tr>
              </tr>
                <tr>
                <td colspan='2'>
                  <input type='submit' value='Simpan'>
                  <input type='button' value='Batal' onclick='self.history.back()'>
                </td>
              </tr>
            </table>
          </form>";
      break;

    case "detail":
      $edit = mysqli_query($conn, "SELECT * FROM pengaduan WHERE Id_Pengaduan= '$_GET[id]'");
      $r = mysqli_fetch_array($edit);

      echo "<h2>Edit</h2>
              <form method='POST' action='$aksi?module=pengaduan-masyarakat&act=update'>
                <input type='hidden' name='id' value='$r[Id_Pengaduan]'>
                <table>
                  <tr>
                    <td>Tanggal Pengaduan</td>
                    <td>: <input type='text' name='judul' size='49' value='$r[Tanggal_Pengaduan]' disabled></td>
                  </tr>
                  <tr>
                    <td>Judul Pengaduan</td>
                    <td>: <input type='text' name='judul' size='49' value='$r[Judul_Pengaduan]' disabled></td>
                  </tr>
                  <tr>
                    <td>Pesan/Pengaduan</td>
                    <td>: <textarea name='isi_laporan' rows='10' cols='50' disabled>$r[Pesan_Pengaduan]</textarea></td>
                  </tr>
                  <tr>
                    <td>Foto</td>
                    <td>: <img src='./images/pengaduan/$r[Foto_Pengaduan]' alt='$r[Foto_Pengaduan]' width='300'></td>
                  </tr>
                  <tr>
                    <td>Status Pengaduan</td>
                    <td>: <input type='text' name='judul' size='49' value='$r[Status]' disabled></td>
                  </tr>
                  <tr>
                  <td colspan='2'>
                    <input type='button' value='Batal' onclick='self.history.back()'>
                  </td>
                </tr>
              </table>
            </form>";
      break;
  }
} else {
  echo "<p>Anda tidak berhak mengakses modul ini</p>";
}
