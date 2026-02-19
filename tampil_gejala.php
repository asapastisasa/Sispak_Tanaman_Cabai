<?php
// koneksi database
include "config.php";

// Periksa koneksi
if ($conn->connect_error) {
  die("Koneksi ke database gagal: " . $conn->connect_error);
}

$no = 1;
$sql = "SELECT * FROM gejala ORDER BY kode ASC";
$result = $conn->query($sql);

// Periksa apakah kueri berhasil dieksekusi
if ($result === false) {
  die("Error: " . $conn->error);
}

?>


<div class="card">
    <div class="card-header bg-success text-white border-dark"><strong>DATA GEJALA</strong></div>
    <div class="card-body">
        <a class="btn btn-success mb-3" href="?page=gejala&action=tambah">Tambah</a>
        <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
        <th width="20px">No.</th>
        <th width="20px">Kode</th>
        <th width="200px">Nama Gejala</th>
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
            <td><?php echo htmlspecialchars($row['nmgejala']); ?></td>
            <td align="center">
                <a class="btn btn-warning mb-2" href="?page=gejala&action=update&id=<?php echo $row['idgejala']; ?>">
                    <i class="fas fa-edit"></i>
                </a>
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger mb-2" href="?page=gejala&action=hapus&id=<?php echo $row['idgejala']; ?>">
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
