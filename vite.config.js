import { defineConfig } from 'vite';

const path = require('path')
import laravel from 'laravel-vite-plugin';
import inject from "@rollup/plugin-inject";

export default defineConfig({
    plugins: [
        inject({   
            $: 'jquery',
            jQuery: 'jquery',
        }),
        laravel({
            input: ['resources/scss/app.scss','resources/js/app.js'],
            refresh: true,
        }),
    ],
});