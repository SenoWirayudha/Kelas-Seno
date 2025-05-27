@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Detail Pesanan #{{ $order->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Informasi Pengiriman</h5>
                        <p class="mb-1"><strong>Nama:</strong> {{ $order->nama }}</p>
                        <p class="mb-1"><strong>Alamat:</strong> {{ $order->alamat }}</p>
                        <p class="mb-1"><strong>Telepon:</strong> {{ $order->telepon }}</p>
                        <p class="mb-0"><strong>Status:</strong> 
                            <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5>Item Pesanan</h5>
                        @foreach($order->items as $item)
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $item->menu->nama }}</h6>
                                    <small class="text-muted">
                                        {{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Total Pembayaran</h5>
                            <h4 class="mb-0 text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Home</a>
            </div>
        </div>
    </div>
</div>
@endsection