@extends('Backend.back')

@section('admincontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: '{{ session('success') }}'
                    });
                </script>
            @endif
            @if(session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ session('error') }}'
                    });
                </script>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Tambah Data Kategori</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/kategori') }}" method="post">
                        @csrf
                       
                        <div class="mt-2">
                            <label class="form-label" for="">Kategori Menu</label>
                            <input class="form-control" value="{{ old('kategori') }}" type="text" name="kategori" id="">
                            <span class="text-danger">
                                @error('kategori')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
            
                        <div class="mt-4">
                            <button class="btn btn-primary w-100 mb-2" type="submit">Simpan</button>
                            <a href="{{ url('admin/kategori') }}" class="btn btn-secondary w-100" type="button">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
    @endif
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000
        });
    @endif
</script>
@endpush

@endsection