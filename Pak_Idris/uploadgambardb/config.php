<?php
$host = 'localhost';
$username = 'root';
$password = 'excebymn1910';
$db_name = 'upload_gambar';

$koneksi = mysqli_connect($host, $username, $password, $db_name);

if (!$koneksi) {
    die("koneksi gagal" . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8');