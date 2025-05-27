<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('is_admin', false)->count();
        $totalOrders = Order::count();
        $totalMessages = Message::count();
        $totalMenus = Menu::count();
        
        return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'totalMessages', 'totalMenus'));
    }

    public function manageMenu()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function createMenu()
    {
        return view('admin.menu.create');
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $gambar = $request->file('gambar');
        $uniqueName = uniqid() . '.' . $gambar->getClientOriginalExtension();
        $gambarName = 'menu/' . $uniqueName;
        
        // Create menu directory if it doesn't exist
        if (!file_exists(public_path('menu'))) {
            mkdir(public_path('menu'), 0755, true);
        }
        
        $gambar->move(public_path('menu'), $uniqueName);

        Menu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $gambarName
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil ditambahkan');
    }

    public function editMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            $oldImage = str_replace('menu/', '', $menu->gambar);
            if (file_exists(public_path('menu/' . $oldImage))) {
                unlink(public_path('menu/' . $oldImage));
            }
            
            // Upload new image directly to public/menu
            $gambar = $request->file('gambar');
            $uniqueName = uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambarName = 'menu/' . $uniqueName;
            
            // Create menu directory if it doesn't exist
            if (!file_exists(public_path('menu'))) {
                mkdir(public_path('menu'), 0755, true);
            }
            
            $gambar->move(public_path('menu'), $uniqueName);
            $menu->gambar = $gambarName;
        }

        $menu->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diperbarui');
    }

    public function deleteMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $oldImage = str_replace('menu/', '', $menu->gambar);
        if (file_exists(public_path('menu/' . $oldImage))) {
            unlink(public_path('menu/' . $oldImage));
        }
        $menu->delete();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus');
    }

    public function manageUsers()
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.users.index', compact('users'));
    }

    public function toggleBanUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned;
        $user->save();

        $status = $user->is_banned ? 'dibanned' : 'diaktifkan kembali';
        return redirect()->route('admin.users')->with('success', "Pengguna berhasil {$status}");
    }

    public function manageOrders()
    {
        $orders = Order::with('menu')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function manageMessages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages')->with('success', 'Pesan berhasil dihapus');
    }
}