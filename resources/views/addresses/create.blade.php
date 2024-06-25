@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Add Address</h1>
        <form action="{{ route('addresses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi:</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi">
            </div>
            <div class="form-group">
                <label for="kota">Kota:</label>
                <input type="text" class="form-control" id="kota" name="kota" required>
            </div>
            <div class="form-group">
                <label for="kecamatan">Kecamatan:</label>
                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
            </div>
            <div class="form-group">
                <label for="kabupaten">Kabupaten:</label>
                <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
            </div>
            <div class="form-group">
                <label for="kode_pos">Kode Pos:</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
            </div>
            <div class="form-group">
                <label for="nomor_hp">Nomor HP:</label>
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Address</button>
        </form>
    </div>
@endsection
