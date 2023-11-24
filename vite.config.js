import { defineConfig } from 'vite';

const path = require('path')
import laravel from 'laravel-vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss','resources/js/app.js'],
            refresh: true,
        }),
    ],
});