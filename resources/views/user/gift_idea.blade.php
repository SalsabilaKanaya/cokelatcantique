@extends('user.layouts.app')

@section('title', 'Gift Idea - Cokelat Cantique')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/gift_idea.css')}}">
@endpush

@section('content')
    <!--Main Content-->
    <section class="main-content">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 banner">
                    <img src="{{ asset('img/giftbanner.JPG')}}" alt="Banner" class="img-fluid">
                    <div class="overlay"></div>
                    <h1 class="main-title">Setiap kali aku memberi cokelat padamu, aku ingin kamu tahu betapa spesialnya kamu bagiku. Cokelat ini lebih dari sekadar hadiah, ini cara kecilku bilang, 'Aku cinta kamu.'</h1>
                </div>
            </div>
            <div class="row content justify-content-between">
                <div class="col-md-6 content-image">
                    <img src="{{ asset('img/harispesial.JPG')}}" alt="Hari Spesial" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>Gift Idea untuk Hari Spesial</h1>
                    <p>Rayakan momen spesial, seperti Hari Guru, anniversary, ulang tahun, dan banyak lagi, dengan cokelat enak dari Cokelat Cantique. Setiap cokelat dibuat dengan hati-hati biar bikin perayaan kamu makin sempurna. Nikmati kebahagiaan di setiap momen spesialmu dengan hadiah manis ini, yang bakal bikin senyum dan kenangan indah tidak terlupakan.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Gift Idea untuk Orang Tersayang</h1>
                    <p>Tunjukin rasa sayang dan perhatianmu lewat hadiah manis yang penuh makna. Cokelat Cantique bikin momen-momen spesial buat orang-orang terdekatmu jadi gak terlupakan. Setiap gigitan memberikan kehangatan dan kasih sayang yang gak bisa diungkapin lewat kata-kata.</p>
                </div>
                <div class="col-md-6 content-image d-flex justify-content-end">
                    <img src="{{ asset('img/orangsayang.JPG')}}" alt="Orang Tersayang" class="img-fluid">
                </div>
            </div>
            <div class="row content justify-content-between">
                <div class="col-md-6 content-image">
                    <img src="{{ asset('img/hariraya.JPG')}}" alt="Hari Raya" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>Gift Idea untuk Hari Raya</h1>
                    <p>Bagikan kebahagiaan dan kehangatan di Hari Raya seperti Idul Fitri, Natal, Imlek, dan lainnya dengan cokelat penuh cinta dari Cokelat Cantique. Hadiahkan momen kebersamaan dan sukacita dalam setiap gigitan manis ini, biar perayaan bareng orang-orang tersayang makin berkesan. Sempurnakan Hari Raya dengan sentuhan manis yang bikin hati saling terhubung.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Gift Idea untuk Konsumsi Pribadi</h1>
                    <p>Yuk, manjain diri dengan kelezatan dari Cokelat Cantique. Setiap gigitan memberikan rasa nikmat dan bikin rileks, pas banget buat kasih momen bahagia di keseharianmu. Bikin setiap hari jadi spesial dengan cokelat yang dibuat khusus buat kamu nikmati sendiri—karena kamu juga pantas dapetin cinta dan apresiasi buat dirimu sendiri.</p>
                </div>
                <div class="col-md-6 content-image d-flex justify-content-end">
                    <img src="{{ asset('img/pribadi.PNG')}}" alt="Konsumsi Pribadi" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
@endsection