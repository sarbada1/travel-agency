<!-- filepath: /home/sarbada/Desktop/travel-agency/resources/views/frontend/pages/destination/show.blade.php -->

@extends('frontend.app.main')
@section('content')
    <!-- Hero Header -->
    <section class="destination-hero">
        <div class="destination-hero-image"
            style="background-image: url('{{ $destination->image ? asset($destination->image) : 'https://via.placeholder.com/1920x500?text=' . urlencode($destination->name) }}'); background-repeat: no-repeat;
  background-size: cover;">
            <div class="destination-hero-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-10">
                            <h1 class="text-white fw-bold slide-in-left">{{ $destination->name }}</h1>
                            <p class="mb-4 text-white lead slide-in-right">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                {{ $destination->region ?? 'Worldwide' }}
                            </p>

                            <!-- Quick Facts -->
                            <div class="row g-3 quick-facts">
                                <div class="col-sm-4">
                                    <div class="p-3 text-center bg-white shadow-sm rounded-3">
                                        <i class="mb-2 fas fa-suitcase text-primary"></i>
                                        <h5 class="mb-0">{{ $tourPackages->count() }} Tour Packages</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="p-3 text-center bg-white shadow-sm rounded-3">
                                        <i class="mb-2 fas fa-calendar-alt text-primary"></i>
                                        <h5 class="mb-0">Best Time: {{ $destination->best_time ?? 'All Year' }}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="p-3 text-center bg-white shadow-sm rounded-3">
                                        <i class="mb-2 fas fa-dollar-sign text-primary"></i>
                                        <h5 class="mb-0">From ${{ number_format($destination->starting_price ?? 500) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="py-2 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('destinations') }}">Destinations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $destination->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Description -->
                    <div class="mb-5">
                        <h2 class="mb-4 fw-bold">About {{ $destination->name }}</h2>
                        <div class="destination-description">
                            {!! $destination->description !!}
                        </div>
                    </div>

                    <!-- Highlights / Attractions -->
                    @php
                        $highlights = [];
                        // Get attributes from destination that are marked as highlights
                        if (isset($destination->attributes) && is_array($destination->attributes)) {
                            foreach ($destination->attributes as $attribute) {
                                if (isset($attribute['is_highlight']) && $attribute['is_highlight']) {
                                    $highlights[] = [
                                        'name' => $attribute['name'] ?? '',
                                        'description' => $attribute['description'] ?? '',
                                        'icon' => $attribute['icon'] ?? 'fas fa-star'
                                    ];
                                }
                            }
                        }
                    @endphp
                    
                    @if(count($highlights) > 0)
                    <div class="mb-5">
                        <h2 class="mb-4 fw-bold">Highlights</h2>
                        <div class="row g-4">
                            @foreach($highlights as $highlight)
                            <div class="col-md-6">
                                <div class="p-3 rounded bg-light highlight-card">
                                    <div class="d-flex">
                                        <div class="me-3 text-primary">
                                            <i class="{{ $highlight['icon'] }} fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5>{{ $highlight['name'] }}</h5>
                                            <p class="mb-0">{{ $highlight['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Gallery -->
                    @php
                        $gallery = [];
                        
                        if (isset($destination->gallery_images)) {
                            if (is_string($destination->gallery_images)) {
                                try {
                                    $gallery = json_decode($destination->gallery_images, true) ?: [];
                                } catch (\Exception $e) {
                                    $gallery = [];
                                }
                            } elseif (is_array($destination->gallery_images)) {
                                $gallery = $destination->gallery_images;
                            }
                            
                            // Ensure gallery items are strings
                            $validGallery = [];
                            foreach ($gallery as $item) {
                                if (is_string($item)) {
                                    $validGallery[] = $item;
                                } elseif (is_array($item) && isset($item['path'])) {
                                    $validGallery[] = $item['path'];
                                } elseif (is_array($item) && isset($item[0])) {
                                    $validGallery[] = $item[0];
                                }
                            }
                            $gallery = $validGallery;
                        }
                        
                        // Add main image to gallery if available
                        if ($destination->image && !in_array($destination->image, $gallery)) {
                            array_unshift($gallery, $destination->image);
                        }
                    @endphp
                    
                    @if(count($gallery) > 0)
                    <div class="mb-5">
                        <h2 class="mb-4 fw-bold">Gallery</h2>
                        <div class="row g-3">
                            @foreach($gallery as $image)
                            <div class="col-md-4 col-6">
                                <a href="{{ asset($image) }}" class="gallery-item" data-lightbox="destination-gallery">
                                    <img src="{{ asset($image) }}" class="rounded img-fluid" alt="{{ $destination->name }} Gallery">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Map -->
                    @if($destination->map_location || $destination->latitude || $destination->longitude)
                    <div class="mb-5">
                        <h2 class="mb-4 fw-bold">Location</h2>
                        <div class="ratio ratio-21x9">
                            @php
                                $mapQuery = '';
                                if ($destination->latitude && $destination->longitude) {
                                    $mapQuery = $destination->latitude . ',' . $destination->longitude;
                                } elseif ($destination->map_location) {
                                    $mapQuery = urlencode($destination->map_location);
                                } else {
                                    $mapQuery = urlencode($destination->name);
                                }
                            @endphp
                            <iframe
                                src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q={{ $mapQuery }}"
                                class="border-0 rounded" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    @endif

                    <!-- Travel Tips -->
                    @php
                        $travelTips = [];
                        
                        // Get travel tips from attributes
                        if (isset($destination->attributes) && is_array($destination->attributes)) {
                            foreach ($destination->attributes as $attribute) {
                                if (isset($attribute['is_travel_tip']) && $attribute['is_travel_tip']) {
                                    $travelTips[] = [
                                        'title' => $attribute['name'] ?? '',
                                        'content' => $attribute['description'] ?? ''
                                    ];
                                }
                            }
                        }
                        
                        // Get travel tips from dedicated field if available
                        if (empty($travelTips) && isset($destination->travel_tips)) {
                            if (is_array($destination->travel_tips)) {
                                $travelTips = $destination->travel_tips;
                            } elseif (is_string($destination->travel_tips)) {
                                try {
                                    $decoded = json_decode($destination->travel_tips, true);
                                    if (is_array($decoded)) {
                                        $travelTips = $decoded;
                                    }
                                } catch (\Exception $e) {
                                    // If error, use simple approach
                                    $travelTips = [
                                        ['title' => 'Travel Tips', 'content' => $destination->travel_tips]
                                    ];
                                }
                            }
                        }
                    @endphp
                    
                    @if(count($travelTips) > 0)
                    <div class="mb-5">
                        <h2 class="mb-4 fw-bold">Travel Tips</h2>
                        <div class="accordion" id="travelTipsAccordion">
                            @foreach($travelTips as $index => $tip)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" 
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" 
                                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                            aria-controls="collapse{{ $index }}">
                                        {{ $tip['title'] }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                     aria-labelledby="heading{{ $index }}" data-bs-parent="#travelTipsAccordion">
                                    <div class="accordion-body">
                                        {{ $tip['content'] }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Featured Tour Packages -->
                    <div class="p-4 mb-4 bg-white rounded shadow-sm sidebar-card">
                        <h4 class="pb-3 border-bottom">Tour Packages in {{ $destination->name }}</h4>

                        @if ($tourPackages->count() > 0)
                            @foreach ($tourPackages as $package)
                                <div class="pb-3 mb-3 border-bottom d-flex tour-package-item">
                                    <div class="flex-shrink-0">
                                        @php
                                            $featuredImage = $package->featured_image;
                                            if (is_array($featuredImage)) {
                                                if (isset($featuredImage['path'])) {
                                                    $featuredImage = $featuredImage['path'];
                                                } elseif (isset($featuredImage[0])) {
                                                    $featuredImage = $featuredImage[0];
                                                } else {
                                                    $featuredImage = null;
                                                }
                                            }
                                        @endphp
                                        
                                        @if ($featuredImage && is_string($featuredImage))
                                            <img src="{{ asset($featuredImage) }}" class="rounded tour-thumbnail" 
                                                 alt="{{ $package->name }}">
                                        @else
                                            <img src="https://via.placeholder.com/100x70?text={{ urlencode($package->name) }}" 
                                                 class="rounded tour-thumbnail" alt="{{ $package->name }}">
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1">{{ $package->name }}</h6>
                                        <div class="mb-1 text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= ($package->rating ?? 4.5))
                                                    <i class="fas fa-star small"></i>
                                                @elseif($i - 0.5 <= ($package->rating ?? 4.5))
                                                    <i class="fas fa-star-half-alt small"></i>
                                                @else
                                                    <i class="far fa-star small"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="mb-1 small text-muted">
                                            <i class="fas fa-clock me-1"></i> {{ $package->duration_days }} Days
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-primary fw-bold">
                                                ${{ number_format($package->sale_price ?? $package->regular_price) }}
                                            </span>
                                            <a href="{{ route('tour-package.show', $package->slug) }}"
                                               class="btn btn-sm btn-outline-primary">View</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-3 text-center">
                                <a href="{{ route('tour-packages') }}" class="btn btn-primary">View All Packages</a>
                            </div>
                        @else
                            <div class="p-3 text-center rounded bg-light">
                                <i class="mb-2 fas fa-suitcase-rolling text-muted fa-2x"></i>
                                <p class="mb-1">No tour packages available for this destination yet.</p>
                                <a href="{{ route('tour-packages') }}" class="btn btn-sm btn-primary">Browse All Tours</a>
                            </div>
                        @endif
                    </div>

                    <!-- Inquiry Form -->
                    <div class="p-4 bg-white rounded shadow-sm sidebar-card">
                        <h4 class="pb-3 border-bottom">Inquire Now</h4>
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                            <input type="hidden" name="inquiry_type" value="destination">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your email address" required>
                            </div>
                            <div class="mb-3">
                                <label for="inquiry" class="form-label">Your Message</label>
                                <textarea class="form-control" id="inquiry" name="message" rows="3" placeholder="How can we help you?" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Destinations -->
    @php
        // Get related destinations based on region or attributes
        $relatedDestinations = \App\Models\Category\Category::where('id', '!=', $destination->id)
            ->where('page_type', 'destination')
            ->where('status', true)
            ->where(function($query) use ($destination) {
                
                // Or similar continent if region doesn't match
                if ($destination->continent) {
                    $query->orWhere('continent', $destination->continent);
                }
            })
            ->take(3)
            ->get();
        
        // If not enough related destinations, add some popular ones
        if ($relatedDestinations->count() < 3) {
            $moreDestinations = \App\Models\Category\Category::where('id', '!=', $destination->id)
                ->where('page_type', 'destination')
                ->where('is_active', true)
                ->where('is_popular', true)
                ->whereNotIn('id', $relatedDestinations->pluck('id')->toArray())
                ->take(3 - $relatedDestinations->count())
                ->get();
            
            $relatedDestinations = $relatedDestinations->concat($moreDestinations);
        }
    @endphp
    
    @if($relatedDestinations->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-4 text-center fw-bold">You May Also Like</h2>
            <div class="row g-4">
                @foreach($relatedDestinations as $relatedDestination)
                <div class="col-md-4">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        @if($relatedDestination->image)
                            <img src="{{ asset($relatedDestination->image) }}" class="card-img-top" 
                                 alt="{{ $relatedDestination->name }}">
                        @else
                            <img src="https://via.placeholder.com/600x400?text={{ urlencode($relatedDestination->name) }}" 
                                 class="card-img-top" alt="{{ $relatedDestination->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedDestination->name }}</h5>
                            <p class="card-text">{!! Str::limit($relatedDestination->description, 100) !!}</p>
                            <a href="{{ route('destination.show', $relatedDestination->slug) }}" 
                               class="btn btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

@section('styles')
<style>
    .destination-hero-image {
        height: 500px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .destination-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 70%, rgba(0, 0, 0, 0.1) 100%);
        display: flex;
        align-items: center;
    }

    .quick-facts {
        margin-top: 20px;
    }

    .highlight-card {
        height: 100%;
        transition: all 0.3s ease;
    }

    .highlight-card:hover {
        background-color: #e9ecef;
    }

    .gallery-item {
        display: block;
        position: relative;
        overflow: hidden;
    }

    .gallery-item img {
        transition: all 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .sidebar-card {
        margin-bottom: 30px;
    }

    .tour-thumbnail {
        width: 100px;
        height: 70px;
        object-fit: cover;
    }

    .tour-package-item {
        transition: all 0.3s ease;
    }

    .tour-package-item:hover {
        background-color: #f8f9fa;
    }

    @media (max-width: 768px) {
        .destination-hero-image {
            height: 400px;
        }

        .destination-hero-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 100%);
            text-align: center;
        }

        .quick-facts {
            margin-top: 20px;
        }
    }
</style>
@endsection