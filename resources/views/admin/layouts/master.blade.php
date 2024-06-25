<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <!-- @auth -->
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('products.create') ? 'active' : '' }}" href="{{ route('products.create') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('categories.create') ? 'active' : '' }}" href="{{ route('categories.create') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('purchase.confirm') ? 'active' : '' }}" href="{{ route('purchase.confirm') }}">Order</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('profile.show') ? 'active' : '' }}" href="{{ route('profile.show') }}">Profile</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li> -->
                <!-- @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.register') }}">Register</a>
                    </li> -->
                <!-- @endauth -->
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
