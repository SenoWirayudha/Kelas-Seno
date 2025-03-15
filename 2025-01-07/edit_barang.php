<?php
include 'config.php'; // Pastikan ini mengarah ke file koneksi Anda

// Validasi dan sanitasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid!");
}

$id = (int)$_GET['id']; // Cast ke integer untuk keamanan

// Query untuk mengambil data produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Cek apakah data barang ditemukan
if (mysqli_num_rows($result) === 0) {
    die("Data barang tidak ditemukan!");
}

$barang = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses update data
    $id = (int)$_POST['id'];
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga_beli = (int)$_POST['harga_beli'];
    $harga_jual = (int)$_POST['harga_jual'];

    // Handle upload file dengan lebih baik
    $gambar_produk = $barang['gambar_produk']; // Default ke gambar lama
    
    if ($_FILES['gambar_produk']['error'] === UPLOAD_ERR_OK) {
        // Hapus gambar lama jika ada
        if (file_exists('uploads/'.$barang['gambar_produk'])) {
            unlink('uploads/'.$barang['gambar_produk']);
        }

        // Generate nama file unik
        $gambar_produk = uniqid().'_'.basename($_FILES['gambar_produk']['name']);
        $target_path = 'uploads/'.$gambar_produk;

        // Pastikan folder upload ada
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        if (!move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_path)) {
            die("Gagal upload gambar!");
        }
    }

    // Update query menggunakan prepared statement
    $query = "UPDATE produk SET 
        nama_produk = ?,
        deskripsi = ?,
        harga_beli = ?,
        harga_jual = ?,
        gambar_produk = ?
        WHERE id = ?";
        
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssiisi", 
        $nama_produk,
        $deskripsi,
        $harga_beli,
        $harga_jual,
        $gambar_produk,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Data berhasil diupdate');
            window.location.href = 'index.php';
        </script>";
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
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
            font-size: 14px;
        }

        textarea {
            height: 100px; /* Tinggi textarea */
            resize: vertical; /* Hanya bisa diubah ukuran vertikal */
        }

        img {
            max-width: 200px; 
            margin-top: 10px; 
            display: block; /* Menampilkan gambar sebagai block */
            margin-left: auto; 
            margin-right: auto; /* Centering image */
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block; /* Agar tombol dan tautan sejajar */
            text-align: center; /* Center text in button */
            margin-top: 10px; /* Tambahkan jarak di atas tombol */
            width: calc(50% - 5px); /* Lebar tombol */
        }

        .btn:hover {
            background-color: #0056b3; /* Warna saat hover */
        }

        .back-link {
            display: inline-block; /* Agar tautan kembali sejajar dengan tombol */
            text-align: center; /* Center text in link */
            margin-top: 10px; /* Tambahkan jarak di atas tautan */
            color: #007bff; /* Warna tautan */
            text-decoration: none; /* Menghilangkan garis bawah pada tautan */
        }

        .back-link:hover {
           text-decoration: underline; /* Garis bawah saat hover */
           color:#0056b3; /* Warna saat hover */
       }
    </style>
</head>
<body>
    <h1>Edit Data Barang</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($barang['id']); ?>">
        
        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" 
               value="<?php echo htmlspecialchars($barang['nama_produk']); ?>" required>
        
        <label>Deskripsi:</label>
        <textarea name="deskripsi"><?php echo htmlspecialchars($barang['deskripsi']); ?></textarea>
        
        <label>Harga Beli:</label>
        <input type="number" name="harga_beli" 
               value="<?php echo htmlspecialchars($barang['harga_beli']); ?>" required>
        
        <label>Harga Jual:</label>
        <input type="number" name="harga_jual" 
               value="<?php echo htmlspecialchars($barang['harga_jual']); ?>" required>
        
        <label>Gambar Saat Ini:</label><br>
         <?php if (!empty($barang['gambar_produk'])) : ?>
             <img src="uploads/<?php echo htmlspecialchars($barang['gambar_produk']); ?>" alt="Gambar Produk">
         <?php else : ?>
             <p>Tidak ada gambar</p>
         <?php endif; ?>
        
         <label>Upload Gambar Baru:</label>
         <input type="file" name="gambar_produk">
         
         <button type="submit" class="btn">Update</button>
         <a href="index.php" class="back-link">Kembali ke Daftar</a> <!-- Tautan kembali -->
     </form>
 </body>
 </html>

<?php
// Menutup koneksi database
mysqli_close($koneksi);
?>
