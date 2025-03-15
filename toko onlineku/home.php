<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Toko Online</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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

    <!-- Banner -->
    <section class="container mt-4">
        <h2 class="text-center">Selamat Datang di Toko Online Kami!</h2>
        <p class="text-center">Temukan berbagai produk menarik di toko kami. Jelajahi koleksi kami sekarang!</p>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Masuk ke Shop</a> <!-- Tombol menuju Shop -->
        </div>
    </section>

            <!-- Footer -->
            <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-white">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-white">Pengembalian Produk</a></li>
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

    <!-- Link ke JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
