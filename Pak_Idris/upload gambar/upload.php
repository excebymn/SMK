<?php
$gambar = $_FILES['gambar'];
$name = $gambar['name'];
$ukuran = $gambar['size'];
$tmp = $gambar['tmp_name'];

$folder = "uploads/";

$extensionValidate = ['jpg', 'jpeg', 'png'];
$extension = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
if (!in_array($extension, $extensionValidate)) :
?>
    <div class="alert alert-danger text-capitalize">ekstensi tidak valid</div>
<?php
    exit();
endif;
if ($ukuran > 1000000) :
?>
    <div class="alert alert-danger text-capitalize">ukuran file terlalu besar. maksimal ukuran file adalah 1 mb</div>
<?php
    exit();
endif;

$newName = uniqid() . '.' . $extension;

if (move_uploaded_file($tmp, $folder . $newName)) :
?>
    <div class="alert alert-success text-capitalize">file berhasil di upload</div>
    <img src="<?= $folder . $newName ?>" alt="Gambar" class="img-fluid mt-3">
<?php else : ?>
    <div class="alert alert-danger text-capitalize">terjadi kesalahan pada saat upload</div>
<?php endif; ?>