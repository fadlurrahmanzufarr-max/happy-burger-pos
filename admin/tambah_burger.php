<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
include '../config/koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_burger'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_POST['foto'];

    $query = "INSERT INTO menu_burger (nama_burger, harga, deskripsi, foto) VALUES ('$nama', '$harga', '$deskripsi', '$foto')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Menu Berhasil Ditambahkan!'); window.location='managemen_produk.php';</script>";
        exit;
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Menu - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <link href="../assets/lib/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="font-family: 'Poppins', sans-serif;">
  <div class="container my-5" style="max-width: 600px;">
    <div class="card p-4 shadow-sm border-0" style="border-radius: 10px;">
      <h4 class="fw-bold text-dark mb-4 text-center">Tambah Menu Burger Baru</h4>
      <form action="" method="POST">
        <div class="mb-3">
          <label class="form-label fw-bold">Nama Burger</label>
          <input type="text" name="nama_burger" class="form-control" required placeholder="Contoh: Cheese Burger Special">
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold">Harga (Rp)</label>
          <input type="number" name="harga" class="form-control" required placeholder="Contoh: 25000">
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold">Deskripsi Menu</label>
          <textarea name="deskripsi" class="form-control" rows="3" required placeholder="Jelaskan komposisi burgermu..."></textarea>
        </div>
        <div class="mb-4">
          <label class="form-label fw-bold">URL Foto/Gambar Burger</label>
          <input type="url" name="foto" class="form-control" placeholder="Masukkan link gambar dari Unsplash atau internet">
        </div>
        <div class="d-flex gap-2">
          <button type="submit" name="tambah" class="btn btn-danger fw-bold w-100 py-2" style="border-radius: 8px;">Simpan Menu</button>
          <a href="managemen_produk.php" class="btn btn-outline-secondary w-100 py-2" style="border-radius: 8px;">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>