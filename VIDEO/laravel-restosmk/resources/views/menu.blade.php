@extends('front')

@section('content')
<div class="row">
    @foreach ($menus as $menu)
        <div class="card mx-2 mt-2" style="width: 18rem;">
            <img src="{{ asset('gambar/'.$menu->gambar) }}" class="card-img-top" alt="...">

            <div class="card-body">
                <h5 class="card-title">{{  $menu->menu }}</h5>
                <p class="card-text">{{ $menu->deskripsi }}</p>
                <p class="card-title">{{ $menu->harga }}</p>
                <a href="{{ url('beli/'.$menu->idmenu) }}" class="btn btn-primary">Buy</a>
            </div>

        </div>
    @endforeach
    <div class="d-flex justify-content-center mt-5">
        {{ $menus->links() }}
    </div>
</div>
@endsection