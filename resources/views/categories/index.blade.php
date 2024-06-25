@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Categories</h1>
                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
    <tr>
        <td>{{ $category->category_id}}</td>
        <td>{{ $category->name }}</td>
        <td>
            <a href="{{ route('categories.edit', $category->category_id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
