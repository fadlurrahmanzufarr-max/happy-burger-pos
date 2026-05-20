<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'config/koneksi.php';

$query_menu = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM menu_burger");
$data_menu = mysqli_fetch_assoc($query_menu);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="assets/lib/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/lib/css/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif; background-color: #f8f9fa;">

  <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand fw-bold" href="dashboard.php"><i class="bi bi-shop me-2"></i>HAPPY BURGER</a>
      <div class="navbar-nav ms-auto flex-row gap-3">
        <span class="nav-link text-white small mt-1">Selamat datang, <strong><?= $_SESSION['username']; ?></strong></span>
        <a class="btn btn-warning text-dark fw-bold btn-sm px-3" href="logout.php">LOGOUT</a>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm p-3">
          <h5 class="fw-bold mb-3 text-muted px-2">NAVIGASI</h5>
          <div class="list-group list-group-flush">
            <a href="dashboard.php" class="list-group-item list-group-item-action active bg-danger border-0 rounded mb-2 py-2.5"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            <a href="managemen_produk.php" class="list-group-item list-group-item-action py-2.5"><i class="bi bi-egg-fried me-2"></i> Managemen Menu</a>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card border-0 shadow-sm p-4 mb-4">
          <h2 class="fw-bold text-dark">Selamat Datang di Panel Kasir 🍔</h2>
          <p class="text-muted">Kelola operasional penjualan toko Happy Burger secara cepat dan efisien.</p>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card border-0 bg-danger text-white p-4 shadow-sm" style="border-radius: 12px;">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="text-uppercase m-0 opacity-75">Varian Menu Burger</h6>
                  <h2 class="display-4 fw-bold mt-2 mb-0"><?= $data_menu['total']; ?></h2>
                </div>
                <div class="display-2 opacity-25"><i class="bi bi-egg-fried"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>