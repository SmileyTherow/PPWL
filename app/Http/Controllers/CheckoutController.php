<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('user.checkout', compact('cart'));
    }

    // Proses checkout: simpan order & items ke DB
    public function process(Request $request)
    {
        $cart = Session::get('cart', []);
        if (!$cart || count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'metode' => 'required|string',
        ]);

        // hitung total
        $grandTotal = 0;
        foreach ($cart as $id => $item) {
            $grandTotal += ($item['harga'] * $item['quantity']);
        }

        // buat order
        $order = Order::create([
            'user_id' => Auth::id(),
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'telepon' => $validated['telepon'],
            'metode' => $validated['metode'],
            'total' => $grandTotal,
            'status' => 'pending',
        ]);

        // simpan order items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'nama' => $item['nama'],
                'quantity' => $item['quantity'],
                'harga' => $item['harga'],
                'subtotal' => $item['harga'] * $item['quantity'],
            ]);
        }

        // kosongkan keranjang
        Session::forget('cart');

        return redirect()->route('checkout.index')->with('success', 'Pesanan berhasil diproses! Nomor pesanan: ' . $order->id);
    }
}
