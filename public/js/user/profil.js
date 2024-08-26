document.addEventListener('DOMContentLoaded', function() {
    const provinceSelect = document.getElementById('province'); // Mengambil elemen dropdown provinsi
    const citySelect = document.getElementById('city'); // Mengambil elemen dropdown kota

    // Fungsi untuk mengisi dropdown provinsi
    function populateProvinces() {
        fetch('/user/api/get-provinces') // Mengirim permintaan ke endpoint API untuk mendapatkan data provinsi
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok'); // Jika ada masalah dengan respons, tampilkan error
                }
                return response.json(); // Mengubah respons menjadi format JSON
            })
            .then(data => {
                console.log('Data fetched from API:', data); // Tambahkan log ini untuk debugging data dari API
                // Data adalah array dari provinsi
                const provinces = data; // Data sudah langsung array dari provinsi
                if (Array.isArray(provinces)) {
                    provinces.forEach(province => {
                        const option = document.createElement('option'); // Membuat elemen option untuk setiap provinsi
                        option.value = province.province_id; // Mengisi nilai option dengan ID provinsi
                        option.textContent = province.province; // Mengisi teks option dengan nama provinsi
                        provinceSelect.appendChild(option); // Menambahkan option ke dropdown provinsi
                    });
                } else {
                    console.error('Data provinsi tidak dalam format yang diharapkan:', data); // Error jika data tidak sesuai format yang diharapkan
                }
            })
            .catch(error => console.error('Error fetching provinces:', error)); // Menangkap dan menampilkan error jika ada masalah saat fetch
    }    

    // Fungsi untuk mengisi dropdown kota berdasarkan provinsi yang dipilih
    function populateCities(provinceId) {
        fetch(`/user/api/get-cities/${provinceId}`) // Mengirim permintaan ke endpoint API untuk mendapatkan data kota berdasarkan ID provinsi
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok'); // Jika ada masalah dengan respons, tampilkan error
                }
                return response.json(); // Mengubah respons menjadi format JSON
            })
            .then(data => {
                citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>'; // Mengosongkan dropdown kota sebelum mengisi data baru
                const cities = data; // Ambil data kota dari respons
                if (Array.isArray(cities)) {
                    cities.forEach(city => {
                        const option = document.createElement('option'); // Membuat elemen option untuk setiap kota
                        option.value = city.city_id; // Mengisi nilai option dengan ID kota
                        option.textContent = city.city_name; // Mengisi teks option dengan nama kota
                        citySelect.appendChild(option); // Menambahkan option ke dropdown kota
                    });
                } else {
                    console.error('Data kota tidak dalam format yang diharapkan:', data); // Error jika data tidak sesuai format yang diharapkan
                }
            })
            .catch(error => console.error('Error fetching cities:', error)); // Menangkap dan menampilkan error jika ada masalah saat fetch
    }

    // Event listener untuk perubahan pada dropdown provinsi
    provinceSelect.addEventListener('change', function() {
        const selectedProvinceId = this.value; // Mengambil ID provinsi yang dipilih
        if (selectedProvinceId) {
            populateCities(selectedProvinceId); // Mengisi dropdown kota berdasarkan ID provinsi yang dipilih
        } else {
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>'; // Kosongkan dropdown kota jika tidak ada provinsi yang dipilih
        }
    });

    // Mengisi dropdown provinsi saat halaman dimuat
    populateProvinces(); // Memanggil fungsi untuk mengisi dropdown provinsi
});
