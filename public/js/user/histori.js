document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.produk-container').forEach(container => {
        container.addEventListener('click', () => {
            window.location.href = container.getAttribute('data-url');
        });
    });
});
