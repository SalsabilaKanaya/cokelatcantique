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
    <link rel="stylesheet" href="{{ asset('css/admin/testimoni.css') }}">
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
            <div class="box">
                <h1 class="m-0">Daftar Testimoni</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Testimoni</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimoni as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->isi_testimoni }}</td>
                                <td>
                                    @if ($item->status === 'publish')
                                        <span class="badge bg-success">Sudah Dibaca</span> 
                                    @elseif ($item->status === 'tolak')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <button class="btn btn-success" onclick="confirmPublishTestimoni({{ $item->id }})">Publish</button>
                                        <button class="btn btn-outline-danger" onclick="confirmRejectTestimoni({{ $item->id }})">Tolak</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Tambahkan link pagination -->
                <div class="pagination-section">
                    {{ $testimoni->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmPublishTestimoni(id) {
            Swal.fire({
                title: 'Konfirmasi Publish Testimoni',
                text: "Apakah Anda yakin ingin mempublikasikan testimoni ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, publish!'
            }).then((result) => {
                if (result.isConfirmed) {
                    publishTestimoni(id);
                }
            });
        }

        function confirmRejectTestimoni(id) {
            Swal.fire({
                title: 'Konfirmasi Tolak Publish Testimoni',
                text: "Apakah Anda yakin tidak ingin publish testimoni ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tolak!'
            }).then((result) => {
                if (result.isConfirmed) {
                    rejectTestimoni(id);
                }
            });
        }

        function publishTestimoni(id) {
            const url = `/admin/testimoni/${id}/publish`;
            console.log("Mengirim permintaan ke:", url); // Tambahkan log ini
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text); });
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Testimoni telah dipublikasikan.',
                        icon: 'success',
                        timer: 2000, // Menampilkan pesan selama 2 detik
                        showConfirmButton: false // Menghapus tombol OK
                    }).then(() => {
                        location.reload(); // Reload halaman setelah timer selesai
                    });
                } else {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat mempublikasikan testimoni.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Gagal!', 'Terjadi kesalahan saat mempublikasikan testimoni: ' + error.message, 'error');
            });
        }

        function rejectTestimoni(id) {
            fetch(`/admin/testimoni/${id}/reject`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text); });
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Testimoni telah ditolak.',
                        icon: 'success',
                        timer: 2000, // Menampilkan pesan selama 2 detik
                        showConfirmButton: false // Menghapus tombol OK
                    }).then(() => {
                        location.reload(); // Reload halaman setelah timer selesai
                    });
                } else {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menolak testimoni.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Gagal!', 'Terjadi kesalahan saat menolak testimoni: ' + error.message, 'error');
            });
        }
    </script>
</body>
</html>