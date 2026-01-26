<h3>Fungsi Matematika</h3>
<ul>
    <li><?php sqrt(25); ?></li>
    <li><?php "pembulatan" . round(56.23);?></li>
    <li><?php "Random" .  rand(0,1000); ?></li>
    <li><?php "Nilai Mutlak" . abs(-13);?></li>
</ul>

<h3>Fungsi String</h3>
<?php $teks = "SMK NEgeRI MOJoagung"; ?>
<ul>
    <li><?php  "Panjang Teks: " . strlen($teks);  ?></li>
    <li><?php  "Uppercase: " . strtoupper($teks);  ?></li>
    <li><?php  "Replace: " . str_replace("NEgeRI", "N", $teks);  ?></li>
</ul>

