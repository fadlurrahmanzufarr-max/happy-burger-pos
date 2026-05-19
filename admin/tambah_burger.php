<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
include '../config/koneksi.php';

if (isset($_POST['submit'])) {
    $nama_burger = mysqli_real_escape_string($koneksi, $_POST['nama_burger']);
    $harga       = $_POST['harga'];
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $foto        = mysqli_real_escape_string($koneksi, $_POST['foto']); // Ambil input foto

    // Tambahkan variabel $foto ke query INSERT
    $query = "INSERT INTO menu_burger (nama_burger, harga, deskripsi, foto) VALUES ('$nama_burger', '$harga', '$deskripsi', '$foto')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Menu burger berhasil ditambahkan!'); window.location='managemen_produk.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="font-family: 'Poppins', sans-serif;">

  <nav class="navbar navbar-dark bg-danger mb-4 py-3">
    <div class="container">
      <a class="navbar-brand fw-bold" href="dashboard.php">HAPPY BURGER</a>
    </div>
  </nav>

  <div class="container my-5" style="max-width: 500px;">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 10px;">
            <h4 class="fw-bold mb-4 text-danger">Form Tambah Menu</h4>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Nama Burger</label>
                    <input type="text" name="nama_burger" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Deskripsi Bahan / Rasa</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Link Foto Burger (URL Online)</label>
                    <input type="url" name="foto" class="form-control" placeholder="Contoh: https://site.com/gambar.jpg">
                    <div class="form-text text-muted" style="font-size: 0.75rem;">*Bisa dikosongkan jika ingin memakai gambar default otomatis.</div>
                </div>
                <div class="d-flex gap-2 pt-2">
                    <button type="submit" name="submit" class="btn btn-danger fw-bold">Simpan Menu</button>
                    <a href="managemen_produk.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
  </div>
</body>
</html>