@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Kontak')

@section('content')
    <!-- Hero Section -->
    <div class="py-5 mb-5" style="background-color: var(--primary-color);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-4" style="color: var(--dark-color);">Hubungi Kami</h1>
                    <p class="lead" style="color: var(--dark-color);">Kami siap melayani pertanyaan dan saran Anda untuk pengalaman kuliner yang lebih baik.</p>
                </div>
                <div class="col-md-6 text-center">
                    <i class="bi bi-headset display-1" style="color: var(--dark-color);"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow-lg" style="background-color: var(--dark-color);">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4 text-white">Kirim Pesan</h3>
                        <form action="{{ route('kontak.store') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control text-white" style="background-color: var(--dark-color); @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                                <label for="nama" class="text-white-50">Nama Lengkap</label>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control text-white" style="background-color: var(--dark-color); @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                                <label for="email" class="text-white-50">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control text-white" style="background-color: var(--dark-color); @error('pesan') is-invalid @enderror" name="pesan" id="pesan" style="height: 150px" placeholder="Pesan" required>{{ old('pesan') }}</textarea>
                                <label for="pesan" class="text-white-50">Pesan</label>
                                @error('pesan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary btn-lg w-100">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg h-100" style="background-color: var(--dark-color);">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4 text-white">Informasi Kontak</h3>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <i class="bi bi-geo-alt-fill fs-2" style="color: var(--accent-color);"></i>
                            </div>
                            <div class="ms-3">
                                <h5>Alamat</h5>
                                <p class="mb-0">Jl. Ayam Goreng Jos No. 123,<br>Jakarta, Indonesia</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <i class="bi bi-telephone-fill fs-2" style="color: var(--accent-color);"></i>
                            </div>
                            <div class="ms-3">
                                <h5>Telepon</h5>
                                <p class="mb-0">+62 812-3456-7890</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bi bi-envelope-fill fs-2" style="color: var(--accent-color);"></i>
                            </div>
                            <div class="ms-3">
                                <h5>Email</h5>
                                <p class="mb-0"><a href="mailto:info@ayamgorengjos.com" class="text-white text-decoration-none">info@ayamgorengjos.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
