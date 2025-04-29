<?php 
session_start();
include '../config/database.php'; 
include '../includes/header.php'; 
?>
<div class="container">

<!-- Discover Section - Slider -->
<div class="discover">
    <div class="discover-slider">
        <!-- Discover Banner 1 -->
        <div class="discover-item">
            <a href="category.php?category=animasi" >
                <div class="discover-image-wrapper">
                    <img src="../assets/imgwhatsapp/banner_animasi.jpeg" alt="Festival Film Indonesia" class="discover-image">
                </div>
                <div class="banner-text">
                    <h3>Film Animasi</h3>
                </div>
            </a>
        </div>

        <!-- Discover Banner 2 -->
        <div class="discover-item">
            <a href="category.php?category=horor">
                <div class="discover-image-wrapper">
                    <img src="../assets/imgwhatsapp/banner_horor.jpeg" alt="Horror" class="discover-image">
                </div>
                <div class="banner-text">
                    <h3>Horror Film</h3>
                </div>
            </a>
        </div>

        <!-- Discover Banner 3 -->
        <div class="discover-item">
            <a href="category.php?category=drama">
                <div class="discover-image-wrapper">
                    <img src="../assets/imgwhatsapp/banner_drama.jpeg" alt="Drama" class="discover-image">
                </div>
                <div class="banner-text">
                    <h3>Drama Film</h3>
                </div>
            </a>
        </div>
        
    </div>
</div>

<!-- CSS for Discover Slider with Dynamic Image Size -->
<style>
    .discover {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 8px;
    }

    .discover-slider {
        display: flex;
        transition: transform 1s ease-in-out;
        width: 100%; /* 3 banners, so 100% for each */
    }

    .discover-item {
        width: 100%; /* Set each item to take full space of the container */
        flex-shrink: 0;
        position: relative;
    }

    /* Wrapper for maintaining 16:9 landscape aspect ratio */
    .discover-image-wrapper {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* Maintain a 16:9 landscape ratio */
        overflow: hidden;
    }

    /* Image style for responsive fit */
    .discover-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure image covers the area */
    }

    .banner-text {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        padding: 10px;
        text-align: center;
    }

    .banner-text h3 {
        margin: 0;
        font-size: 24px;
    }
</style>

<!-- JavaScript for Slider Behavior -->
<script>
    let discoverSlider = document.querySelector('.discover-slider');
    let currentIndex = 0;
    const totalItems = document.querySelectorAll('.discover-item').length;

    // Function to move to the next banner
    function moveSlider() {
        currentIndex = (currentIndex + 1) % totalItems; // Increment index, reset after last item
        discoverSlider.style.transform = `translateX(-${currentIndex * 100}%)`; // Move slider by 100% width of each item
    }

    // Automatically slide every 10 seconds (10000ms)
    setInterval(moveSlider, 3000); // Change every 10 seconds
</script>


<!-- Katalog Kategori Film -->
<div class="catalogue">
    <div class="category">
        <a href="category.php?category=animasi" style="text-decoration: none;">
            <img src="../assets/imgwhatsapp/animasi.jpeg" alt="Festival Film Indonesia" class="category-image">
            <h3>Animasi</h3>
        </a>
    </div>
    <div class="category">
        <a href="category.php?category=horor" style="text-decoration: none;">
            <img src="../assets/imgwhatsapp/horor.jpeg" alt="Horror" class="category-image">
            <h3>Horror</h3>
        </a>
    </div>
    <div class="category">
        <a href="category.php?category=drama" style="text-decoration: none;">
            <img src="../assets/imgwhatsapp/drama.jpeg" alt="Drama" class="category-image">
            <h3>Drama</h3>
        </a>
    </div>
    <div class="category">
        <a href="category.php?category=action" style="text-decoration: none;">
            <img src="../assets/imgwhatsapp/action.jpeg" alt="Action" class="category-image">
            <h3>Action</h3>
        </a>
    </div>
    <div class="category">
        <a href="category.php?category=klasik" style="text-decoration: none;">
            <img src="../assets/imgwhatsapp/klasik.jpeg" alt="90s - 2000s" class="category-image">
            <h3>Klasik</h3>
        </a>
    </div>
    <div class="category">
        <a href="category.php?category=sci-Fi" style="text-decoration: none;">
            <img src="../assets/imgwhatsapp/sci-fi.jpeg" alt="90s - 2000s" class="category-image">
            <h3>Sci-Fi</h3>
        </a>
    </div>
    <div class="category">
        <a href="category.php?category=musikal" style="text-decoration: none;">
            <img src="../assets/imgwhatsapp/musikal.jpeg" alt="90s - 2000s" class="category-image">
            <h3>Musikal</h3>
        </a>
    </div>
</div>

<!-- Konten Halaman -->
<div class="container">
    <h1>DVD</h1>

    <!-- Form Pencarian -->
    <form action="index.php" method="post" class="search-form">
        <input type="text" name="search" placeholder="Cari DVD..." required>
        <button type="submit"><i class="fas fa-search"></i> Cari</button>
    </form>

    <div class="product-list">
        <?php
        // Proses pencarian
        $searchResults = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
            $searchTerm = trim($_POST['search']);
            
            if (!empty($searchTerm)) {
                // Query untuk mencari produk berdasarkan judul
                $stmt = $pdo->prepare("SELECT * FROM products WHERE title LIKE ? LIMIT 10");
                $stmt->execute(['%' . $searchTerm . '%']);
                $searchResults = $stmt->fetchAll();
            }
        } else {
            // Ambil semua produk dari database jika tidak ada pencarian
            $stmt = $pdo->query("SELECT * FROM products");
            $searchResults = $stmt->fetchAll();
        }

        // Tampilkan produk
        foreach ($searchResults as $row) {
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

        // Jika tidak ada hasil pencarian
        if (empty($searchResults) && isset($_POST['search'])) {
            echo "<p>Tidak ada DVD ditemukan untuk \"<strong>" . htmlspecialchars($searchTerm) . "</strong>\".</p>";
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
