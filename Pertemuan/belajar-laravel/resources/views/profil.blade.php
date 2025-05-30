{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Profil</title>
</head>
<body>
    <h1>Tentang Kami</h1>
    
    <!-- Menambahkan gambar -->
    <img src="{{ asset('images/profil.jpg') }}" alt="Gambar Profil Institusi" style="max-width: 100%; height: auto; border-radius: 5px; margin-bottom: 20px;">

    <p>Kami adalah institusi pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas tinggi kepada mahasiswa kami.</p>

    <h2>Sejarah Kami</h2>
    <p>Didirikan pada tahun 2000, kami telah berkembang menjadi salah satu lembaga pendidikan terkemuka di daerah ini.</p>

    <h2>Visi dan Misi</h2>
    <p><strong>Visi:</strong> Menjadi pusat pendidikan unggul yang menghasilkan pemimpin masa depan.</p>
    <p><strong>Misi:</strong> Menyediakan lingkungan belajar yang inovatif dan mendukung perkembangan pribadi dan profesional mahasiswa.</p>

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
    <title>Ayam Goreng Jos - Profil</title>
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
        <h2 class="text-center mb-4">Tentang Kami</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="{{ asset('images/ayam goreng.jpg') }}" class="card-img-top" alt="Restoran Ayam Goreng Jos">
                    <div class="card-body">
                        <h5 class="card-title">Ayam Goreng Jos</h5>
                        <p class="card-text">Ayam Goreng Jos adalah restoran yang menyediakan ayam goreng lezat dengan berbagai pilihan sambal dan menu lainnya. Kami menggunakan bahan berkualitas untuk memastikan setiap hidangan enak dan aman bagi pelanggan kami.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <h4>Visi & Misi</h4>
                <p>Visi kami adalah menjadi restoran ayam goreng terbaik di Indonesia, dengan menyediakan pengalaman kuliner yang unik dan memuaskan bagi pelanggan kami. Misi kami adalah selalu menjaga kualitas, kebersihan, dan kepuasan pelanggan.</p>
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
