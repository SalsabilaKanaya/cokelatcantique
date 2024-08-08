document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.btn-simpan').addEventListener('click', function() {
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
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
