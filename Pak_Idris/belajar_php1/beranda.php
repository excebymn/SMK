<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];


        if ($email == "bima@g" && $password == "bimalurus") {
            echo "<h2>Selamat datang $nama</h2>";
        }
    }
}
?>
