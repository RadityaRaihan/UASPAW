<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_items' => Item::count(),
            'total_users' => User::count(),
            'lost_items' => Item::where('type', 'lost')->count(),
            'found_items' => Item::where('type', 'found')->count(),
            'recent_items' => Item::with('user')->latest()->take(5)->get(),
            'recent_users' => User::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function items(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        $status = $request->input('status');

        $items = Item::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                           ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(20);

        return view('admin.items.index', compact('items'));
    }

    public function users(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');

        $users = User::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($role, function ($query, $role) {
                return $query->where('role', $role);
            })
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Role user berhasil diupdate.');
    }

    public function deleteItem(Item $item)
    {
        // Hapus file gambar jika ada
        if ($item->image_url) {
            Storage::disk('public')->delete($item->image_url);
        }

        $item->delete();

        return back()->with('success', 'Laporan berhasil dihapus.');
    }

    public function updateItemStatus(Request $request, Item $item)
    {
        $request->validate([
            'status' => 'required|in:open,closed',
        ]);

        $item->update(['status' => $request->status]);

        return back()->with('success', 'Status laporan berhasil diupdate.');
    }

    public function showUser(User $user)
    {
        $stats = [
            'total_reports' => $user->items()->count(),
            'open_reports' => $user->items()->where('status', 'open')->count(),
            'closed_reports' => $user->items()->where('status', 'closed')->count(),
        ];

        $items = $user->items()->latest()->paginate(10);

        return view('admin.users.show', compact('user', 'stats', 'items'));
    }
}
