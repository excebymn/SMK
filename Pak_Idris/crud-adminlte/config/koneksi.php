<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'db_crud';

$koneksi = mysqli_connect($host, $username, $password, $db_name);

if (!$koneksi) {
    die("koneksi gagal" . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8');