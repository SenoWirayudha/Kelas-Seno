<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/" style="color: var(--primary-color);">Ayam Goreng Jos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                        <i class="bi bi-house"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profil') ? 'active' : '' }}" href="/profil">
                        <i class="bi bi-info-circle"></i> Profil
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}" href="{{ route('cart') }}">
                            <i class="bi bi-cart3"></i> Cart
                            @if(session('cart'))
                                <span class="badge" style="background-color: var(--primary-color); color: var(--dark-color);">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="/kontak">
                        <i class="bi bi-envelope"></i> Kontak
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background-color: var(--dark-color); border-color: var(--accent-color);">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-2">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-white hover-opacity">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>