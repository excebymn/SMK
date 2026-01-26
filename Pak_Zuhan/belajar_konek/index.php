<?php
// index.php
// Pastikan db_connect.php ada di folder sama (dipakai hanya untuk cek koneksi, bisa dihapus kalau nggak mau)
include_once 'db_connect.php';
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard Perpustakaan</title>
<style>
/* Minimal styling agar rapi saat dicoba — kamu boleh ubah CSS nanti */
body{font-family:system-ui,Segoe UI,Roboto,Arial;margin:24px;background:#f5f6fb}
.container{max-width:900px;margin:0 auto;padding:20px;background:#fff;border-radius:8px;box-shadow:0 6px 22px rgba(0,0,0,.06)}
h1{margin-top:0}
.row{display:flex;flex-wrap:wrap;gap:12px}
.card{flex:1 1 200px;padding:14px;border-radius:8px;border:1px solid #eee;text-align:center;background:#fafafa}
.card a{display:inline-block;padding:8px 12px;border-radius:6px;text-decoration:none;border:1px solid #ddd;margin-top:8px}
.small{font-size:0.9rem;color:#666}
.footer{margin-top:18px;font-size:0.9rem;color:#444}
</style>
</head>
<body>
<div class="container">
  <h1>Selamat datang di Sistem Perpustakaan</h1>
  <p class="small">Pilih aksi di bawah — klik tombol untuk buka form atau melihat data. (CSS boleh kamu ganti biar makin cakep.)</p>

  <div style="margin:18px 0;">
    <strong>Form & Transaksi</strong>
    <div class="row" style="margin-top:8px;">
      <div class="card">
        <div>Tambah / Kelola Anggota</div>
        <a href="anggota_form.php">Buka Form Anggota</a><br>
        <a href="view_table.php?table=anggota" style="margin-top:6px">Lihat Anggota</a>
      </div>

      <div class="card">
        <div>Tambah Pengarang</div>
        <a href="pengarang_form.php">Form Pengarang</a><br>
        <a href="view_table.php?table=pengarang" style="margin-top:6px">Lihat Pengarang</a>
      </div>

      <div class="card">
        <div>Tambah Buku</div>
        <a href="buku_form.php">Form Buku</a><br>
        <a href="view_table.php?table=buku" style="margin-top:6px">Lihat Buku</a>
      </div>

      <div class="card">
        <div>Tambah Koleksi (No Seri)</div>
        <a href="koleksi_form.php">Form Koleksi</a><br>
        <a href="view_table.php?table=koleksi" style="margin-top:6px">Lihat Koleksi</a>
      </div>

      <div class="card">
        <div>Tambah Pegawai</div>
        <a href="pegawai_form.php">Form Pegawai</a><br>
        <a href="view_table.php?table=pegawai" style="margin-top:6px">Lihat Pegawai</a>
      </div>

      <div class="card">
        <div>Transaksi Pinjam / Kembali</div>
        <a href="pinjam_form.php">Form Pinjam</a><br>
        <a href="view_table.php?table=pinjam" style="margin-top:6px">Lihat Pinjam</a>
      </div>
    </div>
  </div>

  <div style="margin-top:12px;">
    <strong>Utility</strong>
    <div class="row" style="margin-top:8px;">
      <div class="card">
        <div>Cek seluruh database</div>
        <a href="view_db.php">Lihat Semua Tabel</a>
      </div>

      <div class="card">
        <div>Backup / Export (manual)</div>
        <a href="https://localhost/phpmyadmin/" target="_blank">Buka phpMyAdmin</a>
        <div class="small" style="margin-top:6px">Gunakan phpMyAdmin untuk export/import SQL</div>
      </div>

      <div class="card">
        <div>Pengaturan (opsional)</div>
        <a href="#" onclick="alert('Belum ada halaman pengaturan.'); return false;">Pengaturan</a>
      </div>
    </div>
  </div>

  <div class="footer">
    <small>Petunjuk singkat: simpan file ini di folder yang sama dengan file-form lain. Pastikan `db_connect.php` ada dan koneksi MySQL aktif.</small>
  </div>
</div>
</body>
</html>
<?php
// jangan lupa tutup koneksi jika include db_connect.php
if (isset($conn) && $conn) mysqli_close($conn);
?>
