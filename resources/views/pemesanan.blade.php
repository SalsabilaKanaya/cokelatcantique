<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Cokelat Cantique</title>
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

    <link rel="stylesheet" href="{{ asset('css/pemesanan.css')}}">
</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-md navbar-bg fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="beranda.html">
                        <img src="img/logo.png" alt="logo" width="150px">
                    </a>
                    <div class="search-bar d-flex">
                        <input type="text" class="input-search flex-grow-1" placeholder="Search...">
                        <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                    <div class="navbar-icons d-flex justify-content-between">
                        <a href="keranjang.html" class="nav-link"><i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="histori.html" class="nav-link"><i class="fa-solid fa-clock-rotate-left"></i></a>
                        <a href="profil.html" class="nav-link"><i class="fa-solid fa-user"></i></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="navbar-nav justify-content-center">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="beranda.html">Beranda</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="tentang.html">Tentang Kami</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produk Kami
                                </a>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="gift_idea.html">Gift Idea</a></li>
                                <li><a class="dropdown-item" href="jenis_cokelat.html">Jenis Cokelat</a></li>
                                <li><a class="dropdown-item" href="karakter_cokelat.html">Karakter Cokelat</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="kustomisasi_cokelat.html">Kustomisasi Cokelat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="kontak.html">Kontak Kami</a>
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
                    <a href="{{ route('kustomisasi_cokelat') }}" class="btn button-back"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 header">
                    <h2>Produk</h2>
                </div>
            </div>
            <div class="row mt-3 d-flex">
                <div class="col-md-8">
                    @if($order)
                        <div class="produk-list">
                            @if($orderItems->isEmpty())
                                <p>Belum ada produk yang dipesan.</p>
                            @else
                                @foreach($orderItems as $orderItem)
                                    <div class="produk-item d-flex">
                                        <img src="{{ asset($orderItem->jenisCokelat->foto) }}" alt="{{ $orderItem->jenisCokelat->nama }}" class="produk-img">
                                        <div class="produk-info">
                                            <h5>{{ $orderItem->jenisCokelat->nama }}</h5>
                                            <p>Rp {{ number_format($orderItem->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    @foreach($orderItem->karakterItems as $karakterItem)
                                        <div class="produk-item d-flex ml-4">
                                            <img src="{{ asset($karakterItem->karakterCokelat->foto) }}" alt="{{ $karakterItem->karakterCokelat->nama }}" class="produk-img">
                                            <div class="produk-info">
                                                <h5>{{ $karakterItem->karakterCokelat->nama }}</h5>
                                                <p>{{ $karakterItem->quantity }}</p>
                                                <p class="catatan">{{ $karakterItem->notes }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                        <form action="{{ route('pemesanan.store') }}" method="POST">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="note">Catatan Lainnya</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <h2>Data Pribadi</h2>
                                <div class="input-data">
                                    <div class="row">
                                        <div class="col">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" required>
                                        </div>
                                        <div class="col">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="xxxxxx@gmail.com" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label for="phone_number" >No Hp</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="08xxxxxx" required>
                                        </div>
                                        <div class="col">
                                            <label for="delivery_date" >Tanggal Pengiriman</label>
                                            <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <h2>Pilih Metode Pembayaran</h2>
                                <div class="d-flex justify-content-start align-items-center mt-3">
                                    <button type="button" id="btn-transfer" class="btn btn-custom me-2 d-flex flex-column align-items-center">
                                        <i class="fa-solid fa-right-left"></i>
                                        <span class="btn-text">Transfer Bank</span>
                                    </button>
                                    <button type="button" id="btn-ewallet" class="btn btn-custom d-flex flex-column align-items-center">
                                        <i class="fa-solid fa-wallet"></i>
                                        <span class="btn-text">E-Wallet</span>
                                    </button>
                                </div>
                                <label for="pilihanBank" class="payment-group mt-2" id="labelBank" style="display: none;">Pilihan Bank</label>
                                <div class="position-relative" id="divBank" style="display: none;">
                                    <select class="form-control" id="pilihanBank" name="pilihanBank" onchange="toggleIcon('iconBank')">
                                        <option disabled selected>Pilih Bank</option>
                                        <option>Bank BCA</option>
                                        <option>Bank Mandiri</option>
                                        <option>Bank BNI</option>
                                    </select>
                                    <i id="iconBank" class="fa fa-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                                </div>
                                <label for="pilihanEwallet" class="payment-group mt-2" id="labelEwallet" style="display: none;">Pilihan E-Wallet</label>
                                <div class="position-relative" id="divEwallet" style="display: none;">
                                    <select class="form-control" id="pilihanEwallet" name="pilihanEwallet" onchange="toggleIcon('iconEwallet')">
                                        <option disabled selected>Pilih E-Wallet</option>
                                        <option>GoPay</option>
                                        <option>OVO</option>
                                        <option>DANA</option>
                                    </select>
                                    <i id="iconEwallet" class="fa fa-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="privacyPolicy" name="privacyPolicy">
                                    <label class="form-check-label privacy-text" for="privacyPolicy">
                                        Menyetujui Privacy Policy
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-pesan mt-3">Bayar</button>
                        </form>
                    @else
                        <p>Anda belum melakukan pemesanan.</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="pengiriman">
                        <form action="{{ route('pemesanan.store') }}" method="POST">
                            @csrf
                            <div class="alamat-pengiriman">
                                <h5>Alamat Pengiriman</h5>
                                <label for="province">Provinsi</label>
                                <select class="form-control" id="province" name="province" required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <label for="city" class="mt-2">Kota/Kabupaten</label>
                                <select class="form-control" id="city" name="city" required>
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                                <label for="postal_code" class="mt-2">Kode Pos</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Kode Pos" required>
                                <label for="address" class="mt-2">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Jl xxxx" required>
                            </div>
                            <div class="pilihan-kurir">
                                <h5>Pilih Kurir</h5>
                                <div id="courier-options">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kuriroption" id="jne" value="option1">
                                        <label class="form-check-label" for="jne">JNE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kuriroption" id="tiki" value="option2">
                                        <label class="form-check-label" for="tiki">Tiki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kuriroption" id="pos" value="option3">
                                        <label class="form-check-label" for="pos">POS</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Cek Ongkir</button>
                        </form>
                    </div>
                    <div class="rekap-pilihan">
                        <h5>Jumlah Pembayaran</h5>
                        <div class="jenis-pilihan">
                            <p class="text">-</p>
                            <p class="harga">-</p>
                        </div>
                        <hr>
                        <div class="total-harga">
                            <p class="text">Subtotal</p>
                            <p class="harga">000000</p>
                        </div>
                        <div class="total-harga">
                            <p class="text">Delivery</p>
                            <p class="harga" id="shipping-cost">
                                @if(isset($shippingCost))
                                    Rp {{ number_format($shippingCost, 2) }}
                                @else
                                    Rp 0
                                @endif
                            </p>
                        </div>
                        <hr>
                        <div class="jumlah-harga">
                            <p class="text">Total</p>
                            <p class="harga">000000</p>
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
                            <img src="img/logo.png" alt="" width="150px">
                        </a>
                    </div>
                </div>
                <div class="col-md-3 footer-content">
                    <h1>Customer Support</h1>
                    <a href="faq.html">FAQ</a>
                    <a href="cara_pemesanan.html">Cara Pemesanan</a>
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
                            <img src="img/instagram.png" alt="">
                        </a>
                        <a href="">
                            <img src="img/facebook.png" alt="">
                        </a>
                        <a href="https://www.tiktok.com/@cokelat_cantique?_t=8neVX6XFl6v&_r=1">
                            <img src="img/tiktok.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('button[type="submit"]').addEventListener('click', function(event) {
                event.preventDefault();
                
                // Mengambil data dari form
                const province = document.getElementById('province').value;
                const city = document.getElementById('city').value;
                const courier = document.querySelector('input[name="kuriroption"]:checked')?.id;
                
                if (!province || !city || !courier) {
                    alert('Harap lengkapi semua informasi sebelum mengecek ongkir.');
                    return;
                }
    
                fetch('{{ route('pemesanan.calculateShippingCost') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        province: province,
                        city: city,
                        courier: courier
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Menampilkan hasil ongkir
                        const courierOptions = document.getElementById('courier-options');
                        courierOptions.innerHTML = '';
    
                        data.forEach(service => {
                            service.costs.forEach(cost => {
                                const option = document.createElement('div');
                                option.innerHTML = `
                                    <h6>${service.service}</h6>
                                    <p>${cost.description}</p>
                                    <p>Rp ${cost.cost[0].value} (${cost.cost[0].etd} hari)</p>
                                `;
                                courierOptions.appendChild(option);
                            });
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>    
    <script src="{{ asset('js/pemesanan.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>