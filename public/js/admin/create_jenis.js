// Mendapatkan elemen sidebar dan tombol sidebar dari DOM
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

// Menambahkan event listener pada tombol sidebar untuk toggle kelas 'active'
sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

// Mengonfirmasi sebelum mengirimkan formulir
const form = document.querySelector('form');
form.addEventListener('submit', function (event) {
    const confirmSubmit = confirm('Apakah data sudah benar?'); // Menampilkan dialog konfirmasi
    if (!confirmSubmit) {
        event.preventDefault(); // Mencegah pengiriman formulir jika konfirmasi ditolak
    }
});

// Event listener ketika DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function() {

    // Mengonfirmasi sebelum mengirimkan formulir
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        const confirmSubmit = confirm('Apakah data sudah benar?'); // Menampilkan dialog konfirmasi
        if (!confirmSubmit) {
            event.preventDefault(); // Mencegah pengiriman formulir jika konfirmasi ditolak
        }
    });
    
    // Menambahkan event listener pada tombol cancel untuk kembali ke halaman sebelumnya
    const cancelButton = document.getElementById('cancelButton');
    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.history.back(); // Mengarahkan pengguna kembali ke halaman sebelumnya
        });
    }
});
