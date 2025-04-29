<?php

function getLimitDescription($text)
{
    $limit = 100;
    if (strlen($text) > $limit) {
        return substr($text, 0, $limit) . '...';
    } else {
        return $text;
    }
}

?>
@extends('frontend.app.main')

@section('content')
    <!-- Blog Header -->
    <header class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/blogs') }}">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Blog Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Article Header -->
                    <div class="mb-4">
                        @if ($blog->category)
                            <span class="badge bg-primary mb-2">{{ $blog->category->name }}</span>
                        @endif
                        <h1 class="display-5 fw-bold mb-3">{{ $blog->title }}</h1>
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ $blog->user && $blog->user->profile_image ? url($blog->user->profile_image) : url('images/demo.webp') }}"
                                class="rounded-circle me-3" alt="Author"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">{{ $blog->user ? $blog->user->name : 'Admin' }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if ($blog->image)
                        <img src="{{ url($blog->image) }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">
                    @else
                        <img src="{{ url('images/demo.webp') }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">
                    @endif
                    <!-- Article Content -->
                    <div class="article-content">
                        {!! $blog->content !!}
                    </div>

                    <!-- Author Bio -->
                    {{-- <div class="card border-0 shadow-sm my-5">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <img src="https://via.placeholder.com/100" class="rounded-circle me-4" alt="Author">
                            <div>
                                <h4>About the Author</h4>
                                <h5 class="mb-2">Sarah Johnson</h5>
                                <p class="text-muted mb-3">Sarah is a real estate expert with over 15 years of experience in the industry. She specializes in helping first-time buyers navigate the complex process of purchasing their first home.</p>
                                <div class="d-flex">
                                    <a href="#" class="text-primary me-3"><i class="bi bi-globe"></i> Website</a>
                                    <a href="#" class="text-primary me-3"><i class="bi bi-twitter"></i> Twitter</a>
                                    <a href="#" class="text-primary"><i class="bi bi-linkedin"></i> LinkedIn</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                    <!-- Comments Section -->
                    <div class="comments-section mt-5">
                        <h3 class="mb-4">Comments ({{ $comments->count() }})</h3>

                        <!-- Comment Form -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h5 class="mb-3">Leave a Comment</h5>
                                <form id="commentForm" method="POST" action="{{ route('blog.comment.store') }}">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <div class="row g-3">
                                        @guest
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                        @endguest
                                        <div class="col-12">
                                            <label for="comment" class="form-label">Comment</label>
                                            <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Post Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="commentsList">
                            @if($comments->count() > 0)
                                @foreach($comments as $comment)
                                    @if(!$comment->parent_id) <!-- Only show parent comments here -->
                                        <div class="comment-item mb-4" id="comment-{{ $comment->id }}">
                                            <div class="d-flex">
                                                <img src="{{ $comment->user ? ($comment->user->profile_image ? url($comment->user->profile_image) : url('images/default-avatar.jpg')) : url('images/default-avatar.jpg') }}" 
                                                    class="rounded-circle me-3" alt="Commenter" style="width: 60px; height: 60px; object-fit: cover;">
                                                <div class="flex-grow-1">
                                                    <div class="bg-light p-3 rounded">
                                                        <div class="d-flex justify-content-between mb-2">
                                                            <h5 class="mb-0">{{ $comment->user ? $comment->user->name : 'Anonymous' }}</h5>
                                                            <span class="text-muted small">{{ $comment->created_at->format('F d, Y') }}</span>
                                                        </div>
                                                        <p class="mb-0">{{ $comment->body }}</p>
                                                    </div>
                                                    <div class="mt-2 ms-2">
                                                        <a href="#" class="text-decoration-none me-3 reply-btn" data-comment-id="{{ $comment->id }}">
                                                            <i class="bi bi-reply"></i> Reply
                                                        </a>
                                                        <a href="#" class="text-decoration-none like-btn">
                                                            <i class="bi bi-hand-thumbs-up"></i> Like
                                                        </a>
                                                    </div>
                                                    
                                                    <!-- Reply Form (initially hidden) -->
                                                    <div class="reply-form mt-3 d-none" id="reply-form-{{ $comment->id }}">
                                                        <form method="POST" action="{{ route('blog.comment.reply') }}" class="replyForm">
                                                            @csrf
                                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                            <div class="mb-3">
                                                                <textarea class="form-control" name="reply" rows="3" required></textarea>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <button type="button" class="btn btn-sm btn-outline-secondary me-2 cancel-reply">Cancel</button>
                                                                <button type="submit" class="btn btn-sm btn-primary">Post Reply</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    
                                                    <!-- Replies to this comment -->
                                                    @if($comment->replies->count() > 0)
                                                        <div class="replies ms-4 mt-3">
                                                            @foreach($comment->replies as $reply)
                                                                <div class="comment-reply mt-3" id="comment-{{ $reply->id }}">
                                                                    <div class="d-flex">
                                                                        <img src="{{ $reply->user ? ($reply->user->profile_image ? url($reply->user->profile_image) : url('images/default-avatar.jpg')) : url('images/default-avatar.jpg') }}" 
                                                                            class="rounded-circle me-3" alt="Commenter" style="width: 60px; height: 60px; object-fit: cover;">
                                                                        <div class="flex-grow-1">
                                                                            <div class="bg-light p-3 rounded">
                                                                                <div class="d-flex justify-content-between mb-2">
                                                                                    <h5 class="mb-0">{{ $reply->user ? $reply->user->name : 'Anonymous' }}</h5>
                                                                                    <span class="text-muted small">{{ $reply->created_at->format('F d, Y') }}</span>
                                                                                </div>
                                                                                <p class="mb-0">{{ $reply->body }}</p>
                                                                            </div>
                                                                            <div class="mt-2 ms-2">
                                                                                <a href="#" class="text-decoration-none me-3 reply-btn" data-comment-id="{{ $comment->id }}">
                                                                                    <i class="bi bi-reply"></i> Reply
                                                                                </a>
                                                                                <a href="#" class="text-decoration-none like-btn">
                                                                                    <i class="bi bi-hand-thumbs-up"></i> Like
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="alert alert-info">No comments yet. Be the first to comment!</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Related Articles -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h4 class="mb-3">Related Articles</h4>
                            @foreach ($relatedPosts as $post)
                                <div class="d-flex mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <img src="{{ $post->image ? url($post->image) : url('images/demo.webp') }}"
                                        class="rounded me-3" alt="Related post"
                                        style="width: 80px; height: 60px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-1"><a href="{{ url('blogs/' . $post->slug) }}"
                                                class="text-decoration-none text-dark">{{ $post->title }}</a></h6>
                                        <p class="text-muted small mb-0"><i class="bi bi-calendar3"></i>
                                            {{ $post->created_at->format('F d, Y') }}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Popular Categories -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h4 class="mb-3">Categories</h4>
                            <ul class="list-group list-group-flush">
                                @foreach ($categories as $category)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <a href="#"
                                            class="text-decoration-none text-dark">{{ $category->name }}</a>
                                        <span class="badge bg-primary rounded-pill">{{ $category->blogs_count }}</span>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4 bg-light rounded">
                            <h4 class="mb-3">Subscribe to Our Newsletter</h4>
                            <p class="text-muted mb-4">Get the latest articles, tips, and market insights delivered
                                straight to your inbox.</p>
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

                    <!-- Tags -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="mb-3">Popular Tags</h4>
                            <div class="d-flex flex-wrap">
                                <a href="#" class="badge bg-light text-dark text-decoration-none m-1 p-2">Real
                                    Estate</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none m-1 p-2">Home
                                    Buying</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none m-1 p-2">Selling
                                    Tips</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none m-1 p-2">Job
                                    Search</a>
                                <a href="#"
                                    class="badge bg-light text-dark text-decoration-none m-1 p-2">Interview</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none m-1 p-2">Resume</a>
                                <a href="#"
                                    class="badge bg-light text-dark text-decoration-none m-1 p-2">Marketing</a>
                                <a href="#"
                                    class="badge bg-light text-dark text-decoration-none m-1 p-2">Photography</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none m-1 p-2">Remote
                                    Work</a>
                                <a href="#"
                                    class="badge bg-light text-dark text-decoration-none m-1 p-2">Investment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
