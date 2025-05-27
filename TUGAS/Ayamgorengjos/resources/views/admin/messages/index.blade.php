@extends('layouts.admin')

@section('title', 'Kelola Pesan - Admin')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Kelola Pesan</h2>

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
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->nama }}</td>
                                <td>{{ $message->email }}</td>
                                <td>
                                    <button type="button" 
                                            class="btn btn-link p-0" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#messageModal{{ $message->id }}">
                                        {{ Str::limit($message->pesan, 50) }}
                                    </button>
                                </td>
                                <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.messages.delete', $message->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Detail Pesan -->
                            <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Pesan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <h6>Dari</h6>
                                                <p class="mb-1">{{ $message->nama }} ({{ $message->email }})</p>
                                                <p class="text-muted small">{{ $message->created_at->format('d M Y H:i') }}</p>
                                            </div>
                                            <div>
                                                <h6>Pesan</h6>
                                                <p class="mb-0">{{ $message->pesan }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <a href="mailto:{{ $message->email }}" class="btn btn-primary">
                                                <i class="bi bi-reply"></i> Balas Email
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection