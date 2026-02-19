<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> About Tanaman Cabai </title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family:comic;
      margin: 0;
      padding: 0;
    }

    .about-section {
      background-color: #f8f9fa;
      padding: 50px 0;
    }

    .about-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .about-content {
      line-height: 1.8;
      text-align: justify
    }

   

    .navbar-custom {
      background-color: #365E32;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-custom .nav-link {
      color: white !important;
      font-size: 1em;
      font-weight: bold;
      margin-right: 20px;
    }

    .navbar-custom .nav-link:hover {
      color: #ddd !important;
    }

    .navbar-custom .navbar-brand {
      font-size: 1.5em;
      font-weight: bold;
      color: white !important;
    }
      .about-image {
      max-width: 80%; /* Membatasi ukuran maksimum gambar */
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border: 5px solid #365E32; /* Bingkai hijau daun */
      padding: 10px; /* Spasi antara bingkai dan gambar */
      background-color: white; /* Latar belakang bingkai */
      display: block;
      margin: 20px auto 0; /* Memusatkan gambar dan memberi jarak ke atas */
    }

  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm navbar-custom navbar-dark">
    <a class="navbar-brand mx-auto" href="index.php">
      <img src="gambar/logo2.png" style="height:50px; width:50px;">
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- About Section -->
  <section class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="about-header">CABAI</h2>
          <p class="about-content">
            Tanaman cabai (Capsicum annuum) adalah salah satu jenis tanaman hortikultura yang banyak dibudidayakan di Indonesia. Cabai memiliki peran penting sebagai bahan baku masakan dan memiliki nilai ekonomi yang tinggi. Tanaman ini dikenal karena buahnya yang pedas, yang berasal dari senyawa kimia yang disebut capsaicin.
          </p>
          <p class="about-content">
            Cabai dapat tumbuh dengan baik di daerah beriklim tropis dengan suhu optimal antara 20-30 derajat Celcius. Tanaman ini membutuhkan sinar matahari yang cukup dan tanah yang kaya akan nutrisi untuk pertumbuhan yang optimal.
          </p>
          <p class="about-content">
            Dalam pertanian, cabai sering menghadapi berbagai tantangan seperti serangan hama dan penyakit, serta perubahan cuaca. Oleh karena itu, petani sering membutuhkan informasi dan solusi untuk menjaga hasil panen tetap optimal.
          </p>
        </div>
        <div class="col-md-6">
          <img src="gambar/cabai.png" alt="Tanaman Cabai" class="about-image">
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>