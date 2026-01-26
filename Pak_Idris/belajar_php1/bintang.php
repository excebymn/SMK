<?php
function right_triangle($n) {
    $out = "";
    for ($i=1; $i<=$n; $i++) {
        $out .= str_repeat("*", $i) . "\n";
    }
    return $out;
}

function pyramid($n) {
    $out = "";
    for ($i=1; $i<=$n; $i++) {
        $out .= str_repeat(" ", $n-$i) . str_repeat("*", 2*$i-1) . "\n";
    }
    return $out;
}

function inverted($n) {
    $out = "";
    for ($i=$n; $i>=1; $i--) {
        $out .= str_repeat("*", $i) . "\n";
    }
    return $out;
}

$result = "";
if (isset($_POST['n']) && isset($_POST['pattern'])) {
    $n = max(1, intval($_POST['n']));
    $pattern = $_POST['pattern'];
    if ($pattern == 'right') $result = right_triangle($n);
    if ($pattern == 'pyramid') $result = pyramid($n);
    if ($pattern == 'inverted') $result = inverted($n);

    $html_result = '<pre>' . htmlspecialchars($result) . '</pre>';
}
echo 10 + "5 ekor ayam";
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pola Bintang</title>
</head>
<body>
  <h2>Cetak Pola Bintang</h2>
  <form method="post">
    <label>Jumlah baris (n): <input type="number" name="n" value="5" min="1" required></label><br><br>
    <label><input type="radio" name="pattern" value="right" checked> Segitiga Kanan</label><br>
    <label><input type="radio" name="pattern" value="pyramid"> Piramida</label><br>
    <label><input type="radio" name="pattern" value="inverted"> Terbalik</label><br><br>
    <button type="submit">Cetak</button>
  </form>

  <hr>
  <?php if (!empty($html_result)) echo $html_result; ?>
</body>
</html>
