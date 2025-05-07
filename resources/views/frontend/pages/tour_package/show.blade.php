@extends('frontend.app.main')
@section('content')
    <!-- Hero Image Gallery -->
    <section class="package-gallery">
        <div class="p-0 container-fluid">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="gallery-main">
                        @if ($tourPackage->featured_image)
                            <img src="{{ asset($tourPackage->featured_image) }}" alt="{{ $tourPackage->name }}"
                                class="img-fluid w-100 h-100 object-fit-cover">
                        @else
                            <img src="https://via.placeholder.com/1200x600?text={{ urlencode($tourPackage->name) }}"
                                alt="{{ $tourPackage->name }}" class="img-fluid w-100 h-100 object-fit-cover">
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row g-0 h-100">
                        <!-- filepath: /home/sarbada/Desktop/travel-agency/resources/views/frontend/pages/tour_package/show.blade.php -->

                        <div class="col-md-12 col-6">
                            <div class="gallery-item">
                                @php
                                    // Properly handle gallery images regardless of format
                                    $gallery = [];
                                    if ($tourPackage->gallery_images) {
                                        if (is_string($tourPackage->gallery_images)) {
                                            try {
                                                $gallery = json_decode($tourPackage->gallery_images, true) ?: [];
                                            } catch (\Exception $e) {
                                                $gallery = [];
                                            }
                                        } elseif (is_array($tourPackage->gallery_images)) {
                                            $gallery = $tourPackage->gallery_images;
                                        }
                                    }

                                    // Ensure gallery items are strings, not nested arrays
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
                                @endphp

                                @if (!empty($gallery) && isset($gallery[0]))
                                    <img src="{{ asset($gallery[0]) }}" alt="Gallery"
                                        class="img-fluid w-100 h-100 object-fit-cover">
                                @else
                                    <img src="https://via.placeholder.com/600x300?text=Gallery+1" alt="Gallery"
                                        class="img-fluid w-100 h-100 object-fit-cover">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-6">
                            <div class="gallery-item">
                                @if (!empty($gallery) && isset($gallery[1]))
                                    <img src="{{ asset($gallery[1]) }}" alt="Gallery"
                                        class="img-fluid w-100 h-100 object-fit-cover">
                                @else
                                    <img src="https://via.placeholder.com/600x300?text=Gallery+2" alt="Gallery"
                                        class="img-fluid w-100 h-100 object-fit-cover">
                                @endif

                                @if (count($gallery) > 2)
                                    <div class="gallery-more">
                                        <span>+{{ count($gallery) - 2 }} more</span>
                                    </div>
                                @endif
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
                    <li class="breadcrumb-item"><a href="{{ route('tour-packages') }}">Tour Packages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $tourPackage->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Package Header -->
    <section class="py-4 package-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="flex-wrap mb-3 d-flex align-items-center">
                        @if ($tourPackage->is_featured)
                            <span class="mb-2 me-3 badge bg-danger">Featured</span>
                        @endif

                        @if ($tourPackage->is_popular)
                            <span class="mb-2 me-3 badge bg-primary">Popular</span>
                        @endif

                        @if ($tourPackage->categories && $tourPackage->categories->count() > 0)
                            @foreach ($tourPackage->categories as $category)
                                <span class="mb-2 me-3 badge bg-info">{{ $category->name }}</span>
                            @endforeach
                        @endif
                    </div>

                    <h1 class="fw-bold">{{ $tourPackage->name }}</h1>

                    <div class="flex-wrap mt-3 d-flex align-items-center">
                        <div class="mb-2 me-4 ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <span class="ms-2">4.8 ({{ rand(10, 99) }} reviews)</span>
                        </div>

                        <div class="mb-2 me-4 duration">
                            <i class="fas fa-clock text-primary me-1"></i>
                            <span>{{ $tourPackage->duration_days }}
                                Days{{ $tourPackage->duration_nights ? ' / ' . $tourPackage->duration_nights . ' Nights' : '' }}</span>
                        </div>

                        <div class="mb-2 me-4 location">
                            <i class="fas fa-map-marker-alt text-primary me-1"></i>
                            <span>
                                @if ($tourPackage->destinations && $tourPackage->destinations->count() > 0)
                                    {{ $tourPackage->destinations->pluck('name')->join(', ') }}
                                @else
                                    Multiple Destinations
                                @endif
                            </span>
                        </div>

                        <div class="mb-2 group-size">
                            <i class="fas fa-users text-primary me-1"></i>
                            <span>Max {{ $tourPackage->max_people ?? 'Any' }} People</span>
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-left text-lg-end col-lg-4 mt-lg-0">
                    <div class="price-section">
                        <p class="mb-1 text-muted">Starting from</p>
                        @if ($tourPackage->sale_price && $tourPackage->sale_price < $tourPackage->regular_price)
                            <p class="mb-1">
                                <span
                                    class="text-muted text-decoration-line-through">${{ number_format($tourPackage->regular_price) }}</span>
                            </p>
                            <h2 class="text-primary fw-bold">${{ number_format($tourPackage->sale_price) }}</h2>
                            <p class="mb-0 text-success">
                                <small>Save
                                    ${{ number_format($tourPackage->regular_price - $tourPackage->sale_price) }}</small>
                            </p>
                        @else
                            <h2 class="text-primary fw-bold">${{ number_format($tourPackage->regular_price) }}</h2>
                        @endif
                        <a href="#booking-form" class="mt-3 btn btn-primary btn-lg">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 package-content">
        <div class="container">
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-8">
                    <!-- Package Description -->
                    <div class="mb-5 package-description">
                        <h2 class="mb-4 fw-bold">Overview</h2>
                        <div class="description-content">
                            {!! $tourPackage->description !!}
                        </div>
                    </div>

                    <!-- Package Highlights -->
                    <div class="mb-5 package-highlights">
                        <h2 class="mb-4 fw-bold">Highlights</h2>
                        <div class="row g-4">
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded bg-light highlight-item">
                                    <div class="d-flex">
                                        <div class="me-3 highlight-icon">
                                            <i class="fas fa-mountain text-primary fa-2x"></i>
                                        </div>
                                        <div class="highlight-text">
                                            <h5 class="mb-1">Scenic Views</h5>
                                            <p class="mb-0">Breathtaking landscapes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded bg-light highlight-item">
                                    <div class="d-flex">
                                        <div class="me-3 highlight-icon">
                                            <i class="fas fa-utensils text-primary fa-2x"></i>
                                        </div>
                                        <div class="highlight-text">
                                            <h5 class="mb-1">Local Cuisine</h5>
                                            <p class="mb-0">Authentic food experiences</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded bg-light highlight-item">
                                    <div class="d-flex">
                                        <div class="me-3 highlight-icon">
                                            <i class="fas fa-hotel text-primary fa-2x"></i>
                                        </div>
                                        <div class="highlight-text">
                                            <h5 class="mb-1">Premium Stays</h5>
                                            <p class="mb-0">Comfortable accommodations</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded bg-light highlight-item">
                                    <div class="d-flex">
                                        <div class="me-3 highlight-icon">
                                            <i class="fas fa-shuttle-van text-primary fa-2x"></i>
                                        </div>
                                        <div class="highlight-text">
                                            <h5 class="mb-1">Transportation</h5>
                                            <p class="mb-0">Convenient travel arrangements</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded bg-light highlight-item">
                                    <div class="d-flex">
                                        <div class="me-3 highlight-icon">
                                            <i class="fas fa-camera text-primary fa-2x"></i>
                                        </div>
                                        <div class="highlight-text">
                                            <h5 class="mb-1">Photo Spots</h5>
                                            <p class="mb-0">Instagram-worthy locations</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded bg-light highlight-item">
                                    <div class="d-flex">
                                        <div class="me-3 highlight-icon">
                                            <i class="fas fa-user-friends text-primary fa-2x"></i>
                                        </div>
                                        <div class="highlight-text">
                                            <h5 class="mb-1">Expert Guides</h5>
                                            <p class="mb-0">Knowledgeable local experts</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Itinerary -->
                    <div class="mb-5 package-itinerary">
                        <h2 class="mb-4 fw-bold">Itinerary</h2>
                        <div class="accordion" id="itineraryAccordion">
                            @if ($tourPackage->itinerary)
                                @php
                                    $itinerary = is_string($tourPackage->itinerary)
                                        ? json_decode($tourPackage->itinerary, true)
                                        : $tourPackage->itinerary;
                                @endphp

                                @if (is_array($itinerary))
                                    @foreach ($itinerary as $day => $details)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $day }}">
                                                <button class="accordion-button {{ $day > 1 ? 'collapsed' : '' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $day }}"
                                                    aria-expanded="{{ $day == 1 ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $day }}">
                                                    <span class="fw-bold">Day {{ $day }}:
                                                        {{ $details['title'] ?? 'Exploration' }}</span>
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $day }}"
                                                class="accordion-collapse collapse {{ $day == 1 ? 'show' : '' }}"
                                                aria-labelledby="heading{{ $day }}"
                                                data-bs-parent="#itineraryAccordion">
                                                <div class="accordion-body">
                                                    @if (isset($details['description']))
                                                        <p>{!! $details['description'] !!}</p>
                                                    @endif

                                                    @if (isset($details['meals']) || isset($details['accommodation']))
                                                        <div class="flex-wrap mt-3 d-flex">
                                                            @if (isset($details['meals']))
                                                                <div class="mb-2 me-4">
                                                                    <span class="fw-bold">Meals:</span>
                                                                    {{ $details['meals'] }}
                                                                </div>
                                                            @endif

                                                            @if (isset($details['accommodation']))
                                                                <div class="mb-2">
                                                                    <span class="fw-bold">Accommodation:</span>
                                                                    {{ $details['accommodation'] }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="p-3 border rounded">
                                        <p>{!! $tourPackage->itinerary !!}</p>
                                    </div>
                                @endif
                            @else
                                <div class="p-3 alert alert-info">
                                    <p>Detailed itinerary will be provided upon booking. Please contact us for more
                                        information.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Includes/Excludes -->
                    <div class="mb-5 package-includes">
                        <h2 class="mb-4 fw-bold">What's Included/Excluded</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="p-4 mb-4 rounded mb-md-0 bg-light includes-box">
                                    <h4 class="mb-3 text-success"><i class="fas fa-check-circle me-2"></i>Included</h4>
                                    <ul class="ps-3">
                                        @if (isset($tourPackage->included) && $tourPackage->included)
                                            @php
                                                $includedItems = is_array($tourPackage->included)
                                                    ? $tourPackage->included
                                                    : explode("\n", $tourPackage->included);
                                            @endphp
                                            @foreach ($includedItems as $item)
                                                <li class="mb-2">{{ $item }}</li>
                                            @endforeach
                                        @else
                                            <li class="mb-2">Hotel Accommodation</li>
                                            <li class="mb-2">Airport Transfers</li>
                                            <li class="mb-2">Daily Breakfast</li>
                                            <li class="mb-2">Guided Tours</li>
                                            <li class="mb-2">All Entry Fees</li>
                                            <li class="mb-2">Transportation in AC Vehicle</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded bg-light excludes-box">
                                    <h4 class="mb-3 text-danger"><i class="fas fa-times-circle me-2"></i>Excluded</h4>
                                    <ul class="ps-3">
                                        @if (isset($tourPackage->excluded) && $tourPackage->excluded)
                                            @php
                                                $excludedItems = is_array($tourPackage->excluded)
                                                    ? $tourPackage->excluded
                                                    : explode("\n", $tourPackage->excluded);
                                            @endphp
                                            @foreach ($excludedItems as $item)
                                                <li class="mb-2">{{ $item }}</li>
                                            @endforeach
                                        @else
                                            <li class="mb-2">International/Domestic Flights</li>
                                            <li class="mb-2">Travel Insurance</li>
                                            <li class="mb-2">Personal Expenses</li>
                                            <li class="mb-2">Optional Activities</li>
                                            <li class="mb-2">Visa Fees</li>
                                            <li class="mb-2">Tips and Gratuities</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Package Attributes -->
                    @if ($tourPackage->attributeValues && $tourPackage->attributeValues->count() > 0)
                        <div class="mb-5 package-attributes">
                            <h2 class="mb-4 fw-bold">Package Details</h2>
                            <div class="row g-3">
                                @php
                                    $groupedAttributes = [];
                                    foreach ($tourPackage->attributeValues as $value) {
                                        if ($value->packageAttribute && $value->packageAttribute->attributeGroup) {
                                            $groupName = $value->packageAttribute->attributeGroup->name;
                                            if (!isset($groupedAttributes[$groupName])) {
                                                $groupedAttributes[$groupName] = [];
                                            }
                                            $groupedAttributes[$groupName][] = [
                                                'name' => $value->packageAttribute->name,
                                                'value' => $value->getValue(),
                                                'type' => $value->packageAttribute->type,
                                            ];
                                        }
                                    }
                                @endphp

                                @foreach ($groupedAttributes as $groupName => $attributes)
                                    <div class="col-md-6">
                                        <div class="p-3 border rounded attribute-group">
                                            <h5 class="mb-3">{{ $groupName }}</h5>
                                            <ul class="list-unstyled">
                                                @foreach ($attributes as $attribute)
                                                    <li class="mb-2 d-flex justify-content-between">
                                                        <span class="fw-semibold">{{ $attribute['name'] }}:</span>
                                                        <span>
                                                            @if ($attribute['type'] == 'boolean')
                                                                {!! $attribute['value']
                                                                    ? '<i class="fas fa-check text-success"></i>'
                                                                    : '<i class="fas fa-times text-danger"></i>' !!}
                                                            @elseif($attribute['type'] == 'array' && is_array($attribute['value']))
                                                                {{ implode(', ', $attribute['value']) }}
                                                            @else
                                                                {{ $attribute['value'] }}
                                                            @endif
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- FAQs -->
                    <div class="mb-5 package-faqs">
                        <h2 class="mb-4 fw-bold">Frequently Asked Questions</h2>
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                        What is the best time to visit?
                                    </button>
                                </h2>
                                <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        The best time to visit depends on the destinations included in this package.
                                        Generally, spring (March-May) and fall (September-November) offer pleasant weather
                                        conditions with fewer crowds.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse2" aria-expanded="false"
                                        aria-controls="faqCollapse2">
                                        How many people will be in the tour group?
                                    </button>
                                </h2>
                                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Our groups typically range from 8-16 people to ensure a personalized experience. We
                                        also offer private tour options if you prefer to travel with just your companions.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse3" aria-expanded="false"
                                        aria-controls="faqCollapse3">
                                        What is the cancellation policy?
                                    </button>
                                </h2>
                                <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faq3"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Cancellations made 30+ days before departure receive a 90% refund. Cancellations
                                        15-29 days before departure receive a 50% refund. No refunds for cancellations less
                                        than 15 days before departure.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse4" aria-expanded="false"
                                        aria-controls="faqCollapse4">
                                        Is travel insurance required?
                                    </button>
                                </h2>
                                <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faq4"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        While not mandatory, we strongly recommend purchasing comprehensive travel insurance
                                        to protect your trip investment against unforeseen circumstances, medical
                                        emergencies, and trip cancellations.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="mb-5 package-reviews">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <h2 class="mb-0 fw-bold">Reviews</h2>
                            <button class="btn btn-outline-primary">Write a Review</button>
                        </div>

                        <div class="p-4 mb-4 rounded bg-light review-summary">
                            <div class="row align-items-center">
                                <div class="text-center col-md-3">
                                    <h2 class="display-4 fw-bold text-primary">4.8</h2>
                                    <div class="mb-2 ratings">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                    <p class="mb-0">Based on {{ rand(10, 99) }} reviews</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-2 d-flex align-items-center">
                                        <div class="me-2 review-label">5 stars</div>
                                        <div class="flex-grow-1 progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%">
                                            </div>
                                        </div>
                                        <div class="ms-2 review-count">75%</div>
                                    </div>
                                    <div class="mb-2 d-flex align-items-center">
                                        <div class="me-2 review-label">4 stars</div>
                                        <div class="flex-grow-1 progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 20%">
                                            </div>
                                        </div>
                                        <div class="ms-2 review-count">20%</div>
                                    </div>
                                    <div class="mb-2 d-flex align-items-center">
                                        <div class="me-2 review-label">3 stars</div>
                                        <div class="flex-grow-1 progress" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 5%">
                                            </div>
                                        </div>
                                        <div class="ms-2 review-count">5%</div>
                                    </div>
                                    <div class="mb-2 d-flex align-items-center">
                                        <div class="me-2 review-label">2 stars</div>
                                        <div class="flex-grow-1 progress" style="height: 8px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 0%">
                                            </div>
                                        </div>
                                        <div class="ms-2 review-count">0%</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2 review-label">1 star</div>
                                        <div class="flex-grow-1 progress" style="height: 8px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 0%">
                                            </div>
                                        </div>
                                        <div class="ms-2 review-count">0%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Individual Reviews -->
                        <div class="review-list">
                            <!-- Review 1 -->
                            <div class="p-4 mb-4 border rounded review-item">
                                <div class="mb-3 d-flex">
                                    <img src="https://via.placeholder.com/50x50" class="rounded-circle me-3"
                                        alt="Reviewer">
                                    <div>
                                        <h5 class="mb-1">Sarah Johnson</h5>
                                        <p class="mb-1 text-muted"><small>Visited in April 2025</small></p>
                                        <div class="ratings">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="mb-2 fw-bold">Absolutely Amazing Experience!</h6>
                                <p>This tour exceeded all my expectations. The accommodation was luxurious, the guides were
                                    knowledgeable and friendly, and the itinerary was perfectly balanced between activities
                                    and free time. The highlight was definitely the sunset view from the mountain top. I
                                    would highly recommend this package to anyone looking for an unforgettable adventure.
                                </p>
                            </div>

                            <!-- Review 2 -->
                            <div class="p-4 mb-4 border rounded review-item">
                                <div class="mb-3 d-flex">
                                    <img src="https://via.placeholder.com/50x50" class="rounded-circle me-3"
                                        alt="Reviewer">
                                    <div>
                                        <h5 class="mb-1">Michael Chen</h5>
                                        <p class="mb-1 text-muted"><small>Visited in March 2025</small></p>
                                        <div class="ratings">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="mb-2 fw-bold">Great Tour with Minor Hiccups</h6>
                                <p>Overall, this was an excellent tour with breathtaking scenery and well-planned
                                    activities. Our guide Marco was exceptional and made the history come alive. The only
                                    improvement could be the food options at some of the included restaurants, but this is a
                                    minor issue. Would definitely travel with this company again!</p>
                            </div>

                            <!-- Load more reviews button -->
                            <div class="text-center">
                                <button class="btn btn-outline-primary">Load More Reviews</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4">
                    <!-- Booking Form -->
                    <div class="p-4 mb-4 bg-white border rounded shadow-sm booking-widget" id="booking-form">
                        <h3 class="mb-3 fw-bold">Book This Tour</h3>
                        <form>
                            <div class="mb-3">
                                <label for="departure-date" class="form-label">Departure Date</label>
                                <input type="date" class="form-control" id="departure-date"
                                    min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label">Number of Travelers</label>
                                <select class="form-select" id="guests">
                                    <option value="1">1 Traveler</option>
                                    <option value="2" selected>2 Travelers</option>
                                    <option value="3">3 Travelers</option>
                                    <option value="4">4 Travelers</option>
                                    <option value="5">5+ Travelers</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room-type" class="form-label">Room Type</label>
                                <select class="form-select" id="room-type">
                                    <option value="standard" selected>Standard Room</option>
                                    <option value="deluxe">Deluxe Room</option>
                                    <option value="suite">Suite</option>
                                    <option value="family">Family Room</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="add-insurance">
                                    <label class="form-check-label" for="add-insurance">
                                        Add Travel Insurance (+${{ rand(50, 150) }})
                                    </label>
                                </div>
                            </div>
                            <div class="p-3 mb-4 rounded bg-light booking-summary">
                                <h5 class="mb-3">Price Summary</h5>
                                <div class="mb-2 d-flex justify-content-between">
                                    <span>Base Price (2 Travelers):</span>
                                    <span>${{ number_format($tourPackage->sale_price ? $tourPackage->sale_price * 2 : $tourPackage->regular_price * 2) }}</span>
                                </div>
                                <div class="mb-2 d-flex justify-content-between">
                                    <span>Taxes & Fees:</span>
                                    <span>${{ number_format(($tourPackage->sale_price ? $tourPackage->sale_price : $tourPackage->regular_price) * 0.1 * 2) }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total:</span>
                                    <span>${{ number_format(($tourPackage->sale_price ? $tourPackage->sale_price : $tourPackage->regular_price) * 2.1) }}</span>
                                </div>
                            </div>
                            <button type="submit" class="mb-3 btn btn-primary w-100">Book Now</button>
                            <p class="mb-0 text-center text-muted small">No payment required today. Reserve now, pay later.
                            </p>
                        </form>
                    </div>

                    <!-- Contact Widget -->
                    <div class="p-4 mb-4 bg-white border rounded shadow-sm contact-widget">
                        <h4 class="mb-3 fw-bold">Need Help?</h4>
                        <p>Our travel experts are here to assist you with your booking.</p>
                        <div class="mb-3 d-flex contact-item">
                            <i class="mt-1 fas fa-phone-alt text-primary me-3"></i>
                            <div>
                                <h6 class="mb-0">Call Us</h6>
                                <p class="mb-0">+1 (800) 123-4567</p>
                            </div>
                        </div>
                        <div class="mb-3 d-flex contact-item">
                            <i class="mt-1 fas fa-envelope text-primary me-3"></i>
                            <div>
                                <h6 class="mb-0">Email Us</h6>
                                <p class="mb-0">info@travelagency.com</p>
                            </div>
                        </div>
                        <div class="d-flex contact-item">
                            <i class="mt-1 fas fa-comments text-primary me-3"></i>
                            <div>
                                <h6 class="mb-0">Live Chat</h6>
                                <p class="mb-0">Available 24/7</p>
                            </div>
                        </div>
                    </div>

                    <!-- Weather Widget -->
                    <div class="p-4 mb-4 bg-white border rounded shadow-sm weather-widget">
                        <h4 class="mb-3 fw-bold">Weather Forecast</h4>
                        <p class="mb-3">Typical weather for this destination:</p>
                        <div class="text-center row">
                            <div class="col-4">
                                <div class="p-2 weather-item">
                                    <p class="mb-1 small">Spring</p>
                                    <i class="mb-1 fas fa-sun fa-2x text-warning"></i>
                                    <p class="mb-0">68°F</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 weather-item">
                                    <p class="mb-1 small">Summer</p>
                                    <i class="mb-1 fas fa-sun fa-2x text-warning"></i>
                                    <p class="mb-0">85°F</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 weather-item">
                                    <p class="mb-1 small">Fall</p>
                                    <i class="mb-1 fas fa-cloud-sun fa-2x text-primary"></i>
                                    <p class="mb-0">70°F</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 weather-item">
                                    <p class="mb-1 small">Winter</p>
                                    <i class="mb-1 fas fa-snowflake fa-2x text-info"></i>
                                    <p class="mb-0">45°F</p>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="p-2 weather-item">
                                    <p class="mb-1 small">Best Time to Visit</p>
                                    <p class="mb-0">April-June & Sept-Oct</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Packages -->
    <section class="py-5 bg-light related-packages">
        <div class="container">
            <h2 class="mb-4 text-center fw-bold">You May Also Like</h2>
            <div class="row g-4">
                @foreach ($relatedPackages as $relatedPackage)
                    <div class="col-lg-4 col-md-6">
                        <div class="border-0 shadow-sm card h-100 hover-scale">
                            <div class="position-relative">
                                @if ($relatedPackage->featured_image)
                                    <img src="{{ asset($relatedPackage->featured_image) }}" class="card-img-top"
                                        alt="{{ $relatedPackage->name }}">
                                @else
                                    <img src="https://via.placeholder.com/600x400?text={{ urlencode($relatedPackage->name) }}"
                                        class="card-img-top" alt="{{ $relatedPackage->name }}">
                                @endif
                                <div
                                    class="top-0 px-3 py-1 m-3 text-white rounded package-duration position-absolute end-0 bg-primary">
                                    {{ $relatedPackage->duration_days }} Days</div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $relatedPackage->name }}</h5>

                                <!-- Ratings -->
                                <div class="mb-3 d-flex">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                    <span class="ms-2 text-muted">({{ rand(10, 50) }} reviews)</span>
                                </div>

                                <p class="card-text">{!! Str::limit($relatedPackage->description, 100) !!}</p>
                            </div>
                            <div class="bg-white border-0 card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if ($relatedPackage->sale_price && $relatedPackage->sale_price < $relatedPackage->regular_price)
                                            <span
                                                class="text-muted text-decoration-line-through me-2">${{ number_format($relatedPackage->regular_price) }}</span>
                                            <span
                                                class="text-primary fw-bold">${{ number_format($relatedPackage->sale_price) }}</span>
                                        @else
                                            <span
                                                class="text-primary fw-bold">${{ number_format($relatedPackage->regular_price) }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('tour-package.show', $relatedPackage->slug) }}"
                                        class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .gallery-item {
            height: 300px;
            position: relative;
            overflow: hidden;
        }

        .gallery-main {
            height: 600px;
            overflow: hidden;
        }

        .gallery-more {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .hover-scale {
            transition: transform 0.3s;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .review-label {
            width: 60px;
        }

        .review-count {
            width: 40px;
            text-align: right;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .highlight-icon {
            width: 50px;
        }

        @media (max-width: 767px) {
            .gallery-main {
                height: 400px;
            }

            .gallery-item {
                height: 200px;
            }
        }
    </style>
@endsection
