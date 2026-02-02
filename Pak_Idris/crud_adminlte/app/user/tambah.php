<?php
require '../../config/config.php';
$message = getMessage();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, rtrim($_POST['nama']));
    $email = mysqli_real_escape_string($koneksi, rtrim($_POST['email']));
    $password = mysqli_real_escape_string($koneksi, rtrim($_POST['password']));
    $telepon = mysqli_real_escape_string($koneksi, (int)$_POST['telepon']);

    mysqli_autocommit($koneksi, false);

    $query = "INSERT INTO admin (nama, email, password, telepon) VALUES (?, ?, ?, ?)";
    $result = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($result, "sssi", $nama, $email, $password, $telepon);
    $result = mysqli_stmt_execute($result);

    if ($result) {
        mysqli_commit($koneksi);
        showMessage('success', 'Data User Behasil ditambahkan');
        header('location:' . BASE_URL . 'private/user.php');
    } else {
        mysqli_rollback($koneksi);
        showMessage('danger', 'Data User Gagal ditambahkan' . mysqli_error($koneksi));
        header('location:' . BASE_URL . 'private/user.php');
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
                                <label for="nama" class="text-capitalize">nama user</label>
                                <input type="text" name="nama" id="nama" placeholder="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-capitalize">email</label>
                                <input type="email" name="email" id="email" placeholder="name@example.com" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-capitalize">password</label>
                                <input type="password" name="password" id="password" placeholder="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="text-capitalize">telepon</label>
                                <input type="number" name="telepon" id="telepon" placeholder="telepon" class="form-control" required>
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