
// untuk menghitung ongkir
// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.querySelector('form'); // Ganti dengan selector form yang sesuai

//     form.addEventListener('submit', function(event) {
//         event.preventDefault();

//         const formData = new FormData(form);

//         fetch('/pemesanan/calculateShippingCost', {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//             }
//         })
//         .then(response => response.text()) // Menggunakan text() untuk memeriksa isi respons
//         .then(text => {
//             try {
//                 const data = JSON.parse(text);
//                 if (data.error) {
//                     console.error('Error:', data.error);
//                     document.getElementById('shipping-cost').textContent = 'Rp 0';
//                 } else {
//                     document.getElementById('shipping-cost').textContent = `Rp ${data.shippingCost.toLocaleString('id-ID')}`;
//                 }
//             } catch (e) {
//                 console.error('Error parsing JSON:', e);
//                 console.error('Received text:', text);
//             }
//         })
//         .catch(error => console.error('Error fetching shipping cost:', error));
//     });
// });

document.getElementById('btn-transfer').addEventListener('click', function() {
    this.classList.add('btn-custom-active');
    this.classList.remove('btn-custom');
    document.getElementById('btn-ewallet').classList.add('btn-custom');
    document.getElementById('btn-ewallet').classList.remove('btn-custom-active');
    document.getElementById('labelBank').style.display = 'block';
    document.getElementById('divBank').style.display = 'block';
    document.getElementById('labelEwallet').style.display = 'none';
    document.getElementById('divEwallet').style.display = 'none';
});

document.getElementById('btn-ewallet').addEventListener('click', function() {
    this.classList.add('btn-custom-active');
    this.classList.remove('btn-custom');
    document.getElementById('btn-transfer').classList.add('btn-custom');
    document.getElementById('btn-transfer').classList.remove('btn-custom-active');
    document.getElementById('labelBank').style.display = 'none';
    document.getElementById('divBank').style.display = 'none';
    document.getElementById('labelEwallet').style.display = 'block';
    document.getElementById('divEwallet').style.display = 'block';
});

function toggleIcon(iconId) {
    const icon = document.getElementById(iconId);
    if (icon.classList.contains('fa-chevron-down')) {
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    } else {
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    }
}

function handleSelectChange(iconId) {
    const icon = document.getElementById(iconId);
    icon.classList.remove('fa-chevron-up');
    icon.classList.add('fa-chevron-down');
}

document.getElementById('pilihanBank').addEventListener('click', function() {
    toggleIcon('iconBank');
});

document.getElementById('pilihanEwallet').addEventListener('click', function() {
    toggleIcon('iconEwallet');
});

// document.getElementById('calculate-shipping').addEventListener('click', function () {
//     const origin = document.getElementById('origin').value;
//     const destination = document.getElementById('destination').value;
//     const weight = document.getElementById('weight').value;
//     const courier = document.getElementById('courier').value;

//     fetch('/pemesanan/calculateShippingCost', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             origin: origin,
//             destination: destination,
//             weight: weight,
//             courier: courier
//         })
//     })
//     .then(response => {
//         console.log('Response Status:', response.status);
//         return response.json();
//     })
//     .then(data => {
//         console.log('Response Data:', data);
//         // Update the page with shipping cost
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//     const courierOptionsContainer = document.getElementById('courier-options');

//     // Fungsi untuk mengisi radio button kurir
//     function populateCouriers() {
//         fetch('/api/post-cost')
//             .then(response => response.json())
//             .then(data => {
//                 console.log('Received courier data:', data); // Tambahkan ini untuk melihat data yang diterima
//                 if (data && data.rajaongkir && Array.isArray(data.rajaongkir.results)) {
//                     data.rajaongkir.results.forEach(courier => {
//                         const radioButton = document.createElement('div');
//                         radioButton.className = 'form-check';
    
//                         radioButton.innerHTML = `
//                             <input class="form-check-input" type="radio" name="courier" id="courier-${courier.code}" value="${courier.code}">
//                             <label class="form-check-label" for="courier-${courier.code}">
//                                 ${courier.name}
//                             </label>
//                         `;
    
//                         courierOptionsContainer.appendChild(radioButton);
//                     });
//                 } else {
//                     console.error('Data kurir tidak dalam format yang diharapkan:', data);
//                 }
//             })
//             .catch(error => console.error('Error fetching couriers:', error));
//     }

//     populateCouriers();
// });



