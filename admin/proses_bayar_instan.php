<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
include '../config/koneksi.php';

if (isset($_POST['total_bayar'])) {
    $total = $_POST['total_bayar'];
    $metode = $_POST['metode'];

    // Query untuk memasukkan data transaksi ke database
    $query = "INSERT INTO transaksi (total_bayar, metode_pembayaran) VALUES ('$total', '$metode')";
    
    if (mysqli_query($koneksi, $query)) {
        // KOSONGKAN KERANJANG SETELAH SUKSES BAYAR BIAR GAK NUMPUK
        $_SESSION['cart'] = [];
        
        // Lempar langsung ke halaman info_transaksi.php
        echo "<script>alert('Pembayaran Berhasil! Data Masuk ke Info Transaksi.'); window.location='info_transaksi.php';</script>";
        exit;
    } else {
        echo "Gagal menyimpan transaksi: " . mysqli_error($koneksi);
    }
} else {
    // Kalau diakses langsung tanpa pencet tombol bayar, balikin ke keranjang
    header("Location: keranjang.php");
    exit;
}
?>