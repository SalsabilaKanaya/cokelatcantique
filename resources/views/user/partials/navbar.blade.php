<nav class="navbar navbar-expand-md navbar-bg fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <a href="{{ route('user.beranda')}}">
                    <img src="{{ asset('img/logo.png')}}" alt="logo" width="150px">
                </a>
                <div class="search-bar d-flex">
                    <form action="{{ route('user.search') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="query" class="input-search flex-grow-1" placeholder="Search...">
                        <button type="submit" class="btn btn-link p-0"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="navbar-icons d-flex justify-content-between">
                    <a href="{{ route('user.showCart', ['navbar_click' => 1]) }}" class="nav-link {{ request()->routeIs('user.showCart') ? 'active' : '' }}"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="{{ route('user.histori', ['navbar_click' => 1]) }}" class="nav-link {{ request()->routeIs('user.histori') ? 'active' : '' }}"><i class="fa-solid fa-clock-rotate-left"></i></a>
                    @if(Auth::check())
                        <div class="dropdown">
                            <a class="nav-link dropdown" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.profil', ['navbar_click' => 1]) }}">Profile</a></li>
                                <form action="{{ route('user.logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-link">Logout</button>
                                </form>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('user.login', ['navbar_click' => 1]) }}" class="nav-link login-link d-flex align-items-center">Login</a>
                    @endif
                </div>
            </div>
            <div class="col-12">
                <div class="navbar-nav justify-content-center">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.beranda') ? 'active' : '' }}" aria-current="page" href="{{ route('user.beranda', ['navbar_click' => 1]) }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.tentang') ? 'active' : '' }}" href="{{ route('user.tentang', ['navbar_click' => 1]) }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ request()->routeIs('user.gift_idea') || request()->routeIs('user.jenis_cokelat') || request()->routeIs('user.karakter_cokelat') ? 'active' : '' }} dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produk Kami
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ request()->routeIs('user.gift_idea') ? 'active' : '' }}" href="{{ route('user.gift_idea', ['navbar_click' => 1]) }}">Gift Idea</a></li>
                                <li><a class="dropdown-item {{ request()->routeIs('user.jenis_cokelat') ? 'active' : '' }}" href="{{ route('user.jenis_cokelat', ['navbar_click' => 1]) }}">Jenis Cokelat</a></li>
                                <li><a class="dropdown-item {{ request()->routeIs('user.karakter_cokelat') ? 'active' : '' }}" href="{{ route('user.karakter_cokelat', ['navbar_click' => 1]) }}">Karakter Cokelat</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.kustomisasi_cokelat') ? 'active' : '' }}" href="{{ route('user.kustomisasi_cokelat', ['navbar_click' => 1]) }}">Kustomisasi Cokelat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.kontak') ? 'active' : '' }}" href="{{ route('user.kontak', ['navbar_click' => 1]) }}">Kontak Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>