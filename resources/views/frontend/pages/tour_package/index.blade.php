@extends('frontend.app.main')
@section('content')
    <!-- Page Header -->
    <div class="py-5 text-white bg-primary page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="fw-bold slide-in-left">Tour Packages</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="mb-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Tour Packages</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/600x300?text=Explore+Tours" class="float-md-end img-fluid rounded slide-in-right" alt="Tour Packages">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Advanced Search/Filter -->
    <div class="py-4 bg-light filter-section">
        <div class="container">
            <div class="p-4 bg-white rounded shadow-sm">
                <form action="{{ route('tour-packages') }}" method="get" class="row g-3">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search packages..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="destination" class="form-label">Destination</label>
                        <select class="form-select" id="destination" name="destination">
                            <option value="">All Destinations</option>
                            <!-- Loop through destinations -->
                            <option value="bali">Bali, Indonesia</option>
                            <option value="paris">Paris, France</option>
                            <option value="tokyo">Tokyo, Japan</option>
                            <option value="new-york">New York, USA</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="duration" class="form-label">Duration</label>
                        <select class="form-select" id="duration" name="duration">
                            <option value="">Any</option>
                            <option value="1-3">1-3 Days</option>
                            <option value="4-7">4-7 Days</option>
                            <option value="8-14">8-14 Days</option>
                            <option value="15+">15+ Days</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="price" class="form-label">Price Range</label>
                        <select class="form-select" id="price" name="price">
                            <option value="">Any</option>
                            <option value="0-500">$0 - $500</option>
                            <option value="500-1000">$500 - $1,000</option>
                            <option value="1000-2000">$1,000 - $2,000</option>
                            <option value="2000+">$2,000+</option>
                        </select>
                    </div>
                    <div class="d-flex col-md-2 align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Sort Options -->
    <div class="container mt-4">
        <div class="mb-4 row align-items-center">
            <div class="col-md-6">
                <p class="mb-md-0">Showing <strong>{{ $tourPackages->firstItem() ?? 0 }}</strong> to <strong>{{ $tourPackages->lastItem() ?? 0 }}</strong> of <strong>{{ $tourPackages->total() ?? 0 }}</strong> tour packages</p>
            </div>
            <div class="text-md-end col-md-6">
                <div class="btn-group" role="group">
                    <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}" class="btn {{ request('view', 'grid') == 'grid' ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fas fa-th-large"></i>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}" class="btn {{ request('view') == 'list' ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fas fa-list"></i>
                    </a>
                </div>
                <select class="ms-2 form-select form-select-sm d-inline-block w-auto" onchange="location = this.value;">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}" {{ request('sort') == 'popular' ? 'selected' : '' }}>Sort by: Popularity</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Sort by: Price (Low to High)</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Sort by: Price (High to Low)</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'duration_short']) }}" {{ request('sort') == 'duration_short' ? 'selected' : '' }}>Sort by: Duration (Shortest)</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'duration_long']) }}" {{ request('sort') == 'duration_long' ? 'selected' : '' }}>Sort by: Duration (Longest)</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Sort by: Newest First</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Tour Packages List -->
    <section class="pb-5">
        <div class="container">
            @if($tourPackages->count() > 0)
                @if(request('view') == 'list')
                    <!-- List View -->
                    <div class="mb-4 row g-4">
                        @foreach($tourPackages as $package)
                            <div class="col-12">
                                <div class="border-0 shadow-sm card overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-md-4 position-relative">
                                            @if($package->featured_image)
                                                <img src="{{ asset($package->featured_image) }}" class="h-100 w-100 object-fit-cover" alt="{{ $package->name }}">
                                            @else
                                                <img src="https://via.placeholder.com/600x400?text={{ urlencode($package->name) }}" class="h-100 w-100 object-fit-cover" alt="{{ $package->name }}">
                                            @endif
                                            <div class="top-0 px-3 py-1 m-3 text-white rounded package-duration position-absolute end-0 bg-primary">{{ $package->duration_days }} Days</div>
                                            
                                            @if($package->is_featured)
                                                <div class="top-0 px-3 py-1 m-3 text-white rounded position-absolute start-0 bg-danger">Featured</div>
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body d-flex flex-column h-100">
                                                <div class="mb-3 d-flex justify-content-between align-items-start">
                                                    <h4 class="card-title">{{ $package->name }}</h4>
                                                    <div class="rating">
                                                        <span class="me-1 text-warning"><i class="fas fa-star"></i> 4.8</span>
                                                        <span class="text-muted">({{ rand(10, 99) }})</span>
                                                    </div>
                                                </div>
                                                
                                                <p class="mb-4 card-text">{{ Str::limit($package->description, 150) }}</p>
                                                
                                                <div class="mb-4 row package-features g-3">
                                                    <div class="col-auto">
                                                        <span class="badge bg-light text-dark">
                                                            <i class="fas fa-map-marker-alt me-1"></i> 
                                                            {{ $package->destinations && $package->destinations->count() > 0 ? $package->destinations->first()->name : 'Multiple Destinations' }}
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span class="badge bg-light text-dark">
                                                            <i class="fas fa-users me-1"></i> Max People: {{ $package->max_people ?? 'Any' }}
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span class="badge bg-light text-dark">
                                                            <i class="fas fa-hotel me-1"></i> 
                                                            {{ $package->accommodation_type ?? 'Hotels' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="text-muted small">Starting from</div>
                                                        @if($package->sale_price && $package->sale_price < $package->regular_price)
                                                            <div>
                                                                <span class="text-muted text-decoration-line-through me-2">${{ number_format($package->regular_price) }}</span>
                                                                <span class="h5 text-primary fw-bold">${{ number_format($package->sale_price) }}</span>
                                                            </div>
                                                        @else
                                                            <div class="h5 text-primary fw-bold">${{ number_format($package->regular_price) }}</div>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('tour-package.show', $package->slug) }}" class="btn btn-primary">View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Grid View -->
                    <div class="mb-4 row g-4">
                        @foreach($tourPackages as $package)
                            <div class="col-lg-4 col-md-6 package-item">
                                <div class="border-0 shadow-sm card h-100 hover-scale">
                                    <div class="position-relative">
                                        @if($package->featured_image)
                                            <img src="{{ asset($package->featured_image) }}" class="card-img-top package-img" alt="{{ $package->name }}">
                                        @else
                                            <img src="https://via.placeholder.com/600x400?text={{ urlencode($package->name) }}" class="card-img-top package-img" alt="{{ $package->name }}">
                                        @endif
                                        <div class="top-0 px-3 py-1 m-3 text-white rounded package-duration position-absolute end-0 bg-primary">{{ $package->duration_days }} Days</div>
                                        
                                        @if($package->is_featured)
                                            <div class="top-0 px-3 py-1 m-3 text-white rounded position-absolute start-0 bg-danger">Featured</div>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-2 d-flex justify-content-between align-items-start">
                                            <h5 class="card-title">{{ $package->name }}</h5>
                                            <div class="rating">
                                                <span class="me-1 text-warning"><i class="fas fa-star"></i> 4.8</span>
                                                <span class="text-muted small">({{ rand(10, 99) }})</span>
                                            </div>
                                        </div>
                                        
                                        <p class="card-text">{{ Str::limit($package->description, 100) }}</p>
                                        
                                        <div class="mb-3 package-features">
                                            @if($package->destinations && $package->destinations->count() > 0)
                                                <span class="mb-2 badge bg-light text-dark me-2">
                                                    <i class="fas fa-map-marker-alt me-1"></i> 
                                                    {{ $package->destinations->first()->name }}
                                                </span>
                                            @endif
                                            
                                            <span class="mb-2 badge bg-light text-dark me-2">
                                                <i class="fas fa-users me-1"></i> 
                                                {{ $package->max_people ?? 'Any' }} People
                                            </span>
                                            
                                            <span class="mb-2 badge bg-light text-dark me-2">
                                                <i class="fas fa-utensils me-1"></i> Meals Included
                                            </span>
                                        </div>
                                        
                                        <div class="pt-3 mt-auto border-top">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    @if($package->sale_price && $package->sale_price < $package->regular_price)
                                                        <span class="text-muted text-decoration-line-through me-1">${{ number_format($package->regular_price) }}</span>
                                                        <span class="text-primary fw-bold">${{ number_format($package->sale_price) }}</span>
                                                    @else
                                                        <span class="text-primary fw-bold">${{ number_format($package->regular_price) }}</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('tour-package.show', $package->slug) }}" class="btn btn-primary btn-sm">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $tourPackages->links() }}
                </div>
                
            @else
                <div class="p-5 text-center">
                    <i class="mb-3 fas fa-suitcase-rolling fa-4x text-muted"></i>
                    <h3>No Tour Packages Found</h3>
                    <p class="text-muted">We couldn't find any tour packages matching your criteria.</p>
                    <a href="{{ route('tour-packages') }}" class="btn btn-primary">View All Packages</a>
                </div>
            @endif
        </div>
    </section>
    
    <!-- Popular Destinations -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-4 fw-bold text-center">Popular Destinations</h2>
            <div class="row g-4">
                <!-- Would be dynamic from your destinations data -->
                <div class="col-lg-3 col-md-6">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Bali" class="card-img-top" alt="Bali">
                        <div class="card-body">
                            <h5 class="card-title">Bali, Indonesia</h5>
                            <p class="card-text">Discover paradise on the Island of the Gods.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Paris" class="card-img-top" alt="Paris">
                        <div class="card-body">
                            <h5 class="card-title">Paris, France</h5>
                            <p class="card-text">Experience the magic of the City of Light.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Tokyo" class="card-img-top" alt="Tokyo">
                        <div class="card-body">
                            <h5 class="card-title">Tokyo, Japan</h5>
                            <p class="card-text">Immerse yourself in Japanese culture and innovation.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=New+York" class="card-img-top" alt="New York">
                        <div class="card-body">
                            <h5 class="card-title">New York, USA</h5>
                            <p class="card-text">Explore the vibrant Big Apple and its landmarks.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Call to Action -->
    <section class="py-5 text-white bg-primary cta-section">
        <div class="container">
            <div class="p-5 rounded-3 cta-container">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <h2 class="fw-bold">Ready for an unforgettable adventure?</h2>
                        <p class="mb-0 lead">Contact our travel experts today to plan your dream vacation.</p>
                    </div>
                    <div class="text-lg-end col-lg-4">
                        <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .package-img {
        height: 240px;
        object-fit: cover;
    }
    
    .cta-container {
        background: linear-gradient(to right, var(--primary-color), #0a58ca);
        border-radius: 10px;
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