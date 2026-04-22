<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-capitalize">image upload</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['error'];
                                unset($_SESSION['error']) ?>
                            </div>
                        <?php endif; ?>
                        <form action="config.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="description" class="form-label text-capitalize">description</label>
                                <input type="text" class="form-control" id="description" name="description" maxlength="255" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Pilih Gambar (jpg/png maks 1MB)</label>
                                <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary text-capitalize">upload</button>
                                <a href="gallery.php" class="btn btn-secondary text-capitalize">lihat galeri</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>