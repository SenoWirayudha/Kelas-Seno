<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string'
        ]);

        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->route('cart')
                ->with('error', 'Keranjang belanja kosong!');
        }

        $total_price = 0;
        foreach ($cart as $id => $details) {
            $total_price += $details['harga'] * $details['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'telepon' => $validated['telepon'],
            'total_price' => $total_price,
            'status' => 'pending'
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['harga']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat! Kami akan menghubungi Anda melalui WhatsApp untuk konfirmasi.');
    }

    public function show($id)
    {
        $order = Order::with(['items.menu'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}