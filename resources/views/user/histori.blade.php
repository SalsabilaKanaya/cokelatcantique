@extends('layouts.app')

@section('title', 'Jenis Cokelat')

@push('styles')
    <link rel="stylesheet" href="{{ asset ('css/user/histori.css')}}">
@endpush

@section('content')
    <!--Main Content-->
    <section class="main-content">
        <div class="container">
            <h2>Histori Pesanan Saya</h2>

            @foreach ($orders as $order)
                <div class="produk-container" data-url="{{ route('pesanan.detail', $order) }}">
                    @foreach ($order->items as $item)
                        <div class="row produk-histori">
                            <div class="col-md-6 nama-gambar">
                                <img src="{{ asset($item->jenisCokelat->foto) }}" alt="{{ $item->jenisCokelat->foto }}" class="produk-img">
                                <div class="produk-nama">
                                    <h5>{{ $item->jenisCokelat->nama }}</h5>
                                    <div class="produk-karakter">
                                        @foreach ($item->karakterItems as $karakterItem)
                                            <p>{{ $karakterItem->karakterCokelat->nama }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 produk-harga">
                                <p>Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="row produk-total">
                        <div class="col total">
                            <p class="total-label">Total</p>
                            <p class="total-amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/user/histori.js')}}"></script>
@endpush

