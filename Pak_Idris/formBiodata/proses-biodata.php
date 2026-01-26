<!-- PROSES-BIODATA.PHP -->
<!-- Memproses data dari form biodata -->

<!DOCTYPE html>
<html lang='id'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>📊 Data Biodata Diterima</title>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .success-box {
            background-color: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px solid #c3e6cb;
        }

        .data-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 5px solid #3498db;
        }

        .data-item {
            margin: 10px 0;
            padding: 8px;
            background-color: white;
            border-radius: 5px;
        }

        .data-label {
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <div class='container'>

        <?php 
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
        ?>

        <div class='success-box'>
            <h2>✅ Biodata Berhasil Diterima!</h2>
            <p>Terima kasih telah mengisi form biodata. Berikut data yang Anda kirim:</p>
        </div>

        <div class='data-box'>
            <h3>👤 Data Pribadi</h3>

            <?php 
                $nama = htmlspecialchars(trim($_POST['nama_lengkap']??''));
                $nis = htmlspecialchars(trim($_POST['nis']??''));
                $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
                $tanggal_lahir = $_POST['tanggal_lahir']??'';
            ?>

            <div class='data-item'><span class='data-label'>Nama Lengkap:</span> <?= $nama ?></div>
            <div class='data-item'><span class='data-label'>NIS:</span> <?= $nis ?></div>
            <div class='data-item'><span class='data-label'>Jenis Kelamin:</span> <?= ($jenis_kelamin === 'L' ? 'laki-laki' : 'perempuan')?></div>
            <div class='data-item'><span class='data-label'>Tanggal Lahir:</span> <?= date('d F Y', strtotime($tanggal_lahir))?></div>

        </div>

        <div class='data-box'>
            <h3>Data Sekolah</h3>

            <?php
                $kelas = $_POST['kelas'];
                $alamat = htmlspecialchars($_POST['alamat']);
                $email = htmlspecialchars($_POST['email']);
                $telepon = htmlspecialchars(trim($_POST['telepon']));
            ?>


            <div class='data-item'><span class='data-label'>Kelas:</span> <?= $kelas ?></div>
            <div class='data-item'><span class='data-label'>Alamat:</span> <?= $alamat ?></div>
            <div class='data-item'><span class='data-label'>Email:</span> <?= $email ?></div>
            <div class='data-item'><span class='data-label'>Telepon:</span> <?= $telepon ?></div>

        </div>

        <div class='data-box'>
            <h3>Minat dan Hobi</h3>

            <?php
                $hobi = $_POST['hobi'];

                if (!empty($hobi)) {
            ?>


            <!-- Minat dan hobi (bisa multiple) -->

            <div class='data-item'>
                <span class='data-label'>Hobi yang dipilih:</span><br>
                    <?php 
                        foreach ($hobi as $hoby){
                            $icon = [
                                'coding' => '💻',
                                'desain' => '🎨 ',
                                'jaringan' => '📶', 
                                'olahraga' => '🏃🏻'
                            ];

                            echo "- " . ($icon[$hoby]) . " " . ucfirst($hoby) . "<br/>";
                        }
                    ?>
            </div>

            <?php } else {
                echo "tidak ada hoby";
            }?>
            
            <!-- Tombol kembali -->
            <div style='text-align: center; margin-top: 30px;'>
                <a href='form-biodata.html' style='
background-color: #3498db; 
color: white; 
padding: 12px 25px; 
text-decoration: none; 
border-radius: 5px;
display: inline-block;
'>📝 Isi Form Lagi</a>
            </div>
        </div>
        <?php }?>
    </div>
</body>

</html>