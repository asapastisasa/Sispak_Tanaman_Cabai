<?php
include 'config.php';
date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['nmpengguna'])) {
    $nmpengguna = $_POST['nmpengguna'];
    $tgl = date("Y/m/d");

    // Insert consultation data
    $sql = "INSERT INTO konsultasi (tanggal, nama_pengguna) VALUES ('$tgl', '$nmpengguna')";
    mysqli_query($conn, $sql);
    $idkonsultasi = mysqli_insert_id($conn);

    // Prepare arrays to store selected gejala and skipped penyakit
    $selectedGejala = [];
    $skippedPenyakit = [];

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'jawaban') !== false) {
            $index = substr($key, 7);
            $idgejala = $_POST['idgejala' . $index];
            $jawaban = $value;

            if ($jawaban == 'ya') {
                $selectedGejala[] = $idgejala;
            }
        }
    }

    // Determine penyakit based on selected gejala
    $selectedPenyakit = [];
    foreach ($selectedGejala as $idgejala) {
        $sql = "SELECT idpenyakit FROM basis_aturan 
                JOIN detail_basis_aturan ON basis_aturan.idaturan = detail_basis_aturan.idaturan 
                WHERE idgejala = '$idgejala'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $selectedPenyakit[] = $row['idpenyakit'];
        }
    }

    // Insert selected gejala into detail_konsultasi
    foreach ($selectedGejala as $idgejala) {
        $sql = "INSERT INTO detail_konsultasi (idkonsultasi, idgejala) VALUES ('$idkonsultasi', '$idgejala')";
        mysqli_query($conn, $sql);
    }

// Calculate accuracy for each penyakit
foreach (array_unique($selectedPenyakit) as $idpenyakit) {
    $totalGejala = 0;
    $jyes = 0;

    // Count total gejala in the penyakit
    $sql = "SELECT COUNT(dba.idgejala) AS total_gejala
            FROM basis_aturan ba
            JOIN detail_basis_aturan dba ON ba.idaturan = dba.idaturan
            WHERE ba.idpenyakit = '$idpenyakit'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $totalGejala = $row['total_gejala'];

    // Count how many selected gejala are in the penyakit
    foreach ($selectedGejala as $idgejala) {
        $sql = "SELECT COUNT(*) AS count
                FROM detail_basis_aturan
                WHERE idgejala = '$idgejala' AND idaturan IN (
                    SELECT idaturan FROM basis_aturan WHERE idpenyakit = '$idpenyakit'
                )";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] > 0) {
            $jyes++;
        }
    }

// Calculate accuracy
$accuracy = ($jyes == $totalGejala) ? 100.00 : round(($jyes / $totalGejala) * 100, 2);

// Insert into detail_penyakit
$sql = "INSERT INTO detail_penyakit (idkonsultasi, idpenyakit, persentase) 
        VALUES ('$idkonsultasi', '$idpenyakit', '$accuracy')";
mysqli_query($conn, $sql);

foreach (array_unique($selectedPenyakit) as $idpenyakit) {
    $sql = "SELECT COUNT(*) AS total_gejala
            FROM detail_basis_aturan
            WHERE idaturan IN (
                SELECT idaturan FROM basis_aturan WHERE idpenyakit = '$idpenyakit'
            )";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $totalGejalaPenyakit = $row['total_gejala'];

    if (count($selectedGejala) === $totalGejalaPenyakit) {
        $accuracy = 100.00;
        $sql = "INSERT INTO detail_penyakit (idkonsultasi, idpenyakit, persentase) 
                VALUES ('$idkonsultasi', '$idpenyakit', '$accuracy')";
        mysqli_query($conn, $sql);
    }
}
}

    header("Location: hasil_konsultasi.php?idkonsultasi=$idkonsultasi");
    exit();
}
?>
