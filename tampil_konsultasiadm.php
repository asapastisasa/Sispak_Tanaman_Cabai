<?php
include 'config.php';

// Fetch all consultations
$sql_konsultasi = "SELECT idkonsultasi, tanggal, nama_pengguna FROM konsultasi ORDER BY tanggal DESC";
$result_konsultasi = $conn->query($sql_konsultasi);

// Check if the query was successful
if (!$result_konsultasi) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Konsultasi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5" style="font-family: comic;">
        <h2>Data Konsultasi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pengguna</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
              if ($result_konsultasi->num_rows > 0) {
                  $no = 1;
                  while ($row = $result_konsultasi->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $no++ . "</td>";
                      echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['nama_pengguna']) . "</td>";
                      echo "<td style='text-align: center; vertical-align: middle;'>
                            <a href='detail_konsultasiadm.php?idkonsultasi=" . htmlspecialchars($row['idkonsultasi']) . "' class='btn btn-primary'><i class='fas fa-list'></i></a>
                            <a onclick=\"return confirm('Yakin menghapus data ini ?')\" class='btn btn-danger' href='?page=konsultasiadm&action=hapus&id=" . htmlspecialchars($row['idkonsultasi']) . "'><i class='fas fa-trash-alt'></i></a>
                            </td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='5'>Belum ada data konsultasi</td></tr>";
              }
              ?>
              </tbody>
        </table>
    </div>
</body>
</html>
