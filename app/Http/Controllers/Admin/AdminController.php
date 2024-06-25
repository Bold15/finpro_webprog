<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'pending')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function confirmOrder(Order $order)
    {
        // Ubah status pesanan menjadi confirmed
        $order->status = 'confirmed';
        $order->save();

        // Kurangi stok barang yang terkait dengan pesanan
        foreach ($order->items as $item) {
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }

        return redirect()->back()->with('success', 'Pesanan dikonfirmasi dan stok barang telah dikurangi.');
    }
}
