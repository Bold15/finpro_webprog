<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['user', 'product'])->get();
        return view('admin.carts.index', compact('carts'));
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('admin.carts.index')->with('success', 'Cart item deleted successfully.');
    }
}

