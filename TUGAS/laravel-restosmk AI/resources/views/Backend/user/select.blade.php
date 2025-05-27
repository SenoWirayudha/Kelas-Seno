@extends('Backend.back')

@section('admincontent')
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
    return false;
}
</script>
    <div class="d-flex justify-content-between align-items-center mb-3 pe-5">
        <h1>Data User</h1>
        <div class="">
            <a class="btn btn-secondary" href="{{ url('admin/user/create') }}"><i class="fas fa-plus"></i> Tambah Data</a>
            @if (session()->has('pesan'))
                <p class="alert alert-danger">{{ session()->get('pesan') }}</p>
            @endif
        </div>
    </div>
    
    <div class="row mb-3 pe-5">
        <div class="col-md-10">
            <form action="{{ url('admin/user') }}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari user..." value="{{ request('search') }}">
                    <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <form action="{{ url('admin/user') }}" method="get">
                <div class="input-group">
                    <select class="form-select" name="level" onchange="this.form.submit()">
                        <option value="">Semua Level</option>
                        <option value="admin" {{ request('level') == 'admin' ? 'selected' : '' }} style="color: #dc3545;">Admin</option>
                        <option value="kasir" {{ request('level') == 'kasir' ? 'selected' : '' }} style="color: #0d6efd;">Kasir</option>
                        <option value="manager" {{ request('level') == 'manager' ? 'selected' : '' }} style="color: #198754;">Manager</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="pe-5">
        <table class="table table-hover">
            <thead>
                <th>No.</th>
                <th><i class="fas fa-user me-2"></i>Nama</th>
                <th><i class="fas fa-envelope me-2"></i>Email</th>
                <th><i class="fas fa-shield-alt me-2"></i>Level</th>
                <th>Aksi User</th>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td></i>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ url('admin/user/'.$user->id.'/edit') }}"><i class="fas fa-edit text-white"></i> </a>
                            <a class="btn btn-sm btn-danger" onclick="return confirmDelete('{{ url('admin/user/'.$user->id) }}')"><i class="fas fa-trash-alt"></i> </a>
                        </td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
