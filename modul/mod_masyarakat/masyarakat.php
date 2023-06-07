<?php
if ($_SESSION['level'] == 'Admin')
{
  $aksi = "modul/mod_masyarakat/aksi_masyarakat.php";
  switch (isset($_GET['act']) ? $_GET['act'] : '')
  {
    default:
    {
      echo "<h2>Masyarakat</h2>
          <input type=button value='Tambah Data Masyarakat' onclick=\"window.location.href='?module=data-masyarakat&act=input';\">
          <table>
          <tr><th>no</th><th>NIK</th><th>Nama</th><th>Username</th><th>Telp</th><th>Blokir</th><th>aksi</th></tr>";
      $tampil = mysqli_query($conn, "SELECT * FROM masyarakat ORDER BY username");
      $no = 1;
      while ($r = mysqli_fetch_array($tampil))
      {
        echo "<tr><td>$no</td>
        <td>$r[NIK]</td>
        <td>$r[Nama_Lengkap]</td>
        <td>$r[Username]</td>
        <td>$r[Telp]</td>
        <td align=center>$r[Blokir]</td>
        <td><a href=?module=data-masyarakat&act=update&id=$r[Id_Masyarakat]>Edit</a> | 
        <a href=$aksi?module=data-masyarakat&act=hapus&id=$r[Id_Masyarakat] onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</a>
        </td></tr>";
        $no++;
      }
      echo "</table>";
      break;
    }

    case "input":
    {
      echo "<h2>Tambah</h2>
          <form method='POST' action='$aksi?module=data-masyarakat&act=input'>
            <table>
              <tr>
                <td>NIK</td>
                <td>: <input type='text' name='nik' size='49'></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>: <input type='text' name='nama' size='49'></td>
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
                <td>Blokir</td>
                <td> : <input type=radio name='blokir' value='Yes'> Yes </td>  
                <td> : <input type=radio name='blokir' value='No'> No </td
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
    }

    case "update":
    {
      $edit = mysqli_query($conn, "SELECT * FROM masyarakat WHERE id_masyarakat ='$_GET[id]'");
      $r = mysqli_fetch_array($edit);

      echo "<h2>Edit</h2>
            <form method='POST' action='$aksi?module=data-masyarakat&act=update'>
              <input type='hidden' name='id' value='$r[Id_Masyarakat]'>
              <table>
                <tr>
                  <td>NIK</td>
                  <td> : <input type='text' name='nik' value='$r[NIK]' size='49'></td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td> : <input type='text' name='nama' value='$r[Nama_Lengkap]' size='49'></td>
                </tr>
                <tr>
                  <td>Username</td>
                  <td> : <input type='text' name='username' value='$r[Username]' size='49'></td>
                </tr>
                <tr>
                  <td>Password</td>
                  <td> : <input type='text' name='password' size='49'> *) </td>
                </tr>
                <tr>
                  <td>Telp</td>
                  <td> : <input type='text' name='telp' size='49' value='$r[Telp]'></td>
                </tr>
                <tr>
                  <td>Blokir</td>";
                  if ($r['Blokir']=='No')
                  {
                    echo "<td> : <input type=radio name='blokir' value='Yes'> Yes   
                          <input type=radio name='blokir' value='No' checked> No </td>";
                  }
                  else
                  {
                    echo "<td> : <input type=radio name='blokir' value='Yes' checked> Yes 
                          <input type=radio name='blokir' value='No'> No </td>
                </tr>";
                  }
          echo "<tr>
                  <td colspan='2'>*) Apabila password tidak diubah, dikosongkan saja.</td>
                </tr>
                <tr>
                  <td colspan='2'>
                    <input type='submit' value='Update Data'>
                    <input type='button' value='Batal' onclick='self.history.back()'>
                  </td>
                </tr>
              </table>
          </form>";
      break;
    }
  }
} else {
  echo "<p>Anda tidak berhak mengakses modul ini</p>";
}
