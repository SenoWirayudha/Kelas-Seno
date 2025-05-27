@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Checkout')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: var(--dark-color);">
                    <h4 class="text-white">Detail Pengiriman</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control @error('telepon') is-invalid @enderror" 
                                id="telepon" name="telepon" value="{{ old('telepon') }}" required>
                            @error('telepon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="catatan" name="catatan" 
                                rows="2">{{ old('catatan') }}</textarea>
                        </div>
                    
                        <button type="submit" class="btn w-100 text-white" style="background-color: var(--dark-color);">Proses Pesanan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="background-color: var(--dark-color);">
                    <h4 class="text-white">Ringkasan Pesanan</h4>
                </div>
                <div class="card-body">
                    @foreach($cart as $id => $item)
                        <div class="menu-item mb-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($item['gambar']) }}" 
                                    alt="{{ $item['nama'] }}" 
                                    class="img-thumbnail me-2" 
                                    style="width: 60px;">
                                <div>
                                    <h6 class="mb-0">{{ $item['nama'] }}</h6>
                                    <small class="text-muted">{{ $item['quantity'] }}x @ Rp {{ number_format($item['harga'], 0, ',', '.') }}</small>
                                    <p class="mb-0">Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="total">
                        <h5>Total Pembayaran</h5>
                        <h4 style="color: var(--accent-color);">Rp {{ number_format($total, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection