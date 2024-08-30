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
                console.log('Redirecting to:', "{{ route('user.histori') }}"); // Log URL tujuan
                alert('Order berhasil disimpan!');
                window.location.href = "{{ route('user.histori') }}";
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