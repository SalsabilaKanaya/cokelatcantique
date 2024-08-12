document.addEventListener('DOMContentLoaded', function() {
    const pilihButtons = document.querySelectorAll('.button-pilih');
    const modalFoto = document.getElementById('modal-foto');
    const modalNama = document.getElementById('modal-nama');
    const quantitySpan = document.querySelector('.num');
    const textarea = document.getElementById('deskripsi');
    let currentKarakterId = null;

    pilihButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id');
            console.log('Karakter ID yang dipilih:', currentKarakterId);

            quantitySpan.textContent = '1';
            textarea.value = '';

            fetch(`/karakter_cokelat/${currentKarakterId}`)
                .then(response => response.json())
                .then(data => {
                    if (modalFoto && modalNama) {
                        if (data.foto) {
                            modalFoto.src = `/${data.foto}`;
                            console.log('Gambar ditemukan dan diubah:', modalFoto.src);
                        } else {
                            console.error('Gambar tidak ditemukan di data yang diterima.');
                        }
                        modalNama.textContent = data.nama;
                    } else {
                        console.error('Modal elemen tidak ditemukan.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching character data:', error);
                });
        });
    });

    document.querySelector('.plus').addEventListener('click', function() {
        let currentQuantity = parseInt(quantitySpan.textContent);
        quantitySpan.textContent = currentQuantity + 1;
        console.log('Jumlah kuantitas setelah tambah:', quantitySpan.textContent);
    });

    document.querySelector('.minus').addEventListener('click', function() {
        let currentQuantity = parseInt(quantitySpan.textContent);
        if (currentQuantity > 1) {
            quantitySpan.textContent = currentQuantity - 1;
            console.log('Jumlah kuantitas setelah kurang:', quantitySpan.textContent);
        }
    });

    document.querySelector('.btn-simpan').addEventListener('click', function() {
        if (!currentKarakterId) {
            console.error('currentKarakterId tidak didefinisikan.');
            return;
        }

        let karakter = {
            id: currentKarakterId,
            jumlah: quantitySpan.textContent,
            catatan: textarea.value
        };
        console.log('Data karakter yang akan disimpan:', karakter);

        fetch('/store-selection', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                karakter_id: currentKarakterId,
                jumlah: karakter.jumlah,
                catatan: karakter.catatan
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Data berhasil disimpan, mengupdate progress bar.');
                updateProgressBar();
                window.location.href = '/pilih-karakter';  // Redirect ke halaman "Pilih Karakter"
            } else {
                console.error('Gagal menyimpan data:', data);
            }
        })
        .catch(error => {
            console.error('Error saat menyimpan data:', error);
        });
    });

    function updateProgressBar() {
        fetch('/get-progress')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const progressBar = document.getElementById('progress-bar');
                    progressBar.style.width = data.progress + '%';
                    progressBar.textContent = data.progress + '%';
                    checkProgress();
                }
            });
    }

    function checkProgress() {
        const progressBar = document.getElementById('progress-bar');
        const progress = parseFloat(progressBar.style.width);

        // Nonaktifkan tombol jika progress sudah 100%
        if (progress >= 100) {
            pilihButtons.forEach(button => {
                button.classList.add('disabled');
                button.setAttribute('disabled', 'true');
            });
        }
    }

    // Check progress on page load
    checkProgress();
});
