<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Kelola Laporan Barang
                </h2>
                <p class="text-sm text-gray-600 mt-1">Pantau dan kelola semua laporan yang masuk</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filters -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
                <form method="GET" class="flex flex-col lg:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau deskripsi..." class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                    </div>
                    <div class="flex gap-3">
                        <select name="type" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500">
                            <option value="">Semua Tipe</option>
                            <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Barang Hilang</option>
                            <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Barang Ditemukan</option>
                        </select>
                        <select name="status" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500">
                            <option value="">Semua Status</option>
                            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Terbuka</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors font-medium">
                            Filter
                        </button>
                        @if(request('search') || request('type') || request('status'))
                            <a href="{{ route('admin.items.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors font-medium">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Items Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0 mr-3">
                                                @if($item->image_url)
                                                    <img src="{{ asset('storage/' . $item->image_url) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($item->title, 30) }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit($item->description, 40) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->type == 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $item->type == 'lost' ? 'HILANG' : 'DITEMUKAN' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->category }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="{{ route('admin.items.update-status', $item) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-xs px-2 py-1 rounded-full border-0 font-medium {{ $item->status == 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                <option value="open" {{ $item->status == 'open' ? 'selected' : '' }}>Terbuka</option>
                                                <option value="closed" {{ $item->status == 'closed' ? 'selected' : '' }}>Ditutup</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('items.show', $item) }}" class="text-indigo-600 hover:text-indigo-900" target="_blank">Lihat</a>
                                            <form method="POST" action="{{ route('admin.items.destroy', $item) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada laporan ditemukan</h3>
                                            <p class="text-gray-500">Coba ubah filter pencarian Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($items->hasPages())
                    <div class="bg-white px-6 py-4 border-t border-gray-200">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>