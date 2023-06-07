<?php
include "config/koneksi.php";
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars(md5($_POST['password']));

// if (isset($_POST['login']))
// {
  if (empty($username) || empty($password))
  {
    echo "<center>LOGIN GAGAL! <br> 
          Username atau Password tidak boleh kosong.<br><br>";
    echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
  }
  else
  {
    $proses = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");
    $user = mysqli_num_rows($proses);
    $db = mysqli_fetch_array($proses);

    $proses2 = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username' AND password = '$password' AND blokir = 'No'");
    $user2 = mysqli_num_rows($proses2);
    $db2 = mysqli_fetch_array($proses2);


    if ($user > 0)
    {
      session_start();
      $_SESSION['id_petugas']   = $db['Id_Petugas'];
      $_SESSION['nama_petugas'] = $db['Nama_Petugas'];
      $_SESSION['username']     = $db['Username'];
      $_SESSION['password']     = $db['Password'];
      $_SESSION['level']        = $db['Level'];

      header('Location: media.php?module=home');
      exit;
    }
    else if ($user2 > 0)
    {
      session_start();
      $_SESSION['id_masyarakat']  = $db2['Id_Masyarakat'];
      $_SESSION['nama']           = $db2['Nama_Lengkap'];
      $_SESSION['username']       = $db2['Username'];
      $_SESSION['password']       = $db2['Password'];
      $_SESSION['telp']           = $db2['Telp'];
      $_SESSION['level']          = $db2['Level'];
      $_SESSION['blokir']         = $db2['Blokir'];

      header('Location: media.php?module=home');
      exit;
    }
    else
    {
      echo "<link href=../config/adminstyle.css rel=stylesheet type=text/css>";
      echo "<center>LOGIN GAGAL! <br> 
            Username atau Password Anda tidak benar.<br>
            Atau account Anda sedang diblokir.<br>";
      echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
    }
  }
// }

if (isset($_POST['register'])) {
  $password = md5($_POST['password']);
  mysqli_query($conn, "INSERT INTO masyarakat (Id_Masyarakat, NIK, Nama_Lengkap, Username, Password, Telp) VALUES ('', '$_POST[nik]', '$_POST[nama]', '$_POST[username]', '$password', '$_POST[telp]')");
  header('location: index.php');
}


// if (isset($_POST['register']))
// {
//   $NIK        = $_POST['nik'];
//   $Fullname   = mysqli_real_escape_string($conn, $_POST['nama']);
//   $Phone      = mysqli_real_escape_string($conn, $_POST['telp']); 
//   $Username   = mysqli_real_escape_string($conn, $_POST['username']);
//   $Password   = mysqli_real_escape_string($conn, $_POST['password']);
  
//   $encrypt    = md5($Password);
//   $result     = "INSERT INTO masyarakat (Id_Masyarakat, NIK, Full_Name, Phone, Profil, Username, Password, Level, Blokir) VALUES ('', '$NIK', '$Fullname', '$Phone', '', $Username', '$encrypt', '', '')";

//   if (mysqli_query($conn, $result))
//   {
//       header("Location: media.php?module=home");
//   }
//   else
//   {
//       echo "Register gagal : " . mysqli_error($conn);
//   }    
// }