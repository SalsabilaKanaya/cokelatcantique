<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Karakter Cokelat Cantique</title>
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

    <link rel="stylesheet" href="pilih_karakter.css">
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

    <!-- MAIN -->
    <section class="main-content">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <a href="javascript:history.back()" class="btn button-back"><i class="fa-solid fa-chevron-left"></i></i> Kembali</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 header">
                    <h2>Pilih Karakter</h2>
                    <p>Pilihlah Character sesuai dengan packages yang dipilih</p>
                </div>
            </div>
            <div class="row mt-3 d-flex">
                @php
                   $kategoriLabels = [
                        'kategori1' => 'Huruf',
                        'kategori2' => 'Kartun',
                        'kategori3' => 'Makanan',
                        'kategori4' => 'Hari Raya',
                        'kategori5' => 'Orang',
                    ];

                    // Mendapatkan kategori yang dipilih dari request
                    $selectedKategori = request('kategori');

                    // Mendapatkan label kategori yang dipilih, jika ada
                    $selectedLabel = $selectedKategori ? $kategoriLabels[$selectedKategori] ?? 'All' : 'All';
                @endphp
                <div class="col-md-8">
                    <div class="produk-filter">
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $selectedLabel }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('pilih_karakter') }}">All</a></li>
                                @foreach($kategoriLabels as $key => $label)
                                    <li><a class="dropdown-item" href="{{ route('pilih_karakter', ['kategori' => $key]) }}">{{ $label }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-3 produk d-flex justify-content-between">
                        @foreach ($karakterCokelat as $cokelat)
                        <div class="col-md-3 produk-card">
                            <div class="card">
                                <img src="{{ asset($cokelat->foto)}}" class="card-img-top" alt="{{ $cokelat->nama }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $cokelat->nama }}</h5>
                                    @php
                                        $kategoriLabels = [
                                            'kategori1' => 'Huruf',
                                            'kategori2' => 'Kartun',
                                            'kategori3' => 'Makanan',
                                            'kategori4' => 'Hari Raya',
                                            'kategori5' => 'Orang',
                                        ];
                                        $namaKategori = $kategoriLabels[$cokelat->kategori] ?? 'Kategori Tidak Dikenal';
                                    @endphp
                                    <p class="card-text">{{ $namaKategori }}</p>
                                    <a class="btn button-detail" href="#" role="button">Pilih Karakter</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rekap-pilihan">
                        <h5>Pilihan Anda</h5>
                        <div class="jenis-pilihan">
                            <p class="text">Cokelat Box (28 sekat)</p>
                            <p class="harga">Rp 168.000</p>
                        </div>
                        <div class="karakter-pilihan">
                            <div class="text-jumlah">
                                <p class="text">Robocar Poly</p>
                                <p class="jumlah">11</p>
                            </div>
                            <p class="catatan">-</p>
                        </div>
                        <div class="karakter-pilihan">
                            <div class="text-jumlah">
                                <p class="text">Tulisan</p>
                                <p class="jumlah">17</p>
                            </div>
                            <p class="catatan">Happy Birthday Roni, warnanya kalau bisa dibuat dominan warna untuk cowok ya tapi jangan satu warna aja</p>
                        </div>
                        <div class="total-harga">
                            <p>Total</p>
                            <p class="harga">Rp 168.000</p>
                        </div>
                        <div class="button d-flex justify-content-between">
                            <a class="btn button-keranjang" href="#" role="button">Keranjang</a>
                            <a class="btn button-pesan" href="#" role="button">Pesan</a>
                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>