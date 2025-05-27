@extends('Backend.back')

@section('admincontent')
<div class="container">
    <div class="row mt-3">
        <h1>Pembayaran Pelanggan</h1>
        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4>Pembayaran</h4>
                </div>
                <div class="card-body">
                    <h5>Pelanggan: {{ $order->idpelanggan}}</h5>
                    <form action="{{ url('admin/order/'.$order->idorder) }}" method="post">
                        @csrf
                        @method('PUT')
                       
                        <div class="form-group">
                            <label>Total Tagihan</label>
                            <input type="text" class="form-control" value="Rp {{ number_format($order->total) }}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label>Jumlah Bayar</label>
                            <input class="form-control" min="{{ $order->total }}" value="{{ $order->total }}" type="number" name="bayar" required>
                            <span class="text-danger">
                                @error('bayar')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        
                        <div class="form-group mt-4">
                            <button class="btn btn-primary w-100" type="submit" onclick="return confirmPayment()">Bayar</button>
                        </div>
                        
                        @push('scripts')
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            function confirmPayment() {
                                Swal.fire({
                                    title: 'Konfirmasi Pembayaran',
                                    text: 'Apakah Anda yakin ingin melakukan pembayaran?',
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Bayar!',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.querySelector('form').submit();
                                    }
                                });
                                return false;
                            }
                        </script>
                        @endpush
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection