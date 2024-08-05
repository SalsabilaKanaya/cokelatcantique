document.addEventListener('DOMContentLoaded', function () {
    var exampleModal = document.getElementById('exampleModal');

    exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var karakterId = button.getAttribute('data-id');
        var modalFoto = exampleModal.querySelector('#modal-foto');
        var modalNama = exampleModal.querySelector('#modal-nama');

        // Memanggil endpoint untuk mendapatkan detail karakter
        fetch(`/karakter/${karakterId}`)
            .then(response => response.json())
            .then(data => {
                modalNama.textContent = data.nama;
                modalFoto.src = data.foto;
            });
    });
});

const plus = document.querySelector(".plus"),
minus = document.querySelector(".minus"),
num = document.querySelector(".num");

let a = 1;

plus.addEventListener("click", ()=>{
    a++;
    a = (a < 10) ? "0" + a : a;
    num.innerText = a;
    console.log(a);
});

minus.addEventListener("click", ()=>{
    if(a > 1){
        a--;
        a = (a < 10) ? "0" + a : a;
        num.innerText = a;
    }
});