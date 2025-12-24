<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <title>TemuBarang - Temukan Kembali Milikmu</title>

        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#4f46e5">
        <meta name="description" content="Platform tercepat untuk melaporkan dan menemukan barang hilang di sekitar Anda.">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="TemuBarang">
        <meta name="msapplication-TileColor" content="#4f46e5">
        <meta name="msapplication-config" content="/browserconfig.xml">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="apple-touch-icon" href="/icons/icon-192x192.svg">
        <link rel="icon" type="image/svg+xml" href="/icons/icon-192x192.svg">
        <link rel="icon" type="image/png" sizes="32x32" href="/icons/icon-192x192.svg">
        <link rel="icon" type="image/png" sizes="16x16" href="/icons/icon-150x150.svg">

        <meta property="og:type" content="website">
        <meta property="og:title" content="TemuBarang - Temukan Kembali Milikmu">
        <meta property="og:description" content="Platform tercepat untuk melaporkan dan menemukan barang hilang.">
        <meta property="og:image" content="{{ asset('icons/icon-512x512.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            .animate-float { animation: float 5s ease-in-out infinite; }
            html { scroll-behavior: smooth; }
        </style>
    </head>
    <body class="antialiased bg-gray-50 text-gray-900 font-[Figtree]">
        
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <div class="bg-indigo-600 p-2 rounded-lg mr-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <span class="text-xl font-black text-gray-900 tracking-tight">TEMU<span class="text-indigo-600">BARANG</span></span>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">
                        <a href="/" class="text-sm font-bold text-gray-700 hover:text-indigo-600 transition">Beranda</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-700 hover:text-indigo-600 transition">Dashboard</a>
                        @endauth
                    </div>

                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-indigo-600">Halo, {{ Auth::user()->name }}</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-indigo-600 transition">Log in</a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative overflow-hidden bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="grid lg:grid-cols-2 gap-12 items-center text-center lg:text-left">
                    <div class="space-y-8">
                        <div class="inline-flex items-center space-x-2 bg-indigo-50 px-3 py-1 rounded-full text-indigo-600 text-sm font-bold">
                            <span>📍 Berbasis Lokasi GPS</span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-black text-gray-900 leading-tight">
                            Kehilangan sesuatu? <br>
                            <span class="text-indigo-600">Komunitas membantu.</span>
                        </h1>
                        <p class="text-lg text-gray-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                            Platform tercepat untuk melaporkan dan menemukan barang hilang di sekitar Anda. Dilengkapi dengan peta interaktif dan integrasi WhatsApp langsung.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black text-lg shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all">
                                Lapor Sekarang
                            </a>
                            <a href="#explore" class="px-8 py-4 bg-white text-gray-700 border-2 border-gray-100 rounded-2xl font-black text-lg hover:bg-gray-50 transition-all">
                                Lihat Barang Terkini
                            </a>
                        </div>
                    </div>
                    <div class="relative flex justify-center lg:justify-end">
                        <div class="absolute inset-0 bg-indigo-200 rounded-full blur-3xl opacity-20 transform scale-75"></div>
                        <img src="https://img.freepik.com/free-vector/way-concept-illustration_114360-1191.jpg" alt="Hero Image" class="relative w-full max-w-md animate-float">
                    </div>
                </div>
            </div>
        </div>

        <div id="explore" class="bg-gray-50 py-24 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-black text-gray-900 mb-4">Barang Terkini</h2>
                    <p class="text-lg text-gray-600">Laporan terbaru dari pahlawan komunitas hari ini.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @forelse($items as $item)
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all">
                            <div class="h-48 bg-gray-200">
                                @if($item->image_url)
                                    <img src="{{ asset('storage/' . $item->image_url) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">No Image</div>
                                @endif
                            </div>
                            <div class="p-6">
                                <span class="text-xs font-bold text-indigo-600 uppercase">{{ $item->category }}</span>
                                <h3 class="text-xl font-black mt-1">{{ $item->title }}</h3>
                                <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $item->description }}</p>
                                <a href="{{ route('items.show', $item) }}" class="inline-block mt-4 text-indigo-600 font-bold">Detail →</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-gray-400">Belum ada barang dilaporkan.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <footer class="bg-white py-12 border-t border-gray-100 text-center">
            <p class="text-gray-400 font-bold text-sm italic">&copy; 2025 TemuBarang Project.</p>
        </footer>

        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js')
                        .then(reg => {
                            console.log('PWA: Service Worker Active', reg);
                            // Check for updates periodically
                            setInterval(() => reg.update(), 60000);
                        })
                        .catch(err => console.log('PWA: Registration Failed', err));
                });
            }

            // Install prompt handling
            let deferredPrompt;
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;
                // Show install button
                const installBtn = document.getElementById('install-btn');
                if (installBtn) {
                    installBtn.style.display = 'block';
                }
            });

            // Handle install button click
            const installBtn = document.getElementById('install-btn');
            if (installBtn) {
                installBtn.addEventListener('click', async () => {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        const { outcome } = await deferredPrompt.userChoice;
                        console.log(`User response: ${outcome}`);
                        deferredPrompt = null;
                        installBtn.style.display = 'none';
                    }
                });
            }
        </script>
    </body>
</html>