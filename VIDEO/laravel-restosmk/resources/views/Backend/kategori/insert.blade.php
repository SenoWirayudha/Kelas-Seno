@extends('Backend.back')

@section('admincontent')
<div class="container">
    <div class="row mt-5">
        <div class="col-4">
            <form action="{{ url('admin/kategori') }}" method="post">
                @csrf
               
                <div class="mt-2">
                    <label class="form-label" for="">Kategori</label>
                    <input class="form-control" value="{{ old('kategori') }}" type="text" name="kategori" id="">
                    <span class="text-danger">
                        @error('kategori')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
    
                <div class="mt-4">
                    <button class="btn-primary btn" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection