@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>{{ $category->name }}</h1>
        <p>ID: {{ $category->id }}</p>
        <p>Created At: {{ $category->created_at }}</p>
        <p>Updated At: {{ $category->updated_at }}</p>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Categories</a>
    </div>
@endsection
