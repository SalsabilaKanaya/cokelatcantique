@extends('user.layouts.app')

@section('title', 'Karakter Cokelat - Cokelat Cantique')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/karakter_cokelat.css')}}">
@endpush

@section('content')
    <!-- MAIN -->
    <section class="main-content">
        <div class="container">
            <div class="row banner d-flex justify-content-between align-items-center">
                <div class="col-12">
                    <img src="{{ asset('img/karakterbanner.JPG')}}" alt="Banner" class="img-fluid">
                    <div class="overlay"></div>
                    <h1 class="main-title">Di setiap perayaan, cokelat menjadi bagian dari tradisi keluargaku. Kami saling berbagi, memberi, dan tersenyum. Hari raya tak lengkap tanpa manisnya cokelat yang menghubungkan kami semua.</h1>
                </div>
            </div>
            <div class="row header d-flex justify-content-between">
                <div class="col-md-6 title">
                    <h2>Karakter Cokelat</h2>
                </div>
                <div class="col-md-6 produk-filter  d-flex justify-content-end">
                    <div class="button-kustomisasi">
                        <a class="btn" href="{{route('user.kustomisasi_cokelat')}}" role="button">Bikin Cokelatmu</a>
                      </div>
                </div>
            </div>
            <div class="row produk justify-content-between">
                @foreach ($karakterCokelat as $cokelat)
                <div class="col-md-3 produk-card">
                    <div class="card">
                        <img src="{{ asset($cokelat->foto)}}" class="card-img-top" alt="{{ $cokelat->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cokelat->nama }}</h5>
                            @php
                                $kategoriLabels = [
                                'huruf' => 'Huruf',
                                'kartun' => 'Kartun',
                                'makanan' => 'Makanan',
                                'hari raya' => 'Hari Raya',
                                'orang' => 'Orang',
                            ];
                                $namaKategori = $kategoriLabels[$cokelat->kategori] ?? 'Kategori Tidak Dikenal';
                            @endphp
                            <p class="card-text">{{ $namaKategori }}</p>
                            <a class="btn button-detail" href="{{ route('user.detail_karakter_cokelat.show', $cokelat->id) }}" role="button">Cek Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection