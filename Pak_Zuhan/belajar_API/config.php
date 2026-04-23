<?php
$host = "localhost";
$user = "root";
$pass = "excebymn1910";
$db   = "produk";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
