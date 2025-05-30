{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Home</title>
</head>
<body>
    <h1>Selamat Datang di Halaman Home</h1>
    <p>Ini adalah website resmi kami, tempat di mana Anda dapat menemukan informasi tentang jurusan, profil institusi, dan cara menghubungi kami.</p>
    
    <h2>Visi dan Misi Kami</h2>
    <p>Visi kami adalah menjadi institusi pendidikan terkemuka yang menghasilkan lulusan berkualitas dan berdaya saing global.</p>
    <p>Misi kami adalah menyediakan pendidikan yang inovatif dan relevan dengan kebutuhan industri.</p>

    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/profil">Profil</a></li>
            <li><a href="/kontak">Kontak</a></li>
            <li><a href="/jurusan">Jurusan</a></li>
        </ul>
    </nav>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayam Goreng Jos - Home</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Ayam Goreng Jos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/profil">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="/order">Order</a></li>
                <li class="nav-item"><a class="nav-link" href="/kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="/chatting">Chatting</a></li>
            </ul>
        </div>
    </nav>

    <header class="bg-light text-dark text-center py-5">
        <h1 class="display-4">Selamat datang di Ayam Goreng Jos!</h1>
        <p class="lead">Nikmati ayam goreng yang renyah dan lezat hanya di Ayam Goreng Jos!</p>
    </header>

    <div class="container my-5">
        <h2 class="text-center mb-4">Menu Kami</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/ayam goreng.jpg') }}" class="card-img-top" alt="Ayam Goreng">
                    <div class="card-body">
                        <h5 class="card-title">Ayam Goreng</h5>
                        <p class="card-text">Ayam goreng dengan rasa crispy yang luar biasa.</p>
                        <a href="#" class="btn btn-outline-dark">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/ayam penyet.jpg') }}" class="card-img-top" alt="Ayam Penyet">
                    <div class="card-body">
                        <h5 class="card-title">Ayam Penyet</h5>
                        <p class="card-text">Ayam penyet dengan sambal pedas yang menggugah selera.</p>
                        <a href="#" class="btn btn-outline-dark">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/ayam bakar.webp') }}" class="card-img-top" alt="Ayam Bakar">
                    <div class="card-body">
                        <h5 class="card-title">Ayam Bakar</h5>
                        <p class="card-text">Ayam bakar dengan bumbu spesial yang kaya rasa.</p>
                        <a href="#" class="btn btn-outline-dark">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2025 Ayam Goreng Jos. All Rights Reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
