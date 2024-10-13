<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Cokelat Cantique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/user/login.css')}}">
</head>
<body>
    <div class="container-fluid h-100">
        @if (session('session_cleared'))
            @if (session('session_cleared') === true)
                <div class="alert alert-success">
                    Session berhasil dihapus.
                </div>
            @else
                <div class="alert alert-danger">
                    Gagal menghapus session.
                </div>
            @endif
        @endif
        <div class="row h-100">
            <div class="col-lg-6" id="sideleft">
                <div class="header">
                    <img src="{{ asset('img/logo.png')}}" alt="" class="logo" width="20%" href="#">
                </div>
                <div class="body text-center justify-content-center align-items-center">
                    <h1>Cokelat Cantique!</h1>
                    <h2>Sweet Moments, Crafted with Love</h2>
                    <div>
                        <img src="{{ asset('img/loginbanner.png')}}" alt="Image" class="main-image" width="35%">
                    </div>
                    <div class="user-images mt-4">
                        <img src="{{ asset('img/user1.png')}}" alt="User 1" class="user-img">
                        <img src="{{ asset('img/user2.png')}}" alt="User 2" class="user-img">
                        <img src="{{ asset('img/user3.png')}}" alt="User 3" class="user-img">
                        <img src="{{ asset('img/user4.png')}}" alt="User 4" class="user-img">
                        <img src="{{ asset('img/user5.png')}}" alt="User 5" class="user-img">
                    </div>
                    <div class="mt-2">
                        <p>1000+ buyers</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" id="sideright">
                <div class="d-flex vh-100 justify-content-center align-items-center">
                    <div class="body">
                        <h1>Welcome!</h1>
                        <p>Harap memasukkan email dan password dengan benar</p>
                        @if ($errors->has('email'))
                            <div class="error-message">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('user.login_submit') }}">
                            @csrf
                            <div class="mb-3 input-box">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 input-box">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="btn btn-secondary" type="button" id="togglePassword" style="height: 40px;">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-login">Masuk</button>
                        </form>
                        <div class="separator">
                            <span>atau dengan akun Google</span>
                        </div>
                        <a href="{{ route('user.google.redirect') }}" class="google-login">
                            <img src="http://www.androidpolice.com/wp-content/themes/ap2/ap_resize/ap_resize.php?src=http%3A%2F%2Fwww.androidpolice.
                            com%2Fwp-content%2Fuploads%2F2015%2F10%2Fnexus2cee_Search-Thumb-150x150.png&w=150&h=150&zc=3" alt="Google">
                            <span>Masuk dengan Google</span>
                        </a>
                        <p class="mt-3 register">Belum punya akun? <a href="{{ route('user.register') }}">Daftar Akun</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/user/login.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>