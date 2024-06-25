@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Your Cart</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else   
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->cart_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                            <td>${{ $item->product->price }}</td>
                            <td>${{ $item->product->price * $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->cart_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-4">
    <h4>Total Amount: ${{ $totalAmount }}</h4>
    <form action="{{ route('purchase.confirm') }}" method="POST">
        @csrf
        @foreach ($cartItems as $item)
            <input type="hidden" name="product_ids[]" value="{{ $item->product->product_id }}">
            <input type="hidden" name="quantities[]" value="{{ $item->quantity }}">
        @endforeach
        <button type="submit" class="btn btn-success">Buy Now</button>
    </form>
</div>

        @endif
    </div>
@endsection
