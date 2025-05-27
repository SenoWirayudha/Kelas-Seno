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
@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Profil')

@section('content')
    <!-- Hero Section -->
    <div class="py-5 mb-5" style="background-color: var(--primary-color);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold" style="color: var(--dark-color);">Tentang Kami</h1>
                    <p class="lead" style="color: var(--dark-color);">Menghadirkan cita rasa autentik ayam goreng dengan kualitas terbaik sejak 2020</p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/ayam goreng.jpg') }}" class="img-fluid rounded-3 shadow" alt="Restoran Ayam Goreng Jos">
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <!-- Sejarah Section -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="{{ asset('images/ayam penyet.jpg') }}" class="img-fluid rounded-3 shadow" alt="Sejarah Ayam Goreng Jos">
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">Sejarah Kami</h2>
                <p class="lead" style="color: var(--accent-color);">Ayam Goreng Jos didirikan pada tahun 2020 dengan tekad untuk menghadirkan hidangan ayam goreng berkualitas tinggi dengan harga terjangkau. Berawal dari sebuah warung kecil, kini kami telah berkembang menjadi restoran yang dicintai oleh berbagai kalangan.</p>
            </div>
        </div>

        <!-- Visi & Misi Section -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow" style="background-color: var(--primary-color);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-eye-fill fs-2 me-3" style="color: var(--dark-color);"></i>
                            <h3 class="mb-0" style="color: var(--dark-color);">Visi</h3>
                        </div>
                        <p class="card-text">Menjadi restoran ayam goreng terbaik di Indonesia dengan menyajikan pengalaman kuliner yang unik dan memuaskan bagi setiap pelanggan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow" style="background-color: var(--primary-color);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-flag-fill fs-2 me-3" style="color: var(--dark-color);"></i>
                            <h3 class="mb-0" style="color: var(--dark-color);">Misi</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2" style="color: var(--dark-color);"><i class="bi bi-check2-circle me-2" style="color: var(--accent-color);"></i>Menyajikan ayam goreng berkualitas tinggi</li>
                            <li class="mb-2" style="color: var(--dark-color);"><i class="bi bi-check2-circle me-2" style="color: var(--accent-color);"></i>Mengutamakan kebersihan dan keamanan pangan</li>
                            <li class="mb-2" style="color: var(--dark-color);"><i class="bi bi-check2-circle me-2" style="color: var(--accent-color);"></i>Memberikan pelayanan terbaik kepada pelanggan</li>
                            <li><i class="bi bi-check2-circle text-primary me-2"></i>Mengembangkan variasi menu yang inovatif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nilai-Nilai Section -->
        <h2 class="text-center mb-4" style="color: var(--dark-color);">Nilai-Nilai Kami</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <i class="bi bi-heart-fill fs-1 mb-3" style="color: var(--accent-color);"></i>
                    <h4 style="color: var(--dark-color);">Kualitas</h4>
                    <p style="color: var(--accent-color);">Menggunakan bahan-bahan terbaik untuk hasil yang maksimal</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <i class="bi bi-shield-check fs-1 mb-3" style="color: var(--accent-color);"></i>
                    <h4 style="color: var(--dark-color);">Kebersihan</h4>
                    <p style="color: var(--accent-color);">Menjaga standar kebersihan tertinggi dalam setiap proses</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <i class="bi bi-people-fill fs-1 mb-3" style="color: var(--accent-color);"></i>
                    <h4 style="color: var(--dark-color);">Pelayanan</h4>
                    <p style="color: var(--accent-color);">Memberikan pelayanan ramah dan profesional</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <i class="bi bi-star-fill fs-1 mb-3" style="color: var(--accent-color);"></i>
                    <h4 style="color: var(--dark-color);">Inovasi</h4>
                    <p style="color: var(--accent-color);">Terus berinovasi dalam menu dan layanan</p>
                </div>
            </div>
        </div>
    </div>

@endsection
