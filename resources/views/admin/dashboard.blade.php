<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Admin Dashboard
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola aplikasi TemuBarang</p>
            </div>
            <div class="text-sm text-gray-500">
                {{ now('Asia/Jakarta')->format('l, d F Y H:i') }} WIB
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Items -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Laporan</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_items'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total User</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Lost Items -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Barang Hilang</p>
                            <p class="text-3xl font-bold text-red-600">{{ $stats['lost_items'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Found Items -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Barang Ditemukan</p>
                            <p class="text-3xl font-bold text-emerald-600">{{ $stats['found_items'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Recent Items -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Laporan Terbaru</h3>
                        <a href="{{ route('admin.items.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse($stats['recent_items'] as $item)
                            <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
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
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item->title }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->user->name }} • {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->type == 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $item->type == 'lost' ? 'HILANG' : 'DITEMUKAN' }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Belum ada laporan</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">User Terbaru</h3>
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse($stats['recent_users'] as $user)
                            <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-medium text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                                </div>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $user->role == 'admin' ? 'ADMIN' : 'USER' }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Belum ada user</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Management Links -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('admin.items.index') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Kelola Laporan</h3>
                            <p class="text-blue-100">Lihat, edit, dan hapus laporan barang</p>
                        </div>
                        <svg class="w-8 h-8 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('admin.users.index') }}" class="bg-gradient-to-r from-purple-600 to-purple-700 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Kelola User</h3>
                            <p class="text-purple-100">Kelola user dan hak akses admin</p>
                        </div>
                        <svg class="w-8 h-8 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>