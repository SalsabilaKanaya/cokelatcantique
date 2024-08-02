<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Cokelat Cantique</title>
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

    <link rel="stylesheet" href="{{ asset('css/tentang.css')}}">
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
                        <a href="{{ route('profil')}}" class="nav-link"><i class="fa-solid fa-user"></i></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="navbar-nav justify-content-center">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('beranda')}}">Beranda</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" href="{{ route('tentang')}}">Tentang Kami</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <img src="{{ asset('img/tentangbanner.JPG')}}" alt="Banner" class="img-fluid">
                    <div class="overlay"></div>
                    <h1 class="main-title">Hadirkan senyum di wajah orang tersayang dengan cokelat karakter dari Cokelat Cantique yang penuh cinta.</h1>
                </div>
            </div>
            <div class="row content align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('img/logo.png')}}" alt="Cokelat Cantique" class="img-fluid logo">
                </div>
                <div class="col-md-6">
                    <h1>Cokelat Cantique</h1>
                    <p>Cokelat Cantique adalah bisnis cokelat karakter yang telah beroperasi sejak tahun 2016. Berawal dari hobi dan inspirasi dari media sosial, Berawal dari hobi dan kecintaan pada cokelat, kami terinspirasi oleh kreasi di media sosial untuk menciptakan cokelat karakter yang penuh makna. Setiap cokelat dari Cokelat Cantique dibuat dengan cinta dan perhatian, membawa kehangatan dan kebahagiaan ke setiap momen spesial Anda.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Bahan yang Digunakan</h1>
                    <p>Cokelat Cantique menggunakan 100% cokelat compound berkualitas tinggi tanpa campuran bahan lainnya untuk menghasilkan rasa yang lezat dan tekstur yang sempurna. Cokelat compound dipilih dengan cermat untuk memastikan setiap produk kami memiliki cita rasa yang konsisten dan memuaskan. Bahan pilihan ini membuat cokelat kami tidak hanya nikmat disantap tetapi juga aman dikonsumsi oleh berbagai kalangan.</p>
                </div>
                <div class="col-md-6 content-image d-flex justify-content-end">
                    <img src="{{ asset('img/bahan.jpeg')}}" alt="Bahan yang Digunakan" class="img-fluid">
                </div>
            </div>
            <div class="row content justify-content-between">
                <div class="col-md-6 content-image">
                    <img src="{{ asset('img/cetakan.jpeg')}}" alt="Cara Pembuatannya" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>Cara Pembuatannya</h1>
                    <p>Setiap cokelat di Cokelat Cantique dibuat dengan penuh ketelitian dan cinta. Proses pembuatan kami dimulai dengan mencairkan cokelat compound hingga mencapai konsistensi yang tepat. Setelah itu, cokelat dituang ke dalam cetakan silikon dengan desain khusus, yang kemudian didinginkan hingga mengeras. Teknik ini memastikan setiap cokelat memiliki bentuk yang sempurna dan detail yang menawan, siap untuk mempermanis momen-momen spesial Anda.</p>
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