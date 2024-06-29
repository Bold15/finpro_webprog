@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Konfirmasi Pembelian</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Produk yang Dipesan</h3>
                <ul class="list-group mb-4">
                    @foreach($products as $index => $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $product->name }} - {{ $quantities[$index] }} x ${{ $product->price }}</span>
                            <input type="hidden" name="product_ids[]" value="{{ $product->product_id }}">
                            <input type="hidden" name="quantities[]" value="{{ $quantities[$index] }}">
                        </li>
                    @endforeach
                </ul>

                <h3 class="card-title">Total Pembayaran</h3>
                <p class="card-text">${{ $totalAmount }}</p>

                <ul class="list-group mb-4">
                    @foreach ($addresses as $address)
                        <li class="list-group-item">
                            {{ $address->alamat }}, {{ $address->kota }}, {{ $address->provinsi }}, {{ $address->kode_pos }}
                        </li>
                    @endforeach
                </ul>

                <form action="{{ route('purchase.finalize') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach ($productIds as $index => $productId)
                        <input type="hidden" name="product_ids[]" value="{{ $productId }}">
                        <input type="hidden" name="quantities[]" value="{{ $quantities[$index] }}">
                    @endforeach

                    <div class="form-group">
                        <label for="proof_of_payment">Unggah Bukti Pembayaran:</label>
                        <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-control-file" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Finalisasi Pembelian</button>
                </form>
            </div>
        </div>
    </div>
@endsection
