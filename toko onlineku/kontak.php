<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
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


    <div class="container my-5">
        <h2 class="text-center mb-4">Kontak Kami</h2>
        <h2>Formulir Kontak</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Pesan</label>
                <textarea class="form-control" id="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
        </form>

        <hr class="my-4">

        <h2>Informasi Kontak Lainnya</h2>
        <p><strong>Email:</strong> info@perusahaan.com</p>
        <p><strong>Telepon:</strong> +62 123 456 7890</p>
        <p><strong>Alamat:</strong> Jl. Contoh No. 123, Jakarta, Indonesia</p>

        <h2>Ikuti Kami di Media Sosial</h2>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="btn btn-outline-primary">Facebook</a></li>
            <li class="list-inline-item"><a href="#" class="btn btn-outline-info">Twitter</a></li>
            <li class="list-inline-item"><a href="#" class="btn btn-outline-danger">Instagram</a></li>
        </ul>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-oBqDVmMz4fnFO9gybZ9c9c7sD9zFfW+H6cH0kL6PqFZJ6eFzLZ6QJ+W8w0HcCw+" crossorigin="anonymous"></script>
</body>

</html>
