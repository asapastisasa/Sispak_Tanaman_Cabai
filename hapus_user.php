<?php

// mengambil id dari parameter
$iduser=$_GET['id'];

$sql = "DELETE FROM user WHERE iduser='$iduser'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=user");
}
$conn->close();
?>