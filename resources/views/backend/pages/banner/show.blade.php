@extends('backend.master.main')

@section('title', 'View Banner')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>View Banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Banners</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Banner Details</h5>
                        
                        <div class="text-center mb-4">
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" class="img-fluid rounded" style="max-height: 400px;">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="fw-bold">Banner ID</h6>
                                    <p>{{ $banner->id }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Title</h6>
                                    <p>{{ $banner->title ?? 'No title' }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Description</h6>
                                    <p>{{ $banner->description ?? 'No description' }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Button</h6>
                                    @if($banner->button_text)
                                        <p>
                                            {{ $banner->button_text }} 
                                            @if($banner->button_url)
                                                <small>(links to: {{ $banner->button_url }})</small>
                                            @endif
                                        </p>
                                    @else
                                        <p>No button defined</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="fw-bold">Position</h6>
                                    <p>{{ \App\Models\Banner\Banner::positions()[$banner->position] ?? $banner->position }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Status</h6>
                                    <p>
                                        <span class="badge bg-{{ $banner->is_active ? 'success' : 'danger' }}">
                                            {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Sort Order</h6>
                                    <p>{{ $banner->sort_order }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Created</h6>
                                    <p>{{ $banner->created_at->format('F d, Y h:i A') }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Last Updated</h6>
                                    <p>{{ $banner->updated_at->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end mt-3">
                            <a href="{{ route('banner.index') }}" class="btn btn-secondary">Back to List</a>
                            <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-primary">Edit Banner</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection