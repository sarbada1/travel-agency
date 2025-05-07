@extends('frontend.app.main')
@section('content')
    <!-- Hero Banner -->
    <section class="hero-banner">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1920x800?text=Beautiful+Beach+Destination" class="d-block w-100"
                        alt="Beach Destination">
                    <div class="carousel-caption">
                        <h1 class="display-4 fw-bold slide-in-left">Discover Paradise</h1>
                        <p class="lead slide-in-right">Explore the world's most beautiful beaches</p>
                        <a href="#" class="mt-3 btn btn-primary btn-lg bounce-in">Book Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1920x800?text=Mountain+Adventure" class="d-block w-100"
                        alt="Mountain Adventure">
                    <div class="carousel-caption">
                        <h1 class="display-4 fw-bold slide-in-left">Adventure Awaits</h1>
                        <p class="lead slide-in-right">Conquer mountains and create memories</p>
                        <a href="#" class="mt-3 btn btn-primary btn-lg bounce-in">Explore Tours</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1920x800?text=Cultural+Experience" class="d-block w-100"
                        alt="Cultural Experience">
                    <div class="carousel-caption">
                        <h1 class="display-4 fw-bold slide-in-left">Experience Cultures</h1>
                        <p class="lead slide-in-right">Immerse yourself in local traditions</p>
                        <a href="#" class="mt-3 btn btn-primary btn-lg bounce-in">Learn More</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Search Form -->
    <section class="py-5 search-section bg-light">
        <div class="container">
            <div class="p-4 bg-white rounded shadow-sm search-form-container">
                <form class="row g-3">
                    <div class="col-md-3">
                        <label for="destination" class="form-label">Destination</label>
                        <select class="form-select" id="destination">
                            <option selected>Choose destination...</option>
                            <option>Bali, Indonesia</option>
                            <option>Paris, France</option>
                            <option>Tokyo, Japan</option>
                            <option>New York, USA</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="checkIn" class="form-label">Check In</label>
                        <input type="date" class="form-control" id="checkIn">
                    </div>
                    <div class="col-md-3">
                        <label for="checkOut" class="form-label">Check Out</label>
                        <input type="date" class="form-control" id="checkOut">
                    </div>
                    <div class="col-md-2">
                        <label for="travelers" class="form-label">Travelers</label>
                        <select class="form-select" id="travelers">
                            <option selected>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4+</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Popular Destinations -->
    <section class="py-5 destinations-section">
        <div class="container">
            <div class="mb-5 text-center section-title">
                <h2 class="fw-bold">Popular Destinations</h2>
                <p class="text-muted">Explore our most sought-after travel destinations</p>
            </div>
            <div class="row g-4">
                @forelse($popularDestinations as $destination)
                    <div class="col-md-4 col-sm-6 destination-item">
                        <div class="border-0 shadow-sm card h-100 hover-scale">
                            @if ($destination->image)
                                <img src="{{ asset($destination->image) }}" class="card-img-top"
                                    alt="{{ $destination->name }}">
                            @else
                                <img src="https://via.placeholder.com/600x400?text={{ urlencode($destination->name) }}"
                                    class="card-img-top" alt="{{ $destination->name }}">
                            @endif
                            <div class="card-body">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 card-title">{{ $destination->name }}</h5>
                                    @if ($destination->is_featured)
                                        <span class="badge bg-info">Featured</span>
                                    @elseif($destination->is_popular)
                                        <span class="badge bg-primary">Popular</span>
                                    @endif
                                </div>
                                <p class="card-text">{!! Str::limit($destination->description, 100) !!}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($destination->starting_price)
                                        <span class="text-primary fw-bold">From
                                            ${{ number_format($destination->starting_price) }}</span>
                                    @else
                                        <span class="text-primary fw-bold">Explore Now</span>
                                    @endif
                                    <a href="{{ route('destination.show', $destination->slug) }}"
                                        class="btn btn-outline-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No destinations found. Please check back later!
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-5 text-center">
                <a href="{{ route('destinations') }}" class="btn btn-outline-primary btn-lg">View All Destinations</a>
            </div>
        </div>
    </section>

    <!-- Tour Packages -->
    <section class="py-5 packages-section bg-light">
        <div class="container">
            <div class="mb-5 text-center section-title">
                <h2 class="fw-bold">Popular Tour Packages</h2>
                <p class="text-muted">Curated travel experiences for every type of traveler</p>
            </div>
            <div class="row g-4">
                @forelse($popularTourPackages as $package)
                    <div class="col-lg-3 col-md-6 package-item">
                        <div class="border-0 shadow-sm card h-100 hover-scale">
                            <div class="position-relative">
                                @if ($package->featured_image)
                                    <img src="{{ asset($package->featured_image) }}" class="card-img-top"
                                        alt="{{ $package->name }}">
                                @else
                                    <img src="https://via.placeholder.com/600x400?text={{ urlencode($package->name) }}"
                                        class="card-img-top" alt="{{ $package->name }}">
                                @endif
                                <div
                                    class="top-0 px-3 py-1 m-3 text-white rounded package-duration position-absolute end-0 bg-primary">
                                    {{ $package->duration_days }} Days</div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $package->name }}</h5>

                                <!-- Ratings - you can make this dynamic later if you have a reviews system -->
                                <div class="mb-3 d-flex">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                    <span class="ms-2 text-muted">({{ rand(10, 99) }} reviews)</span>
                                </div>

                                <p class="card-text">{!! Str::limit($package->description, 100) !!}</p>

                                <!-- Package features - can be made dynamic later -->
                                <!-- filepath: /home/sarbada/Desktop/travel-agency/resources/views/frontend/pages/home/home.blade.php -->

                                <!-- Package features - now dynamic from attributes -->
                                <div class="mb-3 package-features">
                                    @if ($package->destinations && $package->destinations->count() > 0)
                                        <span class="mb-2 badge bg-light text-dark me-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $package->destinations->first()->name }}
                                        </span>
                                    @endif

                                    @php
                                        // Get attributes from both package and its categories
                                        $packageAttributes = [];

                                        // Direct package attributes if available
                                        if (method_exists($package, 'attributeValues') && $package->attributeValues) {
                                            foreach ($package->attributeValues as $attrValue) {
                                                if ($attrValue->attribute && $attrValue->value) {
                                                    $packageAttributes[] = [
                                                        'name' => $attrValue->attribute->name,
                                                        'icon' => $attrValue->attribute->icon ?? 'fas fa-check',
                                                        'value' => $attrValue->value,
                                                    ];
                                                }
                                            }
                                        }

                                        // Category attributes
                                        if ($package->categories) {
                                            foreach ($package->categories as $category) {
                                                if (isset($category->attributes) && is_array($category->attributes)) {
                                                    foreach ($category->attributes as $attr) {
                                                        if (isset($attr['is_feature']) && $attr['is_feature']) {
                                                            $packageAttributes[] = [
                                                                'name' => $attr['name'],
                                                                'icon' =>
                                                                    $attr['icon'] ?? getFeatureIcon($attr['name']),
                                                                'value' => $attr['value'] ?? true,
                                                            ];
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        $packageAttributes = array_slice($packageAttributes, 0, 3);
                                    @endphp

                                    @foreach ($packageAttributes as $attr)
                                        <span class="mb-2 badge bg-light text-dark me-2">
                                            <i class="{{ $attr['icon'] }} me-1"></i> {{ $attr['name'] }}
                                        </span>
                                    @endforeach

                                    @if (count($packageAttributes) == 0)
                                        @if ($package->duration_days >= 7)
                                            <span class="mb-2 badge bg-light text-dark me-2">
                                                <i class="fas fa-hotel me-1"></i> Luxury Stays
                                            </span>
                                        @endif

                                        <span class="mb-2 badge bg-light text-dark me-2">
                                            <i class="fas fa-utensils me-1"></i> Meals Included
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="bg-white border-0 card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if ($package->sale_price && $package->sale_price < $package->regular_price)
                                            <span
                                                class="text-muted text-decoration-line-through me-2">${{ number_format($package->regular_price) }}</span>
                                            <span
                                                class="text-primary fw-bold">${{ number_format($package->sale_price) }}</span>
                                        @else
                                            <span
                                                class="text-primary fw-bold">${{ number_format($package->regular_price) }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('tour-package.show', $package->slug) }}"
                                        class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No tour packages available at the moment. Please check back later!
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-5 text-center">
                <a href="{{ route('tour-packages') }}" class="btn btn-outline-primary btn-lg">View All Packages</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 features-section">
        <div class="container">
            <div class="mb-5 text-center section-title">
                <h2 class="fw-bold">Why Choose Us</h2>
                <p class="text-muted">We offer the best travel experiences with premium service</p>
            </div>
            <div class="row g-4">
                <div class="text-center col-md-4 feature-item">
                    <div class="mx-auto mb-4 text-white feature-icon bg-primary rounded-circle fade-in">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h4>Worldwide Destinations</h4>
                    <p class="text-muted">We offer tours to over 100 countries across all continents, ensuring you have
                        endless options to explore.</p>
                </div>
                <div class="text-center col-md-4 feature-item">
                    <div class="mx-auto mb-4 text-white feature-icon bg-primary rounded-circle fade-in">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h4>Best Price Guarantee</h4>
                    <p class="text-muted">Find a lower price for the same tour elsewhere? We'll match it and give you an
                        additional 5% discount.</p>
                </div>
                <div class="text-center col-md-4 feature-item">
                    <div class="mx-auto mb-4 text-white feature-icon bg-primary rounded-circle fade-in">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>24/7 Customer Support</h4>
                    <p class="text-muted">Our dedicated support team is available around the clock to assist you with any
                        questions or concerns.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 testimonials-section bg-light">
        <div class="container">
            <div class="mb-5 text-center section-title">
                <h2 class="fw-bold">What Our Travelers Say</h2>
                <p class="text-muted">Read testimonials from our satisfied customers</p>
            </div>
            <div class="row">
                <div class="mx-auto col-lg-8">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="p-4 text-center bg-white rounded shadow-sm testimonial-item">
                                    <img src="https://via.placeholder.com/100x100" class="mb-3 rounded-circle"
                                        alt="Customer">
                                    <p class="mb-3 testimonial-text">"Our trip to Bali was absolutely perfect! The
                                        accommodations were luxurious, the guides were knowledgeable, and every detail was
                                        taken care of. We can't wait to book our next adventure with Wanderlust!"</p>
                                    <h5 class="mb-1">Sarah Johnson</h5>
                                    <p class="mb-0 text-muted">New York, USA</p>
                                    <div class="mt-2 d-flex justify-content-center">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="p-4 text-center bg-white rounded shadow-sm testimonial-item">
                                    <img src="https://via.placeholder.com/100x100" class="mb-3 rounded-circle"
                                        alt="Customer">
                                    <p class="mb-3 testimonial-text">"The European tour exceeded all our expectations. The
                                        itinerary was perfectly balanced between guided tours and free time. Our guide Marco
                                        was exceptional and made the history come alive. Highly recommended!"</p>
                                    <h5 class="mb-1">David & Emma Thompson</h5>
                                    <p class="mb-0 text-muted">London, UK</p>
                                    <div class="mt-2 d-flex justify-content-center">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="p-4 text-center bg-white rounded shadow-sm testimonial-item">
                                    <img src="https://via.placeholder.com/100x100" class="mb-3 rounded-circle"
                                        alt="Customer">
                                    <p class="mb-3 testimonial-text">"As a solo traveler, I was nervous about my trip to
                                        Thailand, but Wanderlust made me feel safe and connected the entire time. I met
                                        amazing people and had experiences I'll never forget. Thank you for an incredible
                                        journey!"</p>
                                    <h5 class="mb-1">Michael Chen</h5>
                                    <p class="mb-0 text-muted">Toronto, Canada</p>
                                    <div class="mt-2 d-flex justify-content-center">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-primary rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-5 blog-section">
        <div class="container">
            <div class="mb-5 text-center section-title">
                <h2 class="fw-bold">Travel Blog</h2>
                <p class="text-muted">Get inspired with our latest travel stories and tips</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 blog-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Travel+Tips" class="card-img-top"
                            alt="Travel Tips">
                        <div class="card-body">
                            <div class="mb-3 blog-meta d-flex justify-content-between">
                                <span class="text-muted"><i class="far fa-calendar-alt me-1"></i> April 1, 2025</span>
                                <span class="text-muted"><i class="far fa-comment me-1"></i> 24 Comments</span>
                            </div>
                            <h5 class="card-title">10 Essential Tips for Budget Travel in 2025</h5>
                            <p class="card-text">Learn how to make the most of your travel budget with these expert tips
                                and tricks.</p>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <a href="#" class="p-0 btn btn-link text-primary">Read More <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 blog-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Hidden+Gems" class="card-img-top"
                            alt="Hidden Gems">
                        <div class="card-body">
                            <div class="mb-3 blog-meta d-flex justify-content-between">
                                <span class="text-muted"><i class="far fa-calendar-alt me-1"></i> March 25, 2025</span>
                                <span class="text-muted"><i class="far fa-comment me-1"></i> 18 Comments</span>
                            </div>
                            <h5 class="card-title">5 Hidden Gems in Southeast Asia You Must Visit</h5>
                            <p class="card-text">Discover lesser-known destinations that offer authentic experiences away
                                from the crowds.</p>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <a href="#" class="p-0 btn btn-link text-primary">Read More <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 blog-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Sustainable+Travel" class="card-img-top"
                            alt="Sustainable Travel">
                        <div class="card-body">
                            <div class="mb-3 blog-meta d-flex justify-content-between">
                                <span class="text-muted"><i class="far fa-calendar-alt me-1"></i> March 18, 2025</span>
                                <span class="text-muted"><i class="far fa-comment me-1"></i> 32 Comments</span>
                            </div>
                            <h5 class="card-title">The Ultimate Guide to Sustainable Travel</h5>
                            <p class="card-text">Learn how to minimize your environmental impact while still enjoying
                                amazing travel experiences.</p>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <a href="#" class="p-0 btn btn-link text-primary">Read More <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 text-center">
                <a href="#" class="btn btn-outline-primary btn-lg">View All Blog Posts</a>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-5 news-section bg-light">
        <div class="container">
            <div class="mb-5 text-center section-title">
                <h2 class="fw-bold">Travel News</h2>
                <p class="text-muted">Stay updated with the latest travel news and industry updates</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 news-item">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300x200?text=News"
                                    class="img-fluid rounded-start h-100 object-fit-cover" alt="Travel News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-2 news-meta d-flex align-items-center">
                                        <span class="badge bg-danger me-2">Breaking</span>
                                        <span class="text-muted small"><i class="far fa-clock me-1"></i> April 3,
                                            2025</span>
                                    </div>
                                    <h5 class="card-title">New Direct Flights Announced Between Major Cities</h5>
                                    <p class="card-text">Major airlines have announced new direct routes connecting key
                                        destinations, making travel more convenient for tourists.</p>
                                    <a href="#" class="p-0 btn btn-link text-primary">Read Full Story <i
                                            class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 news-item">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300x200?text=News"
                                    class="img-fluid rounded-start h-100 object-fit-cover" alt="Travel News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-2 news-meta d-flex align-items-center">
                                        <span class="badge bg-primary me-2">Industry</span>
                                        <span class="text-muted small"><i class="far fa-clock me-1"></i> April 2,
                                            2025</span>
                                    </div>
                                    <h5 class="card-title">Tourism Recovery Reaches Pre-Pandemic Levels</h5>
                                    <p class="card-text">Global tourism has finally rebounded to pre-pandemic levels
                                        according to the latest industry reports.</p>
                                    <a href="#" class="p-0 btn btn-link text-primary">Read Full Story <i
                                            class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 news-item">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300x200?text=News"
                                    class="img-fluid rounded-start h-100 object-fit-cover" alt="Travel News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-2 news-meta d-flex align-items-center">
                                        <span class="badge bg-success me-2">Destination</span>
                                        <span class="text-muted small"><i class="far fa-clock me-1"></i> March 30,
                                            2025</span>
                                    </div>
                                    <h5 class="card-title">New UNESCO World Heritage Sites Announced</h5>
                                    <p class="card-text">UNESCO has added several new sites to its prestigious World
                                        Heritage list, including cultural and natural wonders.</p>
                                    <a href="#" class="p-0 btn btn-link text-primary">Read Full Story <i
                                            class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 news-item">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300x200?text=News"
                                    class="img-fluid rounded-start h-100 object-fit-cover" alt="Travel News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-2 news-meta d-flex align-items-center">
                                        <span class="badge bg-warning text-dark me-2">Travel Tech</span>
                                        <span class="text-muted small"><i class="far fa-clock me-1"></i> March 28,
                                            2025</span>
                                    </div>
                                    <h5 class="card-title">New Travel App Revolutionizes Trip Planning</h5>
                                    <p class="card-text">A new AI-powered travel app is changing how travelers plan their
                                        trips with personalized recommendations.</p>
                                    <a href="#" class="p-0 btn btn-link text-primary">Read Full Story <i
                                            class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 text-center">
                <a href="#" class="btn btn-outline-primary btn-lg">View All News</a>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-5 text-white newsletter-section bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mb-4 col-lg-6 mb-lg-0">
                    <h3 class="fw-bold">Subscribe to Our Newsletter</h3>
                    <p class="mb-0">Get exclusive deals, travel tips, and updates delivered to your inbox.</p>
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
