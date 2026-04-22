<?php
session_start();
?>
<h1>Langkah 2 = Membaca Session</h1>

<?php if(isset($_SESSION["nama_pengunjung"])):?>
    <p>we remember who you are</p>
    <p>Halo, <strong><?= $_SESSION["nama_pengunjung"]  ?></strong>dari kelas <?= $_SESSION["kelas"] ?> </p>
    <p>anda membuat sesi ini pada : <?= $_SESSION["waktu_akses"]?></p>
    <?php else: ?>
        <p>lu siape mpruy</p>
        <?php endif; ?>

        <a href="index.php">langkah 1 </a>
        <a href="delete_session.php">ke langkah 3</a>
