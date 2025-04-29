@section('header')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seo['title'] ?? 'Default Title' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Default Description' }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? '' }}">
    <!-- Open Graph Tags -->
    <meta property="og:type" content="{{ $seo['og:type'] ?? 'website' }}">
    <meta property="og:url" content="{{ $seo['og:url'] ?? url('/') }}">
    <meta property="og:image" content="{{ $seo['og:image'] ?? asset('default-image.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{url('assets/css/frontend.css')}}">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{route('index')}}">Booking System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('real-estate')}}">Real-estate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('jobs')}}">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('blogs')}}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('news')}}">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact')}}">Contact</a>
                </li>
            </ul>
@auth
@if(auth()->user()->account_type_id == 3)
    <a href="{{ route('seller.create') }}" class="btn btn-primary btn-sm mx-3 mr-5" >
        <i class="bi bi-plus-circle me-1"></i> Add Listing
    </a>
@endif
@endauth
            @guest
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                </div>
            @else
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('company-backend') }}">Dashboard</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
</nav>

@endsection