<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
include '../config/koneksi.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'kosongkan') {
    $_SESSION['cart'] = [];
    header("Location: keranjang.php");
    exit;
}
$grand_total = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <link href="../assets/lib/css/bootstrap.min.css" rel="stylesheet">
  
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
        <a class="nav-link-custom active" href="keranjang.php">Keranjang</a>
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
      <h4 class="fw-bold m-0 text-dark">Keranjang Belanja Kasir</h4>
      <?php if (!empty($_SESSION['cart'])): ?>
        <a href="keranjang.php?aksi=kosongkan" class="btn btn-sm btn-outline-danger fw-bold">Kosongkan Keranjang</a>
      <?php endif; ?>
    </div>
    <div class="card p-3 shadow-sm border-0" style="border-radius: 10px;">
      <table class="table table-bordered table-striped m-0 text-center align-middle">
        <thead class="table-danger">
          <tr>
            <th>Nama Burger</th>
            <th>Harga Satuan</th>
            <th>Jumlah (Qty)</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if (!empty($_SESSION['cart'])):
            foreach ($_SESSION['cart'] as $id => $item): 
              $subtotal = $item['harga'] * $item['qty'];
              $grand_total += $subtotal;
          ?>
            <tr>
              <td class="text-start fw-bold"><?= $item['nama']; ?></td>
              <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
              <td><?= $item['qty']; ?> porsi</td>
              <td class="fw-bold text-danger">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
            </tr>
          <?php endforeach; else: ?>
            <tr><td colspan="4" class="text-center text-muted py-5">Keranjang kasir kosong. Silakan pilih menu di tab Katalog Toko.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php if ($grand_total > 0): ?>
      <div class="card p-4 mt-3 bg-white shadow-sm border-0 d-flex flex-md-row justify-content-between align-items-center" style="border-radius: 10px;">
        <div>
          <span class="text-muted small">Total yang harus dibayar:</span>
          <h3 class="fw-bold text-danger m-0">Rp <?= number_format($grand_total, 0, ',', '.'); ?></h3>
        </div>
        <form action="proses_bayar_instan.php" method="POST" class="d-flex gap-2 align-items-center mt-3 mt-md-0">
          <input type="hidden" name="total_bayar" value="<?= $grand_total; ?>">
          <select name="metode" class="form-select" style="width: 180px;" required>
            <option value="Tunai / Cash">Tunai / Cash</option>
            <option value="QRIS / Digital">QRIS / Digital</option>
          </select>
          <button type="submit" class="btn btn-danger fw-bold px-4">Bayar & Cetak</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>