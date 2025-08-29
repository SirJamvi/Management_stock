<?php
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Stok Barang</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Stok Barang</h1>
        <a href="pages/tambah.php" class="btn btn-tambah">Tambah Barang Baru</a>
        <br><br>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Stok</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM barang ORDER BY id DESC";
                $result = mysqli_query($koneksi, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                        
                        echo "<td>";
                        echo "<div class='stok-control'>";
                        echo "<button class='btn-stok btn-kurang' data-id='" . $row['id'] . "' data-aksi='kurang'>-</button>";
                        echo "<span class='stok-display' id='stok-" . $row['id'] . "'>" . $row['jumlah_stok'] . "</span>";
                        echo "<button class='btn-stok btn-tambah' data-id='" . $row['id'] . "' data-aksi='tambah'>+</button>";
                        echo "</div>";
                        echo "</td>";
                        
                        echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                        
                        echo "<td>";
                        echo "<a href='pages/edit.php?id=" . $row['id'] . "' class='btn btn-edit'>Edit</a> ";
                        echo "<a href='pages/hapus.php?id=" . $row['id'] . "' class='btn btn-hapus' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Belum ada data barang.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('.btn-stok').on('click', function() {
            var button = $(this);
            var id = button.data('id');
            var aksi = button.data('aksi');
            
            $.ajax({
                url: 'pages/update_stok_ajax.php', 
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    aksi: aksi
                },
                success: function(response) {
                    if (response.success) {
                        
                        $('#stok-' + id).text(response.new_stock);
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);
                    alert('Tidak dapat terhubung ke server. Check console untuk detail.');
                }
            });
        });
    });
    </script>

</body>
</html>
<?php
mysqli_close($koneksi);
?>