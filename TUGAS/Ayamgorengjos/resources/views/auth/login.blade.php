@extends('layouts.app')

@section('title', 'Login - Ayam Goreng Jos')

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-white text-center py-3" style="background-color: var(--dark-color);">
                        <h4 class="mb-0">Selamat Datang Kembali</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                                <label for="email">Email</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Password">
                                <label for="password">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Ingat Saya</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-lg text-white" style="background-color: var(--dark-color);">Masuk</button>
                            </div>

                            <div class="text-center mt-3">
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none" style="color: var(--accent-color);" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>
                            
                            <div class="text-center mt-3">
                                <p class="mb-0">Belum punya akun? 
                                    <a href="{{ route('register') }}" class="text-decoration-none" style="color: var(--accent-color);">Daftar sekarang</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection