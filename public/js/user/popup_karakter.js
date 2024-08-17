document.addEventListener('DOMContentLoaded', function() {
    const pilihButtons = document.querySelectorAll('.button-pilih');
    const pesanButtons = document.querySelectorAll('.button-pesan');
    const modalFoto = document.getElementById('modal-foto');
    const modalNama = document.getElementById('modal-nama');
    const quantitySpan = document.querySelector('.num');
    const textarea = document.getElementById('deskripsi');
    let currentKarakterId = null;

    pilihButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id');

            quantitySpan.textContent = '1';
            textarea.value = '';

            fetch(`/karakter_cokelat/details/${currentKarakterId}`)
                .then(response => response.json())
                .then(data => {
                    if (modalFoto && modalNama) {
                        if (data.foto) {
                            modalFoto.src = `/${data.foto}`;
                        }
                        modalNama.textContent = data.nama;
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
    });

    document.querySelector('.minus').addEventListener('click', function() {
        let currentQuantity = parseInt(quantitySpan.textContent);
        if (currentQuantity > 1) {
            quantitySpan.textContent = currentQuantity - 1;
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
                updateProgressBar();
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

        // Nonaktifkan tombol pilih jika progress sudah 100%
        if (progress >= 100) {
            pilihButtons.forEach(button => {
                button.classList.add('disabled');
                button.setAttribute('disabled', 'true');
            });
        } else {
            pilihButtons.forEach(button => {
                button.classList.remove('disabled');
                button.removeAttribute('disabled');
            });
        }

        // Nonaktifkan tombol pesan jika progress belum 100%
        if (progress < 100) {
            pesanButtons.forEach(button => {
                button.classList.add('disabled');
                button.setAttribute('disabled', 'true');
            });
        } else {
            pesanButtons.forEach(button => {
                button.classList.remove('disabled');
                button.removeAttribute('disabled');
            });
        }
    }

    // Check progress on page load
    updateProgressBar();
});
