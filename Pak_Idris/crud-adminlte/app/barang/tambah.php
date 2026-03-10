<?php
require '../../config/config.php';
$message = getMessage();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaBarang = mysqli_escape_string($koneksi, $_POST['namaBarang']);
    $kategori = mysqli_escape_string($koneksi, $_POST['kategori']);
    $harga = mysqli_escape_string($koneksi, $_POST['hargaBarang']);
    $stok = mysqli_escape_string($koneksi, $_POST['stok']);
    $deskripsi = mysqli_escape_string($koneksi, $_POST['deskripsi']);

    mysqli_autocommit($koneksi, false);

    $query = "INSERT INTO barang (nama_barang, kategori, harga, stok, deskripsi) VALUES (?, ?, ?, ?, ?)";
    $result = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($result, "ssiis", $namaBarang, $kategori, $harga, $stok, $deskripsi);
    $result = mysqli_stmt_execute($result);

    if ($result) {
        mysqli_commit($koneksi);
        showMessage('success', 'Data Barang Behasil ditambahkan');
        header('location:' . BASE_URL . 'private/barang.php');
    } else {
        mysqli_rollback($koneksi);
        showMessage('danger', 'Data Barang Gagal ditambahkan' . mysqli_error($koneksi));
        header('location:' . BASE_URL . 'private/barang.php');
    }

    mysqli_close($koneksi);
    exit();
}

require BASE_PATH . 'template/header.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase">tambah barang</h1>
                </div>
            </div><!-- /.row -->
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_barang" class="text-capitalize">nama barang</label>
                                <input type="text" name="namaBarang" id="namaBarang" class="form-control" placeholder="nama barang" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori" class="text-capitalize">kategori</label>
                                <select class="custom-select" name="kategori" id="kategori" required>
                                    <option value="" class="text-capitalize" hidden>pilih kategori</option>
                                    <option value="elektronik" class="text-capitalize">elektronik</option>
                                    <option value="furnitur" class="text-capitalize">furnitur</option>
                                    <option value="aksesoris" class="text-capitalize">aksesoris</option>
                                    <option value="lainnya" class="text-capitalize">lainnya...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_barang" class="text-capitalize">harga barang (rp.)</label>
                                <input type="number" name="hargaBarang" id="hargaBarang" class="form-control" placeholder="harga barang" required>
                            </div>
                            <div class="form-group">
                                <label for="stok" class="text-capitalize">stok</label>
                                <input type="number" name="stok" id="stok" placeholder="stok" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="text-capitalize">deskripsi barang</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
<?php
require BASE_PATH . "template/footer.php"
?>