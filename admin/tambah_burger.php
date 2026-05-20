<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_burger']);
    $harga = intval($_POST['harga']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    
    $nama_foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $error_foto = $_FILES['foto']['error'];

    if ($error_foto === 0) {
        $ekstensi_valid = ['jpg', 'jpeg', 'png', 'webp'];
        $ekstensi_file = strtolower(end(explode('.', $nama_foto)));

        if (in_array($ekstensi_file, $ekstensi_valid)) {
            $nama_foto_baru = time() . '_' . $nama_foto;
            
            if (move_uploaded_file($tmp_name, 'assets/img/' . $nama_foto_baru)) {
                mysqli_query($koneksi, "INSERT INTO menu_burger (nama_burger, harga, deskripsi, foto) VALUES ('$nama', '$harga', '$deskripsi', '$nama_foto_baru')");
                echo "<script>alert('Menu burger berhasil ditambahkan!'); window.location='managemen_produk.php';</script>";
                exit;
            } else {
                echo "<script>alert('Gagal simpan gambar!');</script>";
            }
        } else {
            echo "<script>alert('Format gambar salah!');</script>";
        }
    } else {
        echo "<script>alert('Wajib upload foto!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Menu - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="assets/lib/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif; background-color: #f8f9fa;">

  <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand fw-bold" href="dashboard.php"><i class="bi bi-shop me-2"></i>HAPPY BURGER</a>
    </div>
  </nav>

  <div class="container mt-5" style="max-width: 700px;">
    <div class="card border-0 shadow-sm p-4">
      <h4 class="fw-bold text-dark mb-4">Tambah Varian Burger Baru</h4>

      <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label fw-bold small">Nama Burger</label>
          <input type="text" name="nama_burger" class="form-control" required placeholder="Misal: Cheese Burger...">
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold small">Harga</label>
          <input type="number" name="harga" class="form-control" required placeholder="Misal: 30000">
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold small">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3" required placeholder="Tulis deskripsi..."></textarea>
        </div>
        <div class="mb-4">
          <label class="form-label fw-bold small">Foto Produk</label>
          <input type="file" name="foto" class="form-control" required>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" name="simpan" class="btn btn-danger fw-bold px-4">SIMPAN MENU</button>
          <a href="managemen_produk.php" class="btn btn-light border fw-bold px-4">KEMBALI</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>