<?php

// mengambil id dari parameter
$idkonsultasi=$_GET['id'];

$sql = "DELETE FROM konsultasi WHERE idkonsultasi='$idkonsultasi'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=konsultasiadm");
}
$conn->close();
?>