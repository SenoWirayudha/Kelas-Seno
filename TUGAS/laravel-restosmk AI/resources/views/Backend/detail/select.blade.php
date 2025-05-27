@extends('Backend.back')

@section('admincontent')
    <div>
        <h1>Order Detail</h1>
    </div>
    <form action="{{ url('admin/orderdetail/create') }}" method="get">

        <div class="row">
           
            <div class="mt-2 col-5">
                <label class="form-label" for="">Tanggal Mulai</label>
                <input class="form-control" value="" type="date" name="tglmulai" id="">
            </div>

            <div class="mt-2 col-5">
                <label class="form-label" for="">Tanggal Akhir</label>
                <input class="form-control" value="" type="date" name="tglakhir" id="">
            </div>

            <div class="my-4 col-2">
                <p></p>
                <button class="btn-secondary btn" type="submit"><i class="fas fa-search me-2"></i>Cari</button>
            </div>
        </div>
    </form>
    <div class="row mb-3">
        <div class="pe-5">
            <table class="table table-hover">
                <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </thead>
                @php
                    $no = 1;
                @endphp
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><i class="fas fa-calendar me-2"></i>{{ $detail->tglorder }}</td>
                            <td><i class="fas fa-user me-2"></i>{{ $detail->pelanggan }}</td>
                            <td>{{ $detail->menu }}</td>
                            <td>Rp {{ number_format($detail->harga) }}</td>
                             <td>{{ $detail->jumlah }}</td>
                            <td><i class="fas fa-money-bill-wave me-2"></i>Rp {{ number_format($detail->total) }}</td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $details->withQueryString()->links() }}
    </div>
@endsection