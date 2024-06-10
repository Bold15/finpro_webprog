<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart;
        $cartItems = $cart ? $cart->items : [];

        return view('cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Auth::user()->cart ?? Cart::create(['user_id' => Auth::id()]);
        $product = Product::findOrFail($request->product_id);

        $cartItem = $cart->items()->where('product_id', $product->id)->first();
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function addItem(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');

    // Ambil keranjang belanja dari sesi
    $cart = session()->get('cart', []);

    // Periksa apakah produk sudah ada di keranjang
    if (isset($cart[$productId])) {
        // Tambahkan kuantitas
        $cart[$productId] += $quantity;
    } else {
        // Tambahkan produk baru
        $cart[$productId] = $quantity;
    }

    // Simpan keranjang belanja kembali ke sesi
    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Item added to cart successfully.');
}

}
