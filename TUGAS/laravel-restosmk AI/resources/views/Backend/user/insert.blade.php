@extends('Backend.back')

@section('admincontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Tambah Data User</h3>
                </div>
                <div class="card-body">
            <form action="{{ url('admin/user') }}" method="post">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label" for="">Level</label>
                    <select class="form-select" name="level" id="">
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="manager">Manager</option>
                    </select>
                    <span class="text-danger">
                        @error('level')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">Nama</label>
                    <input class="form-control" type="text" name="name" id="" value="{{ old('name') }}">
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="">Email</label>
                    <input class="form-control" type="email" name="email" id="" value="{{ old('email') }}">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="">Password</label>
                    <input class="form-control" type="password" name="password" id="" value="{{ old('password') }}">
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary w-100" type="submit">Simpan</button>
                    <a href="{{ url('admin/user') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection