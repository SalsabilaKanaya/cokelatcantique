@extends('user.layouts.app')

@section('title', 'Search Results')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/search_results.css') }}">
@endpush

@section('content')
<div class="main-content">
    <h1>Hasil Pencarian untuk "{{ $query }}"</h1>

    @if(!$jenisCokelats->isEmpty())
        <p class="hasil-title">{{ $jenisCokelats->count() }} results found for "{{$query}}"</p>
        <div class="row produk justify-content-between">
            @foreach($jenisCokelats as $jenisCokelat)
                <div class="col-md-3 produk-card">
                    <div class="card">
                        <img src="{{ asset($jenisCokelat->foto) }}" class="card-img-top" alt="{{ $jenisCokelat->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $jenisCokelat->nama }}</h5>
                            <p class="card-text">Rp {{ number_format($jenisCokelat->harga, 0, ',', '.') }}</p>
                            <a class="btn button-detail" href="{{ route('user.detail_jenis_cokelat.show', $jenisCokelat->id) }}" role="button">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(!$karakterCokelats->isEmpty())
        <p class="hasil-title">{{ $karakterCokelats->count() }} results found for "{{$query}}"</p>
        <div class="row produk justify-content-between">
            @foreach ($karakterCokelats as $karakterCokelat)
            <div class="col-md-3 produk-card">
                <div class="card">
                    <img src="{{ asset($karakterCokelat->foto)}}" class="card-img-top" alt="{{ $karakterCokelat->nama }}">
                    <div class="card-body">
                        <h5 class="card-title" style="font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 500; color: black;">{{ $karakterCokelat->nama }}</h5>
                        @php
                            $kategoriLabels = [
                                'kategori1' => 'Huruf',
                                'kategori2' => 'Kartun',
                                'kategori3' => 'Makanan',
                                'kategori4' => 'Hari Raya',
                                'kategori5' => 'Orang',
                            ];
                            $namaKategori = $kategoriLabels[$karakterCokelat->kategori] ?? 'Kategori Tidak Dikenal';
                        @endphp
                        <p class="card-text" style="font-size: 14px; font-weight: 400; color: #404852;">{{ $namaKategori }}</p>
                        <a class="btn button-detail" href="{{ route('user.detail_karakter_cokelat.show', $karakterCokelat->id) }}" role="button">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if(!$pages->isEmpty())
        <p>Menampilkan {{ $pages->count() }} hasil untuk "Informasi".</p>
        <h2>Informasi</h2>
        <ul>
            @foreach($pages as $page)
                <li><a href="{{ route($page['route']) }}">{{ $page['title'] }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
@endsection