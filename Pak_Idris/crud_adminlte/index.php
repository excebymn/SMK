<?php
include 'config.php';
include 'template/header.php';
?>

<div class="content-wrapper">

  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">

      <!-- Title -->
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
      </div>

      <!-- Info Box Row -->
      <div class="row">

        <!-- Total Barang -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info">
              <i class="fas fa-box"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Total Barang</span>
              <?php
              $query = "SELECT COUNT(stok) AS jml_stok FROM barang";
              $result = mysqli_query($koneksi, $query);
              $data = mysqli_fetch_assoc($result);
              ?>
              <span class="info-box-number"><?= $data['jml_stok']; ?></span>
            </div>
          </div>
        </div>

        <!-- Total Stok -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-success">
              <i class="fas fa-shopping-cart"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Total Stok</span>
              <?php
              $query = "SELECT SUM(stok) AS total_stok FROM barang";
              $result = mysqli_query($koneksi, $query);
              $data = mysqli_fetch_assoc($result);
              ?>
              <span class="info-box-number"><?= $data['total_stok']; ?></span>
            </div>
          </div>
        </div>

      </div>

      <!-- Info Fitur -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title m-0">Info Fitur</h5>
            </div>

            <div class="card-body">
              <h6 class="card-title">
                Aplikasi ini digunakan untuk mengelola data barang dengan fitur CRUD
                (Create, Read, Update, Delete)
              </h6>

              <ul>
                <li>Menampilkan data barang</li>
                <li>Menambah data barang</li>
                <li>Mengedit data barang</li>
                <li>Menghapus data barang</li>
              </ul>

              <a href="barang.php" class="btn btn-primary">
                Lihat Data Barang
              </a>
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
