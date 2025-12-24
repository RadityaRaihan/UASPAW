<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $items = App\Models\Item::with('user')->latest()->take(6)->get();
    return view('welcome', compact('items'));
});

// Semua route di dalam grup ini wajib LOGIN
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Dashboard (Menampilkan semua barang)
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');

    // 2. Form Lapor Barang (Tampilan Form)
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

    // 3. Simpan Laporan (Proses Database)
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');

    // 4. Detail Barang (Menampilkan Peta & Deskripsi Lengkap)
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

    // --- Profile (Bawaan Laravel Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Items Management
    Route::get('/items', [App\Http\Controllers\AdminController::class, 'items'])->name('items.index');
    Route::patch('/items/{item}/status', [App\Http\Controllers\AdminController::class, 'updateItemStatus'])->name('items.update-status');
    Route::delete('/items/{item}', [App\Http\Controllers\AdminController::class, 'deleteItem'])->name('items.destroy');
    
    // Users Management
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
    Route::patch('/users/{user}/role', [App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::get('/users/{user}', [App\Http\Controllers\AdminController::class, 'showUser'])->name('users.show');
});

require __DIR__.'/auth.php';