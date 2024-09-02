<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Cokelat Cantique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"/>
    <link rel="stylesheet" href="{{ asset('css/admin/kontak.css') }}">
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
                    <i class='bx bx-log-out' style="color: #dc3545;"></i>
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
                <h1>Pesan Masuk</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Isi Pesan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = ($kontak->currentPage() - 1) * $kontak->perPage() + 1; @endphp
                        @foreach($kontak as $item)
                        <tr id="row-{{ $item->id }}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->no_telp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->pesan }}</td>
                            <td>
                                @if ($item->status === 'unread')
                                    <span class="badge bg-warning text-dark">Belum Dibaca</span>
                                @else
                                    <span class="badge bg-success">Sudah Dibaca</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status === 'unread')
                                    <button class="btn-checklist btn-primary btn-sm" onclick="markAsRead({{ $item->id }})">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Tambahkan link pagination -->
                <div class="pagination-section">
                    {{ $kontak->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function markAsRead(id) {
            Swal.fire({
                title: 'Apakah Anda yakin pesan ini sudah dibaca?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, sudah dibaca',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'swal2-popup',
                    title: 'swal2-title',
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/kontak/${id}/mark-as-read`, {
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
                            let row = document.getElementById(`row-${id}`);
                            row.querySelector('td:nth-child(6)').innerHTML = '<span class="badge bg-success">Sudah Dibaca</span>';
                            row.querySelector('td:nth-child(7)').innerHTML = ''; // Hapus tombol aksi
                            
                            // Pindahkan baris ke posisi yang tepat di antara baris yang sudah dibaca
                            let tbody = row.parentNode;
                            tbody.removeChild(row);
                            let firstReadRow = Array.from(tbody.children).find(tr => tr.querySelector('td:nth-child(6) .badge').classList.contains('bg-success'));
                            if (firstReadRow) {
                                firstReadRow.before(row);
                            } else {
                                tbody.appendChild(row);
                            }

                            // Perbarui nomor urut
                            Array.from(tbody.children).forEach((tr, index) => {
                                tr.querySelector('td:first-child').textContent = index + 1;
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }
    </script>    
</body>
</html>