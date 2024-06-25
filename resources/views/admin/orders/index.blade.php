@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Pesanan yang Menunggu Konfirmasi</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($orders->isEmpty())
            <p>Tidak ada pesanan yang perlu dikonfirmasi saat ini.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>User</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>${{ $order->total_amount }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Konfirmasi Pesanan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
