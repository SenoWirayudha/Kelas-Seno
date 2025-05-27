@extends('front')

@section('content')
    @if (session('cart'))
        <div class="pe-5">
            
            @php
                $no = 1;
                $total = 0;
            @endphp
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr class="table-dark">
                                <th class="border-0">No.</th>
                                <th class="border-0">Menu</th>
                                <th class="border-0">Harga</th>
                                <th class="border-0">Jumlah</th>
                                <th class="border-0">Total</th>
                                <th class="border-0">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('cart') as $idmenu=>$menu )
                                <tr class="border-bottom">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $menu['menu'] }}</td>
                                    <td>Rp {{ number_format($menu['harga'], 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a class="btn btn-outline-secondary btn-sm rounded-circle" href="{{ url('kurang/'.$menu['idmenu']) }}">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                            <span class="px-2">{{ $menu['jumlah'] }}</span>
                                            <a class="btn btn-outline-secondary btn-sm rounded-circle" href="{{ url('tambah/'.$menu['idmenu']) }}">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($menu['jumlah'] * $menu['harga'], 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-outline-danger btn-sm" onclick="window.location.href='{{ url('hapus/'.$menu['idmenu']) }}'">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @php
                                $total = $total + ($menu['jumlah'] * $menu['harga']);
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-dark">Total Pembayaran:</h4>
                        <h4 class="mb-0 text-success">Rp {{ number_format($total, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-3 mt-4">
                <a class="btn btn-success px-4 rounded-pill" href="{{ url('checkout') }}" onclick="confirmCheckout(event)">
                    <i class="fas fa-shopping-cart me-2"></i>CheckOut
                </a>
                <a class="btn btn-outline-danger px-4 rounded-pill" href="{{ url('batal') }}" onclick="confirmBatal(event)">
                    <i class="fas fa-trash-alt me-2"></i>Batal
                </a>
            </div>

        </div>
    @else
        <script>
            window.location.href="/";
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCheckout(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Checkout',
                text: "Apakah Anda yakin ingin melanjutkan checkout?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = e.target.href;
                }
            });
        }
        
        function confirmBatal(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Pembatalan',
                text: "Apakah Anda yakin ingin membatalkan pesanan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = e.target.href;
                }
            });
        }
    </script>
@endsection