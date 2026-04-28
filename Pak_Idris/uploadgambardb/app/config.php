<?php

$host = 'localhost';
$user = 'root';
$pass = 'excebymn1910'; // sesuaikan password
$db   = 'db_gallery';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}