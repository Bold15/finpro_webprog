<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function confirm(Request $request)
    {
        $productIds = $request->input('product_ids');
        $quantities = $request->input('quantities');

        $user = Auth::user();
        $addresses = Address::where('user_id', $user->user_id)->get();

        $products = Product::whereIn('product_id', $productIds)->get();
        $totalAmount = 0;
        foreach ($products as $product) {
            $index = array_search($product->product_id, $productIds);
            $totalAmount += $product->price * $quantities[$index];
        }

        return view('purchase.confirm', compact('products', 'quantities', 'addresses', 'totalAmount', 'productIds'));
    }

    public function finalize(Request $request)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|max:2048',
        ]);

        $proofOfPaymentPath = $request->file('proof_of_payment')->store('proof_of_payments', 'public');

        $productIds = $request->input('product_ids');
        $quantities = $request->input('quantities');

        foreach ($productIds as $index => $productId) {
            $quantity = $quantities[$index];

            Purchase::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => $quantity,
                'proof_of_payment' => $proofOfPaymentPath,
            ]);
        }

        // Clear the cart
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('cart.index')->with('success', 'Pembelian berhasil! Bukti pembayaran Anda telah dikirim.');
    }
}