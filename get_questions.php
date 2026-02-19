<?php
include 'config.php';

// Query to select symptoms and their associated rules
$sql_gejala = "
    SELECT g.idgejala, g.nmgejala, a.idaturan, a.idpenyakit 
    FROM gejala g 
    JOIN detail_basis_aturan d ON g.idgejala = d.idgejala 
    JOIN basis_aturan a ON d.idaturan = a.idaturan 
    ORDER BY g.kode ASC";

$result_gejala = mysqli_query($conn, $sql_gejala);

$questions = [];

if ($result_gejala && mysqli_num_rows($result_gejala) > 0) {
    while ($row = mysqli_fetch_assoc($result_gejala)) {
        $questions[] = [
            'idgejala' => $row['idgejala'],
            'nmgejala' => $row['nmgejala'],
            'idpenyakit' => $row['idpenyakit'],
            'idaturan' => $row['idaturan']
        ];
    }
    echo json_encode($questions);
} else {
    echo json_encode([]);
}

mysqli_close($conn);
?>
