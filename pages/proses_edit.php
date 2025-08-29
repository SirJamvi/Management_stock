<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = (int)$_POST['id'];
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $jumlah_stok = (int)$_POST['jumlah_stok'];
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    
    $sql = "UPDATE barang SET 
                nama_barang = '$nama_barang', 
                jumlah_stok = '$jumlah_stok', 
                deskripsi = '$deskripsi' 
            WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>