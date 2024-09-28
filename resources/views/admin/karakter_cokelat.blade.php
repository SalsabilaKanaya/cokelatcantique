<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Karakter Cokelat - Cokelat Cantique</title>
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

    <link rel="stylesheet" href="{{ asset('css/admin/karakter_cokelat.css') }}">
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
                <h1>Karakter Cokelat</h1>
                <a href="{{ route('admin.create_karakter') }}">
                    <button class="btn btn-tambah">Tambah Karakter Cokelat</button>
                </a>
            </div>
            <div class="box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karakterCokelat as $cokelat)
                        <tr>
                            <td>
                                <img src="{{ asset($cokelat->foto) }}" alt="{{ $cokelat->nama }}" width="50">
                            </td>
                            <td>{{ $cokelat->nama }}</td>
                            <td>
                                @php
                                    $kategoriLabels = [
                                        'huruf' => 'Karakter Huruf',
                                        'kartun' => 'Karakter Kartun',
                                        'makanan' => 'Karakter Makanan',
                                        'hari raya' => 'Karakter Hari Raya',
                                        'orang' => 'Karakter Orang',
                                    ];
                                @endphp
                                {{ $kategoriLabels[$cokelat->kategori] ?? 'Unknown' }}
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($cokelat->deskripsi, 50, '...') }}</td>
                            <td>
                                <a href="{{ route('admin.edit_karakter', ['id' => $cokelat->id]) }}" class="btn btn-warning">Edit</a>
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $cokelat->id }}">Hapus</button>
                                <form id="delete-form-{{ $cokelat->id }}" action="{{ route('admin.delete_karakter', ['id' => $cokelat->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $karakterCokelat->links('vendor.pagination.default') }}
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/admin/karakter_cokelat.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>