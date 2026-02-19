<?php

// mengambil id dari parameter
$idaturan = $_GET['id'];

// proses menampilkan data penyakit berdasarkan basis aturan yang dipilih
$sql = "SELECT basis_aturan.idaturan, basis_aturan.idpenyakit, penyakit.kode, penyakit.nmpenyakit
        FROM basis_aturan 
        INNER JOIN penyakit ON basis_aturan.idpenyakit = penyakit.idpenyakit 
        WHERE idaturan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idaturan);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// proses update
if (isset($_POST['update'])) {
    $idgejala = $_POST['idgejala'];

    // Ambil semua gejala terkait dengan aturan ini
    $existing_gejala = [];
    $select_sql = $conn->prepare("SELECT idgejala FROM detail_basis_aturan WHERE idaturan = ?");
    $select_sql->bind_param("i", $idaturan);
    $select_sql->execute();
    $select_result = $select_sql->get_result();
    while ($select_row = $select_result->fetch_assoc()) {
        $existing_gejala[] = $select_row['idgejala'];
    }

    // Hapus gejala yang tidak dipilih lagi
    $to_delete = array_diff($existing_gejala, $idgejala);
    if (!empty($to_delete)) {
        $delete_sql = $conn->prepare("DELETE FROM detail_basis_aturan WHERE idaturan = ? AND idgejala = ?");
        foreach ($to_delete as $delete_idgejala) {
            $delete_sql->bind_param("ii", $idaturan, $delete_idgejala);
            $delete_sql->execute();
        }
    }

    // Tambahkan gejala baru yang dipilih
    $to_add = array_diff($idgejala, $existing_gejala);
    if (!empty($to_add)) {
        $insert_sql = $conn->prepare("INSERT INTO detail_basis_aturan (idaturan, idgejala) VALUES (?, ?)");
        foreach ($to_add as $add_idgejala) {
            $insert_sql->bind_param("ii", $idaturan, $add_idgejala);
            $insert_sql->execute();
        }
    }

    header("Location:?page=aturan");
    exit;
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-success text-white border-dark"><strong>Update Data Basis Aturan</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Hama & Penyakit</label>
                            <input type="text" class="form-control" value="<?php echo $row['nmpenyakit'] ?>" name="nmpenyakit" readonly>
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
                                        $idgejala = $row['idgejala'];

                                        // cek ke tabel detail basis aturan
                                        $sql2 = $conn->prepare("SELECT * FROM detail_basis_aturan WHERE idaturan = ? AND idgejala = ?");
                                        $sql2->bind_param("ii", $idaturan, $idgejala);
                                        $sql2->execute();
                                        $result2 = $sql2->get_result();

                                        $checked = $result2->num_rows > 0 ? 'checked' : '';
                                        $disabled = $result2->num_rows > 0 ? 'disabled' : '';
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['kode']; ?></td>
                                            <td><?php echo $row['nmgejala']; ?></td>
                                            <td align="center">
                                                <input type="checkbox" class="check-item" name="idgejala[]" value="<?php echo $row['idgejala']; ?>" <?php echo $checked; ?>></td>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <input class="btn btn-success mb-2" type="submit" name="update" value="Update">
                        <a class="btn btn-danger mb-2" href="?page=aturan">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
// close the connection after all operations are completed
$conn->close();
?>
