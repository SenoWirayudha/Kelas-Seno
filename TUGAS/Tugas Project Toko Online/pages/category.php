<?php 
session_start();
include '../config/database.php';
include '../includes/header.php';

// Mendapatkan kategori dari URL
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Menampilkan daftar produk berdasarkan kategori
if ($category) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->execute([$category]);
    $products = $stmt->fetchAll();
}

?>

<div class="container">
    <h1>Katalog: <?php echo ucfirst(str_replace('_', ' ', $category)); ?></h1>

    <div class="product-list">
        <?php
        if (!empty($products)) {
            foreach ($products as $row) {
                // Hitung rata-rata rating
                $averageRating = $row['rating_count'] > 0 ? $row['total_rating'] / $row['rating_count'] : 0;
                
                echo "<div class='product-card'>"; // Menggunakan class card
                echo "<img src='../assets/images/{$row['image']}' alt='{$row['title']}' class='product-image'>"; // Perbaiki jalur gambar
                echo "<h2 class='product-title'>{$row['title']}</h2>";
                echo "<p class='product-price'>Harga: Rp " . number_format($row['price'], 2, ',', '.') . "</p>";
                echo "<p class='product-rating'>" . displayRating($averageRating) . " ({$row['rating_count']} Ulasan)</p>";
                echo "<a href='product.php?id={$row['id']}' class='btn'>Lihat Detail</a>"; // Mengarahkan ke detail produk
                echo "</div>";
                }
        } else {
            echo "<p>Tidak ada produk dalam kategori ini.</p>";
        }
        ?>
    </div>
</div>

<?php
// Fungsi untuk menampilkan rating bintang
function displayRating($rating) {
    $output = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $output .= '★'; // Bintang penuh
        } else {
            $output .= '☆'; // Bintang kosong
        }
    }
    return $output;
}
?>

<?php include '../includes/footer.php'; ?>
