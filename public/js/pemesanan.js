document.addEventListener('DOMContentLoaded', function() {
    const cityInput = document.getElementById('city');
    const provinceInput = document.getElementById('province');

    const calculateShippingCost = () => {
        const city = cityInput.value.trim();
        const province = provinceInput.value.trim();

        if (city && province) {
            fetchShippingCost(city, province);
        }
    };

    const fetchShippingCost = (city, province) => {
        const formData = new FormData();
        formData.append('city', city);
        formData.append('province', province);

        fetch('/calculate-shipping-cost', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('shipping-cost').textContent = `Shipping Cost: Rp ${data.shippingCost}`;
            }
        })
        .catch(error => console.error('Error fetching shipping cost:', error));
    };

    cityInput.addEventListener('input', calculateShippingCost);
    provinceInput.addEventListener('input', calculateShippingCost);
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