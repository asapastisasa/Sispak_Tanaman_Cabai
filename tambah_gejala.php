<?php

if(isset($_POST['simpan'])){

    // mengambil data dari form
    $kode=$_POST['kode'];
    $nmgejala=$_POST['nmgejala'];
	
    $check_sql = "SELECT * FROM gejala WHERE nmgejala='$nmgejala'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Gejala sudah digunakan');</script>";
    } else {

    $sql = "INSERT INTO gejala VALUES (Null,'$kode','$nmgejala')";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=gejala");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
     }
 }

?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-success text-white border-dark"><strong>Tambah Data Gejala</strong></div>
                <div class="card-body">
                <div class="form-group">
                        <label for="">Kode</label>
                        <input type="text" class="form-control" name="kode" maxlength="10" required
                        oninvalid="this.setCustomValidity('Isi Kode')"
                        oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Gejala</label>
                        <input type="text" class="form-control" name="nmgejala" maxlength="200" required
                        oninvalid="this.setCustomValidity('Isi Gejala')"
                        oninput="this.setCustomValidity('')">
                    </div>

                <input class="btn btn-success mb-2" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger mb-2" href="?page=gejala">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>