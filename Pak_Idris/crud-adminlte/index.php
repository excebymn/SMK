<?php
include './config/config.php';
include './template/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Barang</span>
                            <?php 
                            $query = "SELECT COUNT(stok) as jumlah_barang FROM barang";
                            $proccess = mysqli_prepare($koneksi, $query);
                            mysqli_stmt_execute($proccess);
                            $result = mysqli_stmt_get_result($proccess);
                            $data = mysqli_fetch_assoc($result);
                            ?>
                            <span class="info-box-number"><?= $data['jumlah_barang'] ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Stok</span>
                            <?php 
                            $query = "SELECT SUM(stok) as total_stok FROM barang";
                            $proccess = mysqli_prepare($koneksi, $query);
                            mysqli_stmt_execute($proccess);
                            $result = mysqli_stmt_get_result($proccess);
                            $data = mysqli_fetch_assoc($result);
                            ?>
                            <span class="info-box-number"><?= $data['total_stok'] ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Selamat Datang di aplikasi CRUD Barang</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Aplikasi ini digunakan untuk mengelola data barang dengan fitur CRUD (Create, Read, Update, Delete)</h6>

                            <p class="card-text">Fitur yang tersedia:</p>
                            <ul>
                                <li>Menampilkan data barang</li>
                                <li>Menambah data barang baru</li>
                                <li>Mengedit data barang</li>
                                <li>Menghapus data barang</li>
                            </ul>
                            <a href="<?= BASE_URL ?>private/barang.php" class="btn btn-primary">Lihat Data Barang</a>
                            <a href="<?= BASE_URL ?>private/user.php" class="btn btn-secondary">Kelola User</a>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>

<?php include './template/footer.php'; ?>