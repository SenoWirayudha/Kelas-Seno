@extends('Backend.back')

@section('admincontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Update Data Kategori</h3>
                </div>
                <div class="card-body">
            <form action="{{ url('admin/kategori/'.$kategori->idkategori) }}" method="post">
                @csrf
                @method('PUT')
               
                <div class="mt-2">
                    <label class="form-label" for="">Kategori</label>
                    <input class="form-control" value="{{ $kategori->kategori }}" type="text" name="kategori" id="">
                    <span class="text-danger">
                        @error('kategori')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
    
                <div class="mt-4">
                    <button class="btn btn-primary w-100 mb-2" type="submit">Simpan</button>
                    <a href="{{ url('admin/kategori') }}" class="btn btn-secondary w-100" type="button">Kembali</a>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection