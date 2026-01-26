<?php


$kartuPelajar = [
    "nama"=>"Budi Santoso",
    "nis"=> 2847308,
    "jurusan" => "RPL",
    "kelas" => "XVII"
];
?>
<ul>
    <li><?php echo "nama siswa : ". $kartuPelajar['nama'];  ?></li>
    <li><?php echo "NIS : ". $kartuPelajar['nis'];  ?></li>
    <li><?php echo "kelas : ". $kartuPelajar['kelas'];  ?></li>
</ul>

<h2>array mmultidimensi</h2>
<?php

$dataSekolah = [
    "kelasRPL 1" => [
        "waliKelas" => "bu dessy",
        "jumlahSiswa" => 36,
        "siswa" => [
            "nama" => "zaki",
            "nis" => "02738637",
            "alamat" => [
                "desa" => "gatau",
                "kecamatan" => "jomokmbito",
                "kabupaten" => "ngawi"
            ]
        ]
    ],
    "kelasRPL 2" => [
        "waliKelas" => "pak agus",
        "jumlahSiswa" => 34,
        "siswa" => [
            "nama" => "bima",
            "nis" => "02984751",
            "alamat" => [
                "desa" => "karangjati",
                "kecamatan" => "padas",
                "kabupaten" => "ngawi"
            ]
        ]
    ],
    "kelasRPL 3" => [
        "waliKelas" => "bu rina",
        "jumlahSiswa" => 35,
        "siswa" => [
            "nama" => "salsa",
            "nis" => "02856492",
            "alamat" => [
                "desa" => "geneng",
                "kecamatan" => "widodaren",
                "kabupaten" => "ngawi"
            ]
        ]
    ],
    "kelasRPL 4" => [
        "waliKelas" => "pak doni",
        "jumlahSiswa" => 33,
        "siswa" => [
            "nama" => "rehan",
            "nis" => "02937284",
            "alamat" => [
                "desa" => "ketanggi",
                "kecamatan" => "karanganyar",
                "kabupaten" => "ngawi"
            ]
        ]
    ]
            ];
            ?>
    <h2>Fungsi di Array</h2>

    <?php
    $rakBuku = ["mtk", "bIndo","rpl", "pai"];

    echo "jumlah data buku : " . count(value: $rakBuku) . "<br>";
rsort($rakBuku);
    echo "buku setelah diurutkan" . implode(",", $rakBuku);

    array_push($rakBuku, "novel", "manga");
    echo "buku setelah diurutkan" . implode(",", $rakBuku);

echo "<br>";
echo implode(" ", $rakBuku);





?>

<h3>Perulangan Array</h3>
<?php
$buah = ["mangga", "jeruk", "pear", "pisang", "jambu"];

foreach($buah as $nama_buah){
    echo "<p>" . $buah . "</p>" ;
}

echo "<br><br><br><br>";
$siswa= [
    "nik" => "0085227726",
    "nama" => "bima",
    "alamat" => "disini"
];
foreach($siswa as $key => $data_siswa){
    echo $data_siswa . "<br>"; 
}