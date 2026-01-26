<?php
function hitungLuasPersegi($sisi)
{
    return $sisi * 4;
}
function hitungKelilingPersegi($sisi){
    return $sisi*4;
}
function hitungLuasPersegiPanjang($panjang, $lebar)
{
    return $panjang * $lebar;
}
function hitungKelilingPersegiPanjang($panjang, $lebar)
{
    return $panjang + $panjang + $lebar + $lebar;
}
function hitungLuasSegitiga($alas, $tinggi)
{
    return ($alas * $tinggi) * 0.5;
}
function hitungLuasLingkaran($jari)
{
    return 3.14 * ($jari * $jari);
}
function hitungKelilingLingkaran($jari)
{
    return 2 * 3.14 * $jari;
}
function hitungVolumeKubus($sisi)
{
    return $sisi * $sisi * $sisi;
}
function celciusToFahrenheit($celcius){
    return ($celcius*9/5)+32;
}
function fahrenheitToCelcius($fahrenheit){
    return (5/9)*($fahrenheit-32);
}
function bmi($tinggi, $berat){
    $tinggiM = $tinggi/100;
    return $berat/($tinggiM * $tinggiM);
}
function kategoriBMI($bmi){
    if($bmi < 18.75){
    return["underweight","3498db","🙏"];
}elseif($bmi <25){
    return["normal", "F39C12", "💪"];
}else{
    return["obesitas", "f30808ff", "💪"];
}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mtk-style.css">
</head>

<body>
    <div class="container"></div>
    <h1>Library Fungsi Matematika</h1>
    <div class="card">
        <h2>Bangun Datar</h2>
        <div class="grid">
            <div class="result">
                <strong>Persegi(sisi = 5)</strong><br>
                Luas : <?= hitungLuasPersegi(5) ?><br>
                Keliling : <?= hitungKelilingPersegi(5)?> <br>
            </div>
            <div class="result">
                <strong>Persegi Panjang</strong><br>
                Luas: <?= hitungLuasPersegiPanjang(8,6) ?> <br>
                Keliling: <?= hitungKelilingPersegiPanjang(8, 6) ?><br>
            </div>
            <div class="result">
                <strong>Segitiga(sisi = 5)</strong><br>
                Luas: <?= hitungLuasSegitiga(5,10) ?><br>
            </div>
            <div class="result">
                <strong>Lingkaran</strong><br>
                Luas: <?= hitungLuasLingkaran(10) ?> <br>
                Keliling:<?= hitungKelilingLingkaran(10) ?> <br>
            </div>
        </div>
    </div>
    <div class="card">
        <h2>Bangun Ruang</h2>
        <div class="result">
            <strong>Kubus</strong><br>
            Volume: <?= hitungVolumeKubus(10) ?><br>
        </div>
    </div>
    <div class="card">
        <h2>Konversi Suhu</h2>
        <div class="grid">
            <div class="result">
                <strong>25°C -> Fahrenheit</strong><br>
                <?= celciusToFahrenheit(25) ."°F" ?> <br>
            </div>
            <div class="result">
                <strong>77°F -> Celcius</strong><br>
                <?= fahrenheitToCelcius(77) . "°C" ?> <br>
            </div>
        </div>

    </div>
    <div class="card">
        <h2>Kalkulator BMI</h2>
         <?php 
            $tinggi= 170;
            $berat = 65;
            $bmi = bmi($tinggi, $berat) ;
            list($kategori,$warna,$icon) = kategoriBMI($bmi);
            ?>
        <div class="result">
            <strong><?= $berat ?>kg, <?= $tinggi ?>cm </strong><br>
            BMI: <?= round(bmi($tinggi,$berat)) ?> <br>
            <strong style="color:<?= $warna ?>"> 
                <?= $icon . " " . $kategori ?>
            </strong> 
        </div>
    </div>
    </div>
</body>

</html>