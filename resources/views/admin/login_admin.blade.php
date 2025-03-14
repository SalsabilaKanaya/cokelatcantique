<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin/login_admin.css') }}">
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-6" id="sideleft">
                <div class="header">
                    <img src="{{asset('img/logo.png')}}" alt="" class="banner" width="20%">
                </div>
                <div class="body text-center justify-content-center align-items-center">
                    <h1>Cokelat Cantique!</h1>
                    <h2>Sweet Moments, Crafted with Love</h2>
                    <div>
                        <img src="{{asset('img/banner.png')}}" alt="Image" class="main-image" width="35%">
                    </div>
                    <div class="user-images mt-4">
                        <img src="{{asset('img/user1.png')}}" alt="User 1" class="user-img">
                        <img src="{{asset('img/user2.png')}}" alt="User 2" class="user-img">
                        <img src="{{asset('img/user3.png')}}" alt="User 3" class="user-img">
                        <img src="{{asset('img/user4.png')}}" alt="User 4" class="user-img">
                        <img src="{{asset('img/user5.png')}}" alt="User 5" class="user-img">
                    </div>
                    <div class="mt-2">
                        <p>1000+ buyers</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" id="sideright">
                <div class="d-flex vh-100 justify-content-center align-items-center">
                    <div class="body">
                        <h1>Welcome Admin!</h1>
                        <p>Harap masukkan username dan password admin dengan benar</p>
                        @if ($errors->has('username'))
                            <div class="alert alert-error-message">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label text-start w-100">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-start w-100">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-lg">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>