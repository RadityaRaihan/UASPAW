<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lapor Barang (Hilang/Temu)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Nama Barang</label>
                                    <input type="text" name="title" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Contoh: Kunci Motor Vario">
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Tipe Laporan</label>
                                    <select name="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="lost">Saya Kehilangan Barang</option>
                                        <option value="found">Saya Menemukan Barang</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Kategori</label>
                                    <select name="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Dokumen">Dokumen/Dompet</option>
                                        <option value="Kunci">Kunci</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Deskripsi</label>
                                    <textarea name="description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ciri-ciri barang atau detail lokasi..."></textarea>
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Nomor WhatsApp</label>
                                    <input type="text" name="phone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Contoh: 6281234567890" required>
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Foto Barang</label>
                                    <input type="file" name="image" accept="image/*" capture="environment" class="w-full mt-1" required>
                                    <p class="text-xs text-gray-500 mt-1">*PWA akan otomatis membuka kamera di HP</p>
                                </div>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700 mb-2">Tandai Lokasi di Peta</label>
                                <div id="map" style="height: 350px;" class="rounded-lg border shadow-inner"></div>
                                
                                <div class="grid grid-cols-2 gap-2 mt-4">
                                    <input type="hidden" name="latitude" id="lat">
                                    <input type="hidden" name="longitude" id="lng">
                                </div>
                                <p class="text-xs text-red-500 italic mt-2">*Klik pada peta untuk menetapkan koordinat lokasi.</p>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Default pusat peta: Jakarta
            var map = L.map('map').setView([-6.2000, 106.8166], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            var marker;

            // Klik peta untuk ambil koordinat
            map.on('click', function(e) {
                if (marker) { map.removeLayer(marker); }
                marker = L.marker(e.latlng).addTo(map);
                document.getElementById('lat').value = e.latlng.lat;
                document.getElementById('lng').value = e.latlng.lng;
            });

            // Fitur PWA: Coba ambil lokasi GPS user otomatis
            map.locate({setView: true, maxZoom: 16});
            map.on('locationfound', function(e) {
                if (marker) { map.removeLayer(marker); }
                marker = L.marker(e.latlng).addTo(map);
                document.getElementById('lat').value = e.latlng.lat;
                document.getElementById('lng').value = e.latlng.lng;
            });
        });
    </script>
</x-app-layout>