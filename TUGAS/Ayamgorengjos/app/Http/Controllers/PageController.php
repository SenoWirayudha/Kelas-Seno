<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $menus = \App\Models\Menu::all();
        return view('home', ['menus' => $menus]);
    }

    public function profil()
    {
        return view('profil');
    }

    public function order()
    {
        $menus = \App\Models\Menu::all();
        return view('order', ['menus' => $menus]);
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function chatting()
    {
        return view('chatting');
    }

    public function checkout()
    {
        if(!session('cart')) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja kosong!');
        }
        
        $cart = session()->get('cart');
        $total = 0;
        
        foreach($cart as $details) {
            $total += $details['harga'] * $details['quantity'];
        }
        
        return view('checkout', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function checkoutDirect(Request $request)
    {
        $menu = \App\Models\Menu::findOrFail($request->menu_id);
        $cart = [
            $request->menu_id => [
                'nama' => $menu->nama,
                'quantity' => $request->quantity,
                'harga' => $menu->harga,
                'gambar' => $menu->gambar
            ]
        ];
        
        session()->put('cart', $cart);
        return redirect()->route('checkout');
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20'
        ]);

        $cart = session()->get('cart');
        if(!$cart) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja kosong!');
        }

        $total = 0;
        foreach($cart as $id => $details) {
            $menu = \App\Models\Menu::findOrFail($id);
            \App\Models\Order::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'menu_id' => $id,
                'quantity' => $details['quantity'],
                'total_harga' => $details['harga'] * $details['quantity'],
                'status' => 'pending'
            ]);
            $total += $details['harga'] * $details['quantity'];
        }

        // Clear the cart after successful order
        session()->forget('cart');

        return redirect()->route('home')
            ->with('success', 'Pesanan akan segera dikirim, pantengin whatsappnya ya, kami akan chat kamu');
    }

    public function cart()
    {
        return view('cart');
    }

    public function addToCart(Request $request)
    {
        $menu = \App\Models\Menu::findOrFail($request->menu_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['quantity']++;
        } else {
            $cart[$request->menu_id] = [
                'nama' => $menu->nama,
                'quantity' => 1,
                'harga' => $menu->harga,
                'gambar' => $menu->gambar
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Keranjang berhasil diupdate!');
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang!');
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string'
        ]);

        \App\Models\Message::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan
        ]);

        return redirect()->back()->with('success', 'Pesan sudah dikirim');
    }
}
