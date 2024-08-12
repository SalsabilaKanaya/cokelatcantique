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
            <div class="col-lg-6" id="sideright">
                <div class="d-flex vh-100 justify-content-center align-items-center">
                    <div class="body">
                        <h1>Welcome!</h1>
                        <p>Harap mempunyai akun Google Gmail terlebih dahulu</p>
                        <a href="{{ route('google.redirect') }}" class="google-login">
                            <img src="http://www.androidpolice.com/wp-content/themes/ap2/ap_resize/ap_resize.php?src=http%3A%2F%2Fwww.androidpolice.
                            com%2Fwp-content%2Fuploads%2F2015%2F10%2Fnexus2cee_Search-Thumb-150x150.png&w=150&h=150&zc=3" alt="Google">
                            <span>Masuk dengan Google</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/login.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
