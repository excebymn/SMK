<?php
include 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $query = "DELETE FROM barang WHERE id = '$id'";
    mysqli_query($koneksi, $query);
}

header('Location: barang.php');
exit();
