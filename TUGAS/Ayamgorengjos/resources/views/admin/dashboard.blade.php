@extends('layouts.admin')

@section('title', 'Admin Dashboard - Ayam Goreng Jos')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <h2 class="card-text">{{ $totalUsers }}</h2>
                    <a href="{{ route('admin.users') }}" class="text-white">Kelola Pengguna →</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Menu</h5>
                    <h2 class="card-text">{{ $totalMenus }}</h2>
                    <a href="{{ route('admin.menu') }}" class="text-white">Kelola Menu →</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan</h5>
                    <h2 class="card-text">{{ $totalOrders }}</h2>
                    <a href="{{ route('admin.orders') }}" class="text-dark">Kelola Pesanan →</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pesan</h5>
                    <h2 class="card-text">{{ $totalMessages }}</h2>
                    <a href="{{ route('admin.messages') }}" class="text-white">Lihat Pesan →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Menu Navigasi Admin</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('admin.menu') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Kelola Menu
                            <span class="badge bg-primary rounded-pill">{{ $totalMenus }}</span>
                        </a>
                        <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Kelola Pengguna
                            <span class="badge bg-primary rounded-pill">{{ $totalUsers }}</span>
                        </a>
                        <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Kelola Pesanan
                            <span class="badge bg-primary rounded-pill">{{ $totalOrders }}</span>
                        </a>
                        <a href="{{ route('admin.messages') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Lihat Pesan
                            <span class="badge bg-primary rounded-pill">{{ $totalMessages }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection