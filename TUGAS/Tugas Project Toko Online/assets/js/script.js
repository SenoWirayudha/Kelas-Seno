document.addEventListener('DOMContentLoaded', function() {
    // JavaScript untuk interaktivitas
    console.log("Toko DVD Film Online siap!");
});
// assets/js/script.js

// Fungsi untuk menggeser discover banner setiap 10 detik
let currentBannerIndex = 0;

function switchDiscoverBanner() {
    const banners = document.querySelectorAll('.discover-banner');
    const totalBanners = banners.length;

    // Sembunyikan semua banner
    banners.forEach((banner, index) => {
        banner.style.display = 'none';
    });

    // Tampilkan banner berikutnya
    currentBannerIndex = (currentBannerIndex + 1) % totalBanners;
    banners[currentBannerIndex].style.display = 'block';
}

// Set interval untuk mengganti banner setiap 10 detik
setInterval(switchDiscoverBanner, 10000); // 10000ms = 10 detik

// Inisialisasi tampilan pertama
document.addEventListener('DOMContentLoaded', function() {
    switchDiscoverBanner();
});
