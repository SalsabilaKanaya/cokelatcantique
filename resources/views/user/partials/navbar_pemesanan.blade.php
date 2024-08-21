<nav class="navbar navbar-expand-md navbar-bg fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <a href="{{ route('user.beranda')}}">
                    <img src="{{ asset('img/logo.png')}}" alt="logo" width="150px">
                </a>
                <div class="navbar-icons d-flex justify-content-between">
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
        </div>
    </div>
</nav>
