@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Your Addresses</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($addresses->isEmpty())
            <p>You have no addresses.</p>
        @else   
            <ul class="list-group">
                @foreach ($addresses as $address)
                    <li class="list-group-item">
                        {{ $address->alamat }}<br>
                        {{ $address->provinsi }}<br>
                        {{ $address->kota }}, {{ $address->kecamatan }} {{ $address->kabupaten }}<br>
                        {{ $address->kode_pos }}<br>
                        {{ $address->nomor_hp }}
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ route('addresses.create') }}" class="btn btn-primary mt-3">Add Address</a>
    </div>
@endsection
