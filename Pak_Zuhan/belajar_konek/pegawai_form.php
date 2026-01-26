<?php
include_once 'db_connect.php';
$errors=[];$success='';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $nip = trim($_POST['nip_peg'] ?? '');
    $pass = trim($_POST['password'] ?? '');
    $nama = trim($_POST['nama_peg'] ?? '');
    $jk = intval($_POST['jk'] ?? 0);
    $alamat = trim($_POST['alamat_peg'] ?? '');

    if ($nip==='') $errors[]='NIP wajib.';
    if ($nama==='') $errors[]='Nama wajib.';

    if (empty($errors)) {
        $hashed = password_hash($pass, PASSWORD_DEFAULT);
        $sql="INSERT INTO pegawai (nip_peg,password,nama_peg,jk,alamat_peg) VALUES (?,?,?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"sssis",$nip,$hashed,$nama,$jk,$alamat);
        if (mysqli_stmt_execute($stmt)) $success='Pegawai disimpan.';
        else $errors[]='Gagal: '.mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Tambah Pegawai</title></head><body>
<h2>Tambah Pegawai</h2>
<?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
<?php if($success) echo "<p style='color:green;'>".htmlspecialchars($success)."</p>"; ?>
<form method="post">
<label>NIP</label><br><input name="nip_peg" value="<?php echo htmlspecialchars($nip ?? ''); ?>" required><br>
<label>Password</label><br><input type="password" name="password"><br>
<label>Nama</label><br><input name="nama_peg" value="<?php echo htmlspecialchars($nama ?? ''); ?>" required><br>
<label>JK (1=L,2=P)</label><br><input name="jk" value="<?php echo htmlspecialchars($jk ?? 1); ?>"><br>
<label>Alamat</label><br><input name="alamat_peg" value="<?php echo htmlspecialchars($alamat ?? ''); ?>"><br>
<button type="submit">Simpan</button>
</form>
<p><a href="view_table.php?table=pegawai">Lihat data pegawai</a></p>
</body></html>
<?php mysqli_close($conn); ?>
