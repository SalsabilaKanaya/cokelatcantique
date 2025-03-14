<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Orderan - Cokelat Cantique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"/>
    <link rel="stylesheet" href="{{ asset('css/admin/order_list.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <section class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">Cokelat Cantique </span>
        </div>
        <ul class="nav-link">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.jenis_cokelat') ? 'active' : '' }}">
                <a href="{{ route('admin.jenis_cokelat') }}">
                    <i class='bx bx-leaf'></i>
                    <span class="link_name">Jenis Cokelat</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.karakter_cokelat') ? 'active' : '' }}">
                <a href="{{ route('admin.karakter_cokelat') }}">
                    <i class='bx bx-cookie'></i>
                    <span class="link_name">Karakter Cokelat</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.order_list') ? 'active' : '' }}">
                <a href="{{ route('admin.order_list') }}">
                    <i class='bx bx-list-ul'></i>
                    <span class="link_name">Order List</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.kontak') ? 'active' : '' }}">
                <a href="{{ route('admin.kontak') }}">
                    <i class='bx bx-chat'></i>
                    <span class="link_name">Pesan</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.testimoni') ? 'active' : '' }}">
                <a href="{{ route('admin.testimoni') }}">
                    <i class='bx bx-star'></i>
                    <span class="link_name">Testimoni</span>
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
            <div class="content-title mb-3 mt-3 d-flex justify-content-between align-items-center">
                <h1 class="m-0">Order List</h1>
                <form action="{{ route('admin.order_list') }}" method="GET">
                    <input type="hidden" name="active_tab" id="active_tab" value="{{ $activeTab }}">
                    <select name="sort_order" class="form-select" style="width: auto;" onchange="this.form.submit()">
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </form>
            </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-underline" id="orderTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'proses' ? 'active' : '' }}" id="proses-tab" data-bs-toggle="tab" data-bs-target="#proses" type="button" role="tab" aria-controls="proses" aria-selected="{{ $activeTab == 'proses' ? 'true' : 'false' }}">Proses</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'selesai' ? 'active' : '' }}" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai" type="button" role="tab" aria-controls="selesai" aria-selected="{{ $activeTab == 'selesai' ? 'true' : 'false' }}">Selesai</button>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="orderTabContent">
                <!-- Tab Proses -->
                <div class="tab-pane fade {{ $activeTab == 'proses' ? 'show active' : '' }}" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                    <div class="box mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Pemesanan</th>
                                    <th>Nama</th>
                                    <th>Pesanan</th>
                                    <th>Total</th>
                                    <th>Lihat Detail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordersAccepted as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            @php
                                                $jenisCokelatNames = $order->items->pluck('jenisCokelat.nama')->toArray();
                                            @endphp
                                            {!! nl2br(e(implode("\n", $jenisCokelatNames))) !!}
                                        </td>
                                        <td>Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.detail_order', $order->id) }}" class="btn btn-text">Lihat Detail</a>
                                        </td>
                                        <td>
                                            @if ($order->status === 'accepted')
                                                <button id="btn-selesai-{{ $order->id }}" class="btn btn-success" onclick="markAsDone('{{ $order->id }}')">Selesai</button>
                                                <span id="status-text-{{ $order->id }}" class="badge bg-success" style="display: none;">Selesai</span>
                                            @elseif ($order->status === 'completed')
                                                <span id="status-text-{{ $order->id }}" class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $ordersAccepted->appends(['active_tab' => 'proses', 'sort_order' => request('sort_order')])->links('vendor.pagination.default') }}
                    </div>
                </div>

                <!-- Tab Selesai -->
                <div class="tab-pane fade {{ $activeTab == 'selesai' ? 'show active' : '' }}" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                    <div class="box mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Pemesanan</th>
                                    <th>Nama</th>
                                    <th>Pesanan</th>
                                    <th>Total</th>
                                    <th>Lihat Detail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordersCompleted as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            @php
                                                $jenisCokelatNames = $order->items->pluck('jenisCokelat.nama')->toArray();
                                            @endphp
                                            {!! nl2br(e(implode("\n", $jenisCokelatNames))) !!}
                                        </td>
                                        <td>Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.detail_order', $order->id) }}" class="btn btn-text">Lihat Detail</a>
                                        </td>
                                        <td>
                                            <span id="status-text-{{ $order->id }}" class="badge bg-success">Selesai</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $ordersCompleted->appends(['active_tab' => 'selesai', 'sort_order' => request('sort_order')])->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function markAsDone(orderId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Orderan ini akan ditandai sebagai selesai!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tandai selesai!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/order/${orderId}/mark-as-done`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            var btn = document.getElementById('btn-selesai-' + orderId);
                            var statusText = document.getElementById('status-text-' + orderId);
                            
                            btn.style.display = 'none';
                            statusText.style.display = 'inline';
                            Swal.fire(
                                'Selesai!',
                                'Orderan telah ditandai sebagai selesai.',
                                'success'
                            );
                        }
                    });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Set the active tab based on the active_tab input value
            var activeTab = document.getElementById('active_tab').value;
            console.log('Active Tab:', activeTab); // Log the active tab value
            if (activeTab === 'selesai') {
                var selesaiTab = new bootstrap.Tab(document.querySelector('#selesai-tab'));
                selesaiTab.show();
            } else {
                var prosesTab = new bootstrap.Tab(document.querySelector('#proses-tab'));
                prosesTab.show();
            }
        });
    </script>
</body>
</html>