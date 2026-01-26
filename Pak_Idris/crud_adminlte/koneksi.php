<?php
$host = "localhost";
$username = "ghani";
$password = "1910";
$database = "db_crud";
// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);
// Cek koneksi
if (!$koneksi) {
die("Koneksi gagal: " . mysqli_connect_error());
}
// Set charset
mysqli_set_charset($koneksi, "utf8");
?>
