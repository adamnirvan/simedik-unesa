import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            // MENGUBAH FONT UTAMA MENJADI POPPINS
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            // WARNA KUSTOM SIMEDIK
            colors: {
                simedik: {
                    dark: '#1E1E1E',    // Untuk teks dan border tebal
                    primary: '#56DFCF', // Untuk tombol utama
                    light: '#B6FBE5',   // Untuk aksen dan hover
                }
            }
        },
    },

    plugins: [forms],
};