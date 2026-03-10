<?php
include '../config/config.php';
include BASE_PATH . 'template/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase">data user</h1>
                </div>
            </div><!-- /.row -->
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Isi dari data user</h3>
                                    <div class="card-tools">
                                        <a href="<?= BASE_URL ?>app/user/tambah.php" class="btn btn-primary btn-sm text-capitalize">tambah user</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive" style="max-height: 340px; overflow-y: auto;">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead class="sticky-top bg-white">
                                                <tr class="text-center">
                                                    <th>no</th>
                                                    <th>Nama User</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Telepon</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM admin ORDER BY id DESC";
                                                $result = mysqli_prepare($koneksi, $query);
                                                mysqli_stmt_execute($result);
                                                $result = mysqli_stmt_get_result($result);
                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)):
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= htmlspecialchars($row['nama']) ?></td>
                                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                                        <td><?= htmlspecialchars($row['password']) ?></td>
                                                        <td><?= htmlspecialchars($row['telepon']) ?></td>
                                                        <td>
                                                            <a href="<?= BASE_URL ?>app/user/edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                                                            <a href="<?= BASE_URL ?>app/user/hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('apakah anda yakin menghapus barang ini?')">hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include BASE_PATH . 'template/footer.php'; ?>