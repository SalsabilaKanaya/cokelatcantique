document.addEventListener('DOMContentLoaded', function() {
    const pilihButtons = document.querySelectorAll('.button-pilih');
    const modalFoto = document.getElementById('modal-foto');
    const modalNama = document.getElementById('modal-nama');
    const quantitySpan = document.querySelector('.num');
    const textarea = document.getElementById('deskripsi');
    let currentKarakterId;

    pilihButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentKarakterId = this.getAttribute('data-id');

            fetch(`/karakter_cokelat/${currentKarakterId}`)
                .then(response => response.json())
                .then(data => {
                    modalFoto.src = `/storage/${data.foto}`;
                    modalNama.textContent = data.nama;
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
        // Implement saving to cart or order logic here
        console.log('Catatan:', textarea.value);
        console.log('Jumlah:', quantitySpan.textContent);
    });
});
