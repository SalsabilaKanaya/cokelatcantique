@extends('layouts.app')

@section('title', 'Jenis Cokelat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/detail_jenis_cokelat.css')}}">
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
                    <h2>Detail Jenis - {{ $cokelat->nama }} </h2>
                </div>
            </div>
            <div class="row mt-3 d-flex produk-content">
                <div class="col-md-6 produk-img">
                    <img src="{{ asset($cokelat->foto) }}" class="img-fluid" alt="{{ $cokelat->nama }}">
                </div>
                <div class="col-md-6 produk-detail d-flex flex-column justify-content-center">
                    @php
                        $kategoriLabels = [
                        'kategori1' => 'Cokelat Box',
                        'kategori2' => 'Cokelat Kiloan',
                        'kategori3' => 'Cokelat Loli',
                        'kategori4' => 'Cokelat Tenteng',
                        ];
                        $namaKategori = $kategoriLabels[$cokelat->kategori] ?? 'Kategori Tidak Dikenal';
                    @endphp
                    <p class="kategori">{{ $namaKategori }}</p>
                    <h1 class="title">{{ $cokelat->nama }}</h1>
                    <p class="deskripsi">{!! nl2br(e($cokelat->deskripsi)) !!}</p>
                    <p class="price">Rp {{ number_format($cokelat->harga, 0, ',', '.') }}</p>
                    <button class="btn btn-kustomisasi">Kustomisasi Cokelat</button>
                </div>
            </div>
            <div class="related-products">
                <h3>Pilihan Jenis Cokelat Lainnya</h3>
                <div class="row related-detail justify-content-between owl-carousel owl-theme">
                    @foreach ($jenisCokelatLainnya as $relatedCokelat)
                    <div class="col-md-3 produk-card">
                        <div class="card">
                            <img src="{{ asset($relatedCokelat->foto)}}" class="card-img-top" alt="{{ $relatedCokelat->nama }}">
                            <div class="card-body">
                            <h5 class="card-title">{{ $relatedCokelat->nama }}</h5>
                            <p class="card-text">Rp {{ number_format($relatedCokelat->harga, 0, ',', '.') }}</p>
                            <a class="btn button-detail" href="{{ route('detail_jenis_cokelat.show', $cokelat->id) }}" role="button">Lihat Detail</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
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