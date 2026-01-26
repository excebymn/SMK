<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_prakpusweb"; 

$conn = mysqli_connect($host, $user, $pass, $db);


if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


$sql = "SELECT * FROM anggota";
$result = mysqli_query($conn, $sql);

// Tampilkan data
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Data Anggota Perpustakaan</h2>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr>
            <th>No Anggota</th>
            <th>Nama</th>
            <th>Password</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['no_anggota'] . "</td>";
        echo "<td>" . $row['nama_anggota'] . "</td>";
        echo "<td>" . $row['password_anggota'] . "</td>";
        echo "<td>" . $row['alamat_anggota'] . "</td>";
        echo "<td>" . $row['no_telp'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data anggota.";
}

mysqli_close($conn);
?>
