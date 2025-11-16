document.addEventListener('DOMContentLoaded', () => {
    const hamburgerButton = document.querySelector('.global-nav-button');
    const navMenu = document.getElementById('mobile-nav');

    hamburgerButton.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });
});