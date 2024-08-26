document.addEventListener('DOMContentLoaded', () => {
    // Menambahkan event listener ke semua elemen dengan kelas 'produk-container'
    document.querySelectorAll('.produk-container').forEach(container => {
        container.addEventListener('click', () => {
            // Ketika elemen diklik, redirect ke URL yang ada di atribut 'data-url'
            window.location.href = container.getAttribute('data-url');
        });
    });
});
