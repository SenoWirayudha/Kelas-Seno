<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Order - Admin</title>
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


<section class="container mt-5">
    <header class="mb-4">
        <h1>Manage Orders</h1>
        <p class="lead">Kelola semua pesanan yang masuk.</p>
    </header>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contoh data statis, ganti dengan data dinamis dari database -->
            <tr>
                <td>#001</td>
                <td>John Doe</td>
                <td>Produk A</td>
                <td>2</td>
                <td><span class="badge bg-warning">Pending</span></td>
                <td>
                    <a href="#" class="btn btn-info btn-sm">Detail</a>
                    <a href="#" class="btn btn-success btn-sm">Konfirmasi</a>
                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <tr>
                <td>#002</td>
                <td>Jane Smith</td>
                <td>Produk B</td>
                <td>1</td>
                <td><span class="badge bg-success">Dikirim</span></td>
                <td>
                    <a href="#" class="btn btn-info btn-sm">Detail</a>
                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
        </tbody>
    </table>

    <!-- Pagination (opsional) -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</section>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
