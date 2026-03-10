<?php
include '../../config/config.php';

if (!isset($_GET['id'])) {
    header('loaction:' . BASE_URL);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('loaction:' . BASE_URL);
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = "DELETE FROM barang WHERE id=?";
$result = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($result, 'i', $id);
$check = mysqli_stmt_execute($result);

if ($check) {
    mysqli_commit($koneksi);
    showMessage('success', 'Data Barang Behasil dihapus');
    header('location:' . BASE_URL . 'private/barang.php');
    exit();
} else {
    mysqli_rollback($koneksi);
    showMessage('danger', 'Data Barang Gagal dihapus' . mysqli_error($koneksi));
    header('location:' . BASE_URL . 'private/barang.php');
    exit();
}
