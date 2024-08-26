// Mendapatkan elemen sidebar dan tombol sidebar dari DOM
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

// Menambahkan event listener pada tombol sidebar untuk toggle kelas 'active'
sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

// Event listener ketika DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Menambahkan event listener pada tombol cancel untuk kembali ke halaman sebelumnya
    const cancelButton = document.getElementById('cancelButton');
    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.history.back(); // Mengarahkan pengguna kembali ke halaman sebelumnya
        });
    }
});
