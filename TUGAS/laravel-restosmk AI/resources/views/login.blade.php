@extends('front')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-75">
    <div class="card shadow" style="width: 28rem;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
            <form action="{{ url('/postlogin') }}" method="post">
                @csrf
                @if (Session::has('pesan'))
                <div class="alert alert-danger">
                    {{ Session::get('pesan') }}
                </div>
                @endif
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
                    <button class="btn-primary btn w-100" type="submit">Login</button>
                </div>
                <div class="mt-3 text-center">
                    <span>Tidak punya akun? <a href="{{ url('register') }}\">Daftar disini</a></span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection