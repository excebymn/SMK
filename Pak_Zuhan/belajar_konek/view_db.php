<?php
include_once 'db_connect.php';
$res = mysqli_query($conn, "SHOW TABLES");
$tables = [];
while($r=mysqli_fetch_row($res)) $tables[] = $r[0];
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Database Viewer</title></head><body>
<h2>Database: db_prakpusweb</h2>
<ul>
<?php foreach($tables as $t): ?>
  <li><a href="view_table.php?table=<?php echo urlencode($t); ?>"><?php echo htmlspecialchars($t); ?></a></li>
<?php endforeach; ?>
</ul>
<p>Form yang tersedia:</p>
<ul>
<li><a href="anggota_form.php">Tambah Anggota</a></li>
<li><a href="pengarang_form.php">Tambah Pengarang</a></li>
<li><a href="buku_form.php">Tambah Buku</a></li>
<li><a href="koleksi_form.php">Tambah Koleksi</a></li>
<li><a href="pegawai_form.php">Tambah Pegawai</a></li>
<li><a href="pinjam_form.php">Transaksi Pinjam</a></li>
</ul>
</body></html>
<?php mysqli_close($conn); ?>
