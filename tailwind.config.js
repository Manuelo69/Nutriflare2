import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                custom: ['Open Sans', 'sans-serif'],
            },
            colors: {
                'azul': '#1A94D6',
                'verde': '#43D32D',
                'rojo': '#FF4B3E',
                'morado': '#7E44D8'
            },
            height: {
                '750px': '600px',
                '700px': '650px',
                '800px': '800px',
                '780px': '780px',
              },
              width: {
                '1600px': '1600px',
                '600px': '600px',
                '700px': '700px',
              },
        },
    },

    plugins: [forms, typography],
};
