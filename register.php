<?php
include 'config/koneksi.php';

if (isset($_POST['register'])) {
    $username = strtolower(stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $konfirmasi = mysqli_real_escape_string($koneksi, $_POST['konfirmasi']);

    $cek = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($cek)) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
    } else {
        if ($password !== $konfirmasi) {
            echo "<script>alert('Konfirmasi password tidak cocok!');</script>";
        } else {
            $password_aman = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($koneksi, "INSERT INTO user (username, password) VALUES ('$username', '$password_aman')");
            echo "<script>alert('Kasir baru berhasil didaftarkan! Silakan login.'); window.location='login.php';</script>";
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register Kasir - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="assets/lib/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-danger d-flex align-items-center" style="font-family: 'Poppins', sans-serif; height: 100vh;">
  <div class="container" style="max-width: 450px;">
    <div class="card p-4 shadow-lg border-0" style="border-radius: 15px;">
      <h3 class="text-center fw-bold text-dark m-0">DAFTAR KASIR</h3>
      <p class="text-center text-muted small mb-4">Buat akun untuk akses sistem POS</p>

      <form action="" method="POST">
        <div class="mb-3">
          <label class="form-label fw-bold">Username</label>
          <input type="text" name="username" class="form-control" required placeholder="Buat username baru...">
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold">Password</label>
          <input type="password" name="password" class="form-control" required placeholder="Buat password...">
        </div>
        <div class="mb-4">
          <label class="form-label fw-bold">Konfirmasi Password</label>
          <input type="password" name="konfirmasi" class="form-control" required placeholder="Ulangi password...">
        </div>
        <button type="submit" name="register" class="btn btn-danger fw-bold w-100 py-2 mb-3" style="border-radius: 8px;">DAFTAR AKUN</button>
        <p class="text-center small text-muted m-0">Sudah punya akun? <a href="login.php" class="text-danger fw-bold text-decoration-none">Login di sini</a></p>
      </form>
    </div>
  </div>
</body>
</html>