<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

// validasi id
if (!isset($_GET['id'])) {
    header('Location: barang.php');
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// ambil data lama
$query = "SELECT * FROM barang WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Query error: ' . mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($result);
if (!$data) {
    die('Data tidak ditemukan');
}

// proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok_barang']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi_barang']);

    $update = "UPDATE barang SET
        nama_barang = '$nama_barang',
        kategori = '$kategori',
        harga = '$harga',
        stok = '$stok',
        deskripsi = '$deskripsi'
        WHERE id = '$id'";

    if (mysqli_query($koneksi, $update)) {
        header('Location: barang.php');
        exit();
    } else {
        die('Update gagal: ' . mysqli_error($koneksi));
    }
}

include 'template/header.php';
?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Edit Barang</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Barang</h3>
                        </div>

                        <div class="card-body">
                            <form method="post">

                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control"
                                        value="<?php echo $data['nama_barang']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <?php
                                        $listKategori = ['Elektronik','Furniture','Buku','Aksesoris','Lainnya'];
                                        foreach ($listKategori as $k) {
                                            $selected = ($data['kategori'] == $k) ? 'selected' : '';
                                            echo "<option value=\"$k\" $selected>$k</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="text" name="harga" class="form-control"
                                        value="<?php echo $data['harga']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Stok Barang</label>
                                    <input type="text" name="stok_barang" class="form-control"
                                        value="<?php echo $data['stok']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Barang</label>
                                    <textarea name="deskripsi_barang" class="form-control" rows="4" required><?php echo $data['deskripsi']; ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="barang.php" class="btn btn-secondary">
                                    Kembali
                                </a>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<?php include 'template/footer.php'; ?>
