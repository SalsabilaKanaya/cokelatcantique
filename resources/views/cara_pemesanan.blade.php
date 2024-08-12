<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Pesan Cokelat Cantique</title>
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

    <link rel="stylesheet" href="{{ asset('css/cara_pemesanan.css')}}">
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
        <h1>Cara Pemesanan</h1>
        <div class="container">
            <div class="content">
                <div class="header">
                    Melalui Halaman Kustomisasi Cokelat
                </div>
                <div class="body">
                    <div class="body-content">
                        <ol>
                            <li>Buka halaman kustomisasi cokelat</li>
                            <li>Pilih jenis cokelat yang diinginkan (Cokelat box, loli, kiloan, atau tenteng)</li>
                            <li>Pilih beberapa karakter cokelat sesuai dengan keinginan</li>
                            <li>Masukkan jumlah karakter cokelat yang dipilih. Banyaknya karakter cokelat sesuai dengan jenis cokelat yang dipilih (bisa dilihat pada halaman jenis cokelat). </li>
                            <li>Masukkan catatan untuk karakter cokelat yang dipilih. Catatan bisa berupa warna dari karakter cokelat, tulisan, dan yang lainnya. </li>
                            <li>Jika sudah memilih semua karakter cokelat yang diinginkan sesuai, lihat pada bagian "Pilihan Anda" dan pastikan kembali bahwa pesanan anda sudah sesuai. </li>
                            <li>Klik tombol “Pesan” untuk melakukan proses pemesanan. Namun jika tidak ingin lakukan pemesanan pada saat itu, bisa klik tombol “Keranjang”. </li>
                            <li>Selanjutnya pada halaman pemesanan, masukkan data pribadi anda dengan benar, masukkan tanggal pengiriman dengan benar, lihat kembali rincian pesanan anda, pilih metode pembayaran, dan masukkan catatan lainnya (option).</li>
                            <li>Jika semua data sudah benar, klik tombol “Bayar”.</li>
                            <li>Lakukan pembayaran sesuai dengan metode pembayaran yang dipilih hingga berhasil</li>
                            <li>Proses pemesanan sudah selesai.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Melalui Halaman Jenis Cokelat
                </div>
                <div class="body">
                    <div class="body-content">
                        <ol>
                            <li>Buka halaman jenis cokelat</li>
                            <li>Pilih jenis cokelat yang diinginkan (Cokelat box, loli, kiloan, atau tenteng)</li>
                            <li>Lihat detail dan informasi mengenai jenis cokelat yang dipilih</li>
                            <li>Pilih beberapa karakter cokelat sesuai dengan keinginan</li>
                            <li>Masukkan jumlah karakter cokelat yang dipilih. Banyaknya karakter cokelat sesuai dengan jenis cokelat yang dipilih (bisa dilihat pada halaman jenis cokelat). </li>
                            <li>Masukkan catatan untuk karakter cokelat yang dipilih. Catatan bisa berupa warna dari karakter cokelat, tulisan, dan yang lainnya. </li>
                            <li>Jika sudah memilih semua karakter cokelat yang diinginkan sesuai, lihat pada bagian "Pilihan Anda" dan pastikan kembali bahwa pesanan anda sudah sesuai. </li>
                            <li>Klik tombol “Pesan” untuk melakukan proses pemesanan. Namun jika tidak ingin lakukan pemesanan pada saat itu, bisa klik tombol “Keranjang”. </li>
                            <li>Selanjutnya pada halaman pemesanan, masukkan data pribadi anda dengan benar, masukkan tanggal pengiriman dengan benar, lihat kembali rincian pesanan anda, pilih metode pembayaran, dan masukkan catatan lainnya (option).</li>                            <li>Jika semua data sudah benar, klik tombol “Bayar”.</li>
                            <li>Lakukan pembayaran sesuai dengan metode pembayaran yang dipilih hingga berhasil</li>
                            <li>Proses pemesanan sudah selesai.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Melalui halaman Karakter Cokelat
                </div>
                <div class="body">
                    <div class="body-content">
                        <ol>
                            <li>Buka halaman karakter cokelat</li>
                            <li>Klik tombol "Kustomisasi Cokelat"</li>
                            <li>Pilih jenis cokelat yang diinginkan (Cokelat box, loli, kiloan, atau tenteng)</li>
                            <li>Pilih beberapa karakter cokelat sesuai dengan keinginan</li>
                            <li>Masukkan jumlah karakter cokelat yang dipilih. Banyaknya karakter cokelat sesuai dengan jenis cokelat yang dipilih (bisa dilihat pada halaman jenis cokelat). </li>
                            <li>Masukkan catatan untuk karakter cokelat yang dipilih. Catatan bisa berupa warna dari karakter cokelat, tulisan, dan yang lainnya. </li>
                            <li>Jika sudah memilih semua karakter cokelat yang diinginkan sesuai, lihat pada bagian "Pilihan Anda" dan pastikan kembali bahwa pesanan anda sudah sesuai. </li>
                            <li>Klik tombol “Pesan” untuk melakukan proses pemesanan. Namun jika tidak ingin lakukan pemesanan pada saat itu, bisa klik tombol “Keranjang”. </li>
                            <li>Selanjutnya pada halaman pemesanan, masukkan data pribadi anda dengan benar, masukkan tanggal pengiriman dengan benar, lihat kembali rincian pesanan anda, pilih metode pembayaran, dan masukkan catatan lainnya (option).</li>                            <li>Jika semua data sudah benar, klik tombol “Bayar”.</li>
                            <li>Lakukan pembayaran sesuai dengan metode pembayaran yang dipilih hingga berhasil</li>
                            <li>Proses pemesanan sudah selesai.</li>
                        </ol>
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

    <script src="{{ asset('js/cara_pemesanan.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>