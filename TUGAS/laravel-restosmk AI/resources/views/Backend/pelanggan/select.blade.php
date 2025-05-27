@extends('Backend.back')

@section('admincontent')
<div class="d-flex justify-content-between align-items-center mb-3 pe-5">
    <h1>Pelanggan</h1>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-filter me-2"></i>Filter Status
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="{{ url('admin/pelanggan') }}"><i class="fas fa-list"></i> Semua Status</a></li>
            <li><a class="dropdown-item text-success" href="{{ url('admin/pelanggan?status=1') }}"><i class="fas fa-check-circle"></i> AKTIF</a></li>
            <li><a class="dropdown-item text-danger" href="{{ url('admin/pelanggan?status=0') }}"><i class="fas fa-ban"></i> BANNED</a></li>
        </ul>
    </div>
</div>

    <div class="row mb-3">
        <div class="pe-5">
            <table class="table table-hover">
                <thead>
                    <th>No.</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Status</th>
                </thead>
                @php
                    $no = 1;
                @endphp
                <tbody>
                    @foreach ($pelanggans as $pelanggan)
                                 <td>{{ $no++ }}</td>
                            <td>{{ $pelanggan->pelanggan }}</td>
                            <td>{{ $pelanggan->alamat }}</td>
                            <td>{{ $pelanggan->email }}</td>
                            <td>{{ $pelanggan->telp }}</td>
                            @php
                                if ($pelanggan->aktif == 0) {
                                    $aktif = '<a href="'.url('admin/pelanggan/'.$pelanggan->idpelanggan).'" class="text-danger font-weight-bold text-decoration-none"><i class="fas fa-ban"></i> BANNED</a>';
                                } else {
                                    $aktif = '<a href="'.url('admin/pelanggan/'.$pelanggan->idpelanggan).'" class="text-success font-weight-bold text-decoration-none"><i class="fas fa-check-circle"></i> AKTIF</a>';
                                }
                            @endphp
                            <td>{!! $aktif !!}</td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-5">
                {{ $pelanggans->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection