<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index($orderId)
    {
        $order = Order::findOrFail($orderId);
        $orderItems = $order->orderItems;

        return view('order_items.index', compact('order', 'orderItems'));
    }

    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        $products = Product::all();

        return view('order_items.create', compact('order', 'products'));
    }

    public function store(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric'
        ]);

        $product = Product::findOrFail($request->product_id);

        $orderItem = new OrderItem([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $request->price
        ]);

        $order->orderItems()->save($orderItem);

        return redirect()->route('orders.show', $order->id)->with('success', 'Order item added successfully.');
    }

    public function edit($orderId, $orderItemId)
    {
        $order = Order::findOrFail($orderId);
        $orderItem = OrderItem::findOrFail($orderItemId);
        $products = Product::all();

        return view('order_items.edit', compact('order', 'orderItem', 'products'));
    }

    public function update(Request $request, $orderId, $orderItemId)
    {
        $order = Order::findOrFail($orderId);
        $orderItem = OrderItem::findOrFail($orderItemId);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric'
        ]);

        $orderItem->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Order item updated successfully.');
    }

    public function destroy($orderId, $orderItemId)
    {
        $orderItem = OrderItem::findOrFail($orderItemId);
        $orderItem->delete();

        return redirect()->route('orders.show', $orderId)->with('success', 'Order item deleted successfully.');
    }
}
