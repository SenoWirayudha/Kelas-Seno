<?php

$sql = "SELECT * FROM produk ORDER BY produk asc";

$hasil = mysqli_query($koneksi, $sql);

$baris = mysqli_num_rows($hasil);

if ($baris === 0) {
    echo "Produk Masih Kosong";
}
?>

<h1>Produk</h1>
<?php if ($baris > 0) {
    while ($row = mysqli_fetch_assoc($hasil)) {
?>
        <div class="container-produk">
            <div class="content">
                <div class="produk">
                    <h2><?= $row['produk'] ?></h2>
                    <a href="?menu=cart&add=<?= $row['id'] ?>">Beli</a>
                </div>
            </div>
        </div>

<?php
    }
}
?>