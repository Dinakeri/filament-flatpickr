import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/filament-flatpickr.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'resources/dist',
        emptyOutDir: true,
    },
});
