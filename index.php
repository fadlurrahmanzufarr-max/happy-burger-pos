<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
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
</head>
<body class="bg-danger d-flex align-items-center" style="font-family: 'Poppins', sans-serif; height: 100vh;">
  <div class="container text-center text-white">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        
        <div class="mb-3">
          <div class="text-warning display-1" style="font-size: 7rem;"><i class="bi bi-shop"></i></div>
        </div>
        
        <h1 class="fw-bold text-uppercase m-0" style="font-size: 4rem;">HAPPY <span class="text-warning">BURGER</span></h1>
        <p class="fs-5 text-white-50 my-4">Sistem Informasi Kasir & Point of Sales Restoran Modern</p>
        
        <div class="mt-5">
          <a href="login.php" class="btn btn-light text-danger fw-bold py-3 px-5 shadow-lg" style="border-radius: 50px; font-size: 1.1rem;">
            MASUK SISTEM KASIR <i class="bi bi-arrow-right-circle-fill ms-2"></i>
          </a>
        </div>
        
      </div>
    </div>
  </div>
</body>
</html>