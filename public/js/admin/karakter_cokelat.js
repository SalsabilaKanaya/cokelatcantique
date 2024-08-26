// Mendapatkan elemen sidebar dan tombol sidebar dari DOM
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

// Menambahkan event listener pada tombol sidebar untuk toggle kelas 'active'
sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

// Konfirmasi Penghapusan
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed'); // Log saat DOM selesai dimuat dan diparsing
    const deleteForms = document.querySelectorAll('form'); // Mendapatkan semua elemen form
    console.log('Found forms:', deleteForms.length); // Log jumlah form yang ditemukan
    deleteForms.forEach(form => {
        // Mengecek apakah action form mengandung 'delete_karakter'
        if (form.action.includes('delete_jenis')) {
            console.log('Found delete form:', form); // Log form penghapusan yang ditemukan
            form.addEventListener('submit', function(event) {
                console.log('Delete form submitted'); // Log saat form penghapusan disubmit
                const confirmed = confirm('Apakah Anda yakin ingin menghapus jenis cokelat ini?'); // Menampilkan dialog konfirmasi
                if (!confirmed) {
                    console.log('Deletion cancelled'); // Log jika penghapusan dibatalkan
                    event.preventDefault(); // Mencegah pengiriman form jika konfirmasi ditolak
                } else {
                    console.log('Deletion confirmed'); // Log jika penghapusan dikonfirmasi
                }
            });
        }
    });
});
