<?php
session_start();

$level = $_SESSION['level'];
if ($level == "Admin" || $level == "Petugas") 
{
  $id_petugas = $_SESSION['id_petugas'];
}
if ($level == "Masyarakat")
{
  $id_masyarakat = $_SESSION['id_masyarakat'];
}
$tanggal = date("Y-m-d");

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else
{
?>

  <html>

  <head>
    <title></title>
    <script type="text/javascript" src="../nicEdit.js"></script>
    <script type="text/javascript">
      bkLib.onDomLoaded(function() {
        nicEditors.allTextAreas()
      });
    </script>
    </script>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <div id="header">
      <div id="menu">
        <ul>
          <li><a href=?module=home>&#187; Home</a></li>
          <?php include "menu.php"; ?>
          <li><a href=logout.php>&#187; Logout</a></li>
        </ul>
        <!-- <p>&nbsp;</p> -->
      </div>

      <div id="content">
        <?php include "content.php"; ?>
      </div>

      <div id="footer">
        Copyright &copy; 2023 Menit.com. All rights reserved.
      </div>
    </div>
  </body>

  </html>
<?php
}
?>