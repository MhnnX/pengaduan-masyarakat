<?php
if ($_SESSION['level'] == 'Admin') {
  $aksi = "modul/mod_petugas/aksi_petugas.php";
  switch (isset($_GET['act']) ? $_GET['act'] : '') {
      // Tampil User
    default:
      echo "<h2>Petugas</h2>
          <input type=button value='Tambah Petugas/Admin' onclick=\"window.location.href='?module=data-petugas&act=input';\">
          <table>
          <tr><th>no</th><th>Nama</th><th>Username</th><th>No.Telp/HP</th><th>Level/HP</th><th>aksi</th></tr>";
      $tampil = mysqli_query($conn, "SELECT * FROM petugas ORDER BY username");
      $no = 1;
      while ($r = mysqli_fetch_array($tampil)) {
        echo "<tr><td>$no</td>
        <td>$r[Nama_Petugas]</td>
        <td>$r[Username]</td>
        <td>$r[Telp]</td>
        <td>$r[Level]</td>
        <td><a href=?module=data-petugas&act=update&id=$r[Id_Petugas]>Edit</a> | 
        <a href=$aksi?module=data-petugas&act=hapus&id=$r[Id_Petugas] onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</a>
        </td></tr>";
        $no++;
      }
      echo "</table>";
      break;

    case "input":
      echo "<h2>Tambah</h2>
          <form method='POST' action='$aksi?module=data-petugas&act=input'>
            <table>
              <tr>
                <td>Nama</td>
                <td>: <input type='text' name='nama_petugas' size='49'></td>
              </tr>
              <tr>
                <td>Username</td>
                <td>: <input type='text' name='username' size='49'></td>
              </tr>
              <tr>
                <td>Password</td>
                <td>: <input type='text' name='password' size='49'></td>
              </tr>  
              <tr>
                <td>Telp</td>
                <td>: <input type='text' name='telp' size='49'></td>
              </tr>
              <tr>
                  <td>Level</td>
                  <td>: 
                    <input type='radio' name='level' id='admin' value='admin'>
                    <label for='admin'>Admin</label>
                    <input type='radio' name='level' id='petugas' value='petugas'>
                    <label for='petugas'>Petugas</label>
                  </td>
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
      $edit = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas ='$_GET[id]'");
      $r = mysqli_fetch_array($edit);

      echo "<h2>Edit</h2>
            <form method='POST' action='$aksi?module=data-petugas&act=update'>
              <input type='hidden' name='id' value='$r[id_petugas]'>
              <table>
                <tr>
                  <td>Nama</td>
                  <td>: <input type='text' name='nama_petugas' value='$r[nama_petugas]' size='49'></td>
                </tr>
                <tr>
                  <td>Username</td>
                  <td>: <input type='text' name='username' value='$r[username]' size='49'></td>
                </tr>
                <tr>
                  <td>Password</td>
                  <td>: <input type='text' name='password' size='49'> *) </td>
                </tr>
                <tr>
                  <td>Telp</td>
                  <td>: <input type='text' name='telp' size='49' value='$r[telp]'></td>
                </tr>
                <tr>
                  <td>Level</td>
                  <td>: 
                    <input type='radio' name='level' id='admin' value='admin'";
      if ($r['level'] == 'Admin') echo " checked";
      echo ">
                    <label for='admin'>Admin</label>
                    <input type='radio' name='level' id='petugas' value='petugas'";
      if ($r['level'] == 'Petugas') echo " checked";
      echo ">
                    <label for='petugas'>Petugas</label>
                  </td>
                </tr>
                <tr>
                  <td>Blokir</td>
                  <td>: 
                    <input type='radio' name='blokir' id='yes' value='Yes'";
      if ($r['blokir'] == 'Yes') echo " checked";
      echo ">
                    <label for='yes'>Yes</label>
                    <input type='radio' name='blokir' id='no' value='No'";
      if ($r['blokir'] == 'No') echo " checked";
      echo ">
                    <label for='no'>No</label>
                  </td>
                </tr>";

      echo "<tr>
                <td colspan='2'>*) Apabila password tidak diubah, dikosongkan saja.</td>
              </tr>
              <tr>
                <td colspan='2'>
                  <input type='submit' value='Update'>
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
