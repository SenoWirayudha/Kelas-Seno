@extends('front')

@section('content')
<div class="row pe-5 mt-5">
    @foreach ($menus as $menu)
    <div class="col-md-4 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-img-container" style="height: 200px; overflow: hidden;">
                <img src="{{ asset('gambar/'.$menu->gambar) }}" class="card-img-top h-100 w-100" style="object-fit: cover;" alt="{{ $menu->menu }}">
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-2" style="font-size: 1.1rem; font-weight: 600; color: #212529;">{{ $menu->menu }}</h5>
                <p class="card-text mb-3 text-muted" style="font-size: 0.9rem;">{{ $menu->deskripsi }}</p>
                <div class="mt-auto">
                    <p class="card-price mb-3" style="font-size: 1.1rem; font-weight: 600; color: #20c997;">Rp {{ number_format($menu->harga,0,',','.') }}</p>
                    <a href="{{ url('beli/'.$menu->idmenu) }}" class="btn btn-primary w-100 rounded-pill">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mt-5">
        {{ $menus->links() }}
    </div>
</div>
@endsection

