@extends('layouts.app')

@section('title', 'Jenis Cokelat')

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
                    <h1 class="main-title">Hadiahkan cokelat karakter dari Cokelat Cantique untuk menyemarakkan momen-momen spesial dengan kesan manis dan hangat yang tak terlupakan.</h1>
                </div>
            </div>
            <div class="row header d-flex justify-content-between">
                <div class="col-md-6 title">
                    <h2>Karakter Cokelat</h2>
                </div>
                <div class="col-md-6 produk-filter  d-flex justify-content-end">
                    <div class="button-kustomisasi">
                        <a class="btn" href="{{route('kustomisasi_cokelat')}}" role="button">Kustomisasi Cokelat</a>
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
                                    'kategori1' => 'Huruf',
                                    'kategori2' => 'Kartun',
                                    'kategori3' => 'Makanan',
                                    'kategori4' => 'Hari Raya',
                                    'kategori5' => 'Orang',
                                ];
                                $namaKategori = $kategoriLabels[$cokelat->kategori] ?? 'Kategori Tidak Dikenal';
                            @endphp
                            <p class="card-text">{{ $namaKategori }}</p>
                            <a class="btn button-detail" href="{{ route('detail_karakter_cokelat.show', $cokelat->id) }}" role="button">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection