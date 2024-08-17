let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
};

// // Display the selected file name
// const fotoInput = document.getElementById('foto');
// const fotoLabel = document.querySelector('label[for="foto"]');

// fotoInput.addEventListener('change', function () {
//     const fileName = this.files[0].name;
//     fotoLabel.textContent = `Foto: ${fileName}`;
// });

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