<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Debugbar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar-nav .dropdown-menu {
            margin-top: 0.5rem;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-bug"></i> DebugbarApp
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}"><i class="fas fa-info-circle"></i> About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('db-test') }}"><i class="fas fa-database"></i> DB Test</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('ajax.test') }}"><i class="fas fa-exchange-alt"></i> Ajax</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-users"></i> Users
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('users.manage.index') }}"><i class="fas fa-list"></i> Manage Users</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.manage.create') }}"><i class="fas fa-plus"></i> Add User</a></li>
                    </ul>
                </li>
                
                <li class="nav-item"><a class="nav-link" href="{{ route('posts.index') }}"><i class="fas fa-newspaper"></i> Posts</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('performance') }}"><i class="fas fa-tachometer-alt"></i> Performance</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cache.monitor') }}"><i class="fas fa-memory"></i> Cache</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @yield('content')
</div>

<footer class="bg-dark text-white text-center p-3 mt-5">
    <div class="container">
        <p class="mb-0">&copy; 2026 Laravel Debugbar Example | Debugging Made Easy</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>