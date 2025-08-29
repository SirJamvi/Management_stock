<?php
include '../config/koneksi.php';


$id = $_GET['id'];


$sql = "SELECT * FROM barang WHERE id=$id";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Barang</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Data Barang</h1>
        <a href="../index.php" class="btn">Kembali ke Daftar Barang</a>
        <br><br>
        <form action="proses_edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($data['nama_barang']); ?>" required>
            </div>
            <div class="form-group">
                <label for="jumlah_stok">Jumlah Stok</label>
                <input type="number" id="jumlah_stok" name="jumlah_stok" value="<?php echo htmlspecialchars($data['jumlah_stok']); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-edit">Update Data</button>
        </form>
    </div>
</body>
</html>