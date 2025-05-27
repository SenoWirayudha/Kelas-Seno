@extends('Backend.back')

@section('admincontent')
<div class="d-flex justify-content-between align-items-center mb-3 pe-5">
        <h1>Kategori</h1>
        <div>
            <a class="btn btn-secondary" href="{{ url('admin/kategori/create') }}"><i class="fas fa-plus"></i> Tambah Kategori</a>    
        </div>
    </div>
    <div class="pe-5">
        <table class="table table-hover">
            <thead>
                <th>No.</th>
                <th>Nama Kategori</th>
                <th>Aksi Manager</th>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody>
                @foreach ($kategoris as $kategori)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $kategori->kategori }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ url('admin/kategori/'.$kategori->idkategori.'/edit') }}"><i class="fas fa-edit text-white"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{ url('admin/kategori/'.$kategori->idkategori) }}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>
@endsection