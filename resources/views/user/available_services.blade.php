<li class="list-group-item py-3 border-top fw-bold">
    <div class="row align-items-center">
        <div class="col-2 col-md-2 col-lg-2"></div>
        <div class="col-4 col-md-4 col-lg-5" style="font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 600;">
            Service
        </div>
        <div class="col-3 col-md-2 col-lg-2" style="font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 600;">
            Estimate
        </div>
        <div class="col-3 text-lg-end text-start text-md-end col-md-3" style="font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 600;">
            Cost
        </div>
    </div>
</li>
@forelse ($services as $service)
    <li class="list-group-item py-3">
        <div class="row align-items-center">
            <div class="col-2 col-md-2 col-lg-2">
                @php
                    $serviceName = $service['service'];
                    $courier = $service['courier'];
                    $addressID = $service['address_id'];
                @endphp
                <input class="form-check-input delivery-package" type="radio" name="delivery_package" id="inlineRadio2" value="{{ $service['service'] }}" onclick="setShippingFee('{{ $serviceName}}', '{{ $courier}}', '{{ $addressID }}')">
            </div>
            <div class="col-4 col-md-4 col-lg-5" style="font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 400;">
                {{ $service['service'] }} - {{ $service['description'] }}
            </div>
            <div class="col-3 col-md-2 col-lg-2" style="font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 400;">
                {{ $service['etd'] }}
            </div>
            <div class="col-3 text-lg-end text-start text-md-end col-md-3" style="font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 700;">
                <span class="fw-bold">IDR {{ $service['cost'] }}</span>
            </div>
        </div>
    </li>
@empty
    <li class="list-group-item py-3">
        <span class="text-danger">No delivery service found, try another courier</span>
    </li>
@endforelse

<script type="text/javascript">
    // Fungsi untuk mengatur biaya pengiriman berdasarkan paket, kurir, dan ID alamat
    function setShippingFee(deliveryPackage, courier, addressID) {
        $.ajax({
            url: "/user/choose-package", // URL endpoint untuk request AJAX
            method: "POST", // Metode HTTP yang digunakan untuk request
            data: {
                delivery_package: deliveryPackage, // Paket pengiriman yang dipilih
                courier: courier, // Kurir yang dipilih
                address_id: addressID, // ID alamat pengiriman
                _token: $('meta[name="csrf-token"]').attr('content'), // Token CSRF untuk keamanan
            },
            success: function (result) {
                // Fungsi yang dijalankan jika request AJAX berhasil
                // Memperbarui elemen HTML dengan hasil dari server
                $('#shipping-cost').html("Rp " + result.shipping_fee); // Menampilkan biaya pengiriman
                $('#jumlah-harga').html("Rp " + result.total_price); // Menampilkan harga total

                // Mengatur nilai input tersembunyi untuk pengiriman data ke server
                $('#delivery_package').val(deliveryPackage); // Menyimpan paket pengiriman ke input tersembunyi
                $('#shipping_cost').val(result.shipping_fee.replace(/\D/g, '')); // Menghapus karakter non-digit dari biaya pengiriman
                $('#total_price').val(result.total_price.replace(/\D/g, '')); // Menghapus karakter non-digit dari harga total
            },
            error: function (e) {
                // Fungsi yang dijalankan jika terjadi kesalahan pada request AJAX
                console.error("Terjadi kesalahan: ", e); // Menampilkan kesalahan di console
            }
        });
    }
</script>


