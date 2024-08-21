document.addEventListener('DOMContentLoaded', function() {
    const btnSimpan = document.querySelector('.btn-simpan');
    let currentKarakterId = null;

    document.querySelectorAll('.button-pilih').forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id');
        });
    });

    btnSimpan.addEventListener('click', function() {
    
        const jumlah = document.querySelector('.num').textContent;
        const catatan = document.getElementById('deskripsi').value;
    
        fetch('/user/store-selection', {
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
                location.reload(); // Tambahkan baris ini untuk reload halaman
            } else {
                console.error('Gagal menyimpan data:', data);
            }
        })
        .catch(error => {
            console.error('Error saat menyimpan data:', error);
        });
    });
});
