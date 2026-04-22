<?php

use Illuminate\Container\Attributes\Bind;

session_start();
require_once './config.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $description = trim($_POST['description']);
    $file = $_FILES['image'];

    if ($_FILES['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = 'terjadi kesalahan saat upload';
        header('location: ../index.php');
    }

    if ($file['size'] > 1048576) {
        $_SESSION['error'] = 'ukuran file maksimal 1MB';
        header('location: ../index.php');
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['error'] = "hanya file JPG dan PNG yang di izinkan";
        header('location: ../index.php');
    }

    $new_name = uniqid() . '_' . time() . '.' . $extension;
    $tujuan = '../uploads/' . $new_name;

    if (move_uploaded_file($file['tmp_name'], $tujuan)) {
        $stmt = $conn->prepare("INSERT INTO image(name_file, description) VALUES(? ,?)");
        $stmt->bind_param("ss", $new_name, $description);
    }

    if ($stmt->execute()) {
        header('location: ../index.php');
        exit;
    } else {
        unlink($tujuan);
        $_SESSION['error'] = "gagal menyimpan ke database";
        header('location: ../index.php');
        exit;
    }

    $stmt->close();
}