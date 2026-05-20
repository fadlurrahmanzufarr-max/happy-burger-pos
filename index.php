<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: admin/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Happy Burger</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
  
  <link href="assets/lib/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/lib/css/bootstrap-icons.min.css" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(178, 31, 45, 0.7)), 
                  url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1000&auto=format&fit=crop') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
    }
    .hero-title { font-size: 3.5rem; font-weight: 800; letter-spacing: 1px; }
    .btn-landing { background-color: #ffffff; color: #dc3545; font-weight: 700; border: 2px solid #ffffff; padding: 12px 35px; border-radius: 30px; transition: all 0.3s ease; }
    .btn-landing:hover { background-color: transparent; color: #ffffff; border: 2px solid #ffffff; transform: scale(1.05); }
  </style>
</head>
<body>
  <div class="container text-center text-white">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="display-1 text-warning mb-3"><i class="bi bi-shop"></i></div>
        <h1 class="hero-title text-uppercase m-0">HAPPY <span class="text-warning">BURGER</span></h1>
        <p class="fs-5 text-white-50 mb-5">Sistem Informasi Kasir & Point of Sales Restoran Modern</p>
        <a href="login.php" class="btn btn-landing shadow-lg text-decoration-none">
          MASUK KE SISTEM KASIR <i class="bi bi-arrow-right-circle-fill ms-2"></i>
        </a>
      </div>
    </div>
  </div>
</body>
</html>