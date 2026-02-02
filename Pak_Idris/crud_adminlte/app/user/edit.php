<?php
require '../../config/config.php';
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

if (!isset($_GET['id'])) {
    header('loaction:' . BASE_URL);
    exit();
}

$query = "SELECT * FROM admin WHERE id=?";
$result = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($result, "i", $id);
mysqli_stmt_execute($result);
$result = mysqli_stmt_get_result($result);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    showMessage('danger', 'data user tidak di temukan');
    header('loaction:' . BASE_URL . "private/user.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    mysqli_begin_transaction($koneksi);

    try {
        $query = "UPDATE admin SET nama=?, email=?, password=?, telepon=? WHERE id=?";
        $result = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($result, "sssii", $nama, $email, $password, $telepon, $id);
        mysqli_stmt_execute($result);


        mysqli_commit($koneksi);
        showMessage('success', 'Data user Behasil update');
        header('location:' . BASE_URL . 'private/user.php');
        exit();
    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        showMessage('danger', 'Data user Gagal update' . mysqli_error($koneksi));
        header('location:' . BASE_URL . 'private/user.php');
        exit();
    }
}

require BASE_PATH . 'template/header.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase">update user</h1>
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
                                <input type="text" name="nama" id="nama" placeholder="name" class="form-control" value="<?= $user['nama'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-capitalize">email</label>
                                <input type="email" name="email" id="email" placeholder="name@example.com" class="form-control" value="<?= $user['email'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-capitalize">password</label>
                                <input type="password" name="password" id="password" placeholder="password" class="form-control" value="<?= $user['nama'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="text-capitalize">telepon</label>
                                <input type="number" name="telepon" id="telepon" placeholder="telepon" class="form-control" value="<?= $user['telepon'] ?>" required>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
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