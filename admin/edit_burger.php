<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
include '../config/koneksi.php';

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM menu_burger WHERE id_burger = $id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_burger = mysqli_real_escape_string($koneksi, $_POST['nama_burger']);
    $harga       = $_POST['harga'];
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $query = "UPDATE menu_burger SET nama_burger='$nama_burger', harga='$harga', deskripsi='$deskripsi' WHERE id_burger=$id";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Menu burger berhasil diperbarui!'); window.location='managemen_produk.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-danger mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold" href="dashboard.php">HAPPY BURGER</a>
    </div>
  </nav>

  <div class="container my-5" style="max-width: 500px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4 text-warning">Form Edit Menu</h4>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Burger</label>
                    <input type="text" name="nama_burger" class="form-control" value="<?= $row['nama_burger']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Bahan / Rasa</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required><?= $row['deskripsi']; ?></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" name="update" class="btn btn-warning fw-bold text-white">Perbarui Menu</button>
                    <a href="managemen_produk.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
  </div>
</body>
</html>