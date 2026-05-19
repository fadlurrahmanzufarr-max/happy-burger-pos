<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
include '../config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM menu_burger ORDER BY id_burger DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Managemen - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    .nav-link-custom { color: rgba(255,255,255,0.75); font-weight: 500; text-decoration: none; padding: 8px 12px; }
    .nav-link-custom:hover, .nav-link-custom.active { color: #ffffff !important; font-weight: 700; }
  </style>
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand navbar-dark bg-danger mb-4 py-3 shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold fs-4" href="dashboard.php">HAPPY BURGER</a>
      <div class="navbar-nav me-auto flex-row gap-3 ms-3">
        <a class="nav-link-custom" href="dashboard.php">Katalog Toko</a>
        <a class="nav-link-custom active" href="managemen_produk.php">Managemen Produk</a>
        <a class="nav-link-custom" href="keranjang.php">Keranjang</a>
        <a class="nav-link-custom" href="info_transaksi.php">Info Transaksi</a>
      </div>
      <div class="navbar-nav ms-auto align-items-center gap-3">
        <span class="text-white small">Halo, <strong class="text-warning"><?= ucwords($_SESSION['username']); ?></strong></span>
        <a href="../logout.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container my-4" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="fw-bold m-0 text-dark">Managemen Produk Burger</h4>
      <a href="tambah_burger.php" class="btn btn-sm btn-danger fw-bold px-3 py-2" style="border-radius: 8px;">+ Tambah Menu</a>
    </div>

    <div class="card p-3 shadow-sm border-0" style="border-radius: 10px;">
      <table class="table table-bordered table-striped m-0 text-center align-middle">
        <thead class="table-danger">
          <tr>
            <th>No</th>
            <th class="text-start">Nama Burger</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td class="text-start fw-bold"><?= $row['nama_burger']; ?></td>
              <td class="text-danger fw-bold">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
              <td class="text-start small text-muted"><?= $row['deskripsi']; ?></td>
              <td>
                <a href="edit_burger.php?id=<?= $row['id_burger']; ?>" class="btn btn-sm btn-warning fw-bold text-white me-1">Edit</a>
                <a href="hapus_burger.php?id=<?= $row['id_burger']; ?>" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Hapus menu ini?')">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>