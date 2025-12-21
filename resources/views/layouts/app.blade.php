<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TemuBarang') }}</title>

        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#4f46e5">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="TemuBarang">
        
        <link rel="apple-touch-icon" href="/icons/icon-192x192.png">
        <link rel="icon" type="image/png" href="/icons/icon-192x192.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <link rel="stylesheet" href="{{ asset('build/assets/app-BjvJC7Um.css') }}">
        <script src="{{ asset('build/assets/app-CiZ6hk-B.js') }}" defer></script>

        <style>
            /* Smooth scrolling untuk PWA */
            html { scroll-behavior: smooth; }
            body { -webkit-tap-highlight-color: transparent; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white border-b border-gray-100 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="pb-20 md:pb-0">
                {{ $slot }}
            </main>
        </div>

        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/build/sw.js')
                        .then(reg => console.log('Service Worker: Terdaftar'))
                        .catch(err => console.log('Service Worker: Gagal', err));
                });
            }
        </script>
    </body>
</html>