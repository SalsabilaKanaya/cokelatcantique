@extends('layouts.app')

@section('title', 'Jenis Cokelat')

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
                    <h1 class="main-title">Ceriakan harimu dengan cokelat karakter dari Cokelat Cantique, yang dirancang untuk menghadirkan kebahagiaan dan kehangatan pada setiap momen spesial.</h1>
                </div>
            </div>
            <div class="row content justify-content-between">
                <div class="col-md-6 content-image">
                    <img src="{{ asset('img/harispesial.JPG')}}" alt="Hari Spesial" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>Gift Idea untuk Hari Spesial</h1>
                    <p>Rayakan momen istimewa seperti hari guru, anniversary, ulang tahun, dan lainnya dengan kelezatan yang memikat dari Cokelat Cantique. Setiap cokelat dirancang dengan penuh keahlian untuk menyempurnakan perayaanmu. Nikmati kebahagiaan dalam setiap detik hari spesialmu dengan hadiah yang manis dan istimewa ini, membawa senyum dan kenangan indah.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Gift Idea untuk Orang Tersayang</h1>
                    <p>Tunjukkan cinta dan perhatianmu dengan hadiah yang manis dan penuh arti. Cokelat Cantique menciptakan momen tak terlupakan untuk orang-orang yang paling berarti dalam hidupmu. Setiap gigitan membawa kehangatan dan kasih sayang yang mendalam, mengungkapkan rasa cinta yang tak terucap dalam kata-kata.</p>
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
                    <p>Berbagi kebahagiaan dan kehangatan Hari Raya seperti Idul Fitri, Natal, Imlek, dan lainnya dengan cokelat yang penuh cinta dari Cokelat Cantique. Hadiahkan kebersamaan dan sukacita dalam setiap gigitan manis ini, menciptakan momen berharga yang dirayakan bersama orang-orang terkasih. Sempurnakan perayaan Hari Raya dengan sentuhan manis yang mempersatukan hati.</p>
                </div>
            </div>
            <div class="row content d-flex justify-content-between">
                <div class="col-md-6">
                    <h1>Gift Idea untuk Konsumsi Pribadi</h1>
                    <p>Manjakan diri sendiri dengan kelezatan yang sempurna dari Cokelat Cantique. Setiap gigitan memberikan rasa kenikmatan dan relaksasi yang tak tertandingi, menghadirkan momen kebahagiaan dalam keseharianmu. Jadikan setiap hari istimewa dengan cokelat yang diciptakan khusus untuk dinikmati sendiri, sebagai bentuk cinta dan penghargaan untuk dirimu sendiri</p>
                </div>
                <div class="col-md-6 content-image d-flex justify-content-end">
                    <img src="{{ asset('img/pribadi.PNG')}}" alt="Konsumsi Pribadi" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
@endsection