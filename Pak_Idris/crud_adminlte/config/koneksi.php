<?php
$host = 'localhost';
$username = 'ghani';
$password = '1910';
$db_name = 'db_crud';

$koneksi = mysqli_connect($host, $username, $password, $db_name);

if (!$koneksi) {
    die("koneksi gagal" . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8');