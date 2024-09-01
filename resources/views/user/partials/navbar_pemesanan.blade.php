<nav class="navbar navbar-expand-md navbar-bg fixed-top">
    <div class="container">
        <div class="row w-100">
            <div class="col-6 d-flex justify-content-start align-items-center">
                <a href="#">
                    <img src="{{ asset('img/logo.png')}}" alt="logo" width="150px">
                </a>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="{{ route('user.logout') }}" method="POST" id="logout-form" class="d-flex align-items-center">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link logout-link" style="color: #f24848; font-weight: 600;">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>