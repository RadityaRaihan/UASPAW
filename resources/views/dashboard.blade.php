<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Daftar Temuan & Kehilangan Barang') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Temukan barang hilang atau laporkan temuan Anda</p>
            </div>
            <div class="hidden md:block">
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Update terakhir: {{ now('Asia/Jakarta')->format('H:i') }} WIB</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="mb-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-8 text-white shadow-2xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-4xl font-black mb-3">Eksplorasi Laporan</h1>
                        <p class="text-indigo-100 text-lg mb-4">Cari dan temukan barang yang hilang di sekitar Anda. Mari bantu satu sama lain!</p>
                        <div class="flex items-center space-x-4 text-sm">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $items->count() }} laporan aktif</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Update real-time</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('items.create') }}" class="inline-flex items-center justify-center bg-white text-indigo-600 px-8 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 font-bold text-lg group">
                            <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Lapor Barang Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Category Filters -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Filter Kategori Cepat</h3>
                    <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium {{ !request('category') ? 'text-gray-400 pointer-events-none' : '' }}">
                        Tampilkan Semua
                    </a>
                </div>
                <div class="flex flex-wrap gap-3">
                    @php
                        $popularCategories = ['Elektronik', 'Dokumen', 'Kunci', 'Lainnya'];
                    @endphp
                    @foreach($popularCategories as $cat)
                        <a href="{{ route('dashboard', ['category' => $cat]) }}" 
                           class="inline-flex items-center px-4 py-2 rounded-xl font-medium transition-all {{ request('category') == $cat ? 'bg-indigo-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Search Section -->
            <div class="mb-10 bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
                <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang, kategori, atau deskripsi..." class="w-full pl-14 pr-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all outline-none text-lg shadow-sm">
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="bg-gradient-to-r from-gray-900 to-gray-800 text-white px-8 py-4 rounded-2xl font-bold hover:from-gray-800 hover:to-gray-700 transition-all shadow-lg hover:shadow-xl flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        @if(request('search') || request('category'))
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-4 bg-red-50 text-red-600 rounded-2xl font-bold hover:bg-red-100 transition-all border border-red-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
                @if(request('search') || request('category'))
                    <div class="mt-4 flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center space-x-3">
                            <p class="text-sm text-gray-600">
                                Menampilkan <span class="font-bold text-indigo-600">{{ $items->count() }}</span> hasil
                                @if(request('category'))
                                    @if(request('search'))
                                        pencarian "<span class="font-bold text-gray-800">{{ request('search') }}</span>" di kategori
                                    @else
                                        di kategori
                                    @endif
                                @elseif(request('search'))
                                    pencarian untuk "<span class="font-bold text-gray-800">{{ request('search') }}</span>"
                                @endif
                            </p>
                            @if(request('category'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800 border border-purple-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ request('category') }}
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2 text-xs text-gray-500">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Ditemukan dalam {{ number_format(microtime(true) - LARAVEL_START, 2) }} detik</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Items Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($items as $item)
                    <div class="group bg-white overflow-hidden shadow-lg rounded-3xl border border-gray-100 hover:shadow-2xl hover:shadow-indigo-200/50 hover:-translate-y-2 transition-all duration-500 cursor-pointer">
                        <div class="relative h-56 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                            @if($item->image_url)
                                <img src="{{ asset('storage/' . $item->image_url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 flex-col">
                                    <svg class="w-16 h-16 mb-3 opacity-30" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-500">Foto tidak tersedia</span>
                                </div>
                            @endif

                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-2 text-xs font-black uppercase tracking-widest rounded-2xl shadow-lg {{ $item->type == 'lost' ? 'bg-gradient-to-r from-red-500 to-red-600 text-white' : 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white' }} transform group-hover:scale-105 transition-transform">
                                    {{ $item->type == 'lost' ? 'HILANG' : 'DITEMUKAN' }}
                                </span>
                            </div>

                            <div class="absolute top-4 right-4">
                                <div class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-xl uppercase tracking-wider border border-indigo-100">{{ $item->category }}</span>
                                <span class="text-xs text-gray-400 font-medium bg-gray-50 px-2 py-1 rounded-lg">{{ $item->created_at->diffForHumans() }}</span>
                            </div>

                            <h4 class="font-black text-gray-900 text-xl mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors leading-tight">{{ $item->title }}</h4>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">{{ $item->description }}</p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-500 font-medium">{{ $item->user->name ?? 'Anonim' }}</span>
                                </div>

                                <a href="{{ route('items.show', $item->id) }}" class="inline-flex items-center justify-center py-2.5 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold text-sm hover:from-indigo-700 hover:to-purple-700 transition-all shadow-md hover:shadow-lg group/btn">
                                    <span>Lihat Detail</span>
                                    <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-gradient-to-br from-gray-50 to-gray-100 p-16 text-center rounded-3xl border-2 border-dashed border-gray-200">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Tidak ada hasil ditemukan</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8 leading-relaxed">Maaf, kami tidak dapat menemukan laporan yang kamu cari. Coba gunakan kata kunci yang berbeda atau lihat semua laporan yang tersedia.</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Tampilkan Semua
                            </a>
                            <a href="{{ route('items.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Laporan Baru
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Stats Footer -->
            @if($items->count() > 0)
            <div class="mt-12 bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                    <div class="p-4">
                        <div class="text-3xl font-black text-indigo-600 mb-2">{{ $items->where('type', 'lost')->count() }}</div>
                        <div class="text-sm text-gray-600 font-medium">Barang Hilang</div>
                    </div>
                    <div class="p-4">
                        <div class="text-3xl font-black text-emerald-600 mb-2">{{ $items->where('type', 'found')->count() }}</div>
                        <div class="text-sm text-gray-600 font-medium">Barang Ditemukan</div>
                    </div>
                    <div class="p-4">
                        <div class="text-3xl font-black text-purple-600 mb-2">{{ $items->count() }}</div>
                        <div class="text-sm text-gray-600 font-medium">Total Laporan</div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>