let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-karakter-form');
    const cancelButton = document.getElementById('cancelButton');
    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.history.back();
        });
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah data sudah benar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, update!',
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
            }
        });
    });
});