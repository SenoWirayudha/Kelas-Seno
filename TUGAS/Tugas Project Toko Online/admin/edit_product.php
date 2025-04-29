<?php
session_start();
include '../config/database.php';
include '../admin/navbaradmin.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Ambil ID produk dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data produk dari database
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Cek apakah produk ada
if (!$product) {
    die("Produk tidak ditemukan.");
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
    $category = trim($_POST['category']);

    // Validasi input
    if (empty($title) || empty($price) || !is_numeric($price) || empty($trailerLink) || empty($synopsis) || empty($releaseYear) || empty($duration) || empty($director) || empty($stock) || empty($category)) {
        $error = "Semua field harus diisi dan harga serta stok harus berupa angka.";
    } else {
        // Jika gambar baru diupload, lakukan upload
        if ($image) {
            // Pindahkan file gambar ke direktori tujuan
            if (move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/$image")) {
                // Update dengan gambar baru dan informasi lainnya
                $stmt = $pdo->prepare("UPDATE products SET title = ?, price = ?, image = ?, trailer_link = ?, synopsis = ?, release_year = ?, duration = ?, director = ?, stock = ?, category = ? WHERE id = ?");
                $stmt->execute([$title, $price, $image, $trailerLink, $synopsis, $releaseYear, $duration, $director, $stock, $category, $id]);
            } else {
                echo "Gagal mengunggah gambar.";
                exit;
            }
        } else {
            // Jika tidak ada gambar baru, update tanpa mengubah gambar
            $stmt = $pdo->prepare("UPDATE products SET title = ?, price = ?, trailer_link = ?, synopsis = ?, release_year = ?, duration = ?, director = ?, stock = ?, category = ? WHERE id = ?");
            $stmt->execute([$title, $price, $trailerLink, $synopsis, $releaseYear, $duration, $director, $stock, $category, $id]);
        }

        // Redirect setelah berhasil menyimpan perubahan
        header('Location: index.php');
        exit; // Pastikan untuk keluar setelah redirect
    }
}
?>

<div class="container">
<h1>Edit Produk</h1>
<?php if (isset($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="title">Judul:</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($product['title']) ?>" required>
    
    <label for="price">Harga:</label>
    <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
    
    <label for="image">Gambar (kosongkan jika tidak ingin mengubah):</label>
    <input type="file" id="image" name="image">
    
    <label for="trailer_link">Trailer Link:</label>
    <input type="text" id="trailer_link" name="trailer_link" value="<?= htmlspecialchars($product['trailer_link']) ?>" required>

    <label for="synopsis">Sinopsis:</label>
    <textarea id="synopsis" name="synopsis" required><?= htmlspecialchars($product['synopsis']) ?></textarea>

    <label for="release_year">Tahun Rilis:</label>
    <input type="number" id="release_year" name="release_year" value="<?= htmlspecialchars($product['release_year']) ?>" required>

    <label for="duration">Durasi (menit):</label>
    <input type="number" id="duration" name="duration" value="<?= htmlspecialchars($product['duration']) ?>" required>

    <label for="director">Sutradara:</label>
    <input type="text" id="director" name="director" value="<?= htmlspecialchars($product['director']) ?>" required>

    <label for="stock">Stok:</label>
    <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($product['stock']) ?>" required>

    <label for="category">Kategori:</label>
    <input type="text" id="category" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>

    <input type="submit" value="Simpan Perubahan">
</form>
</div>

<?php include '../includes/footer.php'; ?>
