@extends('user.layouts.app')

@section('title', 'Keranjang Saya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/keranjang.css')}}">
@endpush

@section('content')
   <!-- Main Content -->
    <section class="main-content">
        <div class="container">
            @if(Auth::check())
                <h2>Keranjang Saya</h2>
                <form action="{{ route('user.cart_process') }}" method="POST">
                    @csrf
                    @if($cart && $cart->items->count() > 0)
                        @foreach($cart->items as $cartItem)
                            <div class="cart-item d-flex align-items-center justify-content-between p-3 mb-3" data-item-id="{{ $cartItem->id }}">
                                <div class="left d-flex align-items-center">
                                    <input type="checkbox" name="selected_items[]" value="{{ $cartItem->id }}" class="form-check-input me-3">
                                    <div class="cart-info d-flex align-items-start">
                                        <div class="cart-img me-3">
                                            <img src="{{ asset($cartItem->jenisCokelat->foto) }}" alt="{{ $cartItem->jenisCokelat->foto }}" class="cart-img">
                                        </div>
                                        <div>
                                            <h5>{{ $cartItem->jenisCokelat->nama }}</h5>

                                            @foreach($cartItem->karakterItems as $karakterItem)
                                            <p> {{ $karakterItem->karakterCokelat->nama }} ({{ $karakterItem->quantity }})</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="right d-flex align-items-center">
                                    <div class="cart-price me-3">
                                        <p>Rp {{ number_format($cartItem->price, 0, ',', '.') }}</p>
                                    </div>
                                    <button type="button" class="btn btn-delete" data-item-id="{{ $cartItem->id }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-pesan">Pesan</button>
                        </div>
                    @else
                        <div class="cart-kosong">
                            <h5>Keranjang Anda Kosong.</h5>
                            <img src="{{ asset('img/cart.PNG')}}" alt="" width="40%" class="mt-0">
                        </div>
                    @endif
                </form>
            @else
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 text-center">
                        <img src="{{ asset('img/error.png') }}" alt="Error" class="img-fluid mb-5" style="max-width: 300px;">
                        <h5 style="color: #000; font-weight: 600; font-family: 'Montserrat', sans-serif;">Harap lakukan login terlebih dahulu untuk melihat keranjang anda</h5>
                        <a href="{{ route('user.login') }}" class="btn btn-login">Login</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const cartItemElement = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Item ini akan dihapus dari keranjang!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('{{ route('user.cart_delete') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ item_id: itemId })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    cartItemElement.remove();
                                    Swal.fire(
                                        'Dihapus!',
                                        data.message,
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        data.message,
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat menghapus item dari keranjang.',
                                    'error'
                                );
                            });
                        }
                    });
                });
            });
        });
    </script>
@endpush