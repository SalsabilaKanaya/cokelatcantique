<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-6" id="sideleft">
                <div class="header">
                    <img src="{{ asset('img/logo.png')}}" alt="" class="logo" width="20%" href="beranda.html">
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
            <!-- Login -->
            <div class="side-right col-lg-6 d-flex justify-content-center align-items-center" id="auth-form">
                <div class="form-container">
                    <!-- Login Form -->
                    <div id="login-form">
                        <h1>Welcome!</h1>
                        <p>Harap masukkan email dan password dengan benar</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="button d-flex justify-content-between">
                                <button type="button" class="btn btn-text" onclick="showSignUp()">Sign up</button>
                                <button type="submit" class="btn btn-submit">Masuk</button>
                            </div>
                        </form>
                    </div>

                    <!-- Sign Up Form -->
                    <div id="signup-form" style="display: none; margin: 20px 0;">
                        <h1>Sign Up</h1>
                        <p>Silakan isi data berikut untuk mendaftar</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">No Telp</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="08xxxxxxxxx" required>
                            </div>
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="" disabled selected>Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="xxxxxx@gmail.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="button d-flex justify-content-between">
                                <button type="button" class="btn btn-text" onclick="showLogin()">Back to Login</button>
                                <button type="submit" class="btn btn-submit">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/login.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
