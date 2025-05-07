@extends('backend.master.main')

@section('title', 'Manage Banners')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Banners</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Banners</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title">Banners List</h5>
                            <a href="{{ route('banner.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Add New Banner
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th>Sort Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td class="media-preview-cell">
                                                @if(isset($banner->media_type) && $banner->media_type == 'video' && $banner->video)
                                                    <div class="video-thumbnail">
                                                        <video width="100" height="60" autoplay loop muted>
                                                            <source src="{{ asset($banner->video) }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <span class="media-badge video-badge">
                                                            <i class="bi bi-film"></i>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="image-thumbnail">
                                                        <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" width="100" class="img-thumbnail">
                                                        <span class="media-badge image-badge">
                                                            <i class="bi bi-image"></i>
                                                        </span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $banner->title ?? 'No Title' }}</td>
                                            <td>{{ \App\Models\Banner\Banner::positions()[$banner->position] ?? $banner->position }}</td>
                                            <td>
                                                <span class="badge bg-{{ $banner->is_active ? 'success' : 'danger' }}">
                                                    {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $banner->sort_order }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('banner.show', $banner->id) }}" class="btn btn-sm btn-info me-1">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-sm btn-primary me-1">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No banners found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<style>
    .media-preview-cell {
        width: 120px;
    }
    
    .image-thumbnail, .video-thumbnail {
        position: relative;
        width: 100px;
        height: 60px;
        overflow: hidden;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .image-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: none;
    }
    
    .video-thumbnail video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .media-badge {
        position: absolute;
        top: 3px;
        right: 3px;
        font-size: 10px;
        padding: 2px 4px;
        border-radius: 3px;
        color: white;
    }
    
    .image-badge {
        background-color: rgba(23, 162, 184, 0.8);
    }
    
    .video-badge {
        background-color: rgba(220, 53, 69, 0.8);
    }
</style>
@endsection 