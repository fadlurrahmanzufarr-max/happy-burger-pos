<?php
session_start();
include 'config/koneksi.php';

if (isset($_SESSION['login'])) {
    header("Location: admin/dashboard.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            header("Location: admin/dashboard.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Kasir - Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  
  <link href="assets/lib/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-danger d-flex align-items-center" style="font-family: 'Poppins', sans-serif; height: 100vh;">
  <div class="container" style="max-width: 450px;">
    <div class="card p-4 shadow-lg border-0" style="border-radius: 15px;">
      <h3 class="text-center fw-bold text-dark m-0">LOGIN KASIR</h3>
      <p class="text-center text-muted small mb-4">Happy Burger Point of Sales</p>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center small py-2">Username atau Password salah!</div>
      <?php endif; ?>

      <form action="" method="POST">
        <div class="mb-3">
          <label class="form-label fw-bold">Username</label>
          <input type="text" name="username" class="form-control" required placeholder="Masukkan username...">
        </div>
        <div class="mb-4">
          <label class="form-label fw-bold">Password</label>
          <input type="password" name="password" class="form-control" required placeholder="Masukkan password...">
        </div>
        <button type="submit" name="login" class="btn btn-danger w-100 fw-bold py-2 mb-3" style="border-radius: 8px;">MASUK SISTEM</button>
        <p class="text-center small text-muted m-0">Belum punya akun kasir? <a href="register.php" class="text-danger fw-bold text-decoration-none">Daftar Sekarang</a></p>
      </form>
    </div>
  </div>
</body>
</html>