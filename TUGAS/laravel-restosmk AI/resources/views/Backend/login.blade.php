<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin Applikasi Restoran SMK</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Login Admin</h1>
                <form action="{{ url('admin/postlogin') }}" method="post">
                    @csrf

                    @if (Session::has('pesan'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ Session::get('pesan') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="mt-2">
                        <label class="form-label" for="">Email</label>
                        <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
        
                    <div class="mt-2">
                        <label class="form-label" for="">Password</label>
                        <input class="form-control" value="{{ old('password') }}" type="password" name="password" id="">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mt-4">
                        <button class="btn-primary btn w-100" type="submit">Login</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>