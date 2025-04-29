<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Banner - Admin</title>
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

    <!-- Manage Banner Section -->
    <section class="container mt-5">
        <h2 class="text-center mb-4">Kelola Banner</h2>
        
        <!-- Upload Banner Form -->
        <h4>Tambah Banner Baru</h4>
        <form>
            <div class="mb-3">
                <label for="bannerImage" class="form-label">Gambar Banner</label>
                <input type="file" class="form-control" id="bannerImage" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Banner</button>
        </form>

        <!-- List Banners -->
        <h4 class="mt-5">Daftar Banner</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Gambar Banner</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="assets/images/default.jpg" alt="Banner" width="150"></td>
                    <td>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Hapus</button>
                    </td>
                </tr>
                <!-- More banner rows can be added dynamically -->
            </tbody>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
