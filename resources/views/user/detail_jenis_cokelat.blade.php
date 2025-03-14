@extends('user.layouts.app')

@section('title', 'Detail Jenis - ' . $cokelat->nama)

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
                    <img src="{{ asset($cokelat->foto) }}" class="img-fluid" alt="{{ $cokelat->nama }}" oncontextmenu="return false;" draggable="false" style="pointer-events: none;">
                </div>
                <div class="col-md-6 produk-detail d-flex flex-column justify-content-center">
                    @php
                        $kategoriLabels = [
                            'box' => 'Cokelat Box',
                            'kiloan' => 'Cokelat Kiloan',
                            'loli' => 'Cokelat Loli',
                            'tenteng' => 'Cokelat Tenteng',
                        ];
                        $namaKategori = $kategoriLabels[$cokelat->kategori] ?? 'Kategori Tidak Dikenal';
                    @endphp
                    <p class="kategori">{{ $namaKategori }}</p>
                    <h1 class="title">{{ $cokelat->nama }}</h1>
                    <p class="deskripsi">{!! nl2br(e($cokelat->deskripsi)) !!}</p>
                    <p class="price">Rp {{ number_format($cokelat->harga, 0, ',', '.') }}</p>
                    @auth
                        <form action="{{ route('user.store_jenis_cokelat_selection') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis_cokelat_id" value="{{ $cokelat->id }}">
                            <button type="submit" class="btn btn-kustomisasi">Bikin Cokelatmu</button>
                        </form>
                    @else
                        <button class="btn btn-kustomisasi" disabled>Login Dulu untuk Kustomisasi</button>
                    @endauth
                </div>
            </div>
            <div class="related-products">
                <h3>Pilihan Jenis Cokelat Lainnya</h3>
                <div class="row related-detail justify-content-between owl-carousel owl-theme">
                    @foreach ($jenisCokelatLainnya as $relatedCokelat)
                    <div class="col-md-3 produk-card">
                        <div class="card">
                            <img src="{{ asset($relatedCokelat->foto)}}" class="card-img-top" alt="{{ $relatedCokelat->nama }}" oncontextmenu="return false;" draggable="false" style="pointer-events: none;">
                            <div class="card-body">
                            <h5 class="card-title">{{ $relatedCokelat->nama }}</h5>
                            <p class="card-text">Rp {{ number_format($relatedCokelat->harga, 0, ',', '.') }}</p>
                            <a class="btn button-detail" href="{{ route('user.detail_jenis_cokelat.show', $cokelat->id) }}" role="button">Cek Detail</a>
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