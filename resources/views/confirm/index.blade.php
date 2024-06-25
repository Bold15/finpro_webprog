<!-- resources/views/confirm/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unconfirmed Purchases</title>
</head>
<body>
    <h1>Unconfirmed Purchases</h1>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if($purchases->isEmpty())
        <p>No unconfirmed purchases found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->purchase_id }}</td>
                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>
                            <form action="{{ route('confirm.confirm', $purchase) }}" method="POST">
                                @csrf
                                <button type="submit">Confirm</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
