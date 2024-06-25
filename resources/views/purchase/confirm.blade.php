@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Konfirmasi Pembelian</h1>
        <div class="card">
            <div class="card-body">
                <h5>Produk yang Dipesan:</h5>
                <ul>
                    @foreach ($products as $index => $product)
                        <li>{{ $product->name }} - {{ $quantities[$index] }} pcs - ${{ $product->price * $quantities[$index] }}</li>
                    @endforeach
                </ul>
                <h5>Alamat Pengiriman:</h5>
                <ul>
                    @foreach ($addresses as $address)
                        <li>
                            {{ $address->alamat }}<br>
                            {{ $address->provinsi }}, {{ $address->kota }}<br>
                            {{ $address->kecamatan }}, {{ $address->kabupaten }}<br>
                            {{ $address->kode_pos }}<br>
                            {{ $address->nomor_hp }}
                        </li>
                    @endforeach
                </ul>
                <h5>Total Harga: ${{ $totalAmount }}</h5>
                <form action="{{ route('purchase.finalize') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach ($productIds as $productId)
                        <input type="hidden" name="product_ids[]" value="{{ $productId }}">
                    @endforeach
                    @foreach ($quantities as $quantity)
                        <input type="hidden" name="quantities[]" value="{{ $quantity }}">
                    @endforeach
                    <div class="form-group">
                        <label for="proof_of_payment">Unggah Bukti Pembayaran:</label>
                        <input type="file" class="form-control" id="proof_of_payment" name="proof_of_payment" required>
                    </div>
                    <button type="submit" class="btn btn-success">Konfirmasi Pembelian</button>
                </form>
            </div>
        </div>
    </div>
@endsection