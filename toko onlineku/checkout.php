<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <!-- Checkout Section -->
    <section class="container mt-5">
        <h2 class="text-center mb-4">Checkout</h2>

        <!-- Ringkasan Pesanan -->
        <div class="row">
            <div class="col-md-6">
                <h4>Ringkasan Pesanan</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Produk 1 -->
                        <tr>
                            <td>Nama Produk 1</td>
                            <td>1</td>
                            <td>Rp 100.000</td>
                            <td>Rp 100.000</td>
                        </tr>
                        <!-- Produk 2 -->
                        <tr>
                            <td>Nama Produk 2</td>
                            <td>2</td>
                            <td>Rp 200.000</td>
                            <td>Rp 200.000</td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <h4>Total: Rp 300.000</h4>
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="col-md-6">
                <h4>Informasi Pengiriman</h4>
                <form>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullName" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Pengiriman</label>
                        <textarea class="form-control" id="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phoneNumber" required>
                    </div>
                    <h4>Pilih Metode Pembayaran</h4>
                    <div class="mb-3">
                        <select class="form-select" id="paymentMethod" required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            <option value="creditCard">Kartu Kredit</option>
                            <option value="bankTransfer">Transfer Bank</option>
                            <option value="cashOnDelivery">Bayar di Tempat</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Lanjutkan ke Pembayaran</button>
                    </div>
                </form>
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
