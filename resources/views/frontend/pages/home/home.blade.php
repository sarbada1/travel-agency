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
    <link rel="stylesheet" href="css/style.css">
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
                        <!-- Destinations Mega Menu -->
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" id="destinationsDropdown" role="button" data-bs-toggle="dropdown">
                                Destinations
                            </a>
                            <div class="dropdown-menu megamenu" aria-labelledby="destinationsDropdown">
                                <div class="container">
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Asia</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">Thailand</a></li>
                                                    <li><a href="#" class="dropdown-item">Japan</a></li>
                                                    <li><a href="#" class="dropdown-item">Indonesia</a></li>
                                                    <li><a href="#" class="dropdown-item">Vietnam</a></li>
                                                    <li><a href="#" class="dropdown-item">Singapore</a></li>
                                                    <li><a href="#" class="dropdown-item">Malaysia</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Europe</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">Italy</a></li>
                                                    <li><a href="#" class="dropdown-item">France</a></li>
                                                    <li><a href="#" class="dropdown-item">Spain</a></li>
                                                    <li><a href="#" class="dropdown-item">Greece</a></li>
                                                    <li><a href="#" class="dropdown-item">Germany</a></li>
                                                    <li><a href="#" class="dropdown-item">United Kingdom</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Americas</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">USA</a></li>
                                                    <li><a href="#" class="dropdown-item">Canada</a></li>
                                                    <li><a href="#" class="dropdown-item">Mexico</a></li>
                                                    <li><a href="#" class="dropdown-item">Brazil</a></li>
                                                    <li><a href="#" class="dropdown-item">Peru</a></li>
                                                    <li><a href="#" class="dropdown-item">Argentina</a></li>
                                                </ul>
                                            </div>
                                        </div>
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
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <!-- Tours Mega Menu -->
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" id="toursDropdown" role="button" data-bs-toggle="dropdown">
                                Tours
                            </a>
                            <div class="dropdown-menu megamenu" aria-labelledby="toursDropdown">
                                <div class="container">
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Tour Types</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">Adventure Tours</a></li>
                                                    <li><a href="#" class="dropdown-item">Cultural Tours</a></li>
                                                    <li><a href="#" class="dropdown-item">Beach Vacations</a></li>
                                                    <li><a href="#" class="dropdown-item">City Breaks</a></li>
                                                    <li><a href="#" class="dropdown-item">Luxury Tours</a></li>
                                                    <li><a href="#" class="dropdown-item">Wildlife Safaris</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Tour Duration</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">Weekend Getaways</a></li>
                                                    <li><a href="#" class="dropdown-item">1 Week Tours</a></li>
                                                    <li><a href="#" class="dropdown-item">2 Week Tours</a></li>
                                                    <li><a href="#" class="dropdown-item">Month-long Journeys</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Special Tours</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">Honeymoon Packages</a></li>
                                                    <li><a href="#" class="dropdown-item">Family Vacations</a></li>
                                                    <li><a href="#" class="dropdown-item">Solo Traveler Tours</a></li>
                                                    <li><a href="#" class="dropdown-item">Senior Citizen Tours</a></li>
                                                </ul>
                                            </div>
                                        </div>
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
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <!-- Packages Mega Menu -->
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" id="packagesDropdown" role="button" data-bs-toggle="dropdown">
                                Packages
                            </a>
                            <div class="dropdown-menu megamenu" aria-labelledby="packagesDropdown">
                                <div class="container">
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Package Types</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">All-Inclusive Resorts</a></li>
                                                    <li><a href="#" class="dropdown-item">Flight + Hotel</a></li>
                                                    <li><a href="#" class="dropdown-item">Cruise Packages</a></li>
                                                    <li><a href="#" class="dropdown-item">Adventure Packages</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Seasonal Packages</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">Summer Specials</a></li>
                                                    <li><a href="#" class="dropdown-item">Winter Getaways</a></li>
                                                    <li><a href="#" class="dropdown-item">Spring Break Deals</a></li>
                                                    <li><a href="#" class="dropdown-item">Fall Escapes</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Budget Options</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">Budget Friendly</a></li>
                                                    <li><a href="#" class="dropdown-item">Mid-Range</a></li>
                                                    <li><a href="#" class="dropdown-item">Luxury</a></li>
                                                    <li><a href="#" class="dropdown-item">Ultra Luxury</a></li>
                                                </ul>
                                            </div>
                                        </div>
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
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <!-- Blog Mega Menu -->
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-bs-toggle="dropdown">
                                Blog
                            </a>
                            <div class="dropdown-menu megamenu" aria-labelledby="blogDropdown">
                                <div class="container">
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Blog Categories</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">Travel Tips</a></li>
                                                    <li><a href="#" class="dropdown-item">Destination Guides</a></li>
                                                    <li><a href="#" class="dropdown-item">Travel Stories</a></li>
                                                    <li><a href="#" class="dropdown-item">Photography</a></li>
                                                    <li><a href="#" class="dropdown-item">Food & Culture</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">Featured Articles</h6>
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="dropdown-item">10 Must-Visit Destinations in 2025</a></li>
                                                    <li><a href="#" class="dropdown-item">How to Pack Like a Pro</a></li>
                                                    <li><a href="#" class="dropdown-item">Budget Travel: Tips & Tricks</a></li>
                                                    <li><a href="#" class="dropdown-item">Solo Female Travel Safety Guide</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-megamenu">
                                                <h6 class="title">Latest Blog Posts</h6>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="border-0 shadow-sm card">
                                                            <img src="https://via.placeholder.com/300x200?text=Blog+Post" class="card-img-top" alt="Blog Post">
                                                            <div class="p-3 card-body">
                                                                <h6 class="card-title">Exploring Hidden Beaches in Thailand</h6>
                                                                <p class="card-text small">Discover secluded paradises away from tourist crowds...</p>
                                                                <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="border-0 shadow-sm card">
                                                            <img src="https://via.placeholder.com/300x200?text=Blog+Post" class="card-img-top" alt="Blog Post">
                                                            <div class="p-3 card-body">
                                                                <h6 class="card-title">Ultimate Guide to European Train Travel</h6>
                                                                <p class="card-text small">Everything you need to know about rail passes...</p>
                                                                <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
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
                    <img src="https://via.placeholder.com/1920x800?text=Beautiful+Beach+Destination" class="d-block w-100" alt="Beach Destination">
                    <div class="carousel-caption">
                        <h1 class="display-4 fw-bold slide-in-left">Discover Paradise</h1>
                        <p class="lead slide-in-right">Explore the world's most beautiful beaches</p>
                        <a href="#" class="mt-3 btn btn-primary btn-lg bounce-in">Book Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1920x800?text=Mountain+Adventure" class="d-block w-100" alt="Mountain Adventure">
                    <div class="carousel-caption">
                        <h1 class="display-4 fw-bold slide-in-left">Adventure Awaits</h1>
                        <p class="lead slide-in-right">Conquer mountains and create memories</p>
                        <a href="#" class="mt-3 btn btn-primary btn-lg bounce-in">Explore Tours</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1920x800?text=Cultural+Experience" class="d-block w-100" alt="Cultural Experience">
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
                <div class="col-md-4 col-sm-6 destination-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Bali" class="card-img-top" alt="Bali">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 card-title">Bali, Indonesia</h5>
                                <span class="badge bg-primary">Popular</span>
                            </div>
                            <p class="card-text">Experience the perfect blend of beaches, culture, and adventure.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold">From $899</span>
                                <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 destination-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Santorini" class="card-img-top" alt="Santorini">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 card-title">Santorini, Greece</h5>
                                <span class="badge bg-info">Featured</span>
                            </div>
                            <p class="card-text">Discover the iconic white buildings and breathtaking sunsets.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold">From $1,299</span>
                                <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 destination-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Kyoto" class="card-img-top" alt="Kyoto">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 card-title">Kyoto, Japan</h5>
                                <span class="badge bg-success">New</span>
                            </div>
                            <p class="card-text">Immerse yourself in Japanese culture and ancient traditions.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold">From $1,099</span>
                                <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 destination-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Paris" class="card-img-top" alt="Paris">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 card-title">Paris, France</h5>
                                <span class="badge bg-primary">Popular</span>
                            </div>
                            <p class="card-text">Experience the romance and charm of the City of Light.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold">From $999</span>
                                <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 destination-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Machu+Picchu" class="card-img-top" alt="Machu Picchu">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 card-title">Machu Picchu, Peru</h5>
                                <span class="badge bg-warning text-dark">Adventure</span>
                            </div>
                            <p class="card-text">Explore the ancient Incan citadel high in the Andes mountains.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold">From $1,499</span>
                                <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 destination-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Maldives" class="card-img-top" alt="Maldives">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 card-title">Maldives</h5>
                                <span class="badge bg-info">Featured</span>
                            </div>
                            <p class="card-text">Relax in overwater bungalows on pristine turquoise waters.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold">From $1,899</span>
                                <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 text-center">
                <a href="#" class="btn btn-outline-primary btn-lg">View All Destinations</a>
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
                <div class="col-lg-3 col-md-6 package-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <div class="position-relative">
                            <img src="https://via.placeholder.com/600x400?text=Beach+Getaway" class="card-img-top" alt="Beach Getaway">
                            <div class="top-0 px-3 py-1 m-3 text-white rounded package-duration position-absolute end-0 bg-primary">7 Days</div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Tropical Beach Getaway</h5>
                            <div class="mb-3 d-flex">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                                <span class="ms-2 text-muted">(48 reviews)</span>
                            </div>
                            <p class="card-text">Enjoy pristine beaches, luxury resorts, and water activities.</p>
                            <div class="mb-3 package-features">
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-hotel me-1"></i> 4-5 Star Hotels</span>
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-utensils me-1"></i> Breakfast</span>
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-plane me-1"></i> Flights</span>
                            </div>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted text-decoration-line-through me-2">$1,299</span>
                                    <span class="text-primary fw-bold">$999</span>
                                </div>
                                <a href="#" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 package-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <div class="position-relative">
                            <img src="https://via.placeholder.com/600x400?text=European+Adventure" class="card-img-top" alt="European Adventure">
                            <div class="top-0 px-3 py-1 m-3 text-white rounded package-duration position-absolute end-0 bg-primary">10 Days</div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">European Adventure</h5>
                            <div class="mb-3 d-flex">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <span class="ms-2 text-muted">(72 reviews)</span>
                            </div>
                            <p class="card-text">Explore the best of Europe: Paris, Rome, Barcelona, and more.</p>
                            <div class="mb-3 package-features">
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-hotel me-1"></i> 4 Star Hotels</span>
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-utensils me-1"></i> Breakfast</span>
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-train me-1"></i> Transport</span>
                            </div>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted text-decoration-line-through me-2">$2,199</span>
                                    <span class="text-primary fw-bold">$1,799</span>
                                </div>
                                <a href="#" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 package-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <div class="position-relative">
                            <img src="https://via.placeholder.com/600x400?text=Asian+Explorer" class="card-img-top" alt="Asian Explorer">
                            <div class="top-0 px-3 py-1 m-3 text-white rounded package-duration position-absolute end-0 bg-primary">12 Days</div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Asian Explorer</h5>
                            <div class="mb-3 d-flex">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                <span class="ms-2 text-muted">(36 reviews)</span>
                            </div>
                            <p class="card-text">Discover the wonders of Thailand, Vietnam, and Cambodia.</p>
                            <div class="mb-3 package-features">
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-hotel me-1"></i> Mixed Accommodations</span>
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-utensils me-1"></i> Some Meals</span>
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-plane me-1"></i> Flights</span>
                            </div>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted text-decoration-line-through me-2">$1,599</span>
                                    <span class="text-primary fw-bold">$1,299</span>
                                </div>
                                <a href="#" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 package-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <div class="position-relative">
                            <img src="https://via.placeholder.com/600x400?text=Safari+Adventure" class="card-img-top" alt="Safari Adventure">
                            <div class="top-0 px-3 py-1 m-3 text-white rounded package-duration position-absolute end-0 bg-primary">8 Days</div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">African Safari Adventure</h5>
                            <div class="mb-3 d-flex">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                                <span class="ms-2 text-muted">(52 reviews)</span>
                            </div>
                            <p class="card-text">Experience wildlife up close in Kenya and Tanzania.</p>
                            <div class="mb-3 package-features">
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-hotel me-1"></i> Luxury Lodges</span>
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-utensils me-1"></i> Full Board</span>
                                <span class="mb-2 badge bg-light text-dark me-2"><i class="fas fa-jeep me-1"></i> Safari Drives</span>
                            </div>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted text-decoration-line-through me-2">$2,499</span>
                                    <span class="text-primary fw-bold">$2,099</span>
                                </div>
                                <a href="#" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 text-center">
                <a href="#" class="btn btn-outline-primary btn-lg">View All Packages</a>
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
                    <p class="text-muted">We offer tours to over 100 countries across all continents, ensuring you have endless options to explore.</p>
                </div>
                <div class="text-center col-md-4 feature-item">
                    <div class="mx-auto mb-4 text-white feature-icon bg-primary rounded-circle fade-in">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h4>Best Price Guarantee</h4>
                    <p class="text-muted">Find a lower price for the same tour elsewhere? We'll match it and give you an additional 5% discount.</p>
                </div>
                <div class="text-center col-md-4 feature-item">
                    <div class="mx-auto mb-4 text-white feature-icon bg-primary rounded-circle fade-in">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>24/7 Customer Support</h4>
                    <p class="text-muted">Our dedicated support team is available around the clock to assist you with any questions or concerns.</p>
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
                                    <img src="https://via.placeholder.com/100x100" class="mb-3 rounded-circle" alt="Customer">
                                    <p class="mb-3 testimonial-text">"Our trip to Bali was absolutely perfect! The accommodations were luxurious, the guides were knowledgeable, and every detail was taken care of. We can't wait to book our next adventure with Wanderlust!"</p>
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
                                    <img src="https://via.placeholder.com/100x100" class="mb-3 rounded-circle" alt="Customer">
                                    <p class="mb-3 testimonial-text">"The European tour exceeded all our expectations. The itinerary was perfectly balanced between guided tours and free time. Our guide Marco was exceptional and made the history come alive. Highly recommended!"</p>
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
                                    <img src="https://via.placeholder.com/100x100" class="mb-3 rounded-circle" alt="Customer">
                                    <p class="mb-3 testimonial-text">"As a solo traveler, I was nervous about my trip to Thailand, but Wanderlust made me feel safe and connected the entire time. I met amazing people and had experiences I'll never forget. Thank you for an incredible journey!"</p>
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
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
                        <img src="https://via.placeholder.com/600x400?text=Travel+Tips" class="card-img-top" alt="Travel Tips">
                        <div class="card-body">
                            <div class="mb-3 blog-meta d-flex justify-content-between">
                                <span class="text-muted"><i class="far fa-calendar-alt me-1"></i> April 1, 2025</span>
                                <span class="text-muted"><i class="far fa-comment me-1"></i> 24 Comments</span>
                            </div>
                            <h5 class="card-title">10 Essential Tips for Budget Travel in 2025</h5>
                            <p class="card-text">Learn how to make the most of your travel budget with these expert tips and tricks.</p>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <a href="#" class="p-0 btn btn-link text-primary">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 blog-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Hidden+Gems" class="card-img-top" alt="Hidden Gems">
                        <div class="card-body">
                            <div class="mb-3 blog-meta d-flex justify-content-between">
                                <span class="text-muted"><i class="far fa-calendar-alt me-1"></i> March 25, 2025</span>
                                <span class="text-muted"><i class="far fa-comment me-1"></i> 18 Comments</span>
                            </div>
                            <h5 class="card-title">5 Hidden Gems in Southeast Asia You Must Visit</h5>
                            <p class="card-text">Discover lesser-known destinations that offer authentic experiences away from the crowds.</p>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <a href="#" class="p-0 btn btn-link text-primary">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 blog-item">
                    <div class="border-0 shadow-sm card h-100 hover-scale">
                        <img src="https://via.placeholder.com/600x400?text=Sustainable+Travel" class="card-img-top" alt="Sustainable Travel">
                        <div class="card-body">
                            <div class="mb-3 blog-meta d-flex justify-content-between">
                                <span class="text-muted"><i class="far fa-calendar-alt me-1"></i> March 18, 2025</span>
                                <span class="text-muted"><i class="far fa-comment me-1"></i> 32 Comments</span>
                            </div>
                            <h5 class="card-title">The Ultimate Guide to Sustainable Travel</h5>
                            <p class="card-text">Learn how to minimize your environmental impact while still enjoying amazing travel experiences.</p>
                        </div>
                        <div class="bg-white border-0 card-footer">
                            <a href="#" class="p-0 btn btn-link text-primary">Read More <i class="fas fa-arrow-right ms-1"></i></a>
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
                                <img src="https://via.placeholder.com/300x200?text=News" class="img-fluid rounded-start h-100 object-fit-cover" alt="Travel News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-2 news-meta d-flex align-items-center">
                                        <span class="badge bg-danger me-2">Breaking</span>
                                        <span class="text-muted small"><i class="far fa-clock me-1"></i> April 3, 2025</span>
                                    </div>
                                    <h5 class="card-title">New Direct Flights Announced Between Major Cities</h5>
                                    <p class="card-text">Major airlines have announced new direct routes connecting key destinations, making travel more convenient for tourists.</p>
                                    <a href="#" class="p-0 btn btn-link text-primary">Read Full Story <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 news-item">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300x200?text=News" class="img-fluid rounded-start h-100 object-fit-cover" alt="Travel News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-2 news-meta d-flex align-items-center">
                                        <span class="badge bg-primary me-2">Industry</span>
                                        <span class="text-muted small"><i class="far fa-clock me-1"></i> April 2, 2025</span>
                                    </div>
                                    <h5 class="card-title">Tourism Recovery Reaches Pre-Pandemic Levels</h5>
                                    <p class="card-text">Global tourism has finally rebounded to pre-pandemic levels according to the latest industry reports.</p>
                                    <a href="#" class="p-0 btn btn-link text-primary">Read Full Story <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 news-item">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300x200?text=News" class="img-fluid rounded-start h-100 object-fit-cover" alt="Travel News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-2 news-meta d-flex align-items-center">
                                        <span class="badge bg-success me-2">Destination</span>
                                        <span class="text-muted small"><i class="far fa-clock me-1"></i> March 30, 2025</span>
                                    </div>
                                    <h5 class="card-title">New UNESCO World Heritage Sites Announced</h5>
                                    <p class="card-text">UNESCO has added several new sites to its prestigious World Heritage list, including cultural and natural wonders.</p>
                                    <a href="#" class="p-0 btn btn-link text-primary">Read Full Story <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 news-item">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/300x200?text=News" class="img-fluid rounded-start h-100 object-fit-cover" alt="Travel News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-2 news-meta d-flex align-items-center">
                                        <span class="badge bg-warning text-dark me-2">Travel Tech</span>
                                        <span class="text-muted small"><i class="far fa-clock me-1"></i> March 28, 2025</span>
                                    </div>
                                    <h5 class="card-title">New Travel App Revolutionizes Trip Planning</h5>
                                    <p class="card-text">A new AI-powered travel app is changing how travelers plan their trips with personalized recommendations.</p>
                                    <a href="#" class="p-0 btn btn-link text-primary">Read Full Story <i class="fas fa-arrow-right ms-1"></i></a>
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

    <!-- Footer -->
    <footer class="pt-5 pb-3 text-white footer-section bg-dark">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Wanderlust</h5>
                    <p>Your trusted partner for unforgettable travel experiences since 2010. We specialize in creating personalized journeys that match your travel style.</p>
                    <div class="mt-3 social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Destinations</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Tour Packages</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Blog</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Contact Info</h5>
                    <ul class="list-unstyled footer-contact">
                        <li class="mb-3"><i class="fas fa-map-marker-alt me-2"></i> 123 Travel Street, New York, NY 10001</li>
                        <li class="mb-3"><i class="fas fa-phone-alt me-2"></i> +1 (234) 567-8900</li>
                        <li class="mb-3"><i class="fas fa-envelope me-2"></i> info@wanderlust.com</li>
                        <li><i class="fas fa-clock me-2"></i> Mon-Fri: 9AM - 6PM</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">We Accept</h5>
                    <div class="payment-methods">
                        <i class="mb-2 fab fa-cc-visa fa-2x me-2"></i>
                        <i class="mb-2 fab fa-cc-mastercard fa-2x me-2"></i>
                        <i class="mb-2 fab fa-cc-amex fa-2x me-2"></i>
                        <i class="mb-2 fab fa-cc-paypal fa-2x"></i>
                    </div>
                    <h5 class="mt-4 mb-3">Download Our App</h5>
                    <div class="app-buttons">
                        <a href="#" class="mb-2 btn btn-outline-light me-2"><i class="fab fa-apple me-2"></i> App Store</a>
                        <a href="#" class="mb-2 btn btn-outline-light"><i class="fab fa-google-play me-2"></i> Google Play</a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-3">
            <div class="row">
                <div class="mb-3 col-md-6 mb-md-0">
                    <p class="mb-0">&copy; 2025 Wanderlust. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none me-3">Terms & Conditions</a>
                    <a href="#" class="text-white text-decoration-none">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top btn btn-primary rounded-circle" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>
</html>

<style>
:root {
    --primary-color: #0d6efd;
    --secondary-color: #6c757d;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --transition: all 0.3s ease;
}

body {
    font-family: 'Poppins', sans-serif;
    color: #333;
}

/* Animation Classes */
.slide-in-left {
    animation: slideInLeft 1s ease-out;
}

.slide-in-right {
    animation: slideInRight 1s ease-out;
}

.bounce-in {
    animation: bounceIn 1s ease;
}

.fade-in {
    animation: fadeIn 1.5s ease-in-out;
}

/* Keyframes */
@keyframes slideInLeft {
    0% {
        transform: translateX(-100px);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideInRight {
    0% {
        transform: translateX(100px);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes bounceIn {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-30px);
    }
    60% {
        transform: translateY(-15px);
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

/* Header Styles */
.top-header {
    font-size: 0.9rem;
}

.social-links a:hover {
    opacity: 0.8;
}

.main-header {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.logo {
    height: 50px;
}

.navbar-nav .nav-link {
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: var(--transition);
}

.navbar-nav .nav-link:hover {
    color: var(--primary-color);
}

/* Mega Menu Styles */
.has-megamenu {
    position: static !important;
}

.megamenu {
    width: 100%;
    left: 0;
    right: 0;
    padding: 20px;
    border-radius: 0;
    border: none;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.col-megamenu {
    padding: 0 15px;
}

.col-megamenu .title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: var(--primary-color);
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.col-megamenu ul li {
    margin-bottom: 8px;
}

.col-megamenu .dropdown-item {
    padding: 5px 0;
    font-size: 0.9rem;
}

.col-megamenu .dropdown-item:hover {
    background: transparent;
    color: var(--primary-color);
    padding-left: 5px;
}

.featured-tour {
    transition: var(--transition);
}

.featured-tour:hover {
    transform: translateY(-3px);
}

.object-fit-cover {
    object-fit: cover;
}

/* Hero Banner */
.hero-banner {
    position: relative;
}

.carousel-item {
    height: 600px;
}

.carousel-item img {
    object-fit: cover;
    height: 100%;
}

.carousel-caption {
    bottom: 20%;
    z-index: 2;
}

.carousel-caption h1 {
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
}

.carousel-caption p {
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
}

/* Search Form */
.search-form-container {
    margin-top: -50px;
    position: relative;
    z-index: 10;
}

/* Destination Section */
.destination-item {
    transition: var(--transition);
}

.hover-scale:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.card-img-top {
    height: 220px;
    object-fit: cover;
}

/* Package Section */
.package-duration {
    font-size: 0.8rem;
    font-weight: 500;
}

.package-features .badge {
    font-weight: 400;
}

/* Features Section */
.feature-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}

/* Testimonials */
.testimonial-item {
    min-height: 300px;
}

.testimonial-item img {
    width: 80px;
    height: 80px;
    object-fit: cover;
}

.testimonial-text {
    font-style: italic;
}

.carousel-control-prev-icon, .carousel-control-next-icon {
    width: 40px;
    height: 40px;
    padding: 10px;
}

/* Blog Section */
.blog-meta {
    font-size: 0.8rem;
}

/* News Section */
.news-section .card {
    transition: var(--transition);
}

.news-section .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.news-meta .badge {
    font-size: 0.7rem;
    font-weight: 500;
}

/* Newsletter */
.newsletter-form .form-control {
    height: 50px;
}

.newsletter-form .btn {
    height: 50px;
    padding-left: 30px;
    padding-right: 30px;
}

/* Footer */
.footer-links a, .footer-contact li {
    transition: var(--transition);
}

.footer-links a:hover {
    padding-left: 5px;
    opacity: 0.8;
}

.payment-methods i {
    color: #fff;
    opacity: 0.8;
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99;
    opacity: 0;
    visibility: hidden;
    transition: var(--transition);
}

.back-to-top.show {
    opacity: 1;
    visibility: visible;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .megamenu {
        padding: 15px;
    }
    
    .carousel-item {
        height: 450px;
    }
    
    .carousel-caption {
        bottom: 10%;
    }
}

@media (max-width: 768px) {
    .carousel-item {
        height: 350px;
    }
    
    .carousel-caption h1 {
        font-size: 2rem;
    }
    
    .search-form-container {
        margin-top: 20px;
    }
    
    .social-links, .contact-info {
        text-align: center;
        justify-content: center;
        margin-bottom: 10px;
    }
}

@media (max-width: 576px) {
    .carousel-item {
        height: 300px;
    }
    
    .carousel-caption h1 {
        font-size: 1.5rem;
    }
    
    .carousel-caption p {
        font-size: 1rem;
    }
    
    .carousel-caption .btn {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
}

</style>