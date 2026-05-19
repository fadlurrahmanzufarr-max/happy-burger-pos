<?php
session_start();
// Proteksi halaman: kalau belum login, kembalikan ke login.php di folder luar
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include '../config/koneksi.php';

// Ambil ID burger dari URL browser
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Jalankan query hapus data berdasarkan id_burger
    $query = "DELETE FROM menu_burger WHERE id_burger = $id";
    
    if (mysqli_query($koneksi, $query)) {
        // DIKOREKSI: Menggunakan header PHP murni agar instan kembali ke dasboard.php tanpa error Not Found
       header("Location: managemen_produk.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: managemen_produk.php");
    exit;
}
?>