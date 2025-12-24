<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Detail User</h2>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap dan laporan milik user</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="mt-6 space-y-2 text-sm text-gray-700">
                        <div class="flex justify-between">
                            <span class="font-medium">Role</span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700' }}">{{ ucfirst($user->role ?? 'user') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Bergabung</span>
                            <span>{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Email Verifikasi</span>
                            <span>{{ $user->email_verified_at ? $user->email_verified_at->format('d M Y') : 'Belum' }}</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <div class="bg-indigo-50 rounded-xl p-4 text-center">
                            <div class="text-xs text-indigo-700">Total Laporan</div>
                            <div class="text-2xl font-black text-indigo-800">{{ $stats['total_reports'] }}</div>
                        </div>
                        <div class="bg-green-50 rounded-xl p-4 text-center">
                            <div class="text-xs text-green-700">Selesai</div>
                            <div class="text-2xl font-black text-green-800">{{ $stats['closed_reports'] }}</div>
                        </div>
                        <div class="bg-amber-50 rounded-xl p-4 text-center">
                            <div class="text-xs text-amber-700">Aktif</div>
                            <div class="text-2xl font-black text-amber-800">{{ $stats['open_reports'] }}</div>
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900">Laporan oleh {{ $user->name }}</h3>
                        <p class="text-sm text-gray-600">Daftar laporan terbaru yang dibuat user ini</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($items as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->title }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $item->type === 'lost' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">{{ ucfirst($item->type) }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $item->status === 'open' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-700' }}">{{ ucfirst($item->status) }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium">
                                            <a href="{{ route('items.show', $item) }}" class="text-indigo-600 hover:text-indigo-900">Lihat</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada laporan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($items->hasPages())
                        <div class="bg-white px-6 py-4 border-t border-gray-200">
                            {{ $items->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
