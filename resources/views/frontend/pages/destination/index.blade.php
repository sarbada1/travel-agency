@extends('frontend.app.main')
@section('content')
    <!-- Page Header -->
    <div class="py-5 text-white bg-primary page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="fw-bold slide-in-left">Explore Destinations</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="mb-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-white-50">Home</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Destinations</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/600x300?text=Explore+Destinations" class="rounded float-md-end img-fluid slide-in-right" alt="Destinations">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div class="py-4 bg-light filter-section">
        <div class="container">
            <div class="p-4 bg-white rounded shadow-sm">
                <form action="{{ route('destinations') }}" method="get" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search destinations..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="continent" class="form-label">Continent</label>
                        <select class="form-select" id="continent" name="continent">
                            <option value="">All Continents</option>
                            <option value="asia" {{ request('continent') == 'asia' ? 'selected' : '' }}>Asia</option>
                            <option value="europe" {{ request('continent') == 'europe' ? 'selected' : '' }}>Europe</option>
                            <option value="north_america" {{ request('continent') == 'north_america' ? 'selected' : '' }}>North America</option>
                            <option value="south_america" {{ request('continent') == 'south_america' ? 'selected' : '' }}>South America</option>
                            <option value="africa" {{ request('continent') == 'africa' ? 'selected' : '' }}>Africa</option>
                            <option value="australia" {{ request('continent') == 'australia' ? 'selected' : '' }}>Australia</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="sort" class="form-label">Sort By</label>
                        <select class="form-select" id="sort" name="sort">
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popularity</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price (High to Low)</option>
                        </select>
                    </div>
                    <div class="d-flex col-md-2 align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Destinations List -->
    <section class="py-5">
        <div class="container">
            @if($destinations->count() > 0)
                <div class="mb-4 row g-4">
                    @foreach($destinations as $destination)
                        <div class="col-lg-4 col-md-6">
                            <div class="border-0 shadow-sm card h-100 hover-scale">
                                @if($destination->image)
                                    <img src="{{ asset($destination->image) }}" class="card-img-top destination-img" alt="{{ $destination->name }}">
                                @else
                                    <img src="https://via.placeholder.com/600x400?text={{ urlencode($destination->name) }}" class="card-img-top destination-img" alt="{{ $destination->name }}">
                                @endif
                                
                                @if($destination->is_featured)
                                    <div class="top-0 px-3 py-1 m-3 text-white rounded position-absolute start-0 bg-info">Featured</div>
                                @endif
                                
                                @if($destination->is_popular)
                                    <div class="top-0 px-3 py-1 m-3 text-white rounded position-absolute end-0 bg-danger">Popular</div>
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title">{{ $destination->name }}</h4>
                                    <p class="mb-3 text-muted small">
                                        <i class="fas fa-map-marker-alt me-1"></i> 
                                        {{ $destination->region ?? 'Worldwide' }}
                                    </p>
                                    <p class="card-text flex-grow-1">{!! Str::limit($destination->description, 120) !!}</p>
                                    
                                    <div class="pt-3 mt-auto border-top">
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if($destination->starting_price)
                                                <div class="text-primary fw-bold">From ${{ number_format($destination->starting_price) }}</div>
                                            @else
                                                <div class="text-primary fw-bold">Explore Now</div>
                                            @endif
                                            <a href="{{ route('destination.show', $destination->slug) }}" class="btn btn-outline-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-5">
                    {{ $destinations->links('vendor.pagination.custom') }}
                </div>
                
            @else
                <div class="p-5 text-center">
                    <i class="mb-3 fas fa-map-marked-alt fa-4x text-muted"></i>
                    <h3>No Destinations Found</h3>
                    <p class="text-muted">We couldn't find any destinations matching your criteria.</p>
                    <a href="{{ route('destinations') }}" class="btn btn-primary">View All Destinations</a>
                </div>
            @endif
        </div>
    </section>
    
    <!-- Newsletter -->
    <section class="py-5 text-white newsletter-section bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mb-4 col-lg-6 mb-lg-0">
                    <h3 class="fw-bold">Get Travel Inspiration</h3>
                    <p class="mb-0">Subscribe to our newsletter for exclusive destination guides and travel tips.</p>
                </div>
                <div class="col-lg-6">
                    <form class="newsletter-form d-flex">
                        <input type="email" class="form-control me-2" placeholder="Your email address" required>
                        <button type="submit" class="btn btn-light">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .destination-img {
        height: 240px;
        object-fit: cover;
    }
    
    @media (max-width: 768px) {
        .page-header {
            text-align: center;
        }
        
        .page-header img {
            margin-top: 20px;
            float: none !important;
        }
    }
</style>
@endsection