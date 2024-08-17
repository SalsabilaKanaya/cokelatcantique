@extends('layouts.app')

@section('title', 'Jenis Cokelat')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/detail_karakter_cokelat.css') }}">
@endpush

@section('content')
    <!--Main-->
    <section class="main-content">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <a href="javascript:history.back()" class="btn button-back"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 header">
                    <h2>Detail Karakter - {{ $cokelat->nama }}</h2>
                </div>
            </div>
            <div class="row mt-3 d-flex produk-content">
                <div class="col-md-6 produk-img">
                    <img src="{{ asset($cokelat->foto) }}" class="img-fluid" alt="{{ $cokelat->nama }}">
                </div>
                <div class="col-md-6 produk-detail">
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
                    <p class="kategori">{{ $namaKategori }}</p>
                    <h1 class="title">{{ $cokelat->nama }}</h1>
                    <p class="deskripsi">{!! nl2br(e($cokelat->deskripsi)) !!}</p>
                </div>
            </div>
            <div class="related-products">
                <h3>Pilihan Karakter Cokelat Lainnya</h3>
                <div class="row related-detail justify-content-between owl-carousel owl-theme">
                    @foreach ($karakterCokelatLainnya as $relatedCokelat)
                    <div class="col-md-3 produk-card">
                        <div class="card">
                            <img src="{{ asset($relatedCokelat->foto)}}" class="card-img-top" alt="{{ $relatedCokelat->nama }}">
                            <div class="card-body">
                              <h5 class="card-title">{{ $relatedCokelat->nama }}</h5>
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
                              <p class="card-text">{{ $namaKategori}}</p>
                              <a class="btn button-detail" href="{{ route('detail_karakter_cokelat.show', $relatedCokelat->id) }}" role="button">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.related-detail').owlCarousel({
                loop:true,
                nav:false,
                dots:true,
                margin:50,
                autoplay:true,
                autoplayTimeout:4000,
                smartSpeed:800,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:4
                    }
                }
            });
        });
    </script>
@endpush
