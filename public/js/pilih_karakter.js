document.addEventListener('DOMContentLoaded', function() {
    const btnSimpan = document.querySelector('.btn-simpan');
    let currentKarakterId = null;

    document.querySelectorAll('.button-pilih').forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id');
        });
    });

    btnSimpan.addEventListener('click', function() {
        if (!currentKarakterId) {
            console.error('currentKarakterId tidak didefinisikan.');
            return;
        }

        const jumlah = document.querySelector('.num').textContent;
        const catatan = document.getElementById('deskripsi').value;

        fetch('/store-selection', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                karakter_id: currentKarakterId,
                jumlah: jumlah,
                catatan: catatan
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                console.error('Gagal menyimpan data:', data);
            }
        })
        .catch(error => {
            console.error('Error saat menyimpan data:', error);
        });
    });
});
