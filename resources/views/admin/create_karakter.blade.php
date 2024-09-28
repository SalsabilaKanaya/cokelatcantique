<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karakter Cokelat - Cokelat Cantique</title>
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

    <link rel="stylesheet" href="{{ asset('css/admin/create_karakter.css') }}">
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
        <nav>
            <div class="sidebar-button sidebarBtn">
                <i class='bx bx-menu'></i>
                <span class="dashboard">Dashboard</span>
            </div>
        </nav>

        <div class="content">
            <div class="box">
                <h1>Tambah Karakter Cokelat</h1>
                <form id="create-karakter-form" action="{{ route('admin.create_karakter.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="col">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Karakter</label>
                        <select class="form-control" name="kategori" id="kategori" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="huruf">Karakter Huruf</option>
                            <option value="kartun">Karakter Kartun</option>
                            <option value="makanan">Karakter Makanan</option>
                            <option value="hari raya">Karakter Hari Raya</option>
                            <option value="orang">Karakter Orang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Masukkan Deskripsi" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger" id="cancelButton">Cancel</button>
                        <button type="submit" class="btn btn-submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/admin/create_karakter.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>