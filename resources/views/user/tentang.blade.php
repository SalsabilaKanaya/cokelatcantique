@extends('user.layouts.app')

@section('title', 'Tentang Kami - Cokelat Cantique')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/tentang.css')}}">
@endpush

@section('content')
   <!--Main Content-->
    <section class="main-content">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 banner">
                    <img src="{{ asset('img/tentangbanner.JPG')}}" alt="Banner" class="img-fluid">
                    <div class="overlay"></div>
                    <h1 class="main-title">Saat kecil, orangtuaku selalu memberi cokelat ketika aku sedih. Sekarang, setiap kali aku memberikan cokelat kepada orang yang kusayangi, aku berharap mereka bisa merasakan cinta dan hangatnya kenangan itu.</h1>
                </div>
            </div>
            <div class="row content align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('img/logo.png')}}" alt="Cokelat Cantique" class="img-fluid logo">
                </div>
                <div class="col-md-6">
                    <h1>Cokelat Cantique: Perjalanan Penuh Cinta dan Kreativitas Sejak 2016</h1>
                    <p>Cokelat Cantique dimulai pada tahun 2016, lahir dari kecintaan kami pada cokelat dan keinginan untuk menciptakan sesuatu yang lebih dari sekadar makanan manis. Terinspirasi dari kreasi kreatif di media sosial, kami memutuskan untuk membuat cokelat karakter yang bukan hanya indah, tetapi juga memiliki makna dalam setiap bentuknya. Kami percaya bahwa setiap cokelat bisa membawa kebahagiaan, menjadi hadiah kecil yang menghangatkan hati.</br>
                    </br>Perjalanan kami tidak selalu mudah. Mulai dari mengembangkan resep hingga menciptakan desain yang menggugah selera, setiap tantangan dihadapi dengan semangat untuk selalu memberikan yang terbaik. Setiap cokelat yang kami hasilkan adalah hasil dari kerja keras dan dedikasi penuh, karena bagi kami, cokelat adalah lebih dari sekadar produk—ini adalah bentuk cinta yang kami bagikan kepada setiap konsumen.</br>
                    </br>Setiap cokelat yang kami hasilkan adalah hasil dari kerja keras, dedikasi, dan perhatian penuh. Kami percaya bahwa cokelat adalah lebih dari sekadar makanan; ini adalah cara kami berbagi cinta, kebahagiaan, dan kehangatan kepada semua orang yang menikmatinya. Di setiap gigitan, kami ingin Anda merasakan semangat yang kami tanamkan sejak awal: semangat untuk menghadirkan senyum di wajah setiap orang, dari perayaan kecil hingga momen-momen besar dalam hidup.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Bahan yang Digunakan</h1>
                    <p>Cokelat Cantique selalu pakai 100% cokelat compound berkualitas tinggi tanpa campuran bahan lain, jadi rasanya enak dan teksturnya pas di lidah. Kami pilih cokelat ini dengan teliti supaya setiap produknya punya rasa yang konsisten dan selalu memuaskan. Bahan-bahan yang kami gunakan nggak cuma bikin cokelat ini nikmat, tapi juga aman untuk dinikmati oleh semua orang.</p>
                </div>
                <div class="col-md-6 content-image d-flex justify-content-end">
                    <img src="{{ asset('img/bahan.jpeg')}}" alt="Bahan yang Digunakan" class="img-fluid">
                </div>
            </div>
            <div class="row content justify-content-between">
                <div class="col-md-6 content-image">
                    <img src="{{ asset('img/cetakan.jpeg')}}" alt="Cara Pembuatannya" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>Cara Pembuatannya</h1>
                    <p>Setiap cokelat di Cokelat Cantique dibuat dengan teliti dan penuh cinta. Prosesnya dimulai dari mencairkan cokelat compound sampai teksturnya pas. Setelah itu, cokelatnya dituangkan ke cetakan silikon dengan desain khusus, lalu didinginkan sampai keras. Dengan cara ini, setiap cokelat punya bentuk yang cantik dan detailnya sempurna, siap bikin momen spesial kamu jadi lebih manis.</p>
                </div>
            </div>
            <div class="row content izin-sertifikat justify-content-center">
                <div class="col-md-12 text-center">
                    <h2>Izin Usaha dan Sertifikat PIRT</h2>
                </div>
                <div class="col-md-6 izin-usaha text-center">
                    <p class="title">Izin Usaha (NIB)</p>
                    <p class="nomor">2612220027168</p>
                </div>
                <div class="col-md-6 sertifikat-pirt text-center">
                    <p class="title">Sertifikat PIRT</p>
                    <p class="nomor">P-IRT 2073215010768-29</p>
                </div>
            </div>
        </div>
    </section>
@endsection