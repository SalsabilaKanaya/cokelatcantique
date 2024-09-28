@extends('user.layouts.app')

@section('title', 'Detail Pesanan - Cokelat Cantique')

@push('styles')
    <link rel="stylesheet" href="{{ asset ('css/user/detail_histori.css')}}">
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <a href="javascript:history.back()" class="btn btn-text"><i class="fa-solid fa-arrow-left"></i><span class="text">Kembali</span></a>
            <h1>Detail Orderan</h1>
            <div class="content-active">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="order-info">
                            <div class="order-row">
                                <p class="order-detail"><strong>ID Order:</strong> {{ $order->id }}</p>
                                <p class="order-detail"><strong>Nama:</strong> {{ $order->user->name }}</p>
                                <p class="order-detail"><strong>Email:</strong> {{ $order->user->email }}</p>
                            </div>
                            <div class="order-row">
                                <p class="order-detail"><strong>No Hp:</strong> {{ $order->userAddress->phone }}</p>
                                <p class="order-detail"><strong>Tanggal Pemesanan:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                                <p class="order-detail"><strong>Tanggal Pengiriman:</strong> {{ $order->delivery_date->format('d/m/Y') }}</p>
                            </div>
                            <div class="order-row">
                                <p class="order-detail"><strong>Kurir</strong> {{ $order->courier}}</p>
                                <p class="order-detail"><strong>Jenis Pengiriman</strong> {{ $order->delivery_package}}</p>
                                <p class="order-detail"><strong>Alamat:</strong> {{ $order->userAddress->address }}, {{ $order->userAddress->city_name }}, {{ $order->userAddress->province_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 header">
                        <h2>Rincian Item</h2>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="produk-list">
                            @foreach ($order->items as $item)
                                <div class="produk-item d-flex">
                                    <img src="{{ asset($item->jenisCokelat->foto) }}" alt="{{ $item->jenisCokelat->nama }}" class="produk-img">
                                    <div class="produk-info">
                                        <h5>{{ $item->jenisCokelat->nama }}</h5>
                                        <p class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        @foreach ($item->karakterItems as $karakterItem)
                                            <div class="produk-item-karakter d-flex">
                                                <img src="{{ asset($karakterItem->karakterCokelat->foto) }}" alt="{{ $karakterItem->karakterCokelat->nama }}" class="karakter-img">
                                                <div class="produk-info-karakter">
                                                    <h5>{{ $karakterItem->karakterCokelat->nama }}</h5>
                                                    <p>{{ $karakterItem->quantity }}</p>
                                                    <p class="catatan">{{ $karakterItem->notes }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="harga-ongkos mt-3">
                                <p class="text">Subtotal</p>
                                <p class="price">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                            </div>
                            <div class="harga-ongkos mt-3">
                                <p class="text">Biaya Pengiriman</p>
                                <p class="price">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                            </div>
                            <div class="total-harga mt-3">
                                <p class="text">Total</p>
                                <p class="total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="form-group mt-3 catatan">
                            <h5>Catatan Lainnya</h5>
                            <p>{{ $order->notes }}</p>
                        </div>
                        <div class="form-group mt-3 bukti-pembayaran">
                            <h5>Bukti Pembayaran</h5>
                            @if($order->payment_proof)
                                <p><a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" download>Unduh Bukti Pembayaran</a></p>
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" download>
                                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" style="max-width: 20%; height: auto;">
                                </a>
                            @else
                                <p>Tidak ada bukti pembayaran yang diunggah.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection