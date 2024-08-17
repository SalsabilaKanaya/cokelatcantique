@extends('layouts.app')

@section('title', 'Jenis Cokelat')

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
                    <h1 class="main-title">Hadirkan senyum di wajah orang tersayang dengan cokelat karakter dari Cokelat Cantique yang penuh cinta.</h1>
                </div>
            </div>
            <div class="row content align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('img/logo.png')}}" alt="Cokelat Cantique" class="img-fluid logo">
                </div>
                <div class="col-md-6">
                    <h1>Cokelat Cantique</h1>
                    <p>Cokelat Cantique adalah bisnis cokelat karakter yang telah beroperasi sejak tahun 2016. Berawal dari hobi dan inspirasi dari media sosial, Berawal dari hobi dan kecintaan pada cokelat, kami terinspirasi oleh kreasi di media sosial untuk menciptakan cokelat karakter yang penuh makna. Setiap cokelat dari Cokelat Cantique dibuat dengan cinta dan perhatian, membawa kehangatan dan kebahagiaan ke setiap momen spesial Anda.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Bahan yang Digunakan</h1>
                    <p>Cokelat Cantique menggunakan 100% cokelat compound berkualitas tinggi tanpa campuran bahan lainnya untuk menghasilkan rasa yang lezat dan tekstur yang sempurna. Cokelat compound dipilih dengan cermat untuk memastikan setiap produk kami memiliki cita rasa yang konsisten dan memuaskan. Bahan pilihan ini membuat cokelat kami tidak hanya nikmat disantap tetapi juga aman dikonsumsi oleh berbagai kalangan.</p>
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
                    <p>Setiap cokelat di Cokelat Cantique dibuat dengan penuh ketelitian dan cinta. Proses pembuatan kami dimulai dengan mencairkan cokelat compound hingga mencapai konsistensi yang tepat. Setelah itu, cokelat dituang ke dalam cetakan silikon dengan desain khusus, yang kemudian didinginkan hingga mengeras. Teknik ini memastikan setiap cokelat memiliki bentuk yang sempurna dan detail yang menawan, siap untuk mempermanis momen-momen spesial Anda.</p>
                </div>
            </div>
        </div>
    </section>
@endsection