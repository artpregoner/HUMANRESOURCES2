// Function para ipakita ang preloader
function showPreloader(id) {
    const preloader = document.getElementById(id); // Hanapin ang preloader gamit ang id
    if (preloader) {
        preloader.classList.remove('d-none'); // Tanggalin ang 'd-none' para ipakita ang preloader
    }
}

// Function para itago ang preloader
function hidePreloader(id) {
    const preloader = document.getElementById(id); // Hanapin ulit ang preloader gamit ang id
    if (preloader) {
        preloader.classList.add('d-none'); // Ibalik ang 'd-none' para itago ang preloader
    }
}
