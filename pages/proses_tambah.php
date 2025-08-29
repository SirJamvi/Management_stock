<?php

include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $jumlah_stok = (int)$_POST['jumlah_stok']; 
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

   
    $sql = "INSERT INTO barang (nama_barang, jumlah_stok, deskripsi) VALUES ('$nama_barang', '$jumlah_stok', '$deskripsi')";

    if (mysqli_query($koneksi, $sql)) {
        
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>