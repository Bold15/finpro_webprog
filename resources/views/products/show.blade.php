@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $product->name }}</h1>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ $product->price }}</p>
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
