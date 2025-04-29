<?php
session_start();
include '../config/database.php';
include '../admin/navbaradmin.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $trailerLink = trim($_POST['trailer_link']);
    $synopsis = trim($_POST['synopsis']);
    $releaseYear = trim($_POST['release_year']);
    $duration = trim($_POST['duration']);
    $director = trim($_POST['director']);
    $stock = trim($_POST['stock']);
    $category = trim($_POST['category']); // Menambahkan kategori

    // Validasi input
    if (empty($title) || empty($price) || !is_numeric($price) || empty($trailerLink) || empty($synopsis) || empty($releaseYear) || empty($duration) || empty($director) || empty($stock) || empty($category)) {
        $error = "Semua field harus diisi dan harga serta stok harus berupa angka.";
    } else {
        // Upload gambar
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/$image");

        // Simpan produk ke database
        $stmt = $pdo->prepare("INSERT INTO products (title, price, image, trailer_link, synopsis, release_year, duration, director, stock, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $price, $image, $trailerLink, $synopsis, $releaseYear, $duration, $director, $stock, $category]);

        header('Location: index.php');
        exit; // Pastikan untuk keluar setelah redirect
    }
}
?>
<div class="container">
<h1>Tambah Produk Baru</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="title">Judul:</label>
    <input type="text" id="title" name="title" required>
    
    <label for="price">Harga:</label>
    <input type="number" id="price" name="price" required>
    
    <label for="image">Gambar:</label>
    <input type="file" id="image" name="image" required>

    <label for="trailer_link">Trailer Link:</label>
    <input type="text" id="trailer_link" name="trailer_link" required>

    <label for="synopsis">Sinopsis:</label>
    <textarea id="synopsis" name="synopsis" required></textarea>

    <label for="release_year">Tahun Rilis:</label>
    <input type="number" id="release_year" name="release_year" required>

    <label for="duration">Durasi (menit):</label>
    <input type="number" id="duration" name="duration" required>

    <label for="director">Sutradara:</label>
    <input type="text" id="director" name="director" required>

    <label for="stock">Stok:</label>
    <input type="number" id="stock" name="stock" required>

    <label for="category">Kategori:</label> <!-- Menambahkan input kategori -->
    <input type="text" id="category" name="category" required>

    <input type="submit" value="Tambah Produk">
</form>
</div>

<?php include '../includes/footer.php'; ?>
