@extends('frontend.app.main')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="contact-info bg-light p-4 rounded h-100">
                        <div class="d-flex mb-4">
                            <h2 class="section-title mb-4">Contact Information</h2>
                        </div>

                        <div class="mb-4">
                            @if ($settings->phone)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon me-3 bg-primary text-white rounded-circle">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Phone</h6>
                                        <a href="tel:{{ $settings->phone }}"
                                            class="text-decoration-none">{{ $settings->phone }}</a>
                                    </div>
                                </div>
                            @endif

                            @if ($settings->email)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon me-3 bg-primary text-white rounded-circle">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Email</h6>
                                        <a href="mailto:{{ $settings->email }}"
                                            class="text-decoration-none">{{ $settings->email }}</a>
                                    </div>
                                </div>
                            @endif

                            @if ($settings->address)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon me-3 bg-primary text-white rounded-circle">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Address</h6>
                                        <p class="mb-0">{{ $settings->address }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Display Sellers Instead of Agents --}}
                        @if (isset($sellers) && $sellers->count() > 0)
                            <div class="mt-5">
                                <h4 class="mb-3">Our Team</h4>
                                <div class="row g-3">
                                    @foreach ($sellers as $seller)
                                        <div class="col-6">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-body text-center">
                                                    <div class="mb-3">
                                                        @if ($seller->image)
                                                            <img src="{{ asset($seller->image) }}" class="rounded-circle"
                                                                width="70" height="70" alt="{{ $seller->name }}">
                                                        @else
                                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                                                style="width: 70px; height: 70px;">
                                                                <i class="bi bi-person-fill fs-3"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <h6 class="card-title mb-1">{{ $seller->name }}</h6>
                                                    <p class="small text-muted">{{ $seller->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($settings->google_map)
                            <div class="map-container mt-5">
                                <h5 class="mb-3">Find Us On Map</h5>
                                <div class="rounded overflow-hidden">
                                    {!! $settings->google_map !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- filepath: /home/sarbada/Desktop/booking/resources/views/frontend/pages/contact/index.blade.php -->

                <div class="col-lg-6">
                    <h2 class="section-title mb-4">Get In Touch</h2>
                    <p class="mb-4">Have questions about a property or need assistance with buying, selling, or renting?
                        Fill out the form below and one of our agents will get back to you shortly.</p>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        @guest
                            <!-- Fields shown only to non-logged in users -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            id="firstName" name="first_name" placeholder="First Name"
                                            value="{{ old('first_name') }}" required>
                                        <label for="firstName">First Name</label>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            id="lastName" name="last_name" placeholder="Last Name"
                                            value="{{ old('last_name') }}" required>
                                        <label for="lastName">Last Name</label>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                <label for="email">Email Address</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                <label for="phone">Phone Number</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                            <!-- Hidden fields for logged in users -->
                            <input type="hidden" name="first_name"
                                value="{{ auth()->user()->first_name ?? (explode(' ', auth()->user()->name)[0] ?? '') }}">
                            <input type="hidden" name="last_name"
                                value="{{ auth()->user()->last_name ?? ((count(explode(' ', auth()->user()->name)) > 1 ? explode(' ', auth()->user()->name)[1] : '') ?? '') }}">
                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                            <input type="hidden" name="phone" value="{{ auth()->user()->phone ?? '' }}">

                            <!-- Display user info -->
                            <div class="alert alert-info mb-4">
                                <strong>Contacting as:</strong> {{ auth()->user()->name }} ({{ auth()->user()->email }})
                                @if (auth()->user()->phone)
                                    <br>Phone: {{ auth()->user()->phone }}
                                @endif
                            </div>
                        @endguest

                        <div class="form-floating mb-3">
                            <select class="form-select @error('inquiry_type') is-invalid @enderror" id="inquiryType"
                                name="inquiry_type" required>
                                <option value="" selected disabled>Select an option</option>
                                <option value="buying" {{ old('inquiry_type') == 'buying' ? 'selected' : '' }}>Buying a
                                    Property</option>
                                <option value="selling" {{ old('inquiry_type') == 'selling' ? 'selected' : '' }}>Selling a
                                    Property</option>
                                <option value="renting" {{ old('inquiry_type') == 'renting' ? 'selected' : '' }}>Renting a
                                    Property</option>
                                <option value="management" {{ old('inquiry_type') == 'management' ? 'selected' : '' }}>
                                    Property Management</option>
                                <option value="other" {{ old('inquiry_type') == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            <label for="inquiryType">Inquiry Type</label>
                            @error('inquiry_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message"
                                style="height: 150px" placeholder="Your Message" required>{{ old('message') }}</textarea>
                            <label for="message">Your Message</label>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- Our Agents Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Meet Our Agents</h2>
                    <p class="text-muted">Our team of experienced real estate professionals is here to help you</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse($agents as $agent)
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100">
                            @if ($agent->image)
                                <img src="{{ url($agent->image) }}" class="card-img-top" alt="{{ $agent->name }}">
                            @else
                                <img src="{{ url('images/default-agent.jpg') }}" class="card-img-top"
                                    alt="{{ $agent->name }}">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $agent->name }}</h5>
                                <p class="text-muted">{{ $agent->memberType->name ?? 'Real Estate Agent' }}</p>
                                <p class="card-text">{{ Str::limit($agent->description, 100) }}</p>
                                <div class="social-links mt-3">
                                    @if ($agent->facebook)
                                        <a href="{{ $agent->facebook }}" class="text-primary me-2" target="_blank"><i
                                                class="bi bi-facebook"></i></a>
                                    @endif
                                    @if ($agent->twitter)
                                        <a href="{{ $agent->twitter }}" class="text-primary me-2" target="_blank"><i
                                                class="bi bi-twitter"></i></a>
                                    @endif
                                    @if ($agent->instagram)
                                        <a href="{{ $agent->instagram }}" class="text-primary me-2" target="_blank"><i
                                                class="bi bi-instagram"></i></a>
                                    @endif
                                    @if ($agent->linkedin)
                                        <a href="{{ $agent->linkedin }}" class="text-primary" target="_blank"><i
                                                class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 text-center">
                                @if ($agent->phone)
                                    <a href="tel:{{ $agent->phone }}" class="btn btn-outline-primary">
                                        <i class="bi bi-telephone me-2"></i> Contact
                                    </a>
                                @elseif($agent->email)
                                    <a href="mailto:{{ $agent->email }}" class="btn btn-outline-primary">
                                        <i class="bi bi-envelope me-2"></i> Contact
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No agents found at the moment. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
