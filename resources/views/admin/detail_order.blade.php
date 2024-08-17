<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Cokelat Cantique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--BoxIcons CDN Link-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"/>

    <link rel="stylesheet" href="{{ asset('css/admin/detail_order.css') }}">
</head>
<body>
    <section class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">Cokelat Cantique </span>
        </div>
        <ul class="nav-link">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jenis_cokelat') }}">
                    <i class='bx bx-leaf'></i>
                    <span class="link_name">Jenis Cokelat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.karakter_cokelat') }}">
                    <i class='bx bx-cookie'></i>
                    <span class="link_name">Karakter Cokelat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.order_list') }}">
                    <i class='bx bx-list-ul'></i>
                    <span class="link_name">Order List</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kontak') }}">
                    <i class='bx bx-chat'></i>
                    <span class="link_name">Pesan</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out'></i>
                    <span class="link_name">Log out</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </section>

    <!--Main Content-->
    <section class="home-section">
        <nav>
            <div class="sidebar-button sidebarBtn">
                <i class='bx bx-menu'></i>
                <span class="dashboard">Dashboard</span>
            </div>
        </nav>

        <div class="content">
            <div class="box">
                <a href="{{ route('admin.order_list')}}" class="btn btn-text"><i class='bx bx-arrow-back'></i><span class="text">Kembali</span></a>
                <h1>Detail Orderan</h1>
                <div class="content-active">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="order-info">
                                <div class="order-row">
                                    <p class="order-detail"><strong>ID Order:</strong> {{ $order->id }}</p>
                                    <p class="order-detail"><strong>Nama:</strong> {{ $order->user->name }}</p>
                                    <p class="order-detail"><strong>Email:</strong> {{ $order->user->email }}</p>
                                </div>
                                <div class="order-row">
                                    <p class="order-detail"><strong>No Hp:</strong> {{ $order->user->phone }}</p>
                                    <p class="order-detail"><strong>Tanggal Pemesanan:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                                    <p class="order-detail"><strong>Tanggal Pengiriman:</strong> {{ $order->delivery_date->format('d/m/Y') }}</p>
                                </div>
                                <div class="order-row">
                                    <p class="order-detail"><strong>Kurir:</strong> {{ $order->courier }}</p>
                                    <p class="order-detail"><strong>Jenis Pengiriman:</strong> {{ $order->delivery_package }}</p>
                                    <p class="order-detail"><strong>Alamat:</strong> {{ $order->userAddress->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 header">
                            <h2>Rincian Item</h2>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="produk-list">
                                @foreach ($order->items as $item)
                                    <div class="produk-item d-flex">
                                        <img src="{{ asset($item->jenisCokelat->foto) }}" alt="{{ $item->jenisCokelat->nama }}" class="produk-img">
                                        <div class="produk-info">
                                            <h5>{{ $item->jenisCokelat->nama }}</h5>
                                            <p class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                            @foreach ($item->karakterItems as $karakterItem)
                                                <div class="produk-item-karakter d-flex">
                                                    <img src="{{ asset($karakterItem->karakterCokelat->foto) }}" alt="{{ $karakterItem->karakterCokelat->nama }}" class="karakter-img">
                                                    <div class="produk-info-karakter">
                                                        <h5>{{ $karakterItem->karakterCokelat->nama }}</h5>
                                                        <p>Quantity: {{ $karakterItem->quantity }}</p>
                                                        <p class="catatan">{{ $karakterItem->notes }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <div class="harga-ongkos mt-3">
                                    <p class="text">Subtotal</p>
                                    <p class="price">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                </div>
                                <div class="harga-ongkos mt-3">
                                    <p class="text">Biaya Pengiriman</p>
                                    <p class="price">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                                </div>
                                <div class="total-harga mt-3">
                                    <p class="text">Total</p>
                                    <p class="total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="form-group mt-3 catatan">
                                <h5>Catatan Lainnya</h5>
                                <p>{{ $order->notes ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>