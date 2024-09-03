@extends('user.layouts.app')

@section('title', 'Jenis Cokelat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/kustomisasi_cokelat.css')}}">
@endpush

@section('content')
   <!-- MAIN -->
    <section class="main-content">
        <div class="container">
            @if(Auth::check())
                <div class="row banner justify-content-between align-items-center">
                    <div class="col-12">
                        <h1 class="banner-title">Create your Chocolate Gift</h1>
                        <img src="{{ asset('img/kustomisasibanner.png')}}" alt="Banner" class="img-fluid">
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
                                <li><a class="dropdown-item" href="{{ route('user.kustomisasi_cokelat') }}">All</a></li>
                                @foreach($kategoriLabels as $key => $label)
                                    <li><a class="dropdown-item" href="{{ route('user.kustomisasi_cokelat', ['kategori' => $key]) }}">{{ $label }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row produk justify-content-between">
                    @foreach ($jenisCokelat as $cokelat)
                    <div class="col-md-3 produk-card">
                        <div class="card">
                            <img src="{{ asset($cokelat->foto)}}" class="card-img-top" alt="{{ $cokelat->nama }}">
                                <div class="card-body">
                                <h5 class="card-title">{{ $cokelat->nama }}</h5>
                                <p class="card-text">Rp {{ number_format($cokelat->harga, 0, ',', '.') }}</p>
                                <form action="{{ route('user.store_jenis_cokelat_selection') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jenis_cokelat_id" value="{{ $cokelat->id }}">
                                    <button type="submit" class="btn button-detail">Pilih Jenis Cokelat</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 text-center">
                        <img src="{{ asset('img/error.png') }}" alt="Error" class="img-fluid mb-5" style="max-width: 300px;">
                        <h5 style="color: #000; font-weight: 600; font-family: 'Montserrat', sans-serif;">Harap lakukan login terlebih dahulu untuk melakukan pemesanan</h5>
                        <a href="{{ route('user.login') }}" class="btn btn-login">Login</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection