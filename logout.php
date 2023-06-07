<?php
session_start();
session_destroy();
header('Location:index.php');

// Apabila setelah logout langsung menuju halaman utama website, aktifkan baris di bawah ini:

//  header('location:http://www.alamatwebsite.com');
