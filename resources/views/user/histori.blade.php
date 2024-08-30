@extends('user.layouts.app')

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
                                        @foreach ($item->karakterItems as $karakterItem)
                                            <p>{{ $karakterItem->karakterCokelat->nama }}</p>
                                        @endforeach
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
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/histori.js')}}"></script>
@endpush