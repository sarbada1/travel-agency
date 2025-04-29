@extends('frontend.app.main')

@section('content')
    <!-- About Header -->
    <header class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">About Us</h1>
                    <p class="lead mb-4">Connecting people with perfect accommodations, services, and opportunities since 2020.</p>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <img src="{{ url('images/about-header.webp') }}" alt="About Us" class="img-fluid rounded" style="max-height: 300px;">
                </div>
            </div>
        </div>
    </header>

    <!-- Our Story Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="{{ url('images/demo.webp') }}" alt="Our Story" class="img-fluid rounded shadow-sm">
                </div>
                <div class="col-lg-7">
                    <h2 class="mb-4">Our Story</h2>
                    <p class="mb-3">Founded in 2020, our booking platform started with a simple mission: to make finding and booking accommodations, services, and job opportunities as seamless as possible.</p>
                    <p class="mb-3">What began as a small startup has grown into a comprehensive marketplace connecting thousands of users with exactly what they need. Our journey has been marked by continuous improvement and a relentless focus on user experience.</p>
                    <p>Today, we're proud to offer a platform that serves diverse needs—from vacation rentals to professional opportunities—all within an intuitive, secure environment designed to make transactions simple and trustworthy.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-3">Our Mission & Values</h2>
                <p class="lead text-muted">The principles that guide everything we do</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-4">
                                <i class="bi bi-award fs-1 text-primary"></i>
                            </div>
                            <h4>Quality First</h4>
                            <p class="text-muted">We're committed to maintaining high standards across all listings on our platform, ensuring users always find quality options.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-4">
                                <i class="bi bi-shield-check fs-1 text-primary"></i>
                            </div>
                            <h4>Trust & Security</h4>
                            <p class="text-muted">We prioritize secure transactions and protect user data, creating a safe environment for everyone who uses our platform.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-4">
                                <i class="bi bi-people fs-1 text-primary"></i>
                            </div>
                            <h4>Community Focus</h4>
                            <p class="text-muted">We believe in building real connections between users, fostering a community that benefits from mutual support and shared resources.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-3">Meet Our Team</h2>
                <p class="lead text-muted">The people who make it all happen</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <img src="{{ url('images/demo.webp') }}" class="card-img-top" alt="Team Member">
                        <div class="card-body">
                            <h5 class="card-title mb-1">John Smith</h5>
                            <p class="text-muted mb-3">Chief Executive Officer</p>
                            <p class="small text-muted mb-3">With over 15 years in tech and hospitality, John leads our strategic vision with passion and expertise.</p>
                            <div class="social-links">
                                <a href="#" class="text-muted me-2"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-muted me-2"><i class="bi bi-twitter-x"></i></a>
                                <a href="#" class="text-muted"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <img src="{{ url('images/demo.webp') }}" class="card-img-top" alt="Team Member">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Jane Doe</h5>
                            <p class="text-muted mb-3">Chief Technology Officer</p>
                            <p class="small text-muted mb-3">Jane's innovative approach to technology has been instrumental in creating our seamless user experience.</p>
                            <div class="social-links">
                                <a href="#" class="text-muted me-2"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-muted me-2"><i class="bi bi-twitter-x"></i></a>
                                <a href="#" class="text-muted"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <img src="{{ url('images/demo.webp') }}" class="card-img-top" alt="Team Member">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Michael Chen</h5>
                            <p class="text-muted mb-3">Head of Marketing</p>
                            <p class="small text-muted mb-3">Michael brings creative strategies to expand our community and connect users worldwide.</p>
                            <div class="social-links">
                                <a href="#" class="text-muted me-2"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-muted me-2"><i class="bi bi-twitter-x"></i></a>
                                <a href="#" class="text-muted"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <img src="{{ url('images/demo.webp') }}" class="card-img-top" alt="Team Member">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Sarah Johnson</h5>
                            <p class="text-muted mb-3">Customer Success Director</p>
                            <p class="small text-muted mb-3">Sarah ensures users have exceptional experiences by leading our dedicated support team.</p>
                            <div class="social-links">
                                <a href="#" class="text-muted me-2"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-muted me-2"><i class="bi bi-twitter-x"></i></a>
                                <a href="#" class="text-muted"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Our Impact By The Numbers</h2>
            </div>
            <div class="row text-center g-4">
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="text-primary fw-bold mb-2">5,000+</h3>
                            <p class="text-muted mb-0">Active Listings</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="text-primary fw-bold mb-2">25,000+</h3>
                            <p class="text-muted mb-0">Registered Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="text-primary fw-bold mb-2">20+</h3>
                            <p class="text-muted mb-0">Cities Covered</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="text-primary fw-bold mb-2">98%</h3>
                            <p class="text-muted mb-0">Satisfaction Rate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">What Clients Say About Us</h2>
                    <div class="card border-0 shadow-sm p-4">
                        <div class="d-flex justify-content-center mb-4">
                            <i class="bi bi-star-fill text-warning mx-1"></i>
                            <i class="bi bi-star-fill text-warning mx-1"></i>
                            <i class="bi bi-star-fill text-warning mx-1"></i>
                            <i class="bi bi-star-fill text-warning mx-1"></i>
                            <i class="bi bi-star-fill text-warning mx-1"></i>
                        </div>
                        <p class="lead mb-4">"This platform has completely transformed how we find accommodations. The process is seamless, the listings are high-quality, and the customer service is exceptional. We won't use any other service!"</p>
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ url('images/demo.webp') }}" class="rounded-circle me-3" alt="Testimonial" style="width: 60px; height: 60px; object-fit: cover;">
                            <div class="text-start">
                                <h5 class="mb-1">Robert Wilson</h5>
                                <p class="text-muted mb-0">Frequent Traveler</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Ready to get started?</h2>
                    <p class="lead mb-0">Join our community today and discover the perfect place for your needs.</p>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Sign Up Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Ad Display Section -->
    <div class="my-5">
        @include('frontend.partials.ad-display', ['position' => 'about_page_banner'])
    </div>
@endsection