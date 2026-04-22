<?php 
session_start();

$_SESSION["nama_pengunjung"] = "ghani";
$_SESSION["kelas"] = "XI RPL";
$_SESSION["waktu_akses"] = date("H:i:s");

?>
<h1>Langkah 1 = Cek Session</h1>
<a href="read_session.php">lanjut</a>