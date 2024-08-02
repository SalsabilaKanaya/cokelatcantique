<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Cokelat Cantique</title>
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

    <link rel="stylesheet" href="{{ asset('css/faq.css')}}">
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
                            <a class="nav-link" href="{{ route('tentang')}}">Tentang Kami</a>
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

    <!--Main-->
    <section class="main-content">
        <h1>Frequently Asked Questions (FAQ)</h1>
        <div class="container">
            <div class="content">
                <div class="header">
                    Apa itu Cokelat Cantique?
                </div>
                <div class="body">
                    <div class="body-content">
                        Cokelat Cantique adalah usaha yang menyediakan cokelat karakter yang dapat 
                        disesuaikan untuk berbagai acara seperti ulang tahun, pernikahan, hari raya, 
                        dan lainnya. Pembeli bisa memilih karakter dan desain sesuai keinginan.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Bagaimana cara memesan cokelat di Cokelat Cantique?
                </div>
                <div class="body">
                    <div class="body-content">
                        Anda dapat memesan cokelat melalui website kami. Penjelasana mengenai cara memesan 
                        cokelat di Cokelat Cantique terdapat pada halaman "Cara Pemesanan".
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Apakah saya bisa memesan desain khusus?
                </div>
                <div class="body">
                    <div class="body-content">
                        Ya, kami menyediakan opsi untuk desain khusus. Anda bisa menghubungi kami melalui fitur kontak di website atau melalui media sosial untuk mendiskusikan desain yang diinginkan.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Berapa lama waktu yang dibutuhkan untuk memproses pesanan?
                </div>
                <div class="body">
                    <div class="body-content">
                        Waktu pemrosesan pesanan biasanya memakan waktu 3-5 hari kerja, tergantung pada jumlah dan kompleksitas pesanan. Pengiriman akan dilakukan segera setelah pesanan selesai diproses.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Apakah Cokelat Cantique melayani pengiriman ke luar kota?
                </div>
                <div class="body">
                    <div class="body-content">
                        Ya, kami melayani pengiriman ke seluruh wilayah Indonesia. Biaya pengiriman akan dihitung berdasarkan lokasi pengiriman dan berat paket.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Bagaimana cara membayar pesanan?
                </div>
                <div class="body">
                    <div class="body-content">
                        Kami menerima pembayaran melalui transfer bank, e-wallet, dan kartu kredit. Informasi lebih lanjut tentang metode pembayaran tersedia di halaman pembayaran saat checkout.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Apakah ada minimal jumlah pesanan?
                </div>
                <div class="body">
                    <div class="body-content">
                        Minimal jumlah order cokelat hanya untuk jenis cokelat loli dan cokelat tenteng dengan minimal order 20pcs.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Bagaimana jika saya menerima produk yang rusak atau tidak sesuai?
                </div>
                <div class="body">
                    <div class="body-content">
                        Jika Anda menerima produk yang rusak atau tidak sesuai dengan pesanan, silakan hubungi layanan pelanggan kami dalam waktu 24 jam setelah menerima paket. Kami akan membantu Anda untuk menukar atau mengembalikan produk tersebut.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Apakah cokelat yang digunakan halal?
                </div>
                <div class="body">
                    <div class="body-content">
                        Ya, semua cokelat yang digunakan di Cokelat Cantique adalah halal dan telah memenuhi standar kualitas yang tinggi.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Bagaimana cara menghubungi layanan pelanggan?
                </div>
                <div class="body">
                    <div class="body-content">
                        Anda dapat menghubungi layanan pelanggan kami melalui email, nomor telepon, atau media sosial. Informasi kontak lengkap tersedia di halaman kontak di website kami.
                    </div>
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

    <script src="{{ asset('js/faq.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>