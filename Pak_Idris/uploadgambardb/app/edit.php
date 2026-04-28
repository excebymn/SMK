<?php
session_start();
require_once 'config.php';
if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM image WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $_SESSION['error'] = 'Data tidak ditemukan.';
    header('Location: ../index.php');
    exit;
}
$data = $result->fetch_assoc();
$stmt->close();
// Proses update jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $keterangan = trim($_POST['keterangan']);
    $updateStmt = $conn->prepare("UPDATE image SET description = ? WHERE id = ?");
    $updateStmt->bind_param("si", $keterangan, $id);
    if ($updateStmt->execute()) {
        header('Location: ../index.php?status=updated');
        exit;
    } else {
        $error = 'Gagal mengupdate keterangan.';
    }

    $updateStmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Keterangan</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">Edit Keterangan</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= htmlspecialchars($data['description']) ?>" maxlength="100" required>
                            </div>
                            <div class="mb-3">
                                <img src="../uploads/<?= $data['name_file'] ?>" alt="Preview" style="max-width: 100%; max-height: 200px;">
                            </div>
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="../index.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>