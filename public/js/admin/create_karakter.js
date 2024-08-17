let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

// Confirm before submitting the form
const form = document.querySelector('form');
form.addEventListener('submit', function (event) {
    const confirmSubmit = confirm('Apakah data sudah benar?');
    if (!confirmSubmit) {
        event.preventDefault();
    }
});

document.addEventListener('DOMContentLoaded', function() {

    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        const confirmSubmit = confirm('Apakah data sudah benar?');
        if (!confirmSubmit) {
            event.preventDefault();
        }
    });

    const cancelButton = document.getElementById('cancelButton');
    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.history.back();
        });
    }
});