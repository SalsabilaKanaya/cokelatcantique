@extends('user.layouts.app')

@section('title', 'Jenis Cokelat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/kontak.css')}}">
@endpush

@section('content')
    <!--Main Content-->
    <section class="main-content">
        <div class="container">
            <div class="content">
                <div class="left-side">
                    <div class="alamat details">
                        <i class="fa-solid fa-location-dot"></i>
                        <div class="title">Alamat</div>
                        <div class="text">Perumnas Blok PG/8, Karawang Barat, Jawa Barat</div>
                    </div>
                    <div class="phone details">
                        <i class="fa solid fa-phone"></i>
                        <div class="title">Phone</div>
                        <div class="text">081399977070</div>
                    </div>
                    <div class="email details">
                        <i class="fa-solid fa-envelope"></i>
                        <div class="title">Email</div>
                        <div class="text">cokelatcantique@gmail.com</div>
                    </div>
                    <div class="sosial-media details">
                        <a href="https://www.instagram.com/cokelat_cantique/">
                            <img src="img/instagram.png" alt="">
                        </a>
                        <a href="">
                            <img src="img/facebook.png" alt="">
                        </a>
                        <a href="https://www.tiktok.com/@cokelat_cantique?_t=8neVX6XFl6v&_r=1">
                            <img src="img/tiktok.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="right-side">
                    <div class="title-text">Kirim kami pesan</div>
                    <p>Jika anda memiliki pertanyaan dan saran untuk kami, anda dapat mengirimi kami pesan dari sini. Dengan senang hati kami membantu anda.</p>
                    <form action="{{ route('user.kontak.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-box">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="input-box">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="08xxxxxxxx" required>
                        </div>
                        <div class="input-box">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="xxxx@gmail.com" required>
                        </div>
                        <div class="input-box message-box">
                            <label for="pesan" class="form-label">Pesan/Masukan</label>
                            <textarea id="pesan" class="form-control" name="pesan" placeholder="Masukkan Pesan/Masukan" required></textarea>
                        </div>
                        <div class="button">
                            <button type="submit" class="btn btn-submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endpush