<?php
include 'config/koneksi.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah digunakan! Cari nama lain.');</script>";
    } else {
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Registrasi akun berhasil! Silakan login.'); window.location='login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Registrasi gagal!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Happy Burger</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            /* BACKGROUND BURGER THEME DENGAN OVERLAY MERAH GRADIENT */
            background: linear-gradient(rgba(178, 31, 45, 0.7), rgba(220, 53, 69, 0.6)), 
                        url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1000&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
        }
        .card-register { 
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
    
    <div class="card-register p-4 shadow-lg">
            <h4 class="fw-bold text-dark mb-4 text-center">Buat Akun Baru</h4>
            
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Buat Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-person-plus"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Username baru" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Buat Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password rahasia" required>
                    </div>
                </div>
                <button type="submit" name="register" class="btn btn-danger-kfc w-100 py-2 text-white shadow-sm mt-2">DAFTAR SEKARANG <i class="bi bi-check-circle"></i></button>
            </form>
            
            <div class="text-center mt-4 border-top pt-3">
                <p class="small text-muted mb-0">Sudah punya akun? <a href="login.php" class="text-danger fw-bold text-decoration-none">Login di sini</a></p>
            </div>
        </div>
    </div>

</body>
</html>