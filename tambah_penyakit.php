<?php

if(isset($_POST['simpan'])){

    // mengambil data dari form
    $kode=$_POST['kode'];
    $nmpenyakit=$_POST['nmpenyakit'];
    $ket=$_POST['ket'];
    $solusi=$_POST['solusi'];
	
    $check_sql = "SELECT * FROM penyakit WHERE nmpenyakit='$nmpenyakit'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Hama&Penyakit sudah digunakan');</script>";
    } else {
        //proses simpan
        $sql = "INSERT INTO penyakit VALUES (NULL, '$kode', '$nmpenyakit', '$ket', '$solusi')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=penyakit");
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
                <div class="card-header bg-success text-white border-dark"><strong>Tambah Data Hama & Penyakit</strong></div>
                <div class="card-body">
                <div class="form-group">
                        <label for="">Kode</label>
                        <input type="text" class="form-control" name="kode" maxlength="10" required
                        oninvalid="this.setCustomValidity('Isi Kode')"
                        oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Hama & Penyakit</label>
                        <input type="text" class="form-control" name="nmpenyakit" maxlength="50" required
                        oninvalid="this.setCustomValidity('Isi Nama Hama & Penyakit')"
                        oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" class="form-control" name="ket" maxlength="2000" required
                        oninvalid="this.setCustomValidity('Isi keterangan')"
                        oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="">Solusi</label>
                        <input type="text" class="form-control" name="solusi" maxlength="2000" required
                        oninvalid="this.setCustomValidity('Isi Solusi')"
                        oninput="this.setCustomValidity('')">
                    </div>

                <input class="btn btn-success mb-2" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger mb-2" href="?page=penyakit">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>