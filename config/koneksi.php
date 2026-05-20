<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "db_happyburger"; // Sudah mengarah ke database barumu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>