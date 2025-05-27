@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Home')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section py-5 mb-5" style="background-color: var(--primary-color);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-4" style="color: var(--dark-color);">Ayam Goreng Jos</h1>
                    <p class="lead mb-4" style="color: var(--dark-color);">Nikmati kelezatan ayam goreng dengan berbagai pilihan sambal yang menggugah selera. Dibuat dengan bahan berkualitas dan bumbu rahasia warisan keluarga.</p>
                    <a href="#menu" class="btn btn-lg" style="background-color: var(--dark-color); color: var(--primary-color);">Lihat Menu</a>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/ayam goreng.jpg') }}" alt="Ayam Goreng Jos" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Menu Section -->
    <div class="container" id="menu">
        <h2 class="text-center mb-5">Menu Pilihan Kami</h2>
        <div class="row g-4">
            @foreach($menus as $menu)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition" style="background-color: white;">
                        <div class="position-relative">
                            <img src="{{ asset($menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}" style="height: 250px; object-fit: cover;">
                            @if(!$menu->tersedia)
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.5);">
                                    <span class="badge bg-danger fs-5">Habis</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">{{ $menu->nama }}</h5>
                                <span class="badge" style="background-color: var(--accent-color);">{{ $menu->kategori }}</span>
                            </div>
                            <p class="card-text text-muted">{{ $menu->deskripsi }}</p>
                            <h4 class="mb-3" style="color: var(--dark-color);">Rp{{ number_format($menu->harga, 0, ',', '.') }}</h4>
                            @if($menu->tersedia)
                                <div class="d-flex gap-2">
                                    <form action="{{ route('checkout.direct') }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                                    </form>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <button type="submit" class="btn" style="border-color: var(--accent-color); color: var(--accent-color);" title="Tambah ke Keranjang">
                                            <i class="bi bi-cart-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <button class="btn btn-secondary w-100" disabled>Habis</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
