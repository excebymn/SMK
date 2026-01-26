<?php
include_once 'db_connect.php';
$errors=[];$success='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = trim($_POST['kode_pengarang'] ?? '');
    $nama = trim($_POST['nama_pengarang'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $kota = trim($_POST['kota'] ?? '');

    if ($kode==='') $errors[]='Kode pengarang wajib.';
    if ($nama==='') $errors[]='Nama pengarang wajib.';

    if (empty($errors)) {
        $sql="INSERT INTO pengarang (kode_pengarang,nama_pengarang,alamat,kota) VALUES (?, ?, ?, ?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"ssss",$kode,$nama,$alamat,$kota);
        if(mysqli_stmt_execute($stmt)) { $success="Pengarang tersimpan."; }
        else $errors[] = "Gagal: ".mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Tambah Pengarang</title></head><body>
<h2>Tambah Pengarang</h2>
<?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
<?php if($success) echo "<p style='color:green;'>".htmlspecialchars($success)."</p>"; ?>
<form method="post">
<label>Kode Pengarang</label><br><input name="kode_pengarang" value="<?php echo htmlspecialchars($kode ?? ''); ?>" required><br>
<label>Nama Pengarang</label><br><input name="nama_pengarang" value="<?php echo htmlspecialchars($nama ?? ''); ?>" required><br>
<label>Alamat</label><br><input name="alamat" value="<?php echo htmlspecialchars($alamat ?? ''); ?>"><br>
<label>Kota</label><br><input name="kota" value="<?php echo htmlspecialchars($kota ?? ''); ?>"><br>
<button type="submit">Simpan</button>
</form>
<p><a href="view_table.php?table=pengarang">Lihat data pengarang</a></p>
</body></html>
<?php mysqli_close($conn); ?>
