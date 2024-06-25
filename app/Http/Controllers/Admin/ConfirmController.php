<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;

class ConfirmController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan yang belum dikonfirmasi
        $purchases = Purchase::where('confirmed', false)->get();

        return view('confirm.index', compact('purchases'));
    }

    public function confirm(Purchase $purchase)
    {
        // Konfirmasi pesanan
        $purchase->confirmed = true;
        $purchase->save();

        // Kurangi stok barang
        $product = Product::find($purchase->product_id);
        $product->stock -= $purchase->quantity;
        $product->save();

        return redirect()->route('confirm.index')->with('success', 'Order confirmed successfully.');
    }
}
