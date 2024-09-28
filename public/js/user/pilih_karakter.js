document.addEventListener('DOMContentLoaded', function() {
    const btnSimpan = document.querySelector('.btn-simpan'); // Tombol untuk menyimpan pilihan karakter
    let currentKarakterId = null; // Variabel untuk menyimpan ID karakter yang sedang dipilih

    // Menambahkan event listener pada setiap tombol pilih karakter
    document.querySelectorAll('.button-pilih').forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id'); // Mendapatkan ID karakter dari atribut tombol yang diklik
        });
    });

    // Pastikan btnSimpan ada sebelum menambahkan event listener
    if (btnSimpan) {
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
    } else {
        console.error('Element .btn-simpan tidak ditemukan di DOM.');
    }

    // Menambahkan event listener untuk tombol hapus
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const karakterId = this.getAttribute('data-id');
            const form = this.closest('.delete-form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Karakter ini akan dihapus dari pilihan Anda!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Mengirim form jika pengguna mengkonfirmasi
                }
            });
        });
    });
});