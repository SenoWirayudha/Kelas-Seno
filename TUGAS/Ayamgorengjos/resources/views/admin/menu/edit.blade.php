@extends('layouts.admin')

@section('title', 'Edit Menu - Admin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Menu</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Menu</label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama', $menu->nama) }}" 
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      required>{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       class="form-control @error('harga') is-invalid @enderror" 
                                       id="harga" 
                                       name="harga" 
                                       value="{{ old('harga', $menu->harga) }}" 
                                       min="0" 
                                       required>
                            </div>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Menu</label>
                            <div class="mb-2">
                                <img src="{{ asset($menu->gambar) }}" 
                                     alt="{{ $menu->nama }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px;">
                            </div>
                            <input type="file" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" 
                                   name="gambar" 
                                   accept="image/*">
                            <div class="form-text">Format yang diizinkan: JPG, JPEG, PNG, WEBP. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</div>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.menu') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection