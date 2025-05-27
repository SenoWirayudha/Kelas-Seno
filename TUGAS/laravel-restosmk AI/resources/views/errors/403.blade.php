<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
            padding: 50px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #dc3545;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>403 - Akses Ditolak</h1>
        <p>{{ $message ?? 'Anda tidak memiliki akses ke halaman ini.' }}</p>
        
        @auth
            <p>Silakan kembali ke halaman yang sesuai dengan level akses Anda:</p>
            @if(Auth::user()->level == 'admin')
                <a href="{{ url('admin/user') }}" class="btn">Kembali ke Halaman Admin</a>
            @elseif(Auth::user()->level == 'manager')
                <a href="{{ url('admin/kategori') }}" class="btn">Kembali ke Halaman Manager</a>
            @elseif(Auth::user()->level == 'kasir')
                <a href="{{ url('admin/order') }}" class="btn">Kembali ke Halaman Kasir</a>
            @endif
        @else
            <a href="{{ url('admin') }}" class="btn">Kembali ke Halaman Login</a>
        @endauth
    </div>
</body>
</html>