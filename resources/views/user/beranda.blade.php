<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Cokelat Cantique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css"/>

    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"/>

    <link rel="stylesheet" href="{{ asset('css/user/beranda.css')}}">
</head>
<body>

    <!--Header-->
    <section class="header">
        <!--Navbar-->
        <nav class="navbar navbar-expand-md navbar-bg">
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
                            <a href="{{ route('user.showCart')}}" class="nav-link"><i class="fa-solid fa-cart-shopping"></i></a>
                            <a href="{{ route('user.histori')}}" class="nav-link"><i class="fa-solid fa-clock-rotate-left"></i></a>
                            @if(Auth::check())
                                <div class="dropdown">
                                    <a class="nav-link dropdown" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                            @else
                                <a href="{{ route('user.login') }}" class="nav-link login-link d-flex align-items-center">Login</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="navbar-nav justify-content-center">
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('user.beranda')}}">Beranda</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.tentang')}}">Tentang Kami</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Produk Kami
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('user.gift_idea')}}">Gift Idea</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.jenis_cokelat')}}">Jenis Cokelat</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.karakter_cokelat')}}">Karakter Cokelat</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.kustomisasi_cokelat')}}">Kustomisasi Cokelat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.kontak')}}">Kontak Kami</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!--Header-->
        <div class="header-content">
            <div class="container justify-content-between">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4">
                        <div class="slogan">
                            <h1>Sweet Moments, Crafted with Love</h1>
                            <p>Di sini, kamu bisa menemukan cokelat karakter yang spesial untuk setiap momen berharga kamu. Dengan desain unik dan 
                                kualitas terbaik, kami hadirkan cokelat yang tidak hanya lezat, tetapi juga penuh dengan cinta dan kebahagiaan.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="header-image">
                            <img src="{{ asset('img/banner.png')}}" alt="Cokelat">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#D2B48C" fill-opacity="1" d="M0,224L40,197.3C80,171,160,117,240,112C320,107,400,149,480,144C560,139,640,85,720,64C800,43,880,53,960,96C1040,139,1120,213,1200,224C1280,235,1360,181,1400,154.7L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg>
    </section>

    <!--Content-->
    <section class="content-1">
        <div class="container">
            @if (session('session_expired'))
                <div class="alert alert-warning">
                    {{ session('session_expired') }}
                </div>
                <script>
                    console.log('Session expired message detected.');
                </script>
            @endif
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="imageabout">
                        <img src="{{ asset('img/home_tentang.PNG')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="teks">
                        <h1>Apa itu Cokelat Cantique?</h1>
                        <p>Cokelat Cantique adalah bisnis cokelat karakter yang telah beroperasi sejak tahun 2016. Berawal dari hobi dan 
                        inspirasi dari media sosial, kami terinspirasi oleh kreasi di media sosial
                        untuk menciptakan cokelat karakter yang penuh makna. Setiap cokelat dari Cokelat Cantique dibuat dengan cinta dan perhatian, 
                        membawa kehangatan dan kebahagiaan ke setiap momen spesial Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-2">
        <div class="container">
            <h1>Produk Kami</h1>
            <div class="row justify-content-between align-items-center">
                <div class="col-md-3">
                    <div class="produk">
                        <img src="{{ asset('img/cokelatkiloan.JPG') }}" alt="" class="produk-img">
                        <p class="text-center">Cokelat Kiloan</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="produk">
                        <img src="{{ asset('img/cokelatloli.JPG') }}" alt="" class="produk-img">
                        <p class="text-center">Cokelat Loli</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="produk">
                        <img src="{{ asset('img/cokelatbox.PNG') }}" alt="" class="produk-img">
                        <p class="text-center">Cokelat Box</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="produk">
                        <img src="{{ asset('img/cokelattenteng.JPG') }}" alt="" class="produk-img">
                        <p class="text-center">Cokelat Tenteng</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial-area">
        <div class="container">
            <div class="sec-title">
                <h1>Testimoni</h1>
            </div>
            <div class="testimonial-content owl-carousel owl-theme">
                @foreach($testimoniss as $testimoni)
                <div class="single-testimonial">
                    <p>{{ $testimoni->isi_testimoni }}</p>
                    <div class="user-info">
                        <div class="user-image">
                            <img src="{{ asset($testimoni->foto) }}" alt="Avatar">
                        </div>
                        <div class="user-detail">
                            <h6>{{ $testimoni->nama }}</h6>
                            <span>{{ $testimoni->produk }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!--Footer-->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#D2B48C" fill-opacity="1" d="M0,32L48,69.3C96,107,192,181,288,181.3C384,181,480,107,576,101.3C672,96,768,160,864,165.3C960,171,1056,117,1152,96C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    <section class="footer justify-content-between">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo-footer">
                        <a href="">
                            <img src="{{ asset('img/logo.png')}}" alt="" width="150px">
                        </a>
                    </div>
                </div>
                <div class="col-md-3 footer-content">
                    <h1>Customer Support</h1>
                    <a href="{{ route('user.faq')}}">FAQ</a>
                    <a href="{{ route('user.cara_pemesanan')}}">Cara Pemesanan</a>
                </div>
                <div class="col-md-4 footer-content">
                    <h1>Kontak Kami</h1>
                    <a href=""><i class="bi bi-geo-alt"></i> Perumnas Blok PG/8, Karawang Barat, Jawa Barat</a>
                    <a href=""><i class="bi bi-telephone"></i> 081399977070</a>
                    <a href=""><i class="bi bi-envelope"></i> cokelatcantique@gmail.com</a>
                </div>
                <div class="col-md-2 footer-content">
                    <h1>Media Social</h1>
                    <div class="sosial-media justify-content-between align-items-center">
                        <a href="https://www.instagram.com/cokelat_cantique/">
                            <img src="{{ asset('img/instagram.png')}}" alt="">
                        </a>
                        <a href="">
                            <img src="{{ asset('img/facebook.png')}}" alt="">
                        </a>
                        <a href="https://www.tiktok.com/@cokelat_cantique?_t=8neVX6XFl6v&_r=1">
                            <img src="{{ asset('img/tiktok.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.testimonial-content').owlCarousel({
                loop:true,
                nav:false,
                dots:true,
                margin:50,
                autoplay:true,
                autoplayTimeout:4000,
                smartSpeed:800,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:2
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('session_expired'))
                console.log('Session expired message detected in script.');
                alert('{{ session('session_expired') }}');
            @endif
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>