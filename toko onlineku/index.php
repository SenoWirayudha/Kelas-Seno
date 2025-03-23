<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <!-- Link ke CDN Bootstrap 5 -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menetapkan ukuran gambar yang seragam */
        .produk-img {
            width: 100%;
            height: 250px;
            object-fit: cover; /* Menjaga proporsi gambar tetap baik */
        }
        .carousel-item {
            transition: transform 1s ease; /* Transisi smooth untuk efek geser */
        }

        .carousel-inner {
            overflow: hidden; /* Sembunyikan gambar yang melampaui kontainer */
        }

        /* Mengatur ukuran gambar di carousel agar tidak zoom dan tetap proporsional */
        .carousel-item img {
            width: 100%;
            height: 500px; /* Sesuaikan dengan tinggi yang diinginkan */
            object-fit: contain; /* Menjaga gambar tetap proporsional tanpa terpotong atau zoom */
        }    
        </style>
</head>
<body>

    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <nav>
                <ul class="list-unstyled d-flex mb-0">
                    <li><a href="home.php" class="text-white mx-3">Beranda</a></li>
                    <li><a href="index.php" class="text-white mx-3">Shop</a></li>
                    <li><a href="cart.php" class="text-white mx-3">Keranjang</a></li> <!-- Menu Keranjang -->
                    <li><a href="tentangkami.php" class="text-white mx-3">Tentang Kami</a></li>
                    <li><a href="kontak.php" class="text-white mx-3">Kontak</a></li>
                </ul>
            </nav>
            <div class="d-flex">
                <a href="login.php"><button class="btn btn-outline-light">Login</button></a>
                <a href="register.php"><button class="btn btn-outline-light">Register</button></a>
            </div>
        </div>
    </header>

    <section class="container mt-4">
        <div id="dynamic-banner" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/produk1.jpg" alt="Banner Dinamis 1" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="images/produk2.jpg" alt="Banner Dinamis 2" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="images/produk3.jpg" alt="Banner Dinamis 3" class="d-block w-100">
                </div>
            </div>
            <!-- Kontrol untuk slide -->
            <button class="carousel-control-prev" type="button" data-bs-target="#dynamic-banner" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#dynamic-banner" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
            </section>
    
    <!-- Produk -->
    <section class="produk container mt-5">
        <h2 class="text-center mb-4">Produk Unggulan</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card">
                    <img src="images/produk1.jpg" alt="Produk 1" class="produk-img">
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk 1</h5>
                        <p class="card-text">Harga: Rp 100.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="images/produk2.jpg" alt="Produk 2" class="produk-img">
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk 2</h5>
                        <p class="card-text">Harga: Rp 200.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="images/produk3.jpg" alt="Produk 3" class="produk-img">
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk 3</h5>
                        <p class="card-text">Harga: Rp 300.000</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li><a href="kebijakan.php" class="text-white">Kebijakan Privasi</a></li>
                        <li><a href="syarat.php" class="text-white">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Pembayaran</h5>
                    <p>Metode pembayaran yang kami terima: Transfer Bank, e-wallet, Kartu Kredit.</p>
                </div>
                <div class="col-md-3">
                    <h5>Ikuti Kami</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Facebook</a></li>
                        <li><a href="#" class="text-white">Instagram</a></li>
                        <li><a href="#" class="text-white">Twitter</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Kontak Kami</h5>
                    <p>Email: support@toko.com</p>
                    <p>Telepon: 0800-123-456</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
