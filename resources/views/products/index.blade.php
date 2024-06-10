@extends('layout.master')

@section('content')
    <h1>Products</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">${{ $product->price }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View Product</a>
                        <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit">Add to Cart</button>
</form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
