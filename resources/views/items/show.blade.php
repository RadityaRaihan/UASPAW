<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail: {{ $item->title }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:underline">← Kembali ke Dashboard</a>
        </div>
    </x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div>
                            <div class="rounded-lg overflow-hidden bg-gray-100 mb-4">
                                @if($item->image_url)
                                    <img src="{{ asset('storage/' . $item->image_url) }}" class="w-full h-auto object-cover">
                                @else
                                    <div class="p-10 text-center text-gray-400">Tidak ada foto</div>
                                @endif
                            </div>
                            
                            <div class="flex items-center space-x-2 mb-4">
                                <span class="px-3 py-1 text-xs font-bold uppercase rounded {{ $item->type == 'lost' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                    {{ $item->type == 'lost' ? 'HILANG' : 'DITEMUKAN' }}
                                </span>
                                <span class="text-sm text-gray-500 italic">{{ $item->category }}</span>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $item->title }}</h3>
                            <p class="text-gray-600 leading-relaxed mb-6">{{ $item->description }}</p>
                            
                            <hr class="mb-6">

                            <a href="https://wa.me/{{ $item->formatted_phone }}?text=Halo, saya menanyakan tentang laporan: {{ $item->title }}" 
                               target="_blank" 
                               class="flex items-center justify-center w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition shadow-md">
                               <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                               Hubungi Pelapor
                            </a>
                        </div>

                        <div class="h-full min-h-[400px]">
                            <h4 class="font-bold text-gray-700 mb-3">Lokasi pada Peta:</h4>
                            <div id="mapDetail" class="w-full h-[400px] md:h-[500px] rounded-xl border shadow-inner"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lat = {{ $item->latitude }};
            const lng = {{ $item->longitude }};
            
            const map = L.map('mapDetail').setView([lat, lng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map)
                .bindPopup("<b>{{ $item->title }}</b><br>Lokasi barang.")
                .openPopup();
        });
    </script>
</x-app-layout>