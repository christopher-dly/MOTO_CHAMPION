// MENU BURGER DE LA NAVBAR
document.addEventListener('DOMContentLoaded', () => {
    const burger = document.getElementById('burger-menu');
    const navList = document.getElementById('navbar-list');

    burger.addEventListener('click', () => {
        navList.classList.toggle('show');
        burger.classList.toggle('open'); 
    });
});

