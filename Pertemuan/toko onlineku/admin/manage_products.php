<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Admin</title>
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

    <!-- Manage Products Section -->
    <section class="container mt-5">
        <h2 class="text-center mb-4">Kelola Produk</h2>
        
        <!-- Add New Product Form -->
        <h4>Tambah Produk Baru</h4>
        <form>
            <div class="mb-3">
                <label for="productName" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="productName" required>
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" id="productImage" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Harga Produk</label>
                <input type="number" class="form-control" id="productPrice" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </form>

        <!-- List Products -->
        <h4 class="mt-5">Daftar Produk</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Produk 1</td>
                    <td><img src="assets/images/default.jpg" alt="Product" width="50"></td>
                    <td>Rp 100.000</td>
                    <td>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Hapus</button>
                    </td>
                </tr>
                <!-- More product rows can be added dynamically -->
            </tbody>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
