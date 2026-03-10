<?php
require "../../config/config.php";
require BASE_PATH . "app/barang/filter.php";

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : "";

$result = getBarang($keyword, $kategori);

require_once BASE_PATH . "template/header.php";
?>

<!-- STYLE KHUSUS PRINT -->
<style>
    @media print {

        /* Sembunyikan SEMUA elemen AdminLTE yang tidak perlu */
        body.sidebar-mini .main-sidebar,
        body.sidebar-mini .main-header,
        .main-sidebar,
        .main-header,
        .main-footer,
        .wrapper>header,
        .wrapper>aside,
        .no-print,
        .btn,
        button,
        .content-header {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            width: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Reset wrapper agar full width */
        body,
        html {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: auto !important;
            overflow: visible !important;
        }

        .wrapper,
        .content-wrapper,
        .content {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            min-height: auto !important;
            background: #fff !important;
        }

        /* Hilangkan margin dan padding dari container */
        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Card styling untuk print */
        .card {
            border: none !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .card-header {
            display: none !important;
        }

        .card-body {
            padding: 10px !important;
            visibility: visible !important;
            display: block !important;
        }

        /* Pastikan tabel terlihat */
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th,
        td {
            border: 1px solid #000 !important;
            padding: 8px !important;
            color: #000 !important;
            background: #fff !important;
        }

        thead {
            display: table-header-group !important;
        }

        /* Page setup */
        @page {
            margin: 1.5cm;
            size: A4;
        }

        /* Force print colors */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <!-- Header Card (Hanya tampil di layar, hilang saat print) -->
                <div class="card-header no-print">
                    <h3 class="card-title">Preview Print Data</h3>
                    <div class="card-tools">
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-print"></i> Cetak Sekarang
                        </button>
                        <a href="<?= BASE_URL ?>private/barang.php" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <!-- AREA PRINT -->
                <div class="card-body">
                    <!-- Judul Laporan -->
                    <div class="text-center mb-4">
                        <h2 class="text-uppercase font-weight-bold">Laporan Data Barang</h2>
                        <p class="text-muted">
                            Dicetak pada: <?= date('d/m/Y') ?> Pukul <?= date('H:i:s') ?>
                        </p>
                        <hr>
                    </div>

                    <!-- Info Filter -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="m-0"><strong>Filter:</strong>
                                <?php
                                if (empty($keyword) && empty($kategori)) {
                                    echo '<span class="badge badge-secondary">Semua Data</span>';
                                } else {
                                    if (!empty($keyword)) echo '<span class="badge badge-info">Kata Kunci: ' . htmlspecialchars($keyword) . '</span> ';
                                    if (!empty($kategori)) echo '<span class="badge badge-info">Kategori: ' . htmlspecialchars($kategori) . '</span>';
                                }
                                ?>
                            </p>
                            <p class="m-0"><strong>Total Data:</strong> <?= mysqli_num_rows($result) ?> Barang</p>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th class="text-right">Harga</th>
                                <th class="text-center">Stok</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Input</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total_harga_aset = 0;
                            $total_stok_aset = 0;

                            if (mysqli_num_rows($result) > 0):
                                while ($row = mysqli_fetch_assoc($result)):
                                    $nilai_barang = $row['harga'] * $row['stok'];
                                    $total_harga_aset += $nilai_barang;
                                    $total_stok_aset += $row['stok'];
                            ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                        <td><?= htmlspecialchars($row['kategori']) ?></td>
                                        <td class="text-right">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                        <td class="text-center"><?= htmlspecialchars($row['stok']) ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                                    </tr>
                                <?php
                                endwhile;
                            else:
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
                                </tr>
                            <?php endif; ?>

                            <!-- Baris Total -->
                            <tr class="bg-light font-weight-bold">
                                <td colspan="3" class="text-right text-uppercase">Total Keseluruhan</td>
                                <td class="text-right">Rp <?= number_format($total_harga_aset, 0, ',', '.') ?></td>
                                <td class="text-center"><?= $total_stok_aset ?></td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Ringkasan Bawah -->
                    <div class="mt-4 p-3 border rounded">
                        <h5 class="text-uppercase font-weight-bold">Ringkasan:</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <small>Total Item</small>
                                <h4><?= ($no - 1) ?></h4>
                            </div>
                            <div class="col-md-4">
                                <small>Total Nilai Aset</small>
                                <h4>Rp <?= number_format($total_harga_aset, 0, ',', '.') ?></h4>
                            </div>
                            <div class="col-md-4">
                                <small>Rata-rata Harga/Item</small>
                                <h4>Rp <?= number_format(($no > 1) ? $total_harga_aset / ($no - 1) : 0, 0, ',', '.'); ?></h4>
                            </div>
                        </div>
                    </div>

                    <!-- Tanda Tangan (Opsional, hanya muncul saat print) -->
                    <div class="row mt-5 d-none d-print-block">
                        <div class="col-6 offset-6 text-center">
                            <p>Mengetahui,</p>
                            <br><br><br>
                            <p class="font-weight-bold">( Admin Gudang )</p>
                        </div>
                    </div>

                </div>
                <!-- /AREA PRINT -->
            </div>
        </div>
    </section>
</div>

<script>
    // Script tambahan untuk memastikan layout rapi sebelum print
    document.querySelector('.btn-primary').addEventListener('click', function() {
        // Opsional: Bisa tambahkan logika di sini jika perlu
        window.print();
    });
</script>

<?php require_once BASE_PATH . "template/footer.php"; ?>