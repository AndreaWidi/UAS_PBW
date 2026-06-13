<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Daftar pesanan milik customer yang login
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.menu')
                       ->latest()
                       ->get();

        return view('orders.index', compact('orders'));
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'items'         => 'required|array|min:1',
            'items.*.id'    => 'required|exists:menus,id',
            'items.*.qty'   => 'required|integer|min:1|max:10',
            'note'          => 'nullable|string|max:255',
        ], [
            'items.required' => 'Pilih minimal 1 menu.',
            'items.min'      => 'Pilih minimal 1 menu.',
        ]);

        DB::transaction(function () use ($request) {
            $totalPrice = 0;

            // Hitung total
            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['id']);
                $totalPrice += $menu->price * $item['qty'];
            }

            // Buat order
            $order = Order::create([
                'user_id'     => Auth::id(),
                'note'        => $request->note,
                'total_price' => $totalPrice,
                'status'      => 'pending',
            ]);

            // Buat order items
            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['id']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id'  => $item['id'],
                    'qty'      => $item['qty'],
                    'subtotal' => $menu->price * $item['qty'],
                ]);
            }
        });

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dikirim! ☕');
    }
}
