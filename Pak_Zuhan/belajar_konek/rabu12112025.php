<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data_pegawai"; // nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query ambil semua data dari tabel pegawai
$sql = "SELECT * FROM pegawai"; 
$result = mysqli_query($conn, $sql);

// Tampilkan data
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Data Pegawai</h2>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Jabatan</th><th>Gaji</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['jabatan'] . "</td>";
        echo "<td>" . $row['gaji'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data pegawai.";
}

mysqli_close($conn);
?>
