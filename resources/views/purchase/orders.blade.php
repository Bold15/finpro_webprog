@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Daftar Pesanan</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($purchases->isEmpty())
            <p class="text-center">Tidak ada pesanan yang ditemukan.</p>
        @else
            @foreach($purchases as $purchase)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan #{{ $purchase->id }}</h5>
                        <ul class="list-group mb-4">
                            @if(is_array($purchase->product_ids) && is_array($purchase->quantities))
                                @foreach($purchase->product_ids as $index => $productId)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $purchase->product->find($productId)->name }} - {{ $purchase->quantities[$index] }} x ${{ $purchase->product->find($productId)->price }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item">Data produk tidak tersedia.</li>
                            @endif
                        </ul>

                        <p><strong>Total Pembayaran:</strong> ${{ $purchase->totalAmount }}</p>
                        <p><strong>Bukti Pembayaran:</strong></p>
                        <img src="{{ asset('storage/' . $purchase->proof_of_payment) }}" alt="Bukti Pembayaran" class="img-fluid">

                        @if($purchase->status !== 'confirmed')
                            <form action="{{ route('purchase.confirmOrder', $purchase->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary mt-2">Konfirmasi Pesanan</button>
                            </form>
                        @else
                            <p class="text-success mt-2">Pesanan telah dikonfirmasi.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
