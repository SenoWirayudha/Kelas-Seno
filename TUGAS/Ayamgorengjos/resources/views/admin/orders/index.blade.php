@extends('layouts.admin')

@section('title', 'Kelola Pesanan - Admin')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Kelola Pesanan</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Pesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ 
                                        $order->status === 'pending' ? 'warning' : 
                                        ($order->status === 'processing' ? 'info' : 
                                        ($order->status === 'completed' ? 'success' : 
                                        ($order->status === 'cancelled' ? 'danger' : 'secondary'))) 
                                    }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <button type="button" 
                                            class="btn btn-primary btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#orderModal{{ $order->id }}">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Detail Pesanan -->
                            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Pesanan #{{ $order->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <h6>Informasi Pelanggan</h6>
                                                    <p class="mb-1">Nama: {{ $order->user->name }}</p>
                                                    <p class="mb-1">Email: {{ $order->user->email }}</p>
                                                    <p class="mb-1">Telepon: {{ $order->phone }}</p>
                                                    <p>Alamat: {{ $order->address }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Informasi Pesanan</h6>
                                                    <p class="mb-1">Status: 
                                                        <span class="badge bg-{{ 
                                                            $order->status === 'pending' ? 'warning' : 
                                                            ($order->status === 'processing' ? 'info' : 
                                                            ($order->status === 'completed' ? 'success' : 
                                                            ($order->status === 'cancelled' ? 'danger' : 'secondary'))) 
                                                        }}">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </p>
                                                    <p class="mb-1">Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
                                                    <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>

                                            <h6>Item Pesanan</h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Menu</th>
                                                            <th>Harga</th>
                                                            <th>Jumlah</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($order->items as $item)
                                                            <tr>
                                                                <td>{{ $item->menu->nama }}</td>
                                                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Update Status</label>
                                                    <select class="form-select" id="status" name="status">
                                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-save"></i> Update Status
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection