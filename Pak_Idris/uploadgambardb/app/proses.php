<?php
session_start();
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $keterangan = trim($_POST['keterangan']);
    $file = $_FILES['gambar'];
    // Validasi file
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = 'Terjadi kesalahan saat upload.';
        header('Location: upload.php');
        exit;
    }
    // Validasi ukuran file (max 1MB)
    if ($file['size'] > 1048576) {
        $_SESSION['error'] = 'Ukuran file maksimal 1MB.';
        header('Location: upload.php');
        exit;
    }
    // Validasi ekstensi file
    $ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ekstensi, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['error'] = 'Hanya file JPG dan PNG yang diperbolehkan.';
        header('Location: upload.php');
        exit;
    }
    // Rename file dengan nama unik
    $nama_baru = uniqid() . '_' . time() . '.' . $ekstensi;
    $tujuan = '../uploads/' . $nama_baru;
    // Pindahkan file ke folder uploads
    if (move_uploaded_file($file['tmp_name'], $tujuan)) {
        // Simpan ke database

        $stmt = $conn->prepare("INSERT INTO image (name_file, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama_baru, $keterangan);
        if ($stmt->execute()) {
            // Redirect ke galeri dengan status sukses
            header('Location: ../index.php?status=success');
            exit;
        } else {
            // Hapus file jika gagal simpan db
            unlink($tujuan);
            $_SESSION['error'] = 'Gagal menyimpan ke database.';
            header('Location: upload.php');
            exit;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = 'Gagal memindahkan file.';
        header('Location: upload.php');
        exit;
    }
} else {
    header('Location: upload.php');
    exit;
}
