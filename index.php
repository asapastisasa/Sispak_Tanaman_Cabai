<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sistem Pakar Pertanian </title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* CSS untuk Background Blur */
    .heroBWA {
        background-image: url('gambar/cabai.png'); /* Ganti dengan path gambar Anda */
      background-size: cover;
      background-position: center;
      position: relative;
      min-height: 80vh; /* Mengatur tinggi bagian hero */
      display: flex;
      align-items: center;
      justify-content: center; /* Menempatkan konten di tengah secara horizontal */
      color: white;
      padding-top: 5rem;
    }

    .heroBWA::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5); /* Layer blur dengan warna hitam transparan */
      backdrop-filter: blur(10px); /* Efek blur */
    }

    .hero-content {
      position: relative; /* Menempatkan konten di atas layer blur */
      z-index: 1;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: 3rem;
      min-height: 100vh;
    }

    .hero-content h1 {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .hero-content p {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
    }

    .card-deck .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card img {
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .card-body {
      padding: 2rem;
    }

    .navbar-custom {
      background-color: #365E32; /* Warna hijau daun */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-custom .nav-link {
      color: white !important;
      font-size: 2 em;
      font-weight: bold;
      margin-right: 50px;
    }

    .navbar-custom .nav-link:hover {
      color: #ddd !important;
    }

    .navbar-custom .navbar-brand {
      font-size: 1.5em;
      font-weight: bold;
      color: white !important;
    }
    
    .navbar-custom .navbar-nav {
      flex: 1;
      display: flex;
      justify-content: flex-end;
    }
    .equal-height {
    display: flex;
    flex-direction: column;
    justify-content: center; /* Centers vertically */
    align-items: center; /* Centers horizontally */
    text-align: center; /* Centers text */
    height: 100%;
    }

    .equal-height .card-body {
        flex-grow: 1;
    }

    .card-deck .card {
        height: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 2); /* Customize the shadow */
    }
    body {
            font-family:comic;
            margin: 0;
            padding: 0;
        }



  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm navbar-custom navbar-dark">
      <a class="navbar-brand mx-auto" href="#">
         <img src="gambar/logo2.png" style="height:50px; width:50px;">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php" role="button">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php" role="button">Login</a>
          </li>
          </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="heroBWA">
    <div class="container hero-content">
        <div class="col-md-6 align-self-center">
          <h1 class="mb-4">Cek Tanaman Yuk!</h1>
          <p class="mb-4">
            Website Pertanian ini Merupakan sistem informasi berbasis Web yang memanfaatkan teknologi Sistem Pakar didalamnya. Dengan menggunakan sistem pakar ini pengguna dapat mengenali atau memeriksakan keluhan terhadap tanaman cabai hanya dengan menjawab pertanyaan yang diberikan oleh sistem, dan kemudian pengguna dapat melihat hasil Test dengan hasil yang direpresentasikan dalam bentuk persentase.
          </p>
          <a class="btn btn-primary" href="tampil_konsultasi.php" role="button">Konsultasi</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Alur Section -->
  <section id="alur" style="margin-top: 50px;">
    <div class="container">
        <h2 class="font-weight-bold text-center" style="margin-bottom: 30px;">Alur Kerja Sistem Pakar Tanaman Cabai</h2>
        <div class="card-deck">
    <div class="col-md-4 mb-4">
        <div class="card equal-height">
            <img src="gambar/login.png" class="card-img-top" alt="Login">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <p class="card-text-center">Login hanya digunakan oleh admin yang sudah mempunyi akun saja, pengguna tidak bisa melakukan login</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card equal-height">
                    <img src="gambar/konsul.png" class="card-img-top" alt="Test Gejala Pasien">
                    <div class="card-body">
                        <h5 class="card-title">Konsultasi</h5>
                        <p class="card-text">Tahap ini pengguna akan diberikan beberapa pertanyaan terkait dengan gejala yang dialami oleh tanaman cabai.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card equal-height">
                    <img src="gambar/solusi.png" class="card-img-top" alt="Hasil dan Solusi">
                    <div class="card-body">
                        <h5 class="card-title">Hasil dan Solusi</h5>
                        <p class="card-text">Tahap ini merupakan tahap akhir dimana setelah melaksanakan konsultasi gejala pengguna akan diberikan hasil konsultasi berupa nama penyakit, keterangan dan solusinya.</p>
                    </div>
                </div>
            </div>
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
