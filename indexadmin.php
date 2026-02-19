<?php
session_start();
// koneksi database
include "config.php";

// cek status login
if ($_SESSION['status'] != "y") {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPFC</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets/css/all.css">

    <style>
        body {
            font-family:comic;
            margin: 0;
            padding: 0;
        }

        .background-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh; /* Full height */
            overflow: hidden;
            z-index: -1;
        }

        .background-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.3; /* Transparansi gambar */
        }

        .content-container {
            position: relative;
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            padding-top: 100px;
        }

        .content-container h1 {
            font-size: 4em;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content-container h3 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .navbar-custom {
            background-color: #365E32; /* Warna hijau daun */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .nav-link {
            color: white !important;
            font-size: 2 em;
            font-weight: bold;
            margin-right: 20px;
        }

        .navbar-custom .nav-link:hover {
            color: #ddd !important;
        }

        .navbar-brand {
            font-family: comic;
            text-align: center;
        }

        </style>

</head>
<body>



<!-- navbar -->
<nav class="navbar navbar-expand-sm navbar-custom navbar-dark">
    <a class="navbar-brand" href="#"> PERTANIAN
   <img src="gambar/logo2.png" style="height:50px; width:50px;">
</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="font-family: comic;">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="indexadmin.php">Home Admin</a>
            </li>
            <?php if ($_SESSION['role'] == "Admin") { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=user">User</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=gejala">Gejala</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=penyakit">Hama&Penyakit</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=aturan">Basis Aturan</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=konsultasiadm">Data Konsultasi</a>
                </li>
            <?php } ?>
            <li class="nav-item active">
                <a class="nav-link" href="?page=logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>


    <!-- setting menu -->
    <?php

    $page = isset($_GET['page']) ? $_GET['page'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if ($page==""){
        include "welcome.php";
    }elseif ($page=="gejala"){
        if ($action==""){
            include "tampil_gejala.php";
        }elseif ($action=="tambah"){
            include "tambah_gejala.php";
        }elseif ($action=="update"){
            include "update_gejala.php";
        }else{
            include "hapus_gejala.php";
        }
    }elseif ($page=="penyakit"){
        if ($action==""){
            include "tampil_penyakit.php";
        }elseif ($action=="tambah"){
            include "tambah_penyakit.php";
        }elseif ($action=="update"){
            include "update_penyakit.php";
        }else{
            include "hapus_penyakit.php";
        }
      }elseif ($page=="aturan"){
        if ($action==""){
            include "tampil_aturan.php";
        }elseif ($action=="tambah"){
            include "tambah_aturan.php";
        }elseif ($action=="detail"){
          include "detail_aturan.php";
        }elseif ($action=="update"){
            include "update_aturan.php";
        }elseif ($action=="hapus_gejala"){
          include "hapus_detail_aturan.php";
        }else{
            include "hapus_aturan.php";
        }
      }elseif ($page=="konsultasi"){
        if ($action==""){
            include "tampil_konsultasi.php";
        }else{
            include "hasil_konsultasi.php";
        }
      }elseif ($page=="konsultasiadm"){
        if ($action==""){
            include "tampil_konsultasiadm.php";
        }elseif ($action=="detail"){
            include "detail_konsultasiadm.php";
        }else{
        include "hapus_konsultasiadm.php";
        }
      }elseif ($page=="user"){
        if ($action==""){
            include "tampil_user.php";
        }elseif ($action=="tambah"){
            include "tambah_user.php";
        }elseif ($action=="update"){
            include "update_user.php";
        }else{
            include "hapus_user.php";
        }
      }elseif ($page=="daftar"){
        if ($action==""){
            include "daftar.php";
        }
    }else{ 
        include "logout.php";
    }
    ?>
</div>


<!-- jQuery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Font Awesome JS -->
<script src="assets/js/all.js"></script>

</body>
</html>
