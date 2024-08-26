@extends('user.layouts.app')
@extends('user.partials.navbar_pemesanan')

@section('title', 'Jenis Cokelat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/pemesanan.css')}}">
@endpush

@section('content')
   <!-- MAIN -->
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="javascript:history.back()" class="btn button-back"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <div class="row content mt-3 d-flex">
                <div class="col-md-8">
                    <div class="produk-order">
                        <div class="produk-title">
                            <h5>Produk Dipesan</h5>
                        </div>
                        @if(isset($order))
                            <div class="produk-list">
                                @if($orderItems->isEmpty())
                                    <p>Belum ada produk yang dipesan.</p>
                                @else
                                    @foreach($orderItems as $orderItem)
                                        <div class="produk-item d-flex">
                                            <div class="produk-info">
                                                <img src="{{ asset($orderItem->jenisCokelat->foto) }}" alt="{{ $orderItem->jenisCokelat->nama }}" class="produk-img">
                                                <div class="produk-isi">
                                                    <h5>{{ $orderItem->jenisCokelat->nama }}</h5>
                                                    @foreach($orderItem->karakterItems as $karakterItem)
                                                        <p>{{ $karakterItem->karakterCokelat->nama }}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <p class="price"style="font-size: 18px; color: #000; font-weight: 700; font-family: 'Montserrat', sans-serif;">Rp {{ number_format($orderItem->price, 0, ',', '.') }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <form action="#" method="POST" id="order-form">
                                @csrf
                                <div class="row note-date mt-3">
                                    <div class="col-md-6">
                                        <label for="notes">Catatan Lainnya</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3" required></textarea> 
                                    </div>
                                    <div class="col-md-6">
                                        <label for="delivery_date" >Tanggal Pengiriman</label>
                                        <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                                        <p>Masukkan tanggal pengiriman 7 hari sebelum digunakan</p>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="alamat-pengiriman">
                        <div class="address-title">
                            <i class="fa-solid fa-location-dot icon-spacing"></i>
                            <h5>Alamat Pengiriman</h5>
                        </div>
                        @if(isset($userAddress))
                            <div class="row mt-3 address-detail">
                                <div class="col-md-4 name-phone">
                                    <p>{{ $userAddress->name }}</p>
                                    <p>{{ $userAddress->phone }}</p>
                                </div>
                                <div class="col-md-8 address">
                                    <p>{{ $userAddress->address }}, {{ $userAddress->city_name }}, {{ $userAddress->province_name }}</p>
                                </div>
                            </div>
                        @endif  
                    </div>
                    <div class="jasa-pengiriman">
                        <div class="courier-title">
                            <i class="fa-solid fa-truck icon-spacing"></i>
                            <h5>Pilih Kurir</h5>
                        </div>
                        <form id="courier-form" action="{{ route('user.shippingfee') }}" method="POST">
                            @csrf
                            <div id="courier-options">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input courier_code" type="radio" name="courier_code" id="jne" value="jne">
                                    <label class="form-check-label" for="jne">JNE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input courier_code" type="radio" name="courier_code" id="tiki" value="tiki">
                                    <label class="form-check-label" for="tiki">Tiki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input courier_code" type="radio" name="courier_code" id="pos" value="pos">
                                    <label class="form-check-label" for="pos">POS</label>
                                </div>
                            </div>
                        </form>
                        <div class="courier-cost">
                            <p>Available Service</p> 
                            <ul class="list-group-item list-group-flush available-services" style="display: none">
                            </ul>
                        </div>
                    </div>
                    <div class="payment form-group mt-3">
                        <div class="payment-title">
                            <h5>Pembayaran</h5>
                        </div>
                        <table class="table jenis-pembayaran mt-3">
                            <thead>
                                <tr>
                                    <th>Jenis Pembayaran</th>
                                    <th>No Rekening</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BNI</td>
                                    <td>1234567890</td> <!-- Ganti dengan nomor rekening yang sesuai -->
                                </tr>
                                <tr>
                                    <td>BRI</td>
                                    <td>1234567890</td> <!-- Ganti dengan nomor rekening yang sesuai -->
                                </tr>
                                <tr>
                                    <td>DANA</td>
                                    <td>081380260922</td> <!-- Ganti dengan nomor rekening yang sesuai -->
                                </tr>
                            </tbody>
                        </table>
                        <div class="upload-bukti mt-4">
                            <h6>Unggah Bukti Pembayaran</h6>
                            <form action="/upload-proof" method="POST" enctype="multipart/form-data">
                                @csrf <!-- Untuk menghindari CSRF attack -->
                                <div class="form-group">
                                    <label for="payment-proof" class="form-label">Pilih File</label>
                                    <input type="file" class="form-control" name="payment_proof" id="payment-proof" accept="image/*,application/pdf"required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="jumlah-pembayaran">
                        <h5>Jumlah Pembayaran</h5>
                        <hr>
                        <div class="total-harga">
                            <p class="text">Subtotal</p>
                            <p class="harga">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                        </div>
                        <div class="total-harga">
                            <p class="text">Delivery</p>
                            <p class="harga" id="shipping-cost">
                                @if(isset($shippingCost))
                                    Rp {{ number_format($shippingCost, 0, ',', '.') }}
                                @else
                                    Rp 0
                                @endif
                            </p>
                        </div>
                        <div class="jumlah-harga">
                            <p class="text">Total</p>
                            <p class="harga" id="jumlah-harga">Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </div>
                        <button type="submit" id="submit-btn" class="btn btn-pesan mt-3" data-url="{{ route('user.order.store') }}">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        window.addressID = @json($userAddress ? $userAddress->id : null);
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#submit-btn').on('click', function(e) {
                e.preventDefault();
    
                // Ambil URL dari data attribute atau meta tag
                var url = $(this).data('url') || $('meta[name="order-store-url"]').attr('content');
                console.log('Submitting form to URL:', url); // Log URL
    
                // Buat objek FormData untuk mengumpulkan data dari form
                var formData = new FormData();
                
                // Tambahkan note dan delivery_date ke FormData
                formData.append('notes', $('#notes').val());
                formData.append('delivery_date', $('#delivery_date').val());
    
                // Tambahkan payment_proof ke FormData jika ada
                var paymentProof = $('#payment-proof')[0].files[0];
                if (paymentProof) {
                    formData.append('payment_proof', paymentProof);
                }
    
                // Mengirimkan data menggunakan AJAX
                $.ajax({
                    url: url, // Menggunakan URL yang diambil
                    type: "POST",
                    data: formData,
                    processData: false,  // Jangan memproses data
                    contentType: false,  // Jangan menetapkan tipe konten
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },            
                    success: function(response) {
                        console.log('Response received:', response);
                        if (response.success) {
                            alert('Order berhasil disimpan!');
                            var redirectUrl = "{{ route('user.histori') }}";
                            window.location.href = redirectUrl;
                        } else {
                            alert('Terjadi kesalahan: ' + response.message);
                        }
                    },
    
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', {
                            status: status,
                            error: error,
                            response: xhr.responseText // Log response text from server
                        });
                        alert('Terjadi kesalahan. Coba lagi.');
                    }
                });
            });
        });
    </script>    
    <script src="{{ asset('js/user/main.js')}}"></script>
@endpush