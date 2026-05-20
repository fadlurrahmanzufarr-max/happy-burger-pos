<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
include '../config/koneksi.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah_keranjang') {
    $id_bgr = $_GET['id'];
    $res_bgr = mysqli_query($koneksi, "SELECT * FROM menu_burger WHERE id_burger = $id_bgr");
    $data_bgr = mysqli_fetch_assoc($res_bgr);
    if ($data_bgr) {
        if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }
        if (isset($_SESSION['cart'][$id_bgr])) { $_SESSION['cart'][$id_bgr]['qty']++; } 
        else { $_SESSION['cart'][$id_bgr] = ['nama' => $data_bgr['nama_burger'], 'harga' => $data_bgr['harga'], 'qty' => 1]; }
    }
    echo "<script>alert('Menu berhasil dimasukkan ke keranjang!'); window.location='dashboard.php';</script>";
    exit;
}
$query = mysqli_query($koneksi, "SELECT * FROM menu_burger ORDER BY id_burger DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Katalog - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <link href="../assets/lib/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/lib/css/bootstrap-icons.min.css" rel="stylesheet">
  
  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    .nav-link-custom { color: rgba(255,255,255,0.75); font-weight: 500; text-decoration: none; padding: 8px 12px; }
    .nav-link-custom:hover, .nav-link-custom.active { color: #ffffff !important; font-weight: 700; }
    .img-burger { height: 160px; object-fit: cover; border-radius: 8px; }
  </style>
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand navbar-dark bg-danger mb-4 py-3 shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold fs-4" href="dashboard.php">HAPPY BURGER</a>
      <div class="navbar-nav me-auto flex-row gap-3 ms-3">
        <a class="nav-link-custom active" href="dashboard.php">Katalog Toko</a>
        <a class="nav-link-custom" href="managemen_produk.php">Managemen Produk</a>
        <a class="nav-link-custom" href="keranjang.php">Keranjang</a>
        <a class="nav-link-custom" href="info_transaksi.php">Info Transaksi</a>
      </div>
      <div class="navbar-nav ms-auto align-items-center gap-3">
        <span class="text-white small">Halo, <strong class="text-warning"><?= ucwords($_SESSION['username']); ?></strong></span>
        <a href="../logout.php" class="btn btn-sm btn-outline-light rounded-pill px-3" onclick="return confirm('Logout?')">Logout</a>
      </div>
    </div>
  </nav>
  <div class="container my-4" style="max-width: 900px;">
    <h4 class="fw-bold mb-3 text-dark">Katalog Menu Burger</h4>
    <div class="row g-3">
      <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="col-md-4">
          <div class="card p-3 shadow-sm border-0 h-100" style="border-radius: 10px;">
            <?php $gambar = (!empty($row['foto'])) ? $row['foto'] : 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=500'; ?>
            <img src="<?= $gambar; ?>" class="w-100 img-burger mb-3" alt="Burger">
            <h5 class="fw-bold m-0 text-dark"><?= $row['nama_burger']; ?></h5>
            <h6 class="text-danger fw-bold my-2">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></h6>
            <p class="text-muted small mb-3"><?= $row['deskripsi']; ?></p>
            <a href="dashboard.php?aksi=tambah_keranjang&id=<?= $row['id_burger']; ?>" class="btn btn-danger btn-sm w-100 fw-bold py-2" style="border-radius: 8px;">+ Masukkan Keranjang</a>
          </div>
        </div>
      <?php endwhile; if (mysqli_num_rows($query) == 0): ?>
        <div class="col-12 text-center text-muted py-5">Katalog menu kosong.</div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>