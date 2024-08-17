let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

// Konfirmasi Penghapusan
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');
    const deleteForms = document.querySelectorAll('form');
    console.log('Found forms:', deleteForms.length);
    deleteForms.forEach(form => {
        if (form.action.includes('delete_jenis')) {
            console.log('Found delete form:', form);
            form.addEventListener('submit', function(event) {
                console.log('Delete form submitted');
                const confirmed = confirm('Apakah Anda yakin ingin menghapus jenis cokelat ini?');
                if (!confirmed) {
                    console.log('Deletion cancelled');
                    event.preventDefault();
                } else {
                    console.log('Deletion confirmed');
                }
            });
        }
    });
});