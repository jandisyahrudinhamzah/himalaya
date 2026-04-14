import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                'himalaya-green': '#0B3D2E',
                'himalaya-brown': '#5C3A21',
                'himalaya-gold': '#D4AF37',
                'himalaya-white': '#F9F9F9',
                'himalaya-dark': '#051F16',
            },
            fontFamily: {
                'sans': ['Poppins', 'sans-serif'],
                'serif': ['Playfair Display', 'serif'],
                'mono': ['Montserrat', 'sans-serif'],
            },
            backgroundImage: {
                'topo-map': "url('https://www.transparenttextures.com/patterns/earth.png')", // Texture kertas/peta
                'gradient-overlay': 'linear-gradient(to bottom, rgba(11, 61, 46, 0.8), rgba(5, 31, 22, 0.95))',
            }
        },
    },
    plugins: [],
};