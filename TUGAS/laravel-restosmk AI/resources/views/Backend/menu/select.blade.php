@extends('Backend.back')

@section('admincontent')
    <div class="d-flex justify-content-between align-items-center mb-3 pe-5">
        <div>
            <h1>Menu</h1>
        </div>
        <div class="d-flex gap-3">
            <form action="{{ url('admin/select') }}" method="get">
                <select class="form-select bg-light border-secondary text-dark" name="idkategori" onchange="this.form.submit()" style="border-width: 2px;">
                    <option class="text-muted" value="">--- Pilih Kategori ---</option>
                    @foreach ($kategoris as $kategori)
                        <option class="text-dark" value="{{ $kategori->idkategori }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>
            </form>
            <a class="btn btn-secondary" href="{{ url('admin/menu/create') }}"><i class="fas fa-plus"></i> Tambah Menu</a>  
        </div>    
    </div>
    <div>
    </div>
    <div class="row pe-5">
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
                        <div class="d-flex justify-content-center gap-3">
                            <a class="btn btn-sm btn-warning text-white" href="{{ url('admin/menu/'.$menu->idmenu.'/edit') }}"><i class="fas fa-edit text-white"></i> Update</a>
                            <a class="btn btn-sm btn-danger text-white" href="{{ url('admin/menu/'.$menu->idmenu) }}" onclick="event.preventDefault(); Swal.fire({
                                title: 'Apakah Anda yakin?',
                                text: 'Anda akan menghapus menu ini!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Ya, hapus!',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = this.href;
                                }
                            });"><i class="fas fa-trash-alt text-white"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $menus->withQueryString()->links() }}
    </div>
@endsection