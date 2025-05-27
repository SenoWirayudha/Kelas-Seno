<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #0ea5e9;
            --navbar-bg: #0f172a;
            --content-bg: #f8fafc;
        }
        
        body {
            background-color: var(--content-bg);
        }
        
        .navbar {
            background-color: var(--navbar-bg) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar, .navbar a {
            color: #ffffff !important;
        }
        
        .list-group {
            border-radius: 0;
            background-color: var(--sidebar-bg);
        }
        
        .list-group-item {
            transition: all 0.3s ease;
            padding: 12px 20px;
            background-color: transparent;
            border: none;
            color: #e2e8f0;
            border-left: 3px solid transparent;
        }
        
        .list-group-item:hover {
            background-color: var(--sidebar-hover);
            transform: none;
            border-left-color: var(--sidebar-active);
        }
        
        .list-group-item a {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
        }
        
        .list-group-item i {
            width: 24px;
            text-align: center;
        }
        
        #admincontent {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 20px;
        }
        
        .logout-btn:hover {
            transform: scale(1.05);
            color: #f43f5e !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-4" style="background-color: var(--navbar-bg); border-bottom: 3px solid var(--sidebar-active);">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-user-shield me-2"></i>Admin Page
                </a>
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
                        <li class="nav-item">
                            <span class="nav-link text-white"><i class="fas fa-envelope me-2"></i>{{ Auth::user()->email }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link text-white"><i class="fas fa-user-tag me-2"></i>Level: {{ Auth::user()->level }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link logout-btn" href="{{ url('admin/logout') }}">
                                <i class="fas fa-sign-out-alt me-2 text-white"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
            <style>
                .logout-btn:hover {
                    transform: scale(1.1);
                    color: #ff6b6b !important;
                }
            </style>
        </div>
        <div class="row g-0 min-vh-100">
            <div class="col-md-2 d-flex flex-column" style="background-color: var(--sidebar-bg); min-height: calc(100vh - 56px);">
                <ul class="list-group flex-grow-1">
                    @if (Auth::user()->level == 'admin')
                        <li class="list-group-item"><a href="{{ url('admin/user') }}"><i class="fas fa-users me-2"></i> User</a></li>
                    @endif
                    @if (Auth::user()->level == 'kasir')
                        <li class="list-group-item"><a href="{{ url('admin/order') }}"><i class="fas fa-cash-register me-2"></i> Order</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/orderdetail') }}"><i class="fas fa-receipt me-2"></i> Order Detail</a></li>
                    @endif
                    @if (Auth::user()->level == 'manager')
                        <li class="list-group-item"><a href="{{ url('admin/kategori') }}"><i class="fas fa-tags me-2"></i> Kategori</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/menu') }}"><i class="fas fa-utensils me-2"></i> Menu</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/pelanggan') }}"><i class="fas fa-user-friends me-2"></i> Pelanggan</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/order') }}"><i class="fas fa-shopping-cart me-2"></i> Order</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/orderdetail') }}"><i class="fas fa-list-alt me-2"></i> Order Detail</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-10 p-4" style="overflow-y: auto; max-height: calc(100vh - 56px);">
                <div id="admincontent">
                    @yield('admincontent')
                </div>
            </div>
        </div>
        <footer class="bg-dark text-white py-4" style="border-top: 3px solid var(--sidebar-active);">
            <div class="container">
                <div class="d-flex justify-content-center gap-5 align-items-center">
                    <p class="mb-0">© 2023 SMK Revit</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('.logout-btn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('admin/logout') }}";
            }
        });
    });
</script>
</body>
</html>