// Mendapatkan elemen sidebar dan tombol sidebar dari DOM
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

// Menambahkan event listener pada tombol sidebar untuk toggle kelas 'active'
sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

// Mengonfirmasi sebelum mengirimkan formulir
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('create-jenis-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah data sudah benar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'swal2-popup',
                title: 'swal2-title',
                confirmButton: 'swal2-confirm',
                cancelButton: 'swal2-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire({
                    title: 'Data berhasil dibuat!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        confirmButton: 'swal2-confirm'
                    }
                });
            }
        });
    });

    const cancelButton = document.getElementById('cancelButton');
    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.history.back();
        });
    }
});