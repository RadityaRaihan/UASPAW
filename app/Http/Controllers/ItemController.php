<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
{
    // Mengambil keyword pencarian dari input 'search'
    $search = $request->input('search');
    $category = $request->input('category');

    $items = Item::with('user')
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%")
                         ->orWhere('category', 'like', "%{$search}%");
        })
        ->when($category, function ($query, $category) {
            return $query->where('category', $category);
        })
        ->latest()
        ->get();

    // Ambil semua kategori unik untuk filter
    $categories = Item::select('category')->distinct()->pluck('category');

    return view('dashboard', compact('items', 'categories'));
}

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:lost,found',
            'category' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:8192',
            'latitude' => 'required',
            'longitude' => 'required',
            'phone' => 'required|string|max:20',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
        }

        Item::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'type' => $request->type,
            'category' => $request->category,
            'description' => $request->description,
            'image_url' => $imagePath ?? null,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'open',
            'phone' => $request->phone,
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil diterbitkan!');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }
}