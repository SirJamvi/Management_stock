<?php
include '../config/koneksi.php';


$id = (int)$_GET['id'];


$sql = "DELETE FROM barang WHERE id = $id";

if (mysqli_query($koneksi, $sql)) {
    header("Location: ../index.php");
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>