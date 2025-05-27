@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4" style="color: var(--dark-color);">Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php $total = 0 @endphp

    @if(session('cart'))
        <div class="card shadow-sm" style="border-color: var(--secondary-color);">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th width="120">Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['harga'] * $details['quantity'] @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($details['gambar']) }}" alt="{{ $details['nama'] }}" class="img-thumbnail me-3" style="width: 80px;">
                                            <span>{{ $details['nama'] }}</span>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control form-control-sm">
                                            <button type="submit" class="btn btn-sm ms-1" style="background-color: var(--accent-color); color: white;"><i class="bi bi-arrow-clockwise"></i></button>
                                        </form>
                                    </td>
                                    <td>Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm" style="background-color: var(--dark-color); color: white;"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('home') }}" class="btn" style="background-color: var(--secondary-color); color: var(--dark-color);"><i class="bi bi-arrow-left"></i> Lanjut Belanja</a>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x display-1" style="color: var(--accent-color);"></i>
            <h3 class="mt-4" style="color: var(--dark-color);">Keranjang Belanja Kosong</h3>
            <p style="color: var(--accent-color);">Anda belum menambahkan menu apapun ke keranjang.</p>
            <a href="{{ route('home') }}" class="btn mt-3" style="background-color: var(--accent-color); color: white;">Mulai Belanja</a>
        </div>
    @endif
</div>
@endsection
