import './bootstrap';
import 'flowbite';

document.addEventListener('alpine:init', () => {
    Alpine.data('themeToggle', () => ({
        isDark: localStorage.getItem('color-theme') === 'dark' ||
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

        init() {
            this.applyTheme();
        },

        toggleTheme() {
            this.isDark = !this.isDark;
            this.applyTheme();
        },

        applyTheme() {
            if (this.isDark) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        }
    }));
});
