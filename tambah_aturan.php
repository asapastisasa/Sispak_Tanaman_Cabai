<?php
if (isset($_POST['simpan'])) {
    // mengambil data dari form
    $nmpenyakit = $_POST['nmpenyakit'];
    
    // validasi nama penyakit
    $check_sql = $conn->prepare("SELECT * FROM penyakit WHERE nmpenyakit = ?");
    $check_sql->bind_param("s", $nmpenyakit);
    $check_sql->execute();
    $result = $check_sql->get_result();

    if ($result->num_rows > 0) {
        // penyakit exists, get the id
        $row = $result->fetch_assoc();
        $idpenyakit = $row['idpenyakit'];

        // cek apakah penyakit sudah digunakan di basis_aturan
        $check_basis_aturan_sql = $conn->prepare("SELECT * FROM basis_aturan WHERE idpenyakit = ?");
        $check_basis_aturan_sql->bind_param("i", $idpenyakit);
        $check_basis_aturan_sql->execute();
        $result_basis_aturan = $check_basis_aturan_sql->get_result();
        
        if ($result_basis_aturan->num_rows > 0) {
            // penyakit sudah digunakan di basis_aturan
            echo "<script>alert('Data aturan sudah digunakan');</script>";
            echo "<script>window.location.href='?page=aturan';</script>";
            exit;
        }
    } else {
        // penyakit does not exist, insert it
        $insert_sql = $conn->prepare("INSERT INTO penyakit (nmpenyakit) VALUES (?)");
        $insert_sql->bind_param("s", $nmpenyakit);
        $insert_sql->execute();
        $idpenyakit = $conn->insert_id;
    }

    //proses simpan basis aturan
    $sql = $conn->prepare("INSERT INTO basis_aturan (idpenyakit) VALUES (?)");
    $sql->bind_param("i", $idpenyakit);
    if ($sql->execute() === TRUE) {
        // mengambil idgejala
        $idgejala = $_POST['idgejala'];

        // proses mengambil data aturan
        $sql = "SELECT * FROM basis_aturan ORDER BY idaturan DESC";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $idaturan = $row['idaturan'];

        //proses simpan detail basis aturan
        $jumlah = count($idgejala);
        $i = 0;
        while ($i < $jumlah) {
            $idgejalane = $idgejala[$i];
            $sql = $conn->prepare("INSERT INTO detail_basis_aturan (idaturan, idgejala) VALUES (?, ?)");
            $sql->bind_param("ii", $idaturan, $idgejalane);
            if ($sql->execute() === TRUE) {
                $i++;
            } else {
                echo "Error: " . $sql->error;
            }
        }

        header("Location:?page=aturan");
    } else {
        echo "Error: " . $sql->error;
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-success text-white border-dark">
                        <strong>Tambah Data Basis Aturan</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Hama & Penyakit</label>
                            <select class="form-control chosen" data-placeholder="Pilih Nama Penyakit" name="nmpenyakit">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM penyakit ORDER BY nmpenyakit ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['nmpenyakit'] . '">' . $row['nmpenyakit'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- tabel data gejala -->
                        <div class="form-group">
                            <label for="">Pilih Gejala-Gejala Berikut :</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20px">No.</th>
                                        <th width="30px">Kode</th>
                                        <th width="700px">Nama Gejala</th>
                                        <th width="30px">Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = "SELECT * FROM gejala ORDER BY kode ASC";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>
                                                <td>' . $no++ . '</td>
                                                <td>' . $row['kode'] . '</td>
                                                <td>' . $row['nmgejala'] . '</td>
                                                <td align="center"><input type="checkbox" class="check-item" name="idgejala[]" value="' . $row['idgejala'] . '"></td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validasiForm() {
        // validasi nama penyakit
        var nmpenyakit = document.forms["Form"]["nmpenyakit"].value;

        if (nmpenyakit == "") {
            alert("Pilih nama hama&penyakit");
            return false;
        }

        // validasi gejala yang belum dipilih
        var checkbox = document.getElementsByName('idgejala[]');
        var isChecked = false;

        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                isChecked = true;
                break;
            }
        }

        // jika belum ada yang di check
        if (!isChecked) {
            alert('Pilih setidaknya satu gejala !!');
            return false;
        }

        return true;
    }
</script>
