<?php
include '../config/koneksi.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $aksi = isset($_POST['aksi']) ? $_POST['aksi'] : '';

    if ($id > 0 && ($aksi == 'tambah' || $aksi == 'kurang')) {

        $stmt_get = mysqli_prepare($koneksi, "SELECT jumlah_stok FROM barang WHERE id = ?");
        mysqli_stmt_bind_param($stmt_get, "i", $id);
        mysqli_stmt_execute($stmt_get);
        $result = mysqli_stmt_get_result($stmt_get);
        $data = mysqli_fetch_assoc($result);

        if ($data) {
            $stok_saat_ini = $data['jumlah_stok'];
            
            if ($aksi == 'tambah') {
                $stok_baru = $stok_saat_ini + 1;
            } else {
                $stok_baru = ($stok_saat_ini > 0) ? $stok_saat_ini - 1 : 0;
            }

            $stmt_update = mysqli_prepare($koneksi, "UPDATE barang SET jumlah_stok = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt_update, "ii", $stok_baru, $id);

            if (mysqli_stmt_execute($stmt_update)) {
                echo json_encode(['success' => true, 'new_stock' => $stok_baru]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal update database.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Barang tidak ditemukan.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Data tidak valid.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode request tidak valid.']);
}

mysqli_close($koneksi);
exit();
?>