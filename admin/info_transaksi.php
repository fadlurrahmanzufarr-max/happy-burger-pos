<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
include '../config/koneksi.php';

$query_transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Transaksi - Happy Burger</title>
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
        <a class="nav-link-custom" href="managemen_produk.php">Managemen Produk</a>
        <a class="nav-link-custom" href="keranjang.php">Keranjang</a>
        <a class="nav-link-custom active" href="info_transaksi.php">Info Transaksi</a>
      </div>
      <div class="navbar-nav ms-auto align-items-center gap-3">
        <span class="text-white small">Halo, <strong class="text-warning"><?= ucwords($_SESSION['username']); ?></strong></span>
        <a href="../logout.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container my-4" style="max-width: 900px;">
    <h4 class="fw-bold mb-3 text-dark">Informasi Transaksi Penjualan</h4>
    <div class="card p-3 shadow-sm border-0" style="border-radius: 10px;">
      <table class="table table-bordered table-striped m-0 text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID Nota</th>
            <th>Waktu Transaksi</th>
            <th>Total Pembayaran</th>
            <th>Metode</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($t_row = mysqli_fetch_assoc($query_transaksi)): ?>
            <tr>
              <td><strong>#TRX-0<?= $t_row['id_transaksi']; ?></strong></td>
              <td><?= $t_row['tanggal_transaksi']; ?></td>
              <td class="text-success fw-bold">Rp <?= number_format($t_row['total_bayar'], 0, ',', '.'); ?></td>
              <td><span class="badge bg-secondary"><?= $t_row['metode_pembayaran']; ?></span></td>
            </tr>
          <?php endwhile; if (mysqli_num_rows($query_transaksi) == 0): ?>
            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data transaksi.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>