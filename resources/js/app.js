import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuButtonToggle = document.getElementById('mobile-menu-button-toggle'); // Or whatever ID you use in _navbar.blade.php
    const mobileMenuNav = document.getElementById('mobile-menu-nav'); // Or ID of the mobile menu itself

    if (mobileMenuButtonToggle && mobileMenuNav) {
        mobileMenuButtonToggle.addEventListener('click', () => {
            const isExpanded = mobileMenuButtonToggle.getAttribute('aria-expanded') === 'true' || false;
            mobileMenuButtonToggle.setAttribute('aria-expanded', !isExpanded);
            mobileMenuNav.classList.toggle('hidden');
            const icon = mobileMenuButtonToggle.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            }
        });
    }

    // User dropdown toggle (if not using Alpine.js)
    const userMenuButton = document.getElementById('user-menu-button'); // ID from _navbar
    const userDropdownMenu = document.getElementById('user-dropdown-menu'); // ID from _navbar

    if (userMenuButton && userDropdownMenu) {
        userMenuButton.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent click from immediately closing it via document listener
            userDropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (userMenuButton && !userMenuButton.contains(event.target) && userDropdownMenu && !userDropdownMenu.contains(event.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    }
});