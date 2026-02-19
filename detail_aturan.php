<!-- proses menampilkan data basis aturan -->
<?php 
// mengambil id dari parameter
$idaturan=$_GET['id'];

$sql = "SELECT basis_aturan.idaturan,basis_aturan.idpenyakit,penyakit.kode,
                penyakit.nmpenyakit,penyakit.keterangan
        FROM basis_aturan INNER JOIN penyakit ON basis_aturan.idpenyakit=penyakit.idpenyakit 
        WHERE basis_aturan.idaturan='$idaturan'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
?>

<!-- tampilan halaman detail -->
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-success text-white border-dark"><strong>DETAIL HALAMAN BASIS ATURAN</strong></div>
                    <div class="card-body">

                    <div class="form-group">
                            <label for="">Kode</label>
                            <input type="text" class="form-control" value="<?php echo $row['kode'] ?>" name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Hama & Penyakit</label>
                            <input type="text" class="form-control" value="<?php echo $row['nmpenyakit'] ?>" name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" value="<?php echo $row['keterangan'] ?>" name="ket" readonly>
                        </div>

                        <!-- tabel gejala-gejala -->
                        <label for="">Gejala-Gejala Penyakit :</label>
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="20px">No.</th>
                            <th width="20px">Kode</th>
                            <th width="700px">Nama Gejala</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 1;
                            $sql = "SELECT detail_basis_aturan.idaturan, detail_basis_aturan.idgejala, gejala.kode, gejala.nmgejala
                                    FROM detail_basis_aturan 
                                    INNER JOIN gejala ON detail_basis_aturan.idgejala = gejala.idgejala 
                                    WHERE detail_basis_aturan.idaturan = '$idaturan'
                                    ORDER BY gejala.kode ASC"; // Mengurutkan berdasarkan kolom kode secara ascending
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['kode']; ?></td>
                                <td><?php echo $row['nmgejala']; ?></td>
                            </tr>
                        <?php
                            }
                            $conn->close();
                        ?>

                        </tbody>
                        </table>

                        <a class="btn btn-primary mb-2" href="?page=aturan">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>