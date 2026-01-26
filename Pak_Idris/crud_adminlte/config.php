<?php
session_start();
include 'koneksi.php';
// Fungsi untuk menampilkan pesan
function showMessage($type, $message) {
$_SESSION['message'] = [
'type' => $type,
'text' => $message
];
}
// Fungsi untuk mendapatkan pesan
function getMessage() {
if (isset($_SESSION['message'])) {
$message = $_SESSION['message'];
unset($_SESSION['message']);
return $message;
}
return null;
}

$protocol = isset($_SERVER['HTTPS'])&& $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$baseurl = rtrim(dirname($_SERVER['PHP_SELF']),'/\\') . '/';
define('BASE_URL', $protocol .  '://' . $host . $baseurl . '/adminlte');
?>