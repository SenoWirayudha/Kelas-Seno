@extends('layouts.app')

@section('title', 'Pengguna Dibanned - Admin')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Pengguna Dibanned</h2>

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
                            <th>Tanggal Ban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bannedUsers as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->banned_at ? $user->banned_at->format('d M Y H:i') : '-' }}</td>
                                <td>
                                    <form action="{{ route('admin.users.toggle-ban', $user->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-success btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin mengaktifkan kembali pengguna ini?');">
                                            <i class="bi bi-person-check"></i> Aktifkan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($bannedUsers->isEmpty())
                <div class="text-center py-3">
                    <p class="text-muted mb-0">Tidak ada pengguna yang dibanned.</p>
                </div>
            @endif

            <div class="mt-4">
                {{ $bannedUsers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection