import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // localhost:{WEB port}で起動しているdocker で laravel viteの5173ポートへフォワードするため
    server: {
        host: true
    },
});
