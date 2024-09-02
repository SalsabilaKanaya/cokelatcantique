// Mendapatkan elemen sidebar dan tombol sidebar dari DOM
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

// Menambahkan event listener pada tombol sidebar untuk toggle kelas 'active'
sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

// Konfirmasi Penghapusan dengan SweetAlert
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cokelatId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus jenis cokelat ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${cokelatId}`).submit();
                }
            });
        });
    });
});