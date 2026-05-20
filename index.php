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
      height: 100vh;
      display: flex;
      align-items: center;
      /* Warna merah solid tegas khas Happy Burger */
      background-color: #dc3545; 
      overflow: hidden;
    }
    
    /* Efek bayangan halus pada teks agar terlihat premium dan timbul */
    .hero-title {
      font-size: 4rem;
      font-weight: 800;
      letter-spacing: -1px;
      text-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    
    /* Desain tombol melayang putih bersih */
    .btn-landing-clean {
      background-color: #ffffff;
      color: #dc3545;
      font-weight: 700;
      border: 2px solid #ffffff;
      padding: 14px 45px;
      border-radius: 50px;
      font-size: 1.1rem;
      letter-spacing: 0.5px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    
    .btn-landing-clean:hover {
      background-color: transparent;
      color: #ffffff;
      border: 2px solid #ffffff;
      transform: translateY(-3px);
      box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
    }
  </style>
</head>
<body>
  
  <div class="container text-center text-white">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        
        <div class="mb-3 animate-bounce">
          <div class="text-warning display-1" style="font-size: 7rem; filter: drop-shadow(0 6px 12px rgba(0,0,0,0.15));">
            <i class="bi bi-shop"></i>
          </div>
        </div>
        
        <h1 class="hero-title text-uppercase m-0">HAPPY <span class="text-warning">BURGER</span></h1>
        <p class="fs-5 text-white-50 my-4 mx-auto" style="max-width: 450px;">Selamat datang di happy burger</p>
        
        <div class="mt-5">
          <a href="login.php" class="btn btn-landing-clean text-decoration-none">
            MASUK BRO ! <i class="bi bi-arrow-right-circle-fill ms-2"></i>
          </a>
        </div>
        
        <p class="text-white-50 mt-5 small mb-0" style="font-size: 0.8rem; opacity: 0.6;">&copy; 2026 Happy Burger Team Tegal,KULIAH ? BSI AJAAA... BSI OIOIOI</p>
        
      </div>
    </div>
  </div>

</body>
</html>