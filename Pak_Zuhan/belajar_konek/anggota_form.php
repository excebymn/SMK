<?php
include_once 'db_connect.php';
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor = trim($_POST['nomor_anggota'] ?? '');
    $nama  = trim($_POST['nama_anggota'] ?? '');
    $pass  = trim($_POST['password_anggota'] ?? '');
    $alamat= trim($_POST['alamat_anggota'] ?? '');
    $tel   = trim($_POST['telepon_anggota'] ?? '');

    if ($nomor === '') {
        $errors[] = "Nomor anggota wajib.";
    }
    if ($nama === '') {
        $errors[] = "Nama wajib.";
    }
    // minimal cek telepon
    if ($tel !== '' && !preg_match('/^[0-9\-\+ ]+$/', $tel)) {
        $errors[] = "Telepon tidak valid.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO anggota (nomor_anggota, nama_anggota, password_anggota, alamat_anggota, telepon_anggota) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // jangan simpan password plain di production — pakai password_hash()
            $hashed = password_hash($pass, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sssss", $nomor, $nama, $hashed, $alamat, $tel);
            if (mysqli_stmt_execute($stmt)) {
                $success = "Anggota berhasil ditambahkan.";
                $nomor = $nama = $alamat = $tel = $pass = '';
            } else {
                $errors[] = "Gagal simpan: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $errors[] = "Gagal mempersiapkan query: " . mysqli_error($conn);
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Anggota</title>
</head>
<body>
  <h2>Tambah Anggota</h2>

  <?php
  if (!empty($errors)) {
      foreach ($errors as $e) {
          echo "<p style='color:red;'>" . htmlspecialchars($e) . "</p>";
      }
  }

  if ($success) {
      echo "<p style='color:green;'>" . htmlspecialchars($success) . "</p>";
  }
  ?>

  <form method="post" action="">
    <label>Nomor Anggota</label><br>
    <input name="nomor_anggota" value="<?php echo htmlspecialchars($nomor ?? ''); ?>" required><br>

    <label>Nama</label><br>
    <input name="nama_anggota" value="<?php echo htmlspecialchars($nama ?? ''); ?>" required><br>

    <label>Password</label><br>
    <input type="password" name="password_anggota" value=""><br>

    <label>Alamat</label><br>
    <input name="alamat_anggota" value="<?php echo htmlspecialchars($alamat ?? ''); ?>"><br>

    <label>Telepon</label><br>
    <input name="telepon_anggota" value="<?php echo htmlspecialchars($tel ?? ''); ?>"><br>

    <button type="submit">Simpan</button>
  </form>

  <p><a href="view_table.php?table=anggota">Lihat data anggota</a></p>
</body>
</html>

<?php
mysqli_close($conn);
?>
