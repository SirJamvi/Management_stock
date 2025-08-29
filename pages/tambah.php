<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Barang Baru</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Barang Baru</h1>
        <a href="../index.php" class="btn">Kembali ke Daftar Barang</a>
        <br><br>
        <form action="proses_tambah.php" method="post">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label for="jumlah_stok">Jumlah Stok</label>
                <input type="number" id="jumlah_stok" name="jumlah_stok" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-tambah">Simpan</button>
        </form>
    </div>
</body>

</html>