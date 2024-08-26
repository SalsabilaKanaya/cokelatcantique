document.addEventListener('DOMContentLoaded', function() {
    const pilihButtons = document.querySelectorAll('.button-pilih'); // Tombol untuk memilih karakter
    const pesanButtons = document.querySelectorAll('.button-pesan'); // Tombol untuk memesan karakter
    const modalFoto = document.getElementById('modal-foto'); // Elemen gambar dalam modal untuk menampilkan foto karakter
    const modalNama = document.getElementById('modal-nama'); // Elemen teks dalam modal untuk menampilkan nama karakter
    const quantitySpan = document.querySelector('.num'); // Elemen untuk menampilkan jumlah karakter yang dipilih
    const textarea = document.getElementById('deskripsi'); // Textarea untuk menulis catatan tentang karakter
    let currentKarakterId = null; // Variabel untuk menyimpan ID karakter yang sedang dipilih

    // Menambahkan event listener pada setiap tombol pilih karakter
    pilihButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id'); // Mendapatkan ID karakter dari atribut tombol yang diklik

            quantitySpan.textContent = '1'; // Mengatur jumlah awal menjadi 1
            textarea.value = ''; // Mengosongkan textarea catatan

            // Mengambil data karakter berdasarkan ID dan menampilkan di modal
            fetch(`/user/karakter_cokelat/details/${currentKarakterId}`)
                .then(response => response.json())
                .then(data => {
                    if (modalFoto && modalNama) {
                        if (data.foto) {
                            modalFoto.src = `/${data.foto}`; // Menampilkan foto karakter dalam modal
                        }
                        modalNama.textContent = data.nama; // Menampilkan nama karakter dalam modal
                    }
                })
                .catch(error => {
                    console.error('Error fetching character data:', error); // Menampilkan error jika terjadi masalah saat mengambil data
                });
        });
    });

    // Event listener untuk tombol tambah jumlah karakter
    document.querySelector('.plus').addEventListener('click', function() {
        let currentQuantity = parseInt(quantitySpan.textContent); // Mendapatkan jumlah karakter saat ini
        quantitySpan.textContent = currentQuantity + 1; // Menambah jumlah karakter
    });

    // Event listener untuk tombol kurangi jumlah karakter
    document.querySelector('.minus').addEventListener('click', function() {
        let currentQuantity = parseInt(quantitySpan.textContent); // Mendapatkan jumlah karakter saat ini
        if (currentQuantity > 1) {
            quantitySpan.textContent = currentQuantity - 1; // Mengurangi jumlah karakter jika lebih dari 1
        }
    });

    // Event listener untuk tombol simpan pilihan karakter
    document.querySelector('.btn-simpan').addEventListener('click', function() {
        if (!currentKarakterId) {
            console.error('currentKarakterId tidak didefinisikan.'); // Menampilkan error jika ID karakter belum didefinisikan
            return;
        }

        let karakter = {
            id: currentKarakterId, // ID karakter yang dipilih
            jumlah: quantitySpan.textContent, // Jumlah karakter yang dipilih
            catatan: textarea.value // Catatan tentang karakter
        };

        // Mengirim data pilihan karakter ke server untuk disimpan
        fetch('/user/store-selection', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Mengatur header konten tipe sebagai JSON
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Menambahkan token CSRF
            },
            body: JSON.stringify({
                karakter_id: currentKarakterId, // Mengirim ID karakter
                jumlah: karakter.jumlah, // Mengirim jumlah karakter
                catatan: karakter.catatan // Mengirim catatan karakter
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateProgressBar(); // Memperbarui progress bar jika data berhasil disimpan
            } else {
                console.error('Gagal menyimpan data:', data); // Menampilkan error jika gagal menyimpan data
            }
        })
        .catch(error => {
            console.error('Error saat menyimpan data:', error); // Menampilkan error jika terjadi masalah saat menyimpan data
        });
    });

    // Fungsi untuk memperbarui progress bar
    function updateProgressBar() {
        fetch('/user/get-progress')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const progressBar = document.getElementById('progress-bar'); // Mengambil elemen progress bar
                    progressBar.style.width = data.progress + '%'; // Mengatur lebar progress bar sesuai dengan progress
                    progressBar.textContent = data.progress + '%'; // Menampilkan persentase progress
                    checkProgress(); // Memeriksa apakah progress sudah mencapai 100%
                }
            });
    }

    // Fungsi untuk memeriksa progress dan mengatur status tombol
    function checkProgress() {
        const progressBar = document.getElementById('progress-bar'); // Mengambil elemen progress bar
        const progress = parseFloat(progressBar.style.width); // Mendapatkan nilai progress dari lebar progress bar

        // Nonaktifkan tombol pilih jika progress sudah 100%
        if (progress >= 100) {
            pilihButtons.forEach(button => {
                button.classList.add('disabled'); // Menambahkan kelas 'disabled' ke tombol pilih
                button.setAttribute('disabled', 'true'); // Menonaktifkan tombol pilih
            });
        } else {
            pilihButtons.forEach(button => {
                button.classList.remove('disabled'); // Menghapus kelas 'disabled' dari tombol pilih
                button.removeAttribute('disabled'); // Mengaktifkan kembali tombol pilih
            });
        }

        // Nonaktifkan tombol pesan jika progress belum 100%
        if (progress < 100) {
            pesanButtons.forEach(button => {
                button.classList.add('disabled'); // Menambahkan kelas 'disabled' ke tombol pesan
                button.setAttribute('disabled', 'true'); // Menonaktifkan tombol pesan
            });
        } else {
            pesanButtons.forEach(button => {
                button.classList.remove('disabled'); // Menghapus kelas 'disabled' dari tombol pesan
                button.removeAttribute('disabled'); // Mengaktifkan kembali tombol pesan
            });
        }
    }

    // Memeriksa progress saat halaman dimuat
    updateProgressBar();
});
