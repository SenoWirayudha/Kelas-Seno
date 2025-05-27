@extends('Backend.back')

@section('admincontent')
<div class="d-flex justify-content-between align-items-center mb-3 pe-5">
    <h1>Order</h1>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-filter me-2"></i>Filter Status
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="{{ url('admin/order') }}"><i class="fas fa-list me-2"></i>Semua</a></li>
            <li><a class="dropdown-item text-danger" href="{{ url('admin/order?status=0') }}"><i class="fas fa-times-circle me-2"></i>Belum Bayar</a></li>
            <li><a class="dropdown-item text-success" href="{{ url('admin/order?status=1') }}"><i class="fas fa-check-circle me-2"></i>Lunas</a></li>
        </ul>
    </div>
</div>

    <div class="row mb-3">
        <div class=" pe-5">
            <table class="table table-hover">
                <thead>
                    <th>No.</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembali</th>
                    <th>Status</th>
                </thead>
                @php
                    $no = 1;
                @endphp
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><a class="text-decoration-none" href="{{ url('admin/order/'.$order->idorder.'/edit') }}"><i class="fas fa-user me-2"></i>{{ $order->pelanggan }}</a></td>
                            <td><i class="fas fa-calendar me-2"></i>{{ $order->tglorder }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($order->bayar, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($order->kembali, 0, ',', '.') }}</td>
                            @php
                                $status = '<i class="fas fa-check-circle text-success"></i> LUNAS';
                                if($order->status == 0){
                                    $status = '<a class="text-decoration-none text-danger" href="'.url('admin/order/'.$order->idorder).'"><i class="fas fa-times-circle text-danger"></i> BAYAR</a>';
                                }
                            @endphp
                            <td>{!! $status !!}</td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-5">
               {{ $orders->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
            
        </div>
    </div>
@endsection

