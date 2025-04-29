<?php
session_start();
include '../config/database.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Mendapatkan ID pengguna dari sesi
$userId = $_SESSION['user_id'];

// Ambil ID produk dari URL
if (!isset($_GET['id'])) {
    die("ID produk tidak ditemukan.");
}

$productId = $_GET['id'];

// Ambil detail produk berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch();

if (!$product) {
    die("Produk tidak ditemukan.");
}

// Menangani penambahan produk ke keranjang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    // Cek apakah produk sudah ada di keranjang
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$userId, $productId]);
    $cartItem = $stmt->fetch();

    if ($cartItem) {
        // Jika produk sudah ada, tingkatkan jumlahnya
        $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
        $stmt->execute([$cartItem['id']]);
    } else {
        // Jika produk belum ada, tambahkan ke keranjang
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $productId, 1]);
    }

    $message = "Produk berhasil ditambahkan ke keranjang!";
}

// Ambil ulasan untuk produk ini
$stmt = $pdo->prepare("SELECT r.*, u.username FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = ?");
$stmt->execute([$productId]);
$reviews = $stmt->fetchAll();

// Cek apakah pengguna telah melakukan pesanan untuk produk ini
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? AND product_id = ?");
$stmt->execute([$userId, $productId]);
$orderExists = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    if (!isset($_SESSION['user_id'])) {
        $error = "Anda harus login untuk memberikan ulasan.";
    } else {
        $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
        $comment = trim($_POST['comment']);

        // Validasi input
        if ($rating < 1 || $rating > 5) {
            $error = "Rating harus antara 1 dan 5.";
        } elseif (empty($comment)) {
            $error = "Komentar tidak boleh kosong.";
        } else {
            // Simpan ulasan ke database
            $stmt = $pdo->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
            $stmt->execute([$productId, $userId, $rating, $comment]);

            // Update total rating dan jumlah rating di tabel products
            $stmt = $pdo->prepare("UPDATE products SET total_rating = total_rating + ?, rating_count = rating_count + 1 WHERE id = ?");
            $stmt->execute([$rating, $productId]);

            $message = "Ulasan berhasil ditambahkan!";
            // Refresh halaman untuk menampilkan ulasan baru
            header("Location: product.php?id=" . $productId);
            exit();
        }
    }
}
?>

<?php include '../includes/header.php'; ?>
<div class="container product-page">
    <h1 class="product-title" style="font-size: 30px;"><?= htmlspecialchars($product['title']) ?></h1>

    <?php if (isset($message)) echo "<p class='message-success'>$message</p>"; ?>
    <?php if (isset($error)) echo "<p class='message-error'>$error</p>"; ?>

    <div class="trailer">
        <h2>Trailer</h2>
        <iframe src="<?= htmlspecialchars($product['trailer_link']) ?>" frameborder="0" allowfullscreen></iframe>
    </div>
        <div class="product-info">
            <p><strong>Tahun Rilis:</strong> <?= htmlspecialchars($product['release_year']) ?></p>
            <p><strong>Nama Sutradara:</strong> <?= htmlspecialchars($product['director']) ?></p>
            <p><strong>Durasi:</strong> <?= htmlspecialchars($product['duration']) ?> menit</p>

            <h3>Sinopsis</h3>
            <p><?= htmlspecialchars($product['synopsis']) ?></p>

            <form action="" method="POST">
                <input type="submit" name="add_to_cart" value="Tambah ke Keranjang" class="btn add-to-cart">
            </form>
        </div>
    <div class="reviews-section">
        <h3>Ulasan</h3>
        <?php if ($orderExists): ?>
            <form action="" method="POST">
                <div class="review-form">
                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating" required>
                        <option value="">Pilih Rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>

                    <label for="comment">Komentar:</label>
                    <textarea name="comment" id="comment" required></textarea>

                    <input type="submit" value="Kirim Ulasan" class="btn submit-review">
                </div>
            </form>
        <?php else: ?>
            <p>Anda harus melakukan pesanan untuk memberikan ulasan.</p>
        <?php endif; ?>

        <h4>Ulasan Pengguna:</h4>
        <?php if (count($reviews) > 0): ?>
            <ul class="reviews-list">
                <?php foreach ($reviews as $review): ?>
                    <li class="review-item">
                        <strong><?= htmlspecialchars($review['username']); ?> (Rating: <?= htmlspecialchars($review['rating']); ?>)</strong>
                        <p><?= htmlspecialchars($review['comment']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Tidak ada ulasan untuk produk ini.</p>
        <?php endif; ?>
    </div>
    </div>
</div>
<style>
    /* styles.css */
/* Judul Produk */
.product-title {
    color: #333;
    text-align: center;
    margin-top: 20px;
}

/* Pesan sukses dan error */
.message-success {
    color: green;
    text-align: center;
}

.message-error {
    color: red;
    text-align: center;
}

/* Trailer */
.trailer {
    text-align: center;
}

.trailer iframe {
    width: 100%;
    height: 400px; /* Atur tinggi sesuai kebutuhan */
    border-radius: 10px;
}

/* Informasi Produk */
.product-info {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.product-info p {
    margin: 10px 0;
}

/* Tombol */
.btn {
    background-color: #007bff; /* Warna biru */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3; /* Warna biru lebih gelap saat hover */
}

/* Bagian Ulasan */
.reviews-section {
    margin-top: 30px;
}

.review-form {
    margin-bottom: 20px;
}

.review-item {
    background-color: #f9f9f9; /* Warna latar belakang ulasan */
    border-left: 5px solid #007bff; /* Garis samping berwarna biru */
    padding: 10px;
    margin-bottom: 10px;
}

.reviews-list {
    list-style-type: none; /* Menghapus bullet point pada list */
}

.reviews-list li {
    padding: 10px;
}

</style>
<?php include '../includes/footer.php'; ?>
