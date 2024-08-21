<nav class="navbar navbar-expand-md navbar-bg fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <a href="{{ route('user.beranda')}}">
                    <img src="{{ asset('img/logo.png')}}" alt="logo" width="150px">
                </a>
                <div class="search-bar d-flex">
                    <input type="text" class="input-search flex-grow-1" placeholder="Search...">
                    <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>
                <div class="navbar-icons d-flex justify-content-between">
                    <a href="{{ route('user.keranjang')}}" class="nav-link {{ request()->routeIs('user.keranjang') ? 'active' : '' }}"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="{{ route('user.histori')}}" class="nav-link {{ request()->routeIs('user.histori') ? 'active' : '' }}"><i class="fa-solid fa-clock-rotate-left"></i></a>
                    <div class="dropdown">
                        <a class="nav-link {{ request()->routeIs('user.profil') ? 'active' : '' }}dropdown" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profil')}}">Profile</a></li>
                            <form action="{{ route('user.logout') }}" method="POST" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item logout-link">Logout</button>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="navbar-nav justify-content-center">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.beranda') ? 'active' : '' }}" aria-current="page" href="{{ route('user.beranda')}}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.tentang') ? 'active' : '' }}" href="{{ route('user.tentang')}}">Tentang Kami</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ request()->routeIs('user.gift_idea') || request()->routeIs('user.jenis_cokelat') || request()->routeIs('user.karakter_cokelat') ? 'active' : '' }} dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produk Kami
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ request()->routeIs('user.gift_idea') ? 'active' : '' }}" href="{{ route('user.gift_idea')}}">Gift Idea</a></li>
                                <li><a class="dropdown-item {{ request()->routeIs('user.jenis_cokelat') ? 'active' : '' }}" href="{{ route('user.jenis_cokelat')}}">Jenis Cokelat</a></li>
                                <li><a class="dropdown-item {{ request()->routeIs('user.karakter_cokelat') ? 'active' : '' }}" href="{{ route('user.karakter_cokelat')}}">Karakter Cokelat</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.kustomisasi_cokelat') ? 'active' : '' }}" href="{{ route('user.kustomisasi_cokelat')}}">Kustomisasi Cokelat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.kontak') ? 'active' : '' }}" href="{{ route('user.kontak')}}">Kontak Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
