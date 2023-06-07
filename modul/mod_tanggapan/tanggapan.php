<?php
if ($_SESSION['level'] == 'Masyarakat') {
  $aksi = "modul/mod_tmasyarakat/aksi_tanggapan.php";
  switch (isset($_GET['act']) ? $_GET['act'] : '') {
      // Tampil User
    default:
      echo "<h2>Tanggapan</h2>
          <table>
          <tr><th>no</th><th>id pengaduan</th><th>nama</th><th>tgl pengaduan</th><th>tgl tanggapan</th><th>petugas</th><th>Judul</th><th>tanggapan</th></tr>";
      // $tampil = mysqli_query($conn, "SELECT * FROM pengaduan");
      $tampil = mysqli_query($conn, "SELECT * FROM tanggapan WHERE Nama_Lengkap = '$_SESSION[nama]'");
      $no = 1;
      while ($r = mysqli_fetch_array($tampil)) {
        echo "<tr><td>$no</td>
        <td>$r[Id_Pengaduan]</td>
        <td>$r[Nama_Lengkap]</td>
        <td>$r[Tanggal_Pengaduan]</td>
        <td>$r[Tanggal_Tanggapan]</td>
        <td>$r[Nama_Petugas]</td>
        <td>$r[Judul_Pengaduan]</td>
        <td>$r[Pesan_Tanggapan]</td>
        </td></tr>";
        $no++;
      }
      echo "</table>";
      break;

    // case "detail":
    //   $edit = mysqli_query($conn, "SELECT tanggapan WHERE Id_Tanggapan = '$_GET[id]'");
    //   $r = mysqli_fetch_array($edit);

    //   echo "<h2>Details</h2>
    //   <form method='POST' action='$aksi?module=tmasyarakat&act=update'>
    //     <input type='hidden' name='id' value='$r[Id_Tanggapan]'>
    //     <table>
    //       <tr>
    //         <td>Petugas</td>
    //         <td>: <input type='text' name='judul' size='49' value='$r[nama_petugas]' disabled></td>
    //       </tr>
    //       <tr>
    //         <td>Tanggal Pengaduan</td>
    //         <td>: <input type='text' name='judul' size='49' value='$r[tgl_pengaduan]' disabled></td>
    //       </tr>
    //       <tr>
    //         <td>Tanggal Tanggapan</td>
    //         <td>: <input type='text' name='judul' size='49' value='$r[tgl_tanggapan]' disabled></td>
    //       </tr>
    //       <tr>
    //         <td>Judul</td>
    //         <td>: <input type='text' name='judul' size='49' value='$r[judul]' disabled></td>
    //       </tr>
    //       <tr>
    //         <td>Foto</td>
    //         <td>: <img src='./images/report/$r[foto]' width='100' height='100'></td>
    //       </tr>
    //       <tr>
    //         <td>Isi Laporan</td>
    //         <td>: <textarea name='isi_laporan' rows='10' cols='50' disabled>$r[isi_laporan]</textarea></td>
    //       </tr>
    //       <tr>
    //         <td>Tanggapan</td>
    //         <td>: <textarea name='isi_laporan' rows='10' cols='50' disabled>$r[tanggapan]</textarea></td>
    //       </tr>
    //       <tr>
    //         <td>Status</td>
    //         <td>: <input type='text' name='judul' size='49' value='$r[status]' disabled></td>
    //       </tr>
    //       <tr>
    //         <td colspan='2'>
    //           <input type='button' value='Batal' onclick='self.history.back()'>
    //         </td>
    //       </tr>
    //     </table>
    //   </form>";

    //   break;
  }
} else {
  echo "<p>Anda tidak berhak mengakses modul ini</p>";
}
