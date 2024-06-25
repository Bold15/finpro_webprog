@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Create Category</h1>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">View All Categories</a>
            </div>
        </div>
    </div>
@endsection
