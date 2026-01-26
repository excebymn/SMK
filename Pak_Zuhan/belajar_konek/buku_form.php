<?php
include_once 'db_connect.php';
$errors=[];$success='';

// ambil daftar pengarang untuk dropdown
$pengarang_list = [];
$rs = mysqli_query($conn, "SELECT kode_pengarang, nama_pengarang FROM pengarang ORDER BY nama_pengarang");
while($r=mysqli_fetch_assoc($rs)) $pengarang_list[] = $r;

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $kode = trim($_POST['kode_buku'] ?? '');
    $kode_peng = trim($_POST['kode_pengarang'] ?? '');
    $judul = trim($_POST['judul_buku'] ?? '');
    $kode_penerbit = trim($_POST['kode_penerbit'] ?? '');

    if ($kode==='') $errors[]='Kode buku wajib.';
    if ($judul==='') $errors[]='Judul wajib.';

    if (empty($errors)) {
        $sql="INSERT INTO buku (kode_buku,kode_pengarang,judul_buku,kode_penerbit) VALUES (?,?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"ssss",$kode,$kode_peng,$judul,$kode_penerbit);
        if (mysqli_stmt_execute($stmt)) $success="Buku tersimpan.";
        else $errors[] = "Gagal: ".mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Tambah Buku</title></head><body>
<h2>Tambah Buku</h2>
<?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
<?php if($success) echo "<p style='color:green;'>".htmlspecialchars($success)."</p>"; ?>
<form method="post">
<label>Kode Buku</label><br><input name="kode_buku" value="<?php echo htmlspecialchars($kode ?? ''); ?>" required><br>
<label>Pengarang</label><br>
<select name="kode_pengarang">
  <option value="">-- Pilih --</option>
  <?php foreach($pengarang_list as $p): ?>
    <option value="<?php echo htmlspecialchars($p['kode_pengarang']); ?>" <?php if(($kode_peng ?? '')===$p['kode_pengarang']) echo 'selected'; ?>>
      <?php echo htmlspecialchars($p['nama_pengarang'])." (".$p['kode_pengarang'].")"; ?>
    </option>
  <?php endforeach; ?>
</select><br>
<label>Judul Buku</label><br><input name="judul_buku" value="<?php echo htmlspecialchars($judul ?? ''); ?>" required><br>
<label>Kode Penerbit</label><br><input name="kode_penerbit" value="<?php echo htmlspecialchars($kode_penerbit ?? ''); ?>"><br>
<button type="submit">Simpan</button>
</form>
<p><a href="view_table.php?table=buku">Lihat data buku</a></p>
</body></html>
<?php mysqli_close($conn); ?>
