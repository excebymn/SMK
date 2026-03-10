<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses upload gambar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="p-4">
    <div class="container">
        <h2 class="text text-uppercase">upload gambar</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gambar" class="form-label">gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">submit</button>
                <a href="gallery.php" class="btn btn-primary">Lihat galeri</a>
            </div>
        </form>
    </div>
</body>

</html>