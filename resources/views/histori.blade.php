@extends('layouts.app')

@section('title', 'Jenis Cokelat')

@push('styles')
    <link rel="stylesheet" href="{{ asset ('css/histori.css')}}">
@endpush

@section('content')
   <!--Main Content-->
    <section class="main-content">
        <div class="container">
            <h2>Keranjang Saya</h2>
            <div class="cart-item d-flex align-items-center justify-content-between p-3 mb-3">
                <div class="left d-flex align-items-center">
                    <div class="cart-info d-flex align-items-start">
                        <div class="cart-img me-3">
                            <img src="img/jenis_cokelat/kiloan.PNG" alt="Cokelat Box" class="cart-img">
                        </div>
                        <div>
                            <h5>Cokelat Box (28 sekat)</h5>
                            <p>Robocar Poli</p>
                            <p>Teks</p>
                        </div>
                    </div>
                </div>
                <div class="cart-quantity me-3 align-self-center">
                    <p>1</p>
                </div>
                <div class="cart-price me-3">
                    <p>Rp 168.000</p>
                </div>
                <div class="cart-total">
                    <p>Total</p>
                    <p>Rp 135.000</p>
                </div>
            </div>
        </div>
    </section>
@endsection

