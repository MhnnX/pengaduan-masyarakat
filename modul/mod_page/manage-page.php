<?php
$aksi="modul/mod_page/aksi_page.php";
switch(isset($_GET['act']) ? $_GET['act']:'')
{
    default:
    {
        echo "<h2>Modul</h2>
                <input type=button value='Tambah Modul' onclick=\"window.location.href='?module=manage-page&act=addpage';\">
                <table>
                    <tr>
                        <th>no</th>
                        <th>nama modul</th>
                        <th>link</th>
                        <th>publish</th>
                        <th>aktif</th>
                        <th>akses</th>
                        <th>aksi</th>
                    </tr>";
        $tampil=mysqli_query($conn,"SELECT * FROM modul ORDER BY urutan");
        while ($r=mysqli_fetch_array($tampil))
        {
            echo "<tr>
                    <td>$r[Urutan]</td>
                    <td>$r[Nama_Modul]</td>
                    <td><a href=$r[Link]>$r[Link]</a></td>
                    <td align=center>$r[Publish]</td>
                    <td align=center>$r[Aktif]</td>
                    <td>$r[Akses]</td>
                    <td><a href=?module=manage-page&act=editpage&id=$r[Id_Modul]>Edit</a> | <a href=$aksi?module=manage-page&act=deletepage&id=$r[Id_Modul]>Hapus</a></td>
                </tr>";
        }
        echo "</table>";
        echo "<div id=paging>*) Apabila PUBLISH bernilai Y, berarti akan ditampilkan pada menu utama di halaman pengunjung</div><br>";
    } 
    break;

    case "addpage":
    {
        echo "<h2>Tambah Page Baru</h2>
              <form method=POST action='$aksi?module=manage-page&act=addpage'>
                <table>
                    <tr>
                        <td>Nama Page</td>
                        <td> : <input type=text name='nama_modul'></td></tr>
                    <tr>
                        <td>Link</td>
                        <td> : <input type=text name='link' size=30></td></tr>
                    <tr>
                        <td>Publish</td>
                        <td> : <input type=radio name='publish' value='Yes'>Yes <input type=radio name='publish' value='No'>No</td>
                    </tr>
                    <tr>
                        <td>Aktif</td>
                        <td> : <input type=radio name='aktif' value='Yes'>Yes <input type=radio name='aktif' value='No'>No</td></tr>
                    <tr>
                        <td>Akses</td>
                        <td> : <input type=radio name='akses' value='Admin'>Admin 
                               <input type=radio name='akses' value='Petugas'>Petugas 
                               <input type=radio name='akses' value='Masyarakat'>Masyarakat 
                               <input type=radio name='akses' value='All'>All
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type=submit value=Simpan> 
                            <input type=button value=Batal onclick=self.history.back()>
                        </td>
                    </tr>
                </table>
              </form>";
    }
    break;
 
    case "editpage":
    {
        $edit = mysqli_query($conn,"SELECT * FROM modul WHERE Id_Modul = '$_GET[id]'");
        $r    = mysqli_fetch_array($edit);
    
        echo "<h2>Edit Modul</h2>
              <form method=POST action=$aksi?module=manage-page&act=editpage>
                <input type=hidden name=id value='$r[Id_Modul]'>
                <table>
                    <tr>
                        <td>Nama Modul</td>
                        <td> : <input type=text name='nama_modul' value='$r[Nama_Modul]'></td>
                    </tr>
                    <tr>
                        <td>Link</td>
                        <td> : <input type=text name='link' size=30 value='$r[Link]'></td>
                    </tr>";

            if ($r['Publish']=='Yes')
            {
                echo "<tr>
                        <td>Publish</td>
                        <td> : <input type=radio name='publish' value='Yes' checked>Yes 
                               <input type=radio name='publish' value='Nno'>No
                        </td>
                      </tr>";
            }
            else
            {
                echo "<tr>
                        <td>Publish</td>
                            <td> : <input type=radio name='publish' value='Yes'>Yes 
                                   <input type=radio name='publish' value='No' checked>No
                            </td>
                      </tr>";
            }

            if ($r['Aktif']=='Yes')
            {
                echo "<tr>
                        <td>Aktif</td>
                        <td> : <input type=radio name='aktif' value='Yes' checked>Yes 
                               <input type=radio name='aktif' value='No'>No
                        </td>
                      </tr>";
            }
            else
            {
                echo "<tr>
                        <td>Aktif</td>
                        <td> : <input type=radio name='aktif' value='Yes'>Yes 
                               <input type=radio name='aktif' value='No' checked>No
                        </td>
                      </tr>";
            }
                    
            if ($r['Akses']=='Admin')
            {
                echo "<tr>
                        <td>Akses</td>
                        <td> : <input type=radio name='akses' value='Admin' checked>Admin 
                               <input type=radio name='akses' value='Petugas'>Petugas 
                               <input type=radio name='akses' value='Masyarakat'>Masyarakat 
                               <input type=radio name='akses' value='All'>All
                        </td>
                      </tr>";
            }
            elseif ($r['Akses']=='Petugas')
            {
                echo "<tr>
                        <td>Status</td>
                        <td> : <input type=radio name='akses' value='Admin'>Admin 
                               <input type=radio name='akses' value='Petugas' checked>Petugas 
                               <input type=radio name='akses' value='Masyarakat'>Masyarakat 
                               <input type=radio name='akses' value='All'>All
                        </td>
                      </tr>";
            }
            elseif ($r['Akses']=='Masyarakat')
            {
                echo "<tr>
                        <td>Status</td>
                        <td> : <input type=radio name='akses' value='Admin'>Admin 
                               <input type=radio name='akses' value='Petugas'>Petugas 
                               <input type=radio name='akses' value='Masyarakat' checked>Masyarakat 
                               <input type=radio name='akses' value='All'>All
                        </td>
                      </tr>";
            }
            elseif ($r['Akses']=='All')
            {
                echo "<tr>
                        <td>Status</td>
                        <td> : <input type=radio name='akses' value='Admin'>Admin 
                               <input type=radio name='akses' value='Petugas'>Petugas 
                               <input type=radio name='akses' value='Masyarakat'>Masyarakat 
                               <input type=radio name='akses' value='All' checked>All
                        </td>
                      </tr>";
            }

            echo "<tr>
                    <td>Urutan</td>
                    <td> : <input type=text name='urutan' size=1 value='$r[Urutan]'></td>
                  </tr>
                  <tr>
                    <td colspan=2><input type=submit value=Update>
                    <input type=button value=Batal onclick=self.history.back()></td>
                  </tr>
                </table>
              </form>";
    }
    break;  
}
?>
