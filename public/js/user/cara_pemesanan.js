const ItemHeaders = document.querySelectorAll(".header"); // Mengambil semua elemen dengan kelas 'header'
ItemHeaders.forEach(ItemHeader => { // Melakukan iterasi untuk setiap elemen header
    ItemHeader.addEventListener("click", event => { // Menambahkan event listener untuk event klik pada setiap header
        ItemHeader.classList.toggle("active"); // Menambahkan atau menghapus kelas 'active' pada header yang diklik

        const ItemBody = ItemHeader.nextElementSibling; // Mengambil elemen berikutnya setelah header, yaitu body item
        const ItemContent = ItemHeader.parentElement; // Mengambil elemen induk dari header, yaitu elemen '.content'

        if(ItemHeader.classList.contains("active")){ // Jika header memiliki kelas 'active'
            ItemBody.style.maxHeight = ItemBody.scrollHeight + "px"; // Mengatur tinggi maksimum body item untuk menampilkan konten
            ItemContent.classList.add("active"); // Menambahkan kelas 'active' pada elemen induk '.content'
        } else {
            ItemBody.style.maxHeight = 0; // Mengatur tinggi maksimum body item ke 0 untuk menyembunyikan konten
            ItemContent.classList.remove("active"); // Menghapus kelas 'active' dari elemen induk '.content'
        }
    });
});