@extends('Backend.back')

@section('admincontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Update Data User</h3>
                </div>
                <div class="card-body">
            <form action="{{ url('admin/user/'.$user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label" for="">Level</label>
                    <select class="form-select" name="level" id="">
                        <option value="admin" {{ request('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kasir" {{ request('level') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="manager" {{ request('level') == 'manager' ? 'selected' : '' }}>Manager</option>
                     </select>
                    <span class="text-danger">
                        @error('level')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="">Nama</label>
                    <input class="form-control" type="text" name="name" id="" value="{{ $user->name }}">
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="">Email</label>
                    <input class="form-control" type="email" name="email" id="" value="{{ $user->email }}">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="">Password</label>
                    <input class="form-control" type="password" name="password" id="">
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

    
                <div class="mt-4">
                    <button class="btn btn-primary" type="submit"">Simpan Perubahan</button>
                    <a href="{{ url('admin/user') }}" class="btn btn-secondary ms-2">Kembali</a>
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
                </script>
                @endpush
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection