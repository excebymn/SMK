<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok_barang']);
    $deskripsi_barang = mysqli_real_escape_string($koneksi, $_POST['deskripsi_barang']);

    $query = "INSERT INTO barang (nama_barang, kategori, harga, stok, deskripsi) 
              VALUES ('$nama_barang', '$kategori', '$harga', '$stok', '$deskripsi_barang')";

    if (mysqli_query($koneksi, $query)) {

        header('Location: index.php');
        exit(); 
    } else {
        showMessage('error', 'Terjadi kesalahan saat menambahkan data barang: ' . mysqli_error($koneksi));
    }
}


include 'template/header.php';
$message = getMessage();



?> 

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Barang</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Barang</h3>
                        </div>

                        <div class="card-body">
                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang"
                                        class="form-control" required placeholder="Nama barang">
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <option value=""><strong>Pilih Kategori</strong></option>
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Furniture">Furniture</option>
                                        <option value="Buku">Buku</option>
                                        <option value="Aksesoris">Aksesoris</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga Barang (Dalam Rupiah)</label>
                                    <input type="text" name="harga" id="harga"
                                        class="form-control" required placeholder="Harga barang">
                                </div>
                                <div class="form-group">
                                    <label for="stok_barang">Stok barang</label>
                                    <input type="text" name="stok_barang" id="stok_barang"
                                        class="form-control" required placeholder="Stok barang">
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi_barang">Deskripsi Barang</label>
                                    <textarea type="number" name="deskripsi_barang" id="deskripsi_barang"
                                        class="form-control" required placeholder="Deskripsi barang" rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="simpan" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <a href="barang.php" class="btn btn-secondary">
                                        Kembali
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<?php
include 'template/footer.php';
?>