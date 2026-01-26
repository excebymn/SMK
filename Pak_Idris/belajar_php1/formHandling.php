<?php 
if(isset($_GET['nama'])){
$nama = $_GET['nama'];
$email = $_GET['email'];
}

echo "selamat $nama, email andaa : $email telah terdaftar";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <h1>Regristasi Akun</h1>
    <form action="" method="get">
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama">
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" id="email"  name="email" placeholder="Masukkan Email">
        </div>
        <div>
            <input type="submit" value="Daftar">
        </div>
    </form>
    <form action="beranda.php" method="post">
        <h2>login user</h2>
        <div class="mb-3">
            <label for="email" class="form-label">Email: </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="masukkan alamat email">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="masukkan password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    

</body>

</html>