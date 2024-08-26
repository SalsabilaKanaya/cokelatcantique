$(function() {
    // Ketika elemen dengan class 'courier_code' diklik
    $('.courier_code').click(function() {
        // Mengambil nilai dari elemen yang diklik (misalnya, kode kurir)
        let courier = $(this).val();
        
        // Mengambil ID alamat dari variabel global window.addressID
        let addressID = window.addressID; // Pastikan addressID sudah diinisialisasi
        
        // Mengambil token CSRF dari meta tag
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        console.log('Mengirim data:', {
            address_id: addressID,
            courier: courier,
            _token: csrfToken
        });

        // Mengirim permintaan AJAX ke server
        $.ajax({
            // URL endpoint yang akan diakses
            url: "/user/available_services",
            method: "POST",
            // Data yang akan dikirimkan ke server
            data: {
                address_id: addressID,
                courier: courier,
                _token: csrfToken
            },
            
            // Fungsi yang dipanggil jika permintaan berhasil
            success: function(result) {
                console.log("Hasil respons:", result);
                // Menampilkan elemen dengan class 'available-services' jika tersembunyi
                $('.available-services').show();
                // Mengisi konten elemen 'available-services' dengan hasil dari server
                $('.available-services').html(result);
            },
            
            // Fungsi yang dipanggil jika terjadi kesalahan selama permintaan
            error: function(jqXHR, textStatus, errorThrown) {
                // Log kesalahan dari AJAX untuk debugging
                console.error('Kesalahan AJAX:', {
                    status: jqXHR.status,
                    statusText: textStatus,
                    error: errorThrown,
                    responseText: jqXHR.responseText
                });
            }
        });
    });
});
