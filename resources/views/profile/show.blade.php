@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Profile</h1>
        <div class="card">
            <div class="card-body">
            <p><strong>ID:</strong> {{ $user->user_id }}</p>
            <p><strong>NIK:</strong> {{ $user->NIK }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Nomor HP:</strong> {{ $user->nomor_hp }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>

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