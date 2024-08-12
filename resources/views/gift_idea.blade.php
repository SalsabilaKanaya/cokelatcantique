<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Idea Cokelat Cantique</title>
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

    <link rel="stylesheet" href="{{ asset('css/gift_idea.css')}}">
</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-md navbar-bg fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="{{ route('beranda')}}">
                        <img src="{{ asset('img/logo.png')}}" alt="logo" width="150px">
                    </a>
                    <div class="search-bar d-flex">
                        <input type="text" class="input-search flex-grow-1" placeholder="Search...">
                        <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                    <div class="navbar-icons d-flex justify-content-between">
                        <a href="{{ route('keranjang')}}" class="nav-link"><i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="{{ route('histori')}}" class="nav-link"><i class="fa-solid fa-clock-rotate-left"></i></a>
                        <div class="dropdown">
                            <a class="nav-link dropdown" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profil')}}">Profile</a></li>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form">
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
                            <a class="nav-link" aria-current="page" href="{{ route('beranda')}}">Beranda</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('tentang')}}">Tentang Kami</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produk Kami
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('gift_idea')}}">Gift Idea</a></li>
                                    <li><a class="dropdown-item" href="{{ route('jenis_cokelat')}}">Jenis Cokelat</a></li>
                                    <li><a class="dropdown-item" href="{{ route('karakter_cokelat')}}">Karakter Cokelat</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kustomisasi_cokelat')}}">Kustomisasi Cokelat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kontak')}}">Kontak Kami</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!--Main Content-->
    <section class="main-content">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 banner">
                    <img src="{{ asset('img/giftbanner.JPG')}}" alt="Banner" class="img-fluid">
                    <div class="overlay"></div>
                    <h1 class="main-title">Ceriakan harimu dengan cokelat karakter dari Cokelat Cantique, yang dirancang untuk menghadirkan kebahagiaan dan kehangatan pada setiap momen spesial.</h1>
                </div>
            </div>
            <div class="row content justify-content-between">
                <div class="col-md-6 content-image">
                    <img src="{{ asset('img/harispesial.JPG')}}" alt="Hari Spesial" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>Gift Idea untuk Hari Spesial</h1>
                    <p>Rayakan momen istimewa seperti hari guru, anniversary, ulang tahun, dan lainnya dengan kelezatan yang memikat dari Cokelat Cantique. Setiap cokelat dirancang dengan penuh keahlian untuk menyempurnakan perayaanmu. Nikmati kebahagiaan dalam setiap detik hari spesialmu dengan hadiah yang manis dan istimewa ini, membawa senyum dan kenangan indah.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Gift Idea untuk Orang Tersayang</h1>
                    <p>Tunjukkan cinta dan perhatianmu dengan hadiah yang manis dan penuh arti. Cokelat Cantique menciptakan momen tak terlupakan untuk orang-orang yang paling berarti dalam hidupmu. Setiap gigitan membawa kehangatan dan kasih sayang yang mendalam, mengungkapkan rasa cinta yang tak terucap dalam kata-kata.</p>
                </div>
                <div class="col-md-6 content-image d-flex justify-content-end">
                    <img src="{{ asset('img/orangsayang.JPG')}}" alt="Orang Tersayang" class="img-fluid">
                </div>
            </div>
            <div class="row content justify-content-between">
                <div class="col-md-6 content-image">
                    <img src="{{ asset('img/hariraya.JPG')}}" alt="Hari Raya" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>Gift Idea untuk Hari Raya</h1>
                    <p>Berbagi kebahagiaan dan kehangatan Hari Raya seperti Idul Fitri, Natal, Imlek, dan lainnya dengan cokelat yang penuh cinta dari Cokelat Cantique. Hadiahkan kebersamaan dan sukacita dalam setiap gigitan manis ini, menciptakan momen berharga yang dirayakan bersama orang-orang terkasih. Sempurnakan perayaan Hari Raya dengan sentuhan manis yang mempersatukan hati.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Gift Idea untuk Konsumsi Pribadi</h1>
                    <p>Manjakan diri sendiri dengan kelezatan yang sempurna dari Cokelat Cantique. Setiap gigitan memberikan rasa kenikmatan dan relaksasi yang tak tertandingi, menghadirkan momen kebahagiaan dalam keseharianmu. Jadikan setiap hari istimewa dengan cokelat yang diciptakan khusus untuk dinikmati sendiri, sebagai bentuk cinta dan penghargaan untuk dirimu sendiri</p>
                </div>
                <div class="col-md-6 content-image d-flex justify-content-end">
                    <img src="{{ asset('img/pribadi.PNG')}}" alt="Konsumsi Pribadi" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!--Footer-->
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
                    <a href="{{ route('faq')}}">FAQ</a>
                    <a href="{{ route('cara_pemesanan')}}">Cara Pemesanan</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>