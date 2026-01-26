<?php
include 'config.php';
include 'template/header.php';

$message = getMessage();
?>

<div class="content-wrapper">

  <!-- Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Barang</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">Daftar Barang</h3>
              <a href="tambah.php" class="btn btn-primary btn-sm">Tambah Barang</a>
            </div>

            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $query  = "SELECT * FROM barang ORDER BY id ASC";
                  $result = mysqli_query($koneksi, $query);

                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <tr>
                      <td><?= $row['id']; ?></td>
                      <td><?= $row['nama_barang']; ?></td>
                      <td><?= $row['harga']; ?></td>
                      <td><?= $row['stok']; ?></td>
                      <td><?= $row['kategori']; ?></td>
                      <td><?= $row['deskripsi']; ?></td>
                      <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                          Hapus
                        </a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>

              </table>
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
