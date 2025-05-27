@extends('front')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-75">
    <div class="card shadow" style="width: 32rem;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Register</h3>
            <form action="{{ url('/postregister') }}" method="post">
                @csrf
                <div class="mt-2">
                    <label class="form-label" for="">Pelanggan</label>
                    <input class="form-control" value="{{ old('pelanggan') }}" type="text" name="pelanggan" id="">
                    <span class="text-danger">
                        @error('pelanggan')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-2">
                    <label class="form-label"for="">Alamat</label>
                    <input class="form-control" value="{{ old('alamat') }}" type="text" name="alamat" id="">
                    <span class="text-danger">
                        @error('alamat')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-2">
                    <label class="form-label" for="">Telp</label>
                    <input class="form-control" value="{{ old('telp') }}" type="text" name="telp" id="">
                    <span class="text-danger">
                        @error('telp')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-2">
                    <label class="form-label" for="">Jenis Kelamin</label>
                    <select class="form-select" name="jeniskelamin" id="">
                        <option value="l">L</option>
                        <option value="p" selected>P</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label class="form-label" for="">Email</label>
                    <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-2">
                    <label class="form-label" for="">Password</label>
                    <input class="form-control" value="{{ old('password') }}" type="password" name="password" id="">
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-4">
                    <button class="btn-primary btn w-100" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@if (Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif