import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    safelist: [
        /* Jenjang pastel variants */
        'from-emerald-100', 'to-emerald-50', 'border-emerald-200/60',
        'bg-emerald-100/60', 'text-emerald-700', 'hover:bg-emerald-50/80',
        'shadow-emerald-200/40', 'group-hover:text-emerald-700',
        'from-sky-100', 'to-sky-50', 'border-sky-200/60',
        'bg-sky-100/60', 'text-sky-700', 'hover:bg-sky-50/80',
        'shadow-sky-200/40', 'group-hover:text-sky-700',
        'from-violet-100', 'to-violet-50', 'border-violet-200/60',
        'bg-violet-100/60', 'text-violet-700', 'hover:bg-violet-50/80',
        'shadow-violet-200/40', 'group-hover:text-violet-700',

        /* Jenjang dark variants */
        'dark:from-emerald-950/40', 'dark:to-emerald-900/20', 'dark:border-emerald-800/50',
        'dark:bg-emerald-950/30', 'dark:text-emerald-300', 'dark:hover:bg-emerald-900/40',
        'dark:group-hover:text-emerald-300',
        'dark:from-sky-950/40', 'dark:to-sky-900/20', 'dark:border-sky-800/50',
        'dark:bg-sky-950/30', 'dark:text-sky-300', 'dark:hover:bg-sky-900/40',
        'dark:group-hover:text-sky-300',
        'dark:from-violet-950/40', 'dark:to-violet-900/20', 'dark:border-violet-800/50',
        'dark:bg-violet-950/30', 'dark:text-violet-300', 'dark:hover:bg-violet-900/40',
        'dark:group-hover:text-violet-300',
    ],

    plugins: [forms],
};
