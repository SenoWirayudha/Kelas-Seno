<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('is_admin', false)->count();
        $totalMenus = Menu::count();
        $totalOrders = Order::count();
        $totalMessages = Message::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMenus',
            'totalOrders',
            'totalMessages',
            'recentOrders',
            'recentMessages'
        ));
    }

    public function manageMenu()
    {
        $menus = Menu::latest()->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    public function createMenu()
    {
        return view('admin.menu.create');
    }

    public function storeMenu(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('menu', 'public');
            $validated['gambar'] = $gambarPath;
        }

        Menu::create($validated);

        return redirect()->route('admin.menu')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function editMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $gambarPath = $request->file('gambar')->store('menu', 'public');
            $validated['gambar'] = $gambarPath;
        }

        $menu->update($validated);

        return redirect()->route('admin.menu')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function deleteMenu($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('admin.menu')
            ->with('success', 'Menu berhasil dihapus.');
    }

    public function manageUsers()
    {
        $users = User::where('is_admin', false)
            ->latest()
            ->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function toggleBanUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned;
        $user->banned_at = $user->is_banned ? now() : null;
        $user->save();

        $message = $user->is_banned ? 'Pengguna berhasil dibanned.' : 'Pengguna berhasil diaktifkan kembali.';
        return back()->with('success', $message);
    }

    public function manageOrders()
    {
        $orders = Order::with(['user', 'items.menu'])
            ->latest()
            ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $validated['status'];
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function manageMessages()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}