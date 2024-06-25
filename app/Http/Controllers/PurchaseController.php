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
    // Validate input
    $validatedData = $request->validate([
        'product_ids' => 'required|array',
        'product_ids.*' => 'exists:products,product_id',
        'quantities' => 'required|array',
        'quantities.*' => 'integer|min:1',
    ]);

    // Debug: Check the validated data
    dd($validatedData);

    $productIds = $request->input('product_ids');
    $quantities = $request->input('quantities');

    if (count($productIds) !== count($quantities)) {
        return redirect()->back()->withErrors('Product IDs and quantities do not match.');
    }

    $user = Auth::user();
    $addresses = Address::where('user_id', $user->id)->get();

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
        // Validate input
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,product_id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'proof_of_payment' => 'required|image|max:2048',
        ]);

        $proofOfPaymentPath = $request->file('proof_of_payment')->store('proof_of_payments', 'public');

        $productIds = $request->input('product_ids');
        $quantities = $request->input('quantities');

        if (count($productIds) !== count($quantities)) {
            return redirect()->back()->withErrors('Product IDs and quantities do not match.');
        }

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
