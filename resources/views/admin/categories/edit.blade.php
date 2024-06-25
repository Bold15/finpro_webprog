@extends('admin.layouts.master')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('admin.categories.update', $category->category_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
