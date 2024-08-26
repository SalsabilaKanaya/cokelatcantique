document.addEventListener('DOMContentLoaded', function() {
    const btnSimpan = document.querySelector('.btn-simpan'); // Tombol untuk menyimpan pilihan karakter
    let currentKarakterId = null; // Variabel untuk menyimpan ID karakter yang sedang dipilih

    // Menambahkan event listener pada setiap tombol pilih karakter
    document.querySelectorAll('.button-pilih').forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id'); // Mendapatkan ID karakter dari atribut tombol yang diklik
        });
    });

    // Event listener untuk tombol simpan
    btnSimpan.addEventListener('click', function() {
    
        const jumlah = document.querySelector('.num').textContent; // Mendapatkan jumlah karakter yang dipilih
        const catatan = document.getElementById('deskripsi').value; // Mendapatkan catatan tentang karakter yang dipilih
    
        // Mengirim data pilihan karakter ke server untuk disimpan
        fetch('/user/store-selection', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Mengatur header konten tipe sebagai JSON
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Menambahkan token CSRF
            },
            body: JSON.stringify({
                karakter_id: currentKarakterId, // Mengirim ID karakter
                jumlah: jumlah, // Mengirim jumlah karakter
                catatan: catatan // Mengirim catatan karakter
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Memuat ulang halaman jika data berhasil disimpan
            } else {
                console.error('Gagal menyimpan data:', data); // Menampilkan error jika gagal menyimpan data
            }
        })
        .catch(error => {
            console.error('Error saat menyimpan data:', error); // Menampilkan error jika terjadi masalah saat menyimpan data
        });
    });
});
