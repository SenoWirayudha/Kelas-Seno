@extends('layouts.admin')

@section('title', 'Kelola Pengguna - Admin')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Kelola Pengguna</h2>

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
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($user->is_banned)
                                        <span class="badge bg-danger">Dibanned</span>
                                    @else
                                        <span class="badge bg-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.users.toggle-ban', $user->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm {{ $user->is_banned ? 'btn-success' : 'btn-danger' }}" 
                                                onclick="return confirm('Apakah Anda yakin ingin {{ $user->is_banned ? 'mengaktifkan' : 'memban' }} pengguna ini?');">
                                            <i class="bi {{ $user->is_banned ? 'bi-person-check' : 'bi-person-x' }}"></i>
                                            {{ $user->is_banned ? 'Aktifkan' : 'Ban' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection