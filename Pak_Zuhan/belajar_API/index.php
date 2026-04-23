<!DOCTYPE html>
<html>
<head>
    <title>CRUD Produk</title>
</head>
<body>

<h2>Tambah Produk</h2>
<form id="formTambah">
    Nama: <input type="text" name="nama_produk" required><br><br>
    Harga: <input type="number" name="harga" required><br><br>
    ID Kategori: <input type="number" name="id_kategori" required><br><br>
    <button type="submit">Tambah</button>
</form>

<hr>

<h2>Daftar Produk</h2>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="dataProduk"></tbody>
</table>

<script>r
// ambil data
function loadData() {
    fetch("api_produk.php")
    .then(res => res.json())
    .then(data => {
        let html = "";
        data.forEach(p => {
            html += `
                <tr>
                    <td>${p.id_produk}</td>
                    <td>${p.nama_produk}</td>
                    <td>${p.harga}</td>
                    <td>${p.nama_kategori}</td>
                    <td>
                        <button onclick="hapus(${p.id_produk})">Hapus</button>
                    </td>
                </tr>
            `;
        });
        document.getElementById("dataProduk").innerHTML = html;
    });
}

// tambah data
document.getElementById("formTambah").addEventListener("submit", function(e){
    e.preventDefault();
    let formData = new FormData(this);

    fetch("api.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        alert(res.message);
        loadData();
        this.reset();
    });
});

// hapus data
function hapus(id) {
    if(confirm("Yakin hapus?")) {
        fetch("api.php", {
            method: "DELETE",
            body: "id_produk=" + id,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            loadData();
        });
    }
}

// pertama kali load
loadData();
</script>

</body>
</html>