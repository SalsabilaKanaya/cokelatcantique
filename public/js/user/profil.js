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
                console.log('Data fetched from API:', data); // Tambahkan log ini
                // Data adalah array dari provinsi
                const provinces = data; // Data sudah langsung array dari provinsi
                if (Array.isArray(provinces)) {
                    provinces.forEach(province => {
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
                const cities = data; // Ambil data kota
                if (Array.isArray(cities)) {
                    cities.forEach(city => {
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
