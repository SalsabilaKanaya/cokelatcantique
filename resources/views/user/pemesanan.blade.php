@extends('user.layouts.app_pemesanan')
@extends('user.partials.navbar_pemesanan')

@section('title', 'Checkout - Cokelat Cantique')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/pemesanan.css') }}">
@endpush

@section('content')
   <!-- MAIN -->
    <section class="main-content">
        <div class="container">
            @if(Auth::check())
                <div class="row mt-5 d-flex justify-content-center">
                    <div class="col-12">
                        <ul id="progress-tracker" class="progress-tracker">
                            <li class="active step0 text-progress"><i class="icon-progress fa-solid fa-gift"></i>Pilih Jenis Cokelat</li>
                            <li class="active step0 text-progress"><i class="icon-progress fa-solid fa-cookie-bite"></i>Pilih Karakter Cokelat</li>
                            <li class="active step0 text-progress"><i class="icon-progress fa-solid fa-money-bill"></i>Checkout dan Payment</li>
                        </ul>
                    </div>
                </div>
                <div class="row content mt-3 d-flex">
                    <div class="col-md-8">
                        <div class="produk-order">
                            <div class="produk-title">
                                <h5>Produk Dipesan</h5>
                            </div>
                            <div class="produk-list">
                                <!-- Tampilkan detail jenis cokelat -->
                                @foreach($jenisCokelat as $jenis)
                                    <div class="produk-item d-flex">
                                        <div class="produk-info">
                                            <img src="{{ asset($jenis->foto) }}" alt="{{ $jenis->nama }}" class="produk-img">
                                            <div class="produk-isi">
                                                <h5>{{ $jenis->nama }}</h5>
                                                <!-- Tampilkan karakter-karakter yang dipilih -->
                                                @if(isset($selectedKarakter[$jenis->id]))
                                                    @foreach($selectedKarakter[$jenis->id] as $karakter)
                                                        <p>{{ $karakter['nama'] }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <p class="price" style="font-size: 18px; color: #000; font-weight: 700; font-family: 'Montserrat', sans-serif;">
                                            Rp {{ number_format($jenis->harga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Form untuk catatan dan tanggal pengiriman -->
                            <form action="#" method="POST" id="order-form">
                                @csrf
                                <div class="row note-date mt-3">
                                    <div class="col-md-6">
                                        <label for="notes">Catatan Lainnya (Optional)</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea> 
                                    </div>
                                    <div class="col-md-6">
                                        <label for="delivery_date">Tanggal Pengiriman</label>
                                        <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                                        <p>Masukkan tanggal pengiriman 7 hari sebelum digunakan</p>
                                    </div>
                                </div>
                            </form>
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
                                <div class="courier-options" id="courier-options">
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
                                <p style="font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 500;">Available Service</p> 
                                <ul class="list-group-item list-group-flush available-services" style="display: none">
                                </ul>
                            </div>
                        </div>
                        <div class="payment form-group mt-3">
                            <div class="payment-title">
                                <h5>Pembayaran</h5>
                            </div>
                            <div class="row pilihan-pembayaran align-items-center">
                                <div class="col-md-12 d-flex align-items-center"> 
                                    <img src="{{ asset('img/bni.png')}}" alt="" width="15%" class="me-3"> 
                                    <div class="text">
                                        <p class="jenis-pembayaran">BNI</p>
                                        <p class="nomor">0197108113</p>
                                        <p class="nama">Atas nama: Eliyana Candra</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 pilihan-pembayaran align-items-center">
                                <div class="col-md-12 d-flex align-items-center"> 
                                    <img src="{{ asset('img/bca.png')}}" alt="" width="15%" class="me-3"> 
                                    <div class="text">
                                        <p class="jenis-pembayaran">BCA</p>
                                        <p class="nomor">742 5090968</p>
                                        <p class="nama">Atas nama: Eliyana Candra</p>
                                    </div>
                                </div>
                            </div>
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
                            <div class="d-flex justify-content-between">
                                <button type="button" id="cancel-btn" class="btn btn-cancel mt-3">Batal</button>
                                <button type="submit" id="submit-btn" class="btn btn-pesan mt-3" data-url="{{ route('user.order.store') }}" disabled>Pesan Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <script>
                    window.location.href = "{{ route('user.login') }}";
                </script>
            @endif
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
                            Swal.fire({
                                title: 'Success!',
                                text: 'Pesanan berhasil dibuat!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var redirectUrl = "{{ route('user.histori') }}";
                                    window.location.href = redirectUrl;
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan: ' + response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
    
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', {
                            status: status,
                            error: error,
                            response: xhr.responseText // Log response text from server
                        });
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan. Coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $('#cancel-btn').on('click', function() {
                $.ajax({
                    url: "{{ route('user.clearSession') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'Session cleared') {
                            window.location.href = "{{ route('beranda') }}"; // Ganti dengan rute yang sesuai
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal menghapus session',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', {
                            status: status,
                            error: error,
                            response: xhr.responseText // Log response text from server
                        });
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menghapus session',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
            function checkFormValidity() {
                const deliveryDate = $('#delivery_date').val();
                const courierSelected = $('input[name="courier_code"]:checked').length > 0;
                const paymentProof = $('#payment-proof').val();
                const packageSelected = $('input[name="delivery_package"]:checked').length > 0;

                // Aktifkan tombol jika semua input valid
                if (deliveryDate && courierSelected && paymentProof && packageSelected) {
                    $('#submit-btn').prop('disabled', false);
                } else {
                    $('#submit-btn').prop('disabled', true);
                }
            }

            // Event listeners untuk memeriksa input
            $('#delivery_date').on('change', checkFormValidity);
            $('input[name="courier_code"]').on('change', checkFormValidity);
            $('#payment-proof').on('change', checkFormValidity);
            $('input[name="delivery_package"]').on('change', checkFormValidity);
        });
    </script>    
    <script src="{{ asset('js/user/main.js') }}"></script>
@endpush