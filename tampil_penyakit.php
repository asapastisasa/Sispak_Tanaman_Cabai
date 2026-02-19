<?php
// koneksi database
include "config.php";

// Periksa koneksi
if ($conn->connect_error) {
  die("Koneksi ke database gagal: " . $conn->connect_error);
}

$no = 1;
$sql = "SELECT * FROM penyakit ORDER BY kode ASC";
$result = $conn->query($sql);

// Periksa apakah kueri berhasil dieksekusi
if ($result === false) {
  die("Error: " . $conn->error);
}

?>


<div class="card">
    <div class="card-header bg-success text-white border-dark"><strong>DATA HAMA & PENYAKIT</strong></div>
    <div class="card-body">
        <a class="btn btn-success mb-3" href="?page=penyakit&action=tambah">Tambah</a>
        <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
        <th width="20px">No.</th>
        <th width="20px">Kode</th>
        <th width="200px">Nama Hama & Penyakit</th>
        <th width="400px">Keterangan</th>
        <th width="200px">Solusi</th>
        <th width="100px"></th>
      </tr>
    </thead>
    <tbody>
    <?php
          while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['kode']); ?></td>
            <td><?php echo htmlspecialchars($row['nmpenyakit']); ?></td>
            <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
            <td><?php echo htmlspecialchars($row['solusi']); ?></td>
            <td align="center">
                <a class="btn btn-warning mb-2" href="?page=penyakit&action=update&id=<?php echo $row['idpenyakit']; ?>">
                    <i class="fas fa-edit"></i>
                </a>
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger mb-2" href="?page=penyakit&action=hapus&id=<?php echo $row['idpenyakit']; ?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
         </tr>
    <?php
     }
     $conn->close();
    ?>  
    </tbody>
</table>
</div>
</div>
