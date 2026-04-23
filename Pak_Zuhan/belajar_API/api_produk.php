<?php
header("Content-Type: application/json");
include "config.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // MENGAMBIL DATA (READ)
        $sql = "SELECT produk.id_produk, produk.nama_produk, produk.harga, kategori.nama_kategori 
                FROM produk 
                JOIN kategori ON produk.id_kategori = kategori.id_kategori";
        $result = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;

    case 'POST':
        // MENAMBAH DATA (CREATE)
        $nama = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $id_k = $_POST['id_kategori'];
        
        $sql = "INSERT INTO produk (nama_produk, harga, id_kategori) VALUES ('$nama', '$harga', '$id_k')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['message' => 'Produk berhasil ditambahkan']);
        } else {
            echo json_encode(['message' => 'Gagal tambah produk']);
        }
        break;

    case 'PUT':
        // MENGUBAH DATA (UPDATE)
        parse_str(file_get_contents("php://input"), $put_vars);
        $id = $put_vars['id_produk'];
        $nama = $put_vars['nama_produk'];
        $harga = $put_vars['harga'];
        
        $sql = "UPDATE produk SET nama_produk='$nama', harga='$harga' WHERE id_produk='$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['message' => 'Produk berhasil diupdate']);
        } else {
            echo json_encode(['message' => 'Gagal update produk']);
        }
        break;

    case 'DELETE':
        // MENGHAPUS DATA (DELETE)
        parse_str(file_get_contents("php://input"), $del_vars);
        $id = $del_vars['id_produk'];
        
        $sql = "DELETE FROM produk WHERE id_produk='$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['message' => 'Produk berhasil dihapus']);
        } else {
            echo json_encode(['message' => 'Gagal hapus produk']);
        }
        break;
}
?>
