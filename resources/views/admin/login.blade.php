<!-- resources/views/auth/login.blade.php -->

@extends('admin.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Login</h2>
    <form action="{{url('admin.login')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="{{url('/register')}}" class="register-btn">Register</a>
    </form>
</div>
@endsection
