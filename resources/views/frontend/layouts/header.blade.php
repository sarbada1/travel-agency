@section('header')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wanderlust - Travel & Tours</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('assets/css/frontend.css')}}">

</head>
<body>
    <!-- Top Header -->
    <div class="py-2 text-white top-header bg-dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="flex-wrap contact-info d-flex">
                        <div class="me-4"><i class="fas fa-phone-alt me-2"></i> +1 (234) 567-8900</div>
                        <div><i class="fas fa-envelope me-2"></i> info@wanderlust.com</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="social-links text-md-end">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header with Mega Menu -->
    <header class="main-header sticky-top">
        <nav class="bg-white shadow-sm navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="https://via.placeholder.com/180x60?text=Wanderlust" alt="Wanderlust Logo" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="mb-2 navbar-nav me-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        
                        @foreach($mainCategories as $mainCategory)
                        <!-- {{ $mainCategory->name }} Mega Menu -->
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" id="{{ Str::slug($mainCategory->name) }}Dropdown" role="button" data-bs-toggle="dropdown">
                                {{ $mainCategory->name }}
                            </a>
                            <div class="dropdown-menu megamenu" aria-labelledby="{{ Str::slug($mainCategory->name) }}Dropdown">
                                <div class="container">
                                    <div class="row g-3">
                                        @foreach($mainCategory->children->chunk(ceil($mainCategory->children->count() / 4)) as $chunk)
                                            <div class="col-lg-3">
                                                @foreach($chunk as $subcategory)
                                                <div class="col-megamenu">
                                                    <h6 class="title">{{ $subcategory->name }}</h6>
                                                    @if($subcategory->children && $subcategory->children->count() > 0)
                                                    <ul class="list-unstyled">
                                                        @foreach($subcategory->children as $childCategory)
                                                        <li><a href="{{ url($mainCategory->slug.'/'.$subcategory->slug.'/'.$childCategory->slug) }}" class="dropdown-item">{{ $childCategory->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                        
                                        @if($mainCategory->slug == 'destinations')
                                        <!-- Featured Destinations -->
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Featured Destinations</h6>
                                                <div class="row g-3">
                                                    <div class="col-6">
                                                        <img src="https://via.placeholder.com/150x100?text=Bali" class="rounded img-fluid" alt="Bali">
                                                        <p class="mt-2 mb-0 small">Bali, Indonesia</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <img src="https://via.placeholder.com/150x100?text=Paris" class="rounded img-fluid" alt="Paris">
                                                        <p class="mt-2 mb-0 small">Paris, France</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($mainCategory->slug == 'tours-packages')
                                        <!-- Featured Tours -->
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Featured Tours</h6>
                                                <div class="p-2 mb-2 rounded featured-tour bg-light">
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://via.placeholder.com/50x50?text=Tour" class="rounded me-2" alt="European Tour">
                                                        <div>
                                                            <h6 class="mb-0 fs-6">European Adventure</h6>
                                                            <span class="text-primary small">From $1,799</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="p-2 rounded featured-tour bg-light">
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://via.placeholder.com/50x50?text=Tour" class="rounded me-2" alt="Asian Tour">
                                                        <div>
                                                            <h6 class="mb-0 fs-6">Asian Explorer</h6>
                                                            <span class="text-primary small">From $1,299</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($mainCategory->slug == 'travel-services')
                                        <!-- Hot Deals -->
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Hot Deals</h6>
                                                <div class="p-2 mb-2 text-white rounded hot-deal bg-danger">
                                                    <p class="mb-1 fw-bold">Flash Sale - 48 Hours Only!</p>
                                                    <p class="mb-0 small">Up to 40% off on selected packages</p>
                                                    <a href="#" class="mt-2 btn btn-sm btn-light text-danger">View Deals</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search destinations..." aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

@endsection