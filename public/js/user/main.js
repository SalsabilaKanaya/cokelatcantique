$(function() {
    $('.courier_code').click(function() {
        let courier = $(this).val();
        let addressID = window.addressID; // Pastikan addressID sudah diinisialisasi
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Log data yang dikirimkan
        console.log('Mengirim data:', {
            address_id: addressID,
            courier: courier,
            _token: csrfToken
        });

        $.ajax({
            url: "/user/available_services",
            method: "POST",
            data: {
                address_id: addressID,
                courier: courier,
                _token: csrfToken
            },
            success: function(result) {
                console.log("Hasil respons:", result); // Tambahkan log untuk hasil respons
                $('.available-services').show();
                $('.available-services').html(result);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Log kesalahan dari AJAX
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
