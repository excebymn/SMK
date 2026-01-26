<?php
session_start();


if (isset($_POST['newgame'])) {
    $_SESSION['target'] = rand(1, 100);
    $_SESSION['tries'] = 0;
    $message = "Permainan baru dimulai. Tebak angka antara 1 - 100.";
}


if (!isset($_SESSION['target'])) {
    $_SESSION['target'] = rand(1, 100);
    $_SESSION['tries'] = 0;
    $message = "Permainan dimulai. Tebak angka antara 1 - 100.";
}

if (isset($_POST['guess'])) {
    $guess = intval($_POST['guess']);
    $_SESSION['tries'] += 1;

    if ($guess < $_SESSION['target']) {
        $message = "Terlalu kecil! Coba lebih besar.";
    } elseif ($guess > $_SESSION['target']) {
        $message = "Terlalu besar! Coba lebih kecil.";
    } else {
        $message = "Yeay! Benar. Angka = {$_SESSION['target']}. Kamu butuh {$_SESSION['tries']} kali tebak.";
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tebak Angka</title>
</head>
<body>
  <h2>Tebak Angka (1 - 100)</h2>
  <p><?php echo $message ?? ""; ?></p>

  <form method="post">
    <input type="number" name="guess" min="1" max="100" required>
    <button type="submit">Tebak</button>
    <button type="submit" name="newgame">New Game</button>
  </form>

  <p>Jumlah tebakan: <?php echo $_SESSION['tries']; ?></p>
  <hr>
  <small>Jika mau mengatur ulang manual, klik New Game.</small>
</body>
</html>
