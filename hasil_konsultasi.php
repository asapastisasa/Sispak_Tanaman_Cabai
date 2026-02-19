<?php
include 'config.php';

$idkonsultasi = $_GET['idkonsultasi'];

if (isset($idkonsultasi) && is_numeric($idkonsultasi)) {

$sql_penyakit = $conn->prepare("SELECT penyakit.nmpenyakit, penyakit.keterangan, penyakit.solusi, detail_penyakit.persentase 
                                    FROM detail_penyakit 
                                    INNER JOIN penyakit ON detail_penyakit.idpenyakit = penyakit.idpenyakit 
                                    WHERE detail_penyakit.idkonsultasi = ? AND detail_penyakit.persentase >= 60
                                    ORDER BY detail_penyakit.persentase DESC");

    $sql_penyakit->bind_param('i', $idkonsultasi);

    $sql_penyakit->execute();

    $result_penyakit = $sql_penyakit->get_result();
} else {
    echo "Invalid consultation ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Konsultasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Hasil Konsultasi</h2>
        
        <h4>Hama & Penyakit yang Mungkin Terjadi:</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Penyakit</th>
                    <th>Keterangan</th>
                    <th>Solusi</th>
                    <th>Persentase (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result_penyakit->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nmpenyakit']); ?></td>
                    <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                    <td><?php echo htmlspecialchars($row['solusi']); ?></td>
                    <td><?php echo htmlspecialchars($row['persentase'])  . '%'; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <a class="btn btn-primary" href="index.php">Kembali Ke Halaman Konsultasi</a>
    </div>
</body>
</html>

<?php

$sql_penyakit->close();
$conn->close();
?>
