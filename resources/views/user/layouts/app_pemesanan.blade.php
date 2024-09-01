<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"/>

    <link rel="stylesheet" href="{{ asset('css/user/app_pemesanan.css')}}">
    @stack('styles')
</head>
<body>

    @include('user.partials.navbar_pemesanan')

    <main class="container">
        @yield('content')
    </main>

    @include('user.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.navbar-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    console.log('Navbar item clicked'); 
                    fetch('/clear-session', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        console.log('Fetch response received'); 
                        return response.json();
                    }).then(data => {
                        if (data.status === 'Session cleared') {
                            console.log('Session berhasil dihapus');
                        } else {
                            console.error('Gagal menghapus session');
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                });
            });

            const buttonBack = document.getElementById('button-back');
            if (buttonBack) {
                buttonBack.addEventListener('click', function() {
                    console.log('Button back clicked'); 
                    fetch('/clear-session', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        console.log('Fetch response received'); 
                        return response.json();
                    }).then(data => {
                        if (data.status === 'Session cleared') {
                            alert('Session berhasil dihapus');
                            history.back();
                        } else {
                            alert('Gagal menghapus session');
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus session');
                    });
                });
            }
        });
    </script> -->
</body>