<?php
// config/koneksi.php
$host = "localhost";
$user = "root";
$pass = ""; // kosongkan jika bawaan Laragon
$db   = "db_happyburger"; // 👈 WAJIB DIGANTI JADI INI BIAR SINKRON

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>