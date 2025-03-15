<?php
include 'config.php';

// Proses Tambah Produk (Hanya jika form disubmit)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $gambar_produk = $_FILES['gambar_produk']['name'];

    // Proses upload gambar jika ada
    if (!empty($gambar_produk)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar_produk);
        move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $target_file);
    }

    // Menyimpan data ke database
    $query = "INSERT INTO produk (nama_produk, deskripsi, harga_beli, harga_jual, gambar_produk) VALUES ('$nama_produk', '$deskripsi', '$harga_beli', '$harga_jual', '$gambar_produk')";
    mysqli_query($koneksi, $query);

    // Redirect untuk mencegah pengulangan penambahan data saat refresh
    header("Location: index.php");
    exit;
}

// Ambil data produk dari database
$query = "SELECT * FROM produk ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            max-width: 100px; /* Mengatur ukuran gambar */
        }
        /* Style untuk tombol */
.btn-edit,
.btn-hapus {
    display: inline-block;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 14px;
    margin: 2px;
    transition: all 0.3s ease;
}

.btn-edit {
    background-color: #007bff;
    color: white;
    border: 1px solid #007bff;
}

.btn-hapus {
    background-color: #dc3545;
    color: white;
    border: 1px solid #dc3545;
}

.btn-edit:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn-hapus:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

    </style>
</head>
<body>

<h2>CRUD barang</h2>
<form method="post" action="" enctype="multipart/form-data">
    Nama Produk: <input type="text" name="nama_produk" required><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    Harga Beli: <input type="number" name="harga_beli" required><br>
    Harga Jual: <input type="number" name="harga_jual" required><br>
    Gambar Produk: <input type="file" name="gambar_produk"><br>
    <input type="submit" name="submit" value="Tambah">
</form>

<h2>Daftar Produk</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Deskripsi</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
            <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
            <td><?php echo number_format($row['harga_beli']); ?></td>
            <td><?php echo number_format($row['harga_jual']); ?></td>
            <td><img src="uploads/<?php echo htmlspecialchars($row['gambar_produk']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>"></td>
            <td>
                <!-- Tambahkan style untuk tombol -->
                <a href="edit_barang.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                <a href="hapus_barang.php?id=<?php echo $row['id']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

<?php
// Menutup koneksi database
mysqli_close($koneksi);
?>
