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

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Happy Burger</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* BERIKUT BACKGROUND BURGER THEME DENGAN OVERLAY MERAH GRADIENT */
            background: linear-gradient(rgba(178, 31, 45, 0.7), rgba(220, 53, 69, 0.6)), 
                        url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1000&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
        }
        /* Efek Glassmorphic / Tembus Pandang Mewah untuk Card */
        .card-login {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-top: 5px solid #dc3545;
            border-radius: 16px;
        }
        .btn-danger-kfc {
            background-color: #dc3545;
            border: none;
            font-weight: 600;
        }
        .btn-danger-kfc:hover {
            background-color: #b21f2d;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
<div class="card-login p-4 shadow-lg">
    <h4 class="fw-bold text-dark mb-4 text-center">Masuk Admin</h4>
    
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-center py-2 small fw-medium">Username atau Password salah!</div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Username</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
        </div>
        <button type="submit" name="login" class="btn btn-danger-kfc w-100 py-2 text-white shadow-sm mt-2">LOGIN <i class="bi bi-box-arrow-in-right"></i></button>
    </form>
    
    <div class="text-center mt-4 border-top pt-3">
        <p class="small text-muted mb-0">Belum punya akun? <a href="register.php" class="text-danger fw-bold text-decoration-none">Daftar Sekarang</a></p>
    </div>
</div>
</div>

</body>
</html>