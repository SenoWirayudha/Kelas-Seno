@extends('Backend.back')

@section('admincontent')
    <div>
        <h1>Data User</h1>
    </div>
    <div>
        <a class="btn btn-primary" href="{{ url('admin/user/create') }}">Tambah Data</a>
        @if (session()->has('pesan'))
            <p class="alert alert-danger">{{ session()->get('pesan') }}</p>
        @endif
    </div>
    <div>
        <table class="table">
            <thead>
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Level</th>
                <th>Ubah</th>
                <th>Hapus</th>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level }}</td>
                        <td><a href="{{ url('admin/user/'.$user->id.'/edit') }}">Ubah Password</a></td>
                        <td><a href="{{ url('admin/user/'.$user->id) }}">Hapus</a></td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>
@endsection