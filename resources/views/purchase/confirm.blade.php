<!-- resources/views/purchase/confirm.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase</title>
</head>
<body>
    <h1>Confirm Purchase</h1>

    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ route('purchase.finalize') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @foreach($products as $index => $product)
            <div>
                <span>{{ $product->name }} - {{ $quantities[$index] }} x {{ $product->price }}</span>
                <input type="hidden" name="product_ids[]" value="{{ $product->product_id }}">
                <input type="hidden" name="quantities[]" value="{{ $quantities[$index] }}">
            </div>
        @endforeach

        <div>
            <label for="proof_of_payment">Proof of Payment:</label>
            <input type="file" name="proof_of_payment" id="proof_of_payment" required>
        </div>

        <button type="submit">Finalize Purchase</button>
    </form>
</body>
</html>
