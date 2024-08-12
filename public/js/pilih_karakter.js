document.addEventListener('DOMContentLoaded', function() {
    const btnSimpan = document.querySelector('.btn-simpan');
    let currentKarakterId = null;

    document.querySelectorAll('.button-pilih').forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id');
            console.log('Karakter ID yang dipilih:', currentKarakterId);
        });
    });

    btnSimpan.addEventListener('click', function() {
        console.log('Tombol Simpan diklik.');
        if (!currentKarakterId) {
            console.error('currentKarakterId tidak didefinisikan.');
            return;
        }

        const jumlah = document.querySelector('.num').textContent;
        const catatan = document.getElementById('deskripsi').value;
        console.log('Mengirim data untuk disimpan:', {
            karakter_id: currentKarakterId,
            jumlah: jumlah,
            catatan: catatan
        });

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
            console.log('Response dari server setelah menyimpan:', data);
            if (data.success) {
                console.log('Data berhasil disimpan.');
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
