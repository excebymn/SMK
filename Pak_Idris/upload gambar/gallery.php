
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="p-4">
    <div class="container">
        <h2 class="text-capitalize">galeri gambar</h2>
        <a href="index.php" class="btn btn-primary mb-3">Upload gambar</a>
        <?php
        $files = scandir('uploads/');
        $no = 0;
        foreach ($files as $file) :
            if ($file != "." && $file != "..") :
        ?>
        <div class="col-md-3 mb-3">
            <img src="uploads/<?= $file ?>" alt="gambar<?= $no++ ?>">
        </div>
        <?php endif;
        endforeach; ?>
    </div>
</body>

</html>
