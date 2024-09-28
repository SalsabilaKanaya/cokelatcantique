@extends('user.layouts.app')

@section('title', 'Cara Pemesanan - Cokelat Cantique')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/cara_pemesanan.css')}}">
@endpush


@section('content')
    <!--Main-->
    <section class="main-content">
        <h1>Cara Pemesanan</h1>
        <div class="container">
            <div class="content">
                <div class="header">
                    Melalui Halaman Kustomisasi Cokelat
                </div>
                <div class="body">
                    <div class="body-content">
                        <ol>
                            <li>Buka halaman kustomisasi cokelat</li>
                            <li>Pilih jenis cokelat yang diinginkan (Cokelat box, loli, kiloan, atau tenteng)</li>
                            <li>Pilih beberapa karakter cokelat sesuai dengan keinginan</li>
                            <li>Masukkan jumlah karakter cokelat yang dipilih. Banyaknya karakter cokelat sesuai dengan jenis cokelat yang dipilih (bisa dilihat pada halaman jenis cokelat). </li>
                            <li>Masukkan catatan untuk karakter cokelat yang dipilih. Catatan bisa berupa warna dari karakter cokelat, tulisan, dan yang lainnya. </li>
                            <li>Jika sudah memilih semua karakter cokelat yang diinginkan sesuai, lihat pada bagian "Pilihan Anda" dan pastikan kembali bahwa pesanan anda sudah sesuai. </li>
                            <li>Klik tombol “Pesan” untuk melakukan proses pemesanan. Namun jika tidak ingin lakukan pemesanan pada saat itu, bisa klik tombol “Keranjang”. </li>
                            <li>Selanjutnya pada halaman pemesanan, masukkan data pribadi anda dengan benar, masukkan tanggal pengiriman dengan benar, lihat kembali rincian pesanan anda, pilih metode pembayaran, dan masukkan catatan lainnya (option).</li>
                            <li>Jika semua data sudah benar, klik tombol “Bayar”.</li>
                            <li>Lakukan pembayaran sesuai dengan metode pembayaran yang dipilih hingga berhasil</li>
                            <li>Proses pemesanan sudah selesai.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Melalui Halaman Jenis Cokelat
                </div>
                <div class="body">
                    <div class="body-content">
                        <ol>
                            <li>Buka halaman jenis cokelat</li>
                            <li>Pilih jenis cokelat yang diinginkan (Cokelat box, loli, kiloan, atau tenteng)</li>
                            <li>Lihat detail dan informasi mengenai jenis cokelat yang dipilih</li>
                            <li>Pilih beberapa karakter cokelat sesuai dengan keinginan</li>
                            <li>Masukkan jumlah karakter cokelat yang dipilih. Banyaknya karakter cokelat sesuai dengan jenis cokelat yang dipilih (bisa dilihat pada halaman jenis cokelat). </li>
                            <li>Masukkan catatan untuk karakter cokelat yang dipilih. Catatan bisa berupa warna dari karakter cokelat, tulisan, dan yang lainnya. </li>
                            <li>Jika sudah memilih semua karakter cokelat yang diinginkan sesuai, lihat pada bagian "Pilihan Anda" dan pastikan kembali bahwa pesanan anda sudah sesuai. </li>
                            <li>Klik tombol “Pesan” untuk melakukan proses pemesanan. Namun jika tidak ingin lakukan pemesanan pada saat itu, bisa klik tombol “Keranjang”. </li>
                            <li>Selanjutnya pada halaman pemesanan, masukkan data pribadi anda dengan benar, masukkan tanggal pengiriman dengan benar, lihat kembali rincian pesanan anda, pilih metode pembayaran, dan masukkan catatan lainnya (option).</li>                            <li>Jika semua data sudah benar, klik tombol “Bayar”.</li>
                            <li>Lakukan pembayaran sesuai dengan metode pembayaran yang dipilih hingga berhasil</li>
                            <li>Proses pemesanan sudah selesai.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="header">
                    Melalui halaman Karakter Cokelat
                </div>
                <div class="body">
                    <div class="body-content">
                        <ol>
                            <li>Buka halaman karakter cokelat</li>
                            <li>Klik tombol "Kustomisasi Cokelat"</li>
                            <li>Pilih jenis cokelat yang diinginkan (Cokelat box, loli, kiloan, atau tenteng)</li>
                            <li>Pilih beberapa karakter cokelat sesuai dengan keinginan</li>
                            <li>Masukkan jumlah karakter cokelat yang dipilih. Banyaknya karakter cokelat sesuai dengan jenis cokelat yang dipilih (bisa dilihat pada halaman jenis cokelat). </li>
                            <li>Masukkan catatan untuk karakter cokelat yang dipilih. Catatan bisa berupa warna dari karakter cokelat, tulisan, dan yang lainnya. </li>
                            <li>Jika sudah memilih semua karakter cokelat yang diinginkan sesuai, lihat pada bagian "Pilihan Anda" dan pastikan kembali bahwa pesanan anda sudah sesuai. </li>
                            <li>Klik tombol “Pesan” untuk melakukan proses pemesanan. Namun jika tidak ingin lakukan pemesanan pada saat itu, bisa klik tombol “Keranjang”. </li>
                            <li>Selanjutnya pada halaman pemesanan, masukkan data pribadi anda dengan benar, masukkan tanggal pengiriman dengan benar, lihat kembali rincian pesanan anda, pilih metode pembayaran, dan masukkan catatan lainnya (option).</li>                            <li>Jika semua data sudah benar, klik tombol “Bayar”.</li>
                            <li>Lakukan pembayaran sesuai dengan metode pembayaran yang dipilih hingga berhasil</li>
                            <li>Proses pemesanan sudah selesai.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/user/cara_pemesanan.js')}}"></script>
@endpush