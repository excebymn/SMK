<?php
include_once 'db_connect.php';
$table = preg_replace('/[^a-z0-9_]/i','', $_GET['table'] ?? '');
if ($table === '') {
    echo "<p>Nama tabel tidak diberikan. Gunakan ?table=nama_tabel</p>";
    echo "<p><a href='view_db.php'>Kembali</a></p>";
    exit;
}

// periksa apakah tabel ada
$res = mysqli_query($conn, "SHOW TABLES LIKE '".mysqli_real_escape_string($conn,$table)."'");
if (!$res || mysqli_num_rows($res)===0) {
    echo "<p>Tabel tidak ditemukan: ".htmlspecialchars($table)."</p>";
    echo "<p><a href='view_db.php'>Kembali</a></p>";
    exit;
}

$sql = "SELECT * FROM `$table` LIMIT 1000";
$result = mysqli_query($conn, $sql);
if (!$result) { echo "Query error: ".mysqli_error($conn); exit; }

echo "<h2>Isi tabel: ".htmlspecialchars($table)."</h2>";
echo "<p><a href='view_db.php'>&laquo; Kembali</a></p>";
echo "<table border='1' cellpadding='6' cellspacing='0'><tr>";
// header
$cols = mysqli_fetch_fields($result);
foreach($cols as $c) echo "<th>".htmlspecialchars($c->name)."</th>";
echo "</tr>";
while($row=mysqli_fetch_assoc($result)){
    echo "<tr>";
    foreach($cols as $c) {
        $val = $row[$c->name];
        echo "<td>".nl2br(htmlspecialchars((string)$val))."</td>";
    }
    echo "</tr>";
}
echo "</table>";
mysqli_free_result($result);
mysqli_close($conn);
?>
