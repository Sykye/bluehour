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
            fontFamily: {
                sans: ['Cormorant Garamond', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: {
                    50:  '#f0f4ff',
                    100: '#dbe4ff',
                    200: '#bac8ff',
                    300: '#91a7ff',
                    400: '#748ffc',
                    500: '#5c7cfa',
                    600: '#4c6ef5',
                    700: '#1a3a6b',
                    800: '#132c52',
                    900: '#0d1f3c',
                    950: '#081428',
                },
                royal: {
                    50:  '#eef2ff',
                    100: '#dde5ff',
                    200: '#c3cfff',
                    300: '#99adff',
                    400: '#6d85fc',
                    500: '#4a63f5',
                    600: '#3347e8',
                    700: '#2a38d4',
                    800: '#2430ab',
                    900: '#232e86',
                },
            },
        },
    },

    plugins: [forms],
};
