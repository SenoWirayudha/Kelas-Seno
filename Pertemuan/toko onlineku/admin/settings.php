<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar Admin -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="manage_products.php">Kelola Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_banner.php">Kelola Banner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php">Kelola Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href= "manage_order.php">Kelola Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">Pengaturan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Settings Section -->
    <section class="container mt-5">
        <h2 class="text-center mb-4">Pengaturan</h2>

        <!-- Edit Kebijakan Privasi -->
        <h4>Kebijakan Privasi</h4>
        <textarea class="form-control mb-3" rows="5" placeholder="Masukkan kebijakan privasi"></textarea>

        <!-- Edit Syarat dan Ketentuan -->
        <h4>Syarat dan Ketentuan</h4>
        <textarea class="form-control mb-3" rows="5" placeholder="Masukkan syarat dan ketentuan"></textarea>

        <!-- Edit Metode Pembayaran -->
        <h4>Metode Pembayaran</h4>
        <select class="form-select mb-3">
            <option value="creditCard">Kartu Kredit</option>
            <option value="bankTransfer">Transfer Bank</option>
            <option value="cashOnDelivery">Bayar di Tempat</option>
        </select>

        <!-- Edit Akun Media Sosial -->
        <h4>Akun Media Sosial</h4>
        <input type="text" class="form-control mb-3" placeholder="Facebook">
        <input type="text" class="form-control mb-3" placeholder="Instagram">
        <input type="text" class="form-control mb-3" placeholder="Twitter">

        <!-- Edit Kontak Kami -->
        <h4>Kontak Kami</h4>
        <input type="text" class="form-control mb-3" placeholder="Email">
        <input type="text" class="form-control mb-3" placeholder="Nomor Telepon">
        
        <button class="btn btn-primary">Simpan Pengaturan</button>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
