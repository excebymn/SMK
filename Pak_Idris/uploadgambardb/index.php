<?php
session_start();
require_once 'app/config.php';
// Ambil semua data gambar
$result = $conn->query("SELECT * FROM image ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Gambar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <!-- Tombol Tambah Gambar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Galeri Gambar</h2>
            <a href="app/upload.php" class="btn btn-success">+ Tambah Gambar</a>
        </div>
        <!-- Alert Sukses/Gagal -->
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'success'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Gambar berhasil diupload.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php elseif ($_GET['status'] == 'deleted'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Gambar berhasil dihapus.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                </div>
            <?php elseif ($_GET['status'] == 'updated'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Keterangan berhasil diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php elseif ($_GET['status'] == 'error'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> Terjadi kesalahan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <!-- Tampilkan Gambar dalam Card -->
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="uploads/<?= $row['name_file'] ?>" class="card-img-top" alt="<?= htmlspecialchars($row['description']) ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="app/edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="app/hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col">
                    <div class="alert alert-info">Belum ada gambar.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>