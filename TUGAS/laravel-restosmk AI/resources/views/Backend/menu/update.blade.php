@extends('Backend.back')

@section('admincontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Update Data Menu</h3>
                </div>
                <div class="card-body">
            <form action="{{ url('admin/postmenu/'.$menu->idmenu) }}" method="post" enctype="multipart/form-data">
                @csrf

                <select class="form-select" name="idkategori">
                    @foreach ($kategoris as $kategori)
                        <option @selected($kategori->idkategori==$menu->idkategori) value="{{ $kategori->idkategori }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>
               
                <div class="mt-2">
                    <label class="form-label" for="">Menu</label>
                    <input class="form-control" type="text" value="{{ $menu->menu }}" name="menu" id="">
                    <span class="text-danger">
                        @error('menu')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mt-2">
                    <label class="form-label" for="">Deskripsi</label>
                    <input class="form-control" type="text" value="{{ $menu->deskripsi }}" name="deskripsi" id="">
                    <span class="text-danger">
                        @error('deskripsi')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mt-2">
                    <label class="form-label" for="">Harga</label>
                    <input class="form-control" type="number" value="{{ $menu->harga }}" name="harga" id="">
                    <span class="text-danger">
                        @error('harga')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-2">
                    <label class="form-label" for="">Gambar</label>
                    <input class="form-control" type="file" name="gambar" id="">
                    <span class="text-danger">
                        @error('gambar')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
    
                <div class="mt-4">
                    <button class="btn btn-primary w-100 mb-2" type="submit">Simpan</button>
                    <a href="{{ url('admin/menu') }}" class="btn btn-secondary w-100" type="button">Kembali</a>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection