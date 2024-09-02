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

    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
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
                    <i class='bx bx-log-out' style="color: #dc3545; font-weight: 500;"></i>
                    <span class="link_name" style="color: #dc3545; font-weight: 500;">Log out</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </section>

    <!--Main Content-->
    <section class="home-section">
        <div class="header-home">
            <div class="sidebar-button sidebarBtn">
                <i class='bx bx-menu'></i>
                <span class="dashboard">Dashboard</span>
            </div>
        </div>

        <div class="content">
            <!-- Kotak Informasi -->
            <div class="info-order row mb-2">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="title">
                                <h5>Sales</h5>
                                <p>This Month</p>
                            </div>
                            <div class="total-sales">
                                <div class="icon">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div>
                                    <p class="card-text">{{ $totalSales }}</p>
                                    <p class="increase">
                                        <span class="percentage">{{ number_format($increasePercentage, 2) }}%</span> increase
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="title">
                                <h5>Revenue</h5>
                                <p>This Month</p>
                            </div>
                            <div class="total-revenue">
                                <div class="icon">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div>
                                    <p class="card-text">Rp {{ number_format($totalRevenue, 2, ',', '.') }}</p>
                                    <p class="increase">
                                        <span class="percentage">{{ number_format($revenueIncreasePercentage, 2) }}%</span> increase
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <h1>Orderan Masuk</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Nama</th>
                            <th>Pesanan</th>
                            <th>Tgl Pengiriman</th>
                            <th>Total</th>
                            <th>Terima/Tolak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ \Illuminate\Support\Str::limit($order->id, 10, '...') }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>
                                    @php
                                        $jenisCokelatNames = $order->items->pluck('jenisCokelat.nama')->toArray();
                                    @endphp
                                    {!! nl2br(e(implode("\n", $jenisCokelatNames))) !!}
                                </td>
                                <td>{{ $order->delivery_date->format('d/m/Y') }}</td>
                                <td>Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-accept" data-id="{{ $order->id }}">Terima</button>
                                    <button type="button" class="btn btn-outline-danger btn-reject" data-id="{{ $order->id }}">Tolak</button>
                                    <form id="accept-form-{{ $order->id }}" action="{{ route('admin.order.accept', $order->id) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="reject-form-{{ $order->id }}" action="{{ route('admin.order.reject', $order->id) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links('vendor.pagination.default') }}
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const acceptButtons = document.querySelectorAll('.btn-accept');
            const rejectButtons = document.querySelectorAll('.btn-reject');

            acceptButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah kamu yakin ingin menerima orderan ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, terima!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`accept-form-${orderId}`).submit();
                        }
                    });
                });
            });

            rejectButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah kamu yakin ingin menolak orderan ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`reject-form-${orderId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>