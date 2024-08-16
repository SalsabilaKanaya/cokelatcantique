@extends('layouts.app')

@section('title', 'Jenis Cokelat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/faq.css')}}">
@endpush

@section('content')

    <!--Main-->
    <section class="main-content">
        <h1>Frequently Asked Questions (FAQ)</h1>
        <div class="container">
            <div class="content">
                <div class="header">
                    Apa itu Cokelat Cantique?
                </div>
                <div class="body">
                    <div class="body-content">
                        Cokelat Cantique adalah usaha yang menyediakan cokelat karakter yang dapat 
                        disesuaikan untuk berbagai acara seperti ulang tahun, pernikahan, hari raya, 
                        dan lainnya. Pembeli bisa memilih karakter dan desain sesuai keinginan.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Bagaimana cara memesan cokelat di Cokelat Cantique?
                </div>
                <div class="body">
                    <div class="body-content">
                        Anda dapat memesan cokelat melalui website kami. Penjelasana mengenai cara memesan 
                        cokelat di Cokelat Cantique terdapat pada halaman "Cara Pemesanan".
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Apakah saya bisa memesan desain khusus?
                </div>
                <div class="body">
                    <div class="body-content">
                        Ya, kami menyediakan opsi untuk desain khusus. Anda bisa menghubungi kami melalui fitur kontak di website atau melalui media sosial untuk mendiskusikan desain yang diinginkan.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Berapa lama waktu yang dibutuhkan untuk memproses pesanan?
                </div>
                <div class="body">
                    <div class="body-content">
                        Waktu pemrosesan pesanan biasanya memakan waktu 3-5 hari kerja, tergantung pada jumlah dan kompleksitas pesanan. Pengiriman akan dilakukan segera setelah pesanan selesai diproses.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Apakah Cokelat Cantique melayani pengiriman ke luar kota?
                </div>
                <div class="body">
                    <div class="body-content">
                        Ya, kami melayani pengiriman ke seluruh wilayah Indonesia. Biaya pengiriman akan dihitung berdasarkan lokasi pengiriman dan berat paket.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Bagaimana cara membayar pesanan?
                </div>
                <div class="body">
                    <div class="body-content">
                        Kami menerima pembayaran melalui transfer bank, e-wallet, dan kartu kredit. Informasi lebih lanjut tentang metode pembayaran tersedia di halaman pembayaran saat checkout.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Apakah ada minimal jumlah pesanan?
                </div>
                <div class="body">
                    <div class="body-content">
                        Minimal jumlah order cokelat hanya untuk jenis cokelat loli dan cokelat tenteng dengan minimal order 20pcs.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Bagaimana jika saya menerima produk yang rusak atau tidak sesuai?
                </div>
                <div class="body">
                    <div class="body-content">
                        Jika Anda menerima produk yang rusak atau tidak sesuai dengan pesanan, silakan hubungi layanan pelanggan kami dalam waktu 24 jam setelah menerima paket. Kami akan membantu Anda untuk menukar atau mengembalikan produk tersebut.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Apakah cokelat yang digunakan halal?
                </div>
                <div class="body">
                    <div class="body-content">
                        Ya, semua cokelat yang digunakan di Cokelat Cantique adalah halal dan telah memenuhi standar kualitas yang tinggi.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Bagaimana cara menghubungi layanan pelanggan?
                </div>
                <div class="body">
                    <div class="body-content">
                        Anda dapat menghubungi layanan pelanggan kami melalui email, nomor telepon, atau media sosial. Informasi kontak lengkap tersedia di halaman kontak di website kami.
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/faq.js')}}"></script>
@endpush