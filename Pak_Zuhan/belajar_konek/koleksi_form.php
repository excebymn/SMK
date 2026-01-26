<?php
include_once 'db_connect.php';
$errors=[];$success='';

// ambil daftar buku
$books=[];
$rs=mysqli_query($conn,"SELECT kode_buku, judul_buku FROM buku ORDER BY judul_buku");
while($r=mysqli_fetch_assoc($rs)) $books[]=$r;

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $no = trim($_POST['no_seri'] ?? '');
    $kode_buku = trim($_POST['kode_buku'] ?? '');
    $status = intval($_POST['status'] ?? 1);
    $tgl_masuk = date('Y-m-d H:i:s'); // set sekarang

    if ($no==='') $errors[]='Nomor seri wajib.';
    if ($kode_buku==='') $errors[]='Pilih buku.';

    if (empty($errors)) {
        $sql="INSERT INTO koleksi (no_seri, kode_buku, tgl_masuk, status) VALUES (?,?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"sssi",$no,$kode_buku,$tgl_masuk,$status);
        if (mysqli_stmt_execute($stmt)) $success='Koleksi tersimpan.';
        else $errors[]='Gagal: '.mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Tambah Koleksi</title></head><body>
<h2>Tambah Koleksi</h2>
<?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
<?php if($success) echo "<p style='color:green;'>".htmlspecialchars($success)."</p>"; ?>
<form method="post">
<label>No Seri</label><br><input name="no_seri" value="<?php echo htmlspecialchars($no ?? ''); ?>" required><br>
<label>Buku</label><br>
<select name="kode_buku" required>
  <option value="">-- Pilih Buku --</option>
  <?php foreach($books as $b): ?>
    <option value="<?php echo htmlspecialchars($b['kode_buku']); ?>"><?php echo htmlspecialchars($b['judul_buku']); ?></option>
  <?php endforeach; ?>
</select><br>
<label>Status (1=tersedia,0=tidak)</label><br><input name="status" value="<?php echo htmlspecialchars($status ?? 1); ?>"><br>
<button type="submit">Simpan</button>
</form>
<p><a href="view_table.php?table=koleksi">Lihat data koleksi</a></p>
</body></html>
<?php mysqli_close($conn); ?>
