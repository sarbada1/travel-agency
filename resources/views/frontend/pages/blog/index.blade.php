@extends('frontend.app.main')
@section('content')

<!-- Blog Header -->
<header class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-3">AdSpot Blog</h1>
                <p class="lead mb-4">Insights, tips, and trends for real estate, jobs, and marketplace success.</p>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="mb-3">Search Articles</h5>
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for articles...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Blog Categories -->
<section class="py-4 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center">
            <a href="#" class="btn btn-outline-primary rounded-pill m-1 active">All</a>
            <a href="#" class="btn btn-outline-primary rounded-pill m-1">Real Estate</a>
            <a href="#" class="btn btn-outline-primary rounded-pill m-1">Career Advice</a>
            <a href="#" class="btn btn-outline-primary rounded-pill m-1">Market Trends</a>
            <a href="#" class="btn btn-outline-primary rounded-pill m-1">Tips & Guides</a>
            <a href="#" class="btn btn-outline-primary rounded-pill m-1">Success Stories</a>
            <a href="#" class="btn btn-outline-primary rounded-pill m-1">Industry News</a>
        </div>
    </div>
</section>

<!-- Featured Article -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                @if($featuredPost)
                <div class="card border-0 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ $featuredPost->image ? url( $featuredPost->image) : url('images/demo.webp') }}" 
                                class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $featuredPost->title }}">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                <div>
                                    <span class="badge bg-primary mb-2">Featured</span>
                                    @if($featuredPost->category)
                                        <span class="badge bg-secondary mb-2">{{ $featuredPost->category->name }}</span>
                                    @endif
                                    <h2 class="card-title h3">{{ $featuredPost->title }}</h2>
                                    <p class="card-text text-muted">{!! Str::limit($featuredPost->description ?? strip_tags($featuredPost->description)) !!}</p>
                                </div>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $featuredPost->user && $featuredPost->user->image_profile ? url( $featuredPost->user->image_profile) : url('images/demo.webp') }}" 
                                            class="rounded-circle me-2" alt="Author" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <p class="mb-0 fw-medium">{{ $featuredPost->user ? $featuredPost->user->name : 'Admin' }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted small"><i class="bi bi-calendar3"></i> {{ $featuredPost->created_at->format('F d, Y') }}</span>
                                        <a href="{{ url('blogs/' . $featuredPost->slug) }}" class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Blog Articles -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <h3 class="mb-4">Latest Articles</h3>

                @forelse($blogs as $blog)
                <!-- Article -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $blog->image ? url($blog->image) : url('images/demo.webp') }}" 
                                class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $blog->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    @if($blog->category)
                                    <span class="badge bg-success me-2">{{ $blog->category->name }}</span>
                                    @endif
                                    <span class="text-muted small"><i class="bi bi-calendar3"></i> {{ $blog->created_at->format('F d, Y') }}</span>
                                </div>
                                <h4 class="card-title">
                                    <a href="{{ url('blogs/' . $blog->slug) }}" class="text-decoration-none text-dark">{{ $blog->title }}</a>
                                </h4>
                                <p class="card-text">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $blog->user && $blog->user->profile_image ? url( $blog->user->profile_image) : url('images/demo.webp') }}" 
                                            class="rounded-circle me-2" alt="Author" style="width: 30px; height: 30px; object-fit: cover;">
                                        <span class="small">{{ $blog->user ? $blog->user->name : 'Admin' }}</span>
                                    </div>
                                    <a href="{{ url('blogs/' . $blog->slug) }}" class="btn btn-sm btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-info">
                    No blog posts found.
                </div>
                @endforelse

                <!-- Pagination -->
                {{ $blogs->links() }}
            </div>


            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Popular Posts -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Popular Posts</h4>

                        @foreach($popularPosts as $post)
                        <!-- Popular Post -->
                        <div class="d-flex mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <img src="{{ $post->image ? url( $post->image) : url('images/demo.webp') }}" 
                                class="rounded me-3" alt="Popular post" style="width: 80px; height: 60px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1"><a href="{{ url('blogs/' . $post->slug) }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h6>
                                <p class="text-muted small mb-0"><i class="bi bi-calendar3"></i> {{ $post->created_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Categories -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Categories</h4>
                        <ul class="list-group list-group-flush">
                            @foreach($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <a href="{{ url('blogs?category=' . $category->slug) }}" class="text-decoration-none text-dark">{{ $category->name }}</a>
                                <span class="badge bg-primary rounded-pill">{{ $category->blogs_count }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

           

                <!-- Newsletter -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 bg-light rounded">
                        <h4 class="mb-3">Subscribe to Our Newsletter</h4>
                        <p class="text-muted mb-4">Get the latest articles, tips, and market insights delivered straight to your inbox.</p>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your email address" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
