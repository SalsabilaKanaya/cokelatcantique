
// untuk menghitung ongkir
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form'); // Ganti dengan selector form yang sesuai

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('/pemesanan/calculateShippingCost', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.text()) // Menggunakan text() untuk memeriksa isi respons
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.error) {
                    console.error('Error:', data.error);
                    document.getElementById('shipping-cost').textContent = 'Rp 0';
                } else {
                    document.getElementById('shipping-cost').textContent = `Rp ${data.shippingCost.toLocaleString('id-ID')}`;
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Received text:', text);
            }
        })
        .catch(error => console.error('Error fetching shipping cost:', error));
    });
});

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

// Untuk data provinsi dan kota di dropdown
document.addEventListener('DOMContentLoaded', function() {
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');

    // Fungsi untuk mengisi dropdown provinsi
    function populateProvinces() {
        fetch('/api/get-provinces')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Pastikan data adalah array provinsi
                if (data && Array.isArray(data)) {
                    data.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.province_id;
                        option.textContent = province.province;
                        provinceSelect.appendChild(option);
                    });
                } else {
                    console.error('Data provinsi tidak dalam format yang diharapkan:', data);
                }
            })
            .catch(error => console.error('Error fetching provinces:', error));
    }

    // Fungsi untuk mengisi dropdown kota berdasarkan provinsi yang dipilih
    function populateCities(provinceId) {
        fetch(`/api/get-cities/${provinceId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>'; // Clear existing options
                if (data && Array.isArray(data)) {
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.city_id;
                        option.textContent = city.city_name;
                        citySelect.appendChild(option);
                    });
                } else {
                    console.error('Data kota tidak dalam format yang diharapkan:', data);
                }
            })
            .catch(error => console.error('Error fetching cities:', error));
    }

    // Event listener untuk perubahan pada dropdown provinsi
    provinceSelect.addEventListener('change', function() {
        const selectedProvinceId = this.value;
        if (selectedProvinceId) {
            populateCities(selectedProvinceId);
        } else {
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>'; // Clear cities if no province selected
        }
    });

    // Mengisi dropdown provinsi saat halaman dimuat
    populateProvinces();
});

