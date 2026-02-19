<!-- proses login  -->
<?php
session_start();
require "config.php";

if (isset($_POST["submit"])) {
    // mengambil data dari form
    $username = $_POST["username"];
    $pass = ($_POST["pass"]);

    // cek username dan password
    $sql = "SELECT * FROM user WHERE username='$username' AND pass='$pass'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        // membuat session
        $_SESSION['username'] = $row["username"];
        $_SESSION['role'] = $row["role"];
        $_SESSION['status'] = "y";

        // jika login berhasil
        header("Location: indexadmin.php");
    } else {
        // jika login gagal
        header("Location: ?msg=n");
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f2f5;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('gambar/cabai.png'); /* Ganti dengan path gambar latar belakang Anda */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            opacity: 0.3; /* Transparansi gambar latar belakang */
            z-index: -1; /* Letakkan di belakang konten */
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9); /* Latar belakang putih dengan sedikit transparansi */
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 300px;
            width: 100%;
        }

        .login-container .card-header {
            background-color: #388E3C; 
            border-radius: 10px 10px 0 0;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .login-container .form-group {
            margin-bottom: 30px;
        }

        .login-container .btn-primary {
            background-color: #4CAF50; 
            border: none;
            transition: background-color 0.3s;
        }

        .login-container .btn-primary:hover {
            background-color: #388E3C; 
        }

        .login-container .btn-danger {
            border: none;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .login-container .btn-danger:hover {
            background-color: #c9302c;
        }

        .login-container .text-center a {
            color: white; 
            text-decoration: none;
        }

        .alert-fixed {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 600px;
            z-index: 1000;
            background-color: #C40C0C;
            color: white;
        }

    </style>
</head>
<body>
<!-- validasi login gagal -->
<?php
if (isset($_GET['msg']) && $_GET['msg'] == "n") {
    ?>
    <div class="alert alert-danger text-center alert-fixed">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:white;">&times;</a>
    <strong>Login Gagal</strong>
    </div>
    <?php
}
?>
<div class="login-container">
    <div class="card border-0">
        <div class="card-header">
            <strong>LOGIN</strong>
        </div>
        <div class="card-body">
            <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="off" required
                    oninvalid="this.setCustomValidity('Masukan Username')"
                    oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" name="pass" autocomplete="off" required
                    oninvalid="this.setCustomValidity('Masukan Password')"
                    oninput="this.setCustomValidity('')">
            </div>
                <button type="submit" class="btn btn-success btn-block" name="submit">Login</button>
                <button type="button" class="btn btn-danger btn-block" onclick="window.location.href='index.php'">Batal</button>
            </form>
        </div>
    </div>
</div>

<!-- jquery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<!-- bootstrap js -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
