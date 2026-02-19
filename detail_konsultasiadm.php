<?php
include 'config.php';

if (!isset($_GET['idkonsultasi'])) {
    die("Error: ID konsultasi tidak ditemukan.");
}

$idkonsultasi = $_GET['idkonsultasi'];

$sql_detail = "SELECT k.tanggal, k.nama_pengguna, g.nmgejala, p.nmpenyakit, dp.persentase
               FROM konsultasi k
               JOIN detail_konsultasi dk ON k.idkonsultasi = dk.idkonsultasi
               JOIN gejala g ON dk.idgejala = g.idgejala
               JOIN detail_penyakit dp ON k.idkonsultasi = dp.idkonsultasi
               JOIN penyakit p ON dp.idpenyakit = p.idpenyakit
               WHERE k.idkonsultasi = ?";
$stmt_detail = $conn->prepare($sql_detail);
$stmt_detail->bind_param("i", $idkonsultasi);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();

if (!$result_detail) {
    die("Query failed: " . $conn->error);
}

$sql_summary = "SELECT penyakit.nmpenyakit, penyakit.keterangan, penyakit.solusi, detail_penyakit.persentase 
                                    FROM detail_penyakit 
                                    INNER JOIN penyakit ON detail_penyakit.idpenyakit = penyakit.idpenyakit 
                                    WHERE detail_penyakit.idkonsultasi = ? AND detail_penyakit.persentase >= 60
                                    ORDER BY detail_penyakit.persentase DESC";
$stmt_summary = $conn->prepare($sql_summary);
$stmt_summary->bind_param("i", $idkonsultasi);
$stmt_summary->execute();
$result_summary = $stmt_summary->get_result();

if (!$result_summary) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konsultasi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style >
    body{
        font-family: comic;
    }

</style>
<body>
    <div class="container mt-5">
        <h2>Ringkasan Konsultasi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Penyakit</th>
                    <th>Keterangan</th>
                    <th>Solusi</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_summary->num_rows > 0) {
                    while ($row = $result_summary->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nmpenyakit']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['solusi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['persentase']) . "%</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada ringkasan konsultasi</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <button class="btn btn-primary mb-4" onclick="window.history.back()">Kembali</button>
        </div>
</body>
</html>

<?php
// Close the prepared statements and database connection
$stmt_detail->close();
$stmt_summary->close();
$conn->close();
?>
