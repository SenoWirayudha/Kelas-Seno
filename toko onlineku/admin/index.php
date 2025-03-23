<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Toko Online</title>
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

    <!-- Dashboard Content -->
    <section class="container mt-5">
        <h2 class="text-center">Selamat datang di Dashboard Admin</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Produk</h5>
                        <p class="card-text">Tambah, edit, dan hapus produk yang ada di toko Anda.</p>
                        <a href="manage_products.php" class="btn btn-primary">Kelola Produk</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Banner</h5>
                        <p class="card-text">Kelola banner yang tampil di halaman utama toko online Anda.</p>
                        <a href="manage_banner.php" class="btn btn-primary">Kelola Banner</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Pengguna</h5>
                        <p class="card-text">Lihat, blokir, dan kelola pengguna yang terdaftar.</p>
                        <a href="manage_users.php" class="btn btn-primary">Kelola Pengguna</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- More sections can be added here for other management tasks -->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
