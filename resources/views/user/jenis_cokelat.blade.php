@extends('user.layouts.app')

@section('title', 'Jenis Cokelat - Cokelat Cantique')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/jenis_cokelat.css')}}">
@endpush


@section('content')
    <!-- MAIN -->
    <section class="main-content">
        <div class="container">
            <div class="row banner justify-content-between align-items-center">
                <div class="col-12">
                    <img src="{{ asset('img/jenisbanner.JPG')}}" alt="Banner" class="img-fluid" oncontextmenu="return false;" draggable="false" style="pointer-events: none;">
                    <div class="overlay"></div>
                    <h1 class="main-title">Suatu hari, aku memberi cokelat kepada sahabatku saat ia sedang down. Senyumnya berubah cerah, dan kami tertawa bersama lagi. Kadang, cokelat adalah cara paling sederhana untuk bilang, ‘Aku ada untukmu.’</h1>
                </div>
            </div>
            <div class="row header justify-content-between">
                <div class="col-md-6 title">
                    <h2>Jenis Cokelat</h2>
                </div>
                @php
                    $kategoriLabels = [
                        'box' => 'Cokelat Box',
                        'kiloan' => 'Cokelat Kiloan',
                        'loli' => 'Cokelat Loli',
                        'tenteng' => 'Cokelat Tenteng',
                    ];

                    // Mendapatkan kategori yang dipilih dari request
                    $selectedKategori = request('kategori');

                    // Mendapatkan label kategori yang dipilih, jika ada
                    $selectedLabel = $selectedKategori ? $kategoriLabels[$selectedKategori] ?? 'All' : 'All';
                @endphp
                <div class="col-md-6 produk-filter  d-flex justify-content-end">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $selectedLabel }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('user.jenis_cokelat') }}">All</a></li>
                            @foreach($kategoriLabels as $key => $label)
                                <li><a class="dropdown-item" href="{{ route('user.jenis_cokelat', ['kategori' => $key]) }}">{{ $label }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row produk justify-content-between">
                @foreach ($jenisCokelat as $cokelat)
                <div class="col-md-3 produk-card">
                    <div class="card">
                        <img src="{{ asset($cokelat->foto)}}" class="card-img-top" alt="{{ $cokelat->nama }}" oncontextmenu="return false;" draggable="false" style="pointer-events: none;">
                        <div class="card-body">
                        <h5 class="card-title">{{ $cokelat->nama }}</h5>
                        <p class="card-text">Rp {{ number_format($cokelat->harga, 0, ',', '.') }}</p>
                        <a class="btn button-detail" href="{{ route('user.detail_jenis_cokelat.show', $cokelat->id) }}" role="button">Cek Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection