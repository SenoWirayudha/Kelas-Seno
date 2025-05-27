<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ayam Goreng Jos')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @yield('styles')
</head>
<body class="bg-white">
    <style>
        :root {
            --primary-color: #CBF1F5;
            --secondary-color: #A6E3E9;
            --accent-color: #71C9CE;
            --dark-color: #227C70;
        }
        .navbar { background-color: var(--dark-color) !important; }
        .btn-primary { background-color: var(--accent-color) !important; border-color: var(--accent-color) !important; }
        .btn-primary:hover { background-color: var(--dark-color) !important; border-color: var(--dark-color) !important; }
        .text-primary { color: var(--dark-color) !important; }
        .bg-primary { background-color: var(--primary-color) !important; }
        .card { border-color: var(--secondary-color) !important; }
        .card:hover { box-shadow: 0 0 15px var(--secondary-color) !important; }
    </style>

    @include('layouts.navigation')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')

    <footer class="text-center py-4 mt-5" style="background-color: var(--dark-color);">
        <p class="text-white mb-0">&copy; 2025 Ayam Goreng Jos. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>