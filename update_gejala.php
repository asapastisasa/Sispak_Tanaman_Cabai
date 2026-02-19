<?php 

// Mengambil id dari parameter
$idgejala = $_GET['id'];

if (isset($_POST['update'])) {
    $nmgejala = $_POST['nmgejala'];
    
    // Proses pengecekan apakah nmgejala sudah ada di database
    $checkSql = "SELECT * FROM gejala WHERE nmgejala='$nmgejala' AND idgejala != '$idgejala'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Jika nmgejala sudah ada di database
        $errorMessage = "Gejala dengan nama '$nmgejala' sudah digunakan.";
    } else {
        // Proses update
        $sql = "UPDATE gejala SET nmgejala='$nmgejala' WHERE idgejala='$idgejala'";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=gejala");
        } else {
            $errorMessage = "Terjadi kesalahan saat mengupdate data.";
        }
    }
}

$sql = "SELECT * FROM gejala WHERE idgejala='$idgejala'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-success text-white border-dark"><strong>Update Data Gejala</strong></div>
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
                            <label for="">Nama Gejala</label>
                            <input type="text" class="form-control" name="nmgejala" value="<?php echo $row['nmgejala'] ?>" maxlength="200" required>
                        </div>

                        <input class="btn btn-success mb-2" type="submit" name="update" value="Update">
                        <a class="btn btn-danger mb-2" href="?page=gejala">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
