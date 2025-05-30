<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayam Goreng Jos - Order</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Ayam Goreng Jos</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/profil">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="/order">Order</a></li>
                <li class="nav-item"><a class="nav-link" href="/kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="/chatting">Chatting</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">Pesan Ayam Goreng Jos</h2>
        <form>
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama Anda">
            </div>
            <div class="form-group">
                <label for="pesanan">Pesanan</label>
                <select class="form-control" id="pesanan">
                    <option>Ayam Goreng</option>
                    <option>Ayam Penyet</option>
                    <option>Ayam Bakar</option>
                </select>
            </div>
            <button type="submit" class="btn btn-outline-dark btn-block">Pesan</button>
        </form>
    </div>

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2025 Ayam Goreng Jos. All Rights Reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
