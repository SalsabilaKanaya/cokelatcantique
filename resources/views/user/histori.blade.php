@extends('user.layouts.app')

@section('title', 'Histori Pesanan - Cokelat Cantique')

@push('styles')
    <link rel="stylesheet" href="{{ asset ('css/user/histori.css')}}">
@endpush

@section('content')
    <!--Main Content-->
    <section class="main-content">
        <div class="container">
            @if(Auth::check())
                <h2>Histori Pesanan Saya</h2>
                @if ($orders->isEmpty())
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 text-center">
                            <h5 style="font-size: 24px; color: #D2B48C; font-weight: 600; font-family: 'Montserrat', sans-serif;">Anda belum memiliki pesanan.</h5>
                            <img src="{{ asset('img/histori2.png') }}" alt="No Orders" class="img-fluid mb-5" style="width: 40%">
                        </div>
                    </div>
                @else
                    @foreach ($orders as $order)
                        <div class="produk-container" data-url="{{ route('user.pesanan.detail', $order) }}">
                            @if ($order->items->isNotEmpty())
                                @php
                                    $item = $order->items->first();
                                @endphp
                                <div class="row produk-histori">
                                    <div class="col-md-4 nama-gambar">
                                        <img src="{{ asset($item->jenisCokelat->foto) }}" alt="{{ $item->jenisCokelat->foto }}" class="produk-img">
                                        <div class="produk-nama">
                                            <h5>{{ $item->jenisCokelat->nama }}</h5>
                                            <div class="produk-karakter">
                                                @foreach ($item->karakterItems as $index => $karakterItem)
                                                    @if ($index < 3) <!-- Menampilkan hanya 3 karakter pertama -->
                                                        <p>{{ $karakterItem->karakterCokelat->nama }}</p>
                                                    @endif
                                                @endforeach
                                                @if ($item->karakterItems->count() > 3) <!-- Jika ada lebih dari 3 karakter -->
                                                    <p>dan lainnya/p> <!-- Menampilkan "..." jika lebih dari 3 karakter -->
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 produk-harga">
                                        <p>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="col-md-4 status">
                                        @php
                                            $statusClass = 'status-' . strtolower($order->status);
                                        @endphp
                                        <p class="{{ $statusClass }}">{{ ucfirst(strtolower($order->status)) }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="row produk-total">
                                <div class="col total">
                                    <p class="total-label">Total</p>
                                    <p class="total-amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @else
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 text-center">
                        <img src="{{ asset('img/error.png') }}" alt="Error" class="img-fluid mb-5" style="max-width: 300px;">
                        <h5 style="color: #000; font-weight: 600; font-family: 'Montserrat', sans-serif;">Harap lakukan login terlebih dahulu untuk melihat histori pesanan anda</h5>
                        <a href="{{ route('user.login') }}" class="btn btn-login">Masuk Akun Yuk</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/histori.js')}}"></script>
@endpush