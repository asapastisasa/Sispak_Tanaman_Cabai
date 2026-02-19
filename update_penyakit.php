<?php 

// Mengambil id dari parameter
$idpenyakit = $_GET['id'];

if (isset($_POST['update'])) {
    $kode = $_POST['kode'];
    $nmpenyakit = $_POST['nmpenyakit'];
    $ket = $_POST['ket'];
    $solusi = $_POST['solusi'];
    
    // Proses pengecekan apakah nmpenyakit sudah ada di database
    $checkSql = "SELECT * FROM penyakit WHERE nmpenyakit='$nmpenyakit' AND idpenyakit != '$idpenyakit'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Jika nmpenyakit sudah ada di database
        $errorMessage = "Hama & Penyakit dengan nama '$nmpenyakit' sudah digunakan.";
    } else {
        // Proses update
        $sql = "UPDATE penyakit SET kode='$kode', nmpenyakit='$nmpenyakit', keterangan='$ket', solusi='$solusi' WHERE idpenyakit='$idpenyakit'";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=penyakit");
        } else {
            $errorMessage = "Terjadi kesalahan saat mengupdate data.";
        }
    }
}

$sql = "SELECT * FROM penyakit WHERE idpenyakit='$idpenyakit'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-success text-white border-dark"><strong>Update Data Hama & Penyakit</strong></div>
                    <div class="card-body">
                        <?php
                        if (isset($errorMessage)) {
                            echo "<div class='alert alert-danger'>$errorMessage</div>";
                        }
                        ?>
                        <div class="form-group">
                            <label for="">Kode</label>
                            <input type="text" class="form-control" value="<?php echo $row['kode'] ?>" name="kode" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Hama & Penyakit</label>
                            <input type="text" class="form-control" name="nmpenyakit" value="<?php echo $row['nmpenyakit'] ?>" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" name="ket" value="<?php echo $row['keterangan'] ?>" maxlength="2000" required>
                        </div>
                        <div class="form-group">
                            <label for="">Solusi</label>
                            <input type="text" class="form-control" name="solusi" value="<?php echo $row['solusi'] ?>" maxlength="200" required>
                        </div>

                        <input class="btn btn-success mb-2" type="submit" name="update" value="Update">
                        <a class="btn btn-danger mb-2" href="?page=penyakit">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
