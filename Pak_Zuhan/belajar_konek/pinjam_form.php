<?php
include_once 'db_connect.php';
$errors=[];$success='';

// ambil opsi: koleksi, anggota, pegawai
$koleksi=[]; $anggota=[]; $pegawai=[];
$r=mysqli_query($conn,"SELECT no_seri, kode_buku FROM koleksi ORDER BY no_seri"); while($x=mysqli_fetch_assoc($r)) $koleksi[]=$x;
$r=mysqli_query($conn,"SELECT nomor_anggota, nama_anggota FROM anggota ORDER BY nama_anggota"); while($x=mysqli_fetch_assoc($r)) $anggota[]=$x;
$r=mysqli_query($conn,"SELECT nip_peg, nama_peg FROM pegawai ORDER BY nama_peg"); while($x=mysqli_fetch_assoc($r)) $pegawai[]=$x;

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $no_seri = trim($_POST['no_seri'] ?? '');
    $no_angg = trim($_POST['no_anggota'] ?? '');
    $nip_peg = trim($_POST['nip_pegawai'] ?? '');
    $tgl_harus = trim($_POST['tgl_harus_kembali'] ?? '');
    $tgl_kembali = trim($_POST['tgl_kembali'] ?? '0000-00-00');
    $denda = intval($_POST['denda'] ?? 0);
    $status = intval($_POST['status'] ?? 0);

    if ($no_seri==='') $errors[]='Pilih no seri.';
    if ($no_angg==='') $errors[]='Pilih anggota.';
    if ($nip_peg==='') $errors[]='Pilih pegawai.';
    if ($tgl_harus==='') $errors[]='Tanggal harus kembali wajib.';

    if (empty($errors)) {
        // jika kosong tgl_kembali, set ke '0000-00-00' sementara
        if ($tgl_kembali==='') $tgl_kembali='0000-00-00';
        $sql="INSERT INTO pinjam (no_seri,no_anggota,nip_pegawai,tgl_harus_kembali,tgl_kembali,denda,status) VALUES (?,?,?,?,?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"sssssii",$no_seri,$no_angg,$nip_peg,$tgl_harus,$tgl_kembali,$denda,$status);
        if (mysqli_stmt_execute($stmt)) $success='Transaksi pinjam tersimpan.';
        else $errors[]='Gagal: '.mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Form Pinjam</title></head><body>
<h2>Form Pinjam</h2>
<?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
<?php if($success) echo "<p style='color:green;'>".htmlspecialchars($success)."</p>"; ?>
<form method="post">
<label>No Seri</label><br>
<select name="no_seri" required>
  <option value="">-- pilih --</option>
  <?php foreach($koleksi as $k) echo "<option value='".htmlspecialchars($k['no_seri'])."'>".htmlspecialchars($k['no_seri'])." — ".htmlspecialchars($k['kode_buku'])."</option>"; ?>
</select><br>

<label>Nomor Anggota</label><br>
<select name="no_anggota" required>
  <option value="">-- pilih --</option>
  <?php foreach($anggota as $a) echo "<option value='".htmlspecialchars($a['nomor_anggota'])."'>".htmlspecialchars($a['nama_anggota'])." (".$a['nomor_anggota'].")</option>"; ?>
</select><br>

<label>NIP Pegawai</label><br>
<select name="nip_pegawai" required>
  <option value="">-- pilih --</option>
  <?php foreach($pegawai as $p) echo "<option value='".htmlspecialchars($p['nip_peg'])."'>".htmlspecialchars($p['nama_peg'])." (".$p['nip_peg'].")</option>"; ?>
</select><br>

<label>Tgl Harus Kembali (YYYY-MM-DD)</label><br><input name="tgl_harus_kembali" placeholder="2025-10-20" value="<?php echo htmlspecialchars($tgl_harus ?? ''); ?>" required><br>
<label>Tgl Kembali (kosongkan jika belum)</label><br><input name="tgl_kembali" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($tgl_kembali ?? ''); ?>"><br>
<label>Denda</label><br><input name="denda" value="<?php echo htmlspecialchars($denda ?? 0); ?>"><br>
<label>Status (0=pinjam,1=kembali)</label><br><input name="status" value="<?php echo htmlspecialchars($status ?? 0); ?>"><br>

<button type="submit">Simpan Pinjam</button>
</form>
<p><a href="view_table.php?table=pinjam">Lihat data pinjam</a></p>
</body></html>
<?php mysqli_close($conn); ?>
