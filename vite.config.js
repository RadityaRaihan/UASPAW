import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePWA } from 'vite-plugin-pwa';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        VitePWA({
            registerType: 'autoUpdate',
            injectRegister: 'auto',
            workbox: {
                // Mengatur aset apa saja yang disimpan di cache agar aplikasi bisa dibuka offline
                globPatterns: ['**/*.{js,css,html,ico,png,svg}']
            },
            manifest: {
                name: 'TemuBarang Kampus',
                short_name: 'TemuBarang',
                description: 'Aplikasi Lost and Found Kampus',
                theme_color: '#4f46e5',
                background_color: '#ffffff',
                display: 'standalone',
                start_url: '/',
                scope: '/',
                icons: [
                    {
                        src: 'https://cdn-icons-png.flaticon.com/512/825/825590.png',
                        sizes: '192x192',
                        type: 'image/png',
                        purpose: 'any maskable'
                    },
                    {
                        src: 'https://cdn-icons-png.flaticon.com/512/825/825590.png',
                        sizes: '512x512',
                        type: 'image/png',
                        purpose: 'any maskable'
                    }
                ]
            },
            filename: 'manifest.webmanifest'
        })
    ],
});