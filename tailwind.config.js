import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';


/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'media', 
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
        './storage/framework/views/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            zIndex: {
                100: '100',
            },
        },
    },

    plugins: [
        forms,
        typography,
        require('tailwind-scrollbar-hide'),
        require('flyonui')   // add the plugin


    ],
};
