<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'config/koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM menu_burger ORDER BY id_burger DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Managemen Menu - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="assets/lib/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/lib/css/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif; background-color: #f8f9fa;">

  <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand fw-bold" href="dashboard.php"><i class="bi bi-shop me-2"></i>HAPPY BURGER</a>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm p-3">
          <h5 class="fw-bold mb-3 text-muted px-2">NAVIGASI</h5>
          <div class="list-group list-group-flush">
            <a href="dashboard.php" class="list-group-item list-group-item-action py-2.5"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            <a href="managemen_produk.php" class="list-group-item list-group-item-action active bg-danger border-0 rounded mb-2 py-2.5"><i class="bi bi-egg-fried me-2"></i> Managemen Menu</a>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card border-0 shadow-sm p-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0 text-dark">Daftar Menu Burger</h4>
            <a href="tambah_burger.php" class="btn btn-danger fw-bold"><i class="bi bi-plus-lg me-1"></i> TAMBAH MENU</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-light text-center small fw-bold">
                <tr>
                  <th style="width: 5%;">No</th>
                  <th style="width: 15%;">Foto</th>
                  <th>Nama Burger</th>
                  <th style="width: 20%;">Harga</th>
                  <th>Deskripsi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (mysqli_num_rows($result) == 0): ?>
                  <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada menu burger. Silakan tambah data!</td>
                  </tr>
                <?php else: $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center">
                      <img src="assets/img/<?= $row['foto']; ?>" width="80" height="60" class="img-thumbnail" alt="Foto">
                    </td>
                    <td class="fw-bold text-dark"><?= $row['nama_burger']; ?></td>
                    <td class="text-danger fw-bold">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td class="small text-muted"><?= $row['deskripsi']; ?></td>
                  </tr>
                <?php endwhile; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>