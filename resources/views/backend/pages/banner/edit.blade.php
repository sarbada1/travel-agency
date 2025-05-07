@extends('backend.master.main')

@section('title', 'Edit Banner')

@section('styles')
<style> 
    /* Radio button styling */
    .media-type-selector {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .radio-card {
        flex: 1;
        position: relative;
        cursor: pointer;
    }
    
    .radio-card input[type="radio"] {
        position: absolute;
        opacity: 0;
    }
    
    .radio-card label {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s;
        height: 100%;
    }
    
    .radio-card input[type="radio"]:checked + label {
        background: #e9f7fe;
        border-color: #0087F7;
        box-shadow: 0 0 10px rgba(0, 135, 247, 0.15);
    }
    
    .radio-card input[type="radio"]:focus + label {
        outline: 2px solid #0087F7;
    }
    
    .radio-card i {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: #6c757d;
        transition: color 0.3s;
    }
    
    .radio-card input[type="radio"]:checked + label i {
        color: #0087F7;
    }
    
    .radio-card-content {
        text-align: center;
    }
    
    /* Enhanced file upload area */
    .file-upload-area {
        border: 2px dashed #0087F7;
        border-radius: 8px;
        background-color: #f8f9fa;
        padding: 40px 20px;
        text-align: center;
        transition: all 0.3s;
        position: relative;
    }
    
    .file-upload-area.highlight {
        background-color: #e9f7fe;
        border-color: #0087F7;
    }
    
    .file-upload-icon {
        font-size: 3.5rem;
        color: #0087F7;
        margin-bottom: 15px;
    }
    
    .file-upload-text {
        margin-bottom: 20px;
        font-size: 1.1rem;
        color: #495057;
    }
    
    .file-upload-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #0087F7;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s;
    }
    
    .file-upload-btn:hover {
        background-color: #0069d9;
    }
    
    .file-input {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        cursor: pointer;
    }
    
    .file-preview {
        margin-top: 25px;
    }
    
    .file-preview img,
    .file-preview video {
        max-height: 200px;
        max-width: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .file-info {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
        padding: 10px;
        background: #e9f7fe;
        border-radius: 5px;
    }
    
    .file-info i {
        margin-right: 10px;
        font-size: 1.2rem;
    }
    
    /* Current media styling */
    .current-media-container {
        margin-bottom: 25px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .current-media-header {
        background-color: #f8f9fa;
        padding: 12px 15px;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
    }
    
    .current-media-content {
        padding: 20px;
        text-align: center;
    }
    
    .current-media-preview {
        margin-bottom: 15px;
    }
    
    .current-media-preview img,
    .current-media-preview video {
        max-height: 250px;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .current-media-info {
        display: inline-block;
        padding: 8px 12px;
        background-color: #e9f7fe;
        border-radius: 4px;
        font-size: 0.9rem;
        color: #495057;
    }
    
    .current-media-info i {
        margin-right: 6px;
        color: #0087F7;
    }
</style>
@endsection

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Banners</a></li>
                <li class="breadcrumb-item active">Edit Banner</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Banner Information</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Basic Banner Info Fields -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $banner->title) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                        <select name="position" id="position" class="form-control" required>
                                            <option value="">Select Position</option>
                                            @foreach($positions as $key => $value)
                                                <option value="{{ $key }}" {{ old('position', $banner->position) == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $banner->description) }}</textarea>
                                <small class="text-muted">Optional: Additional text to display on the banner</small>
                            </div>

                            <!-- Button Fields -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="button_text" class="form-label">Button Text</label>
                                        <input type="text" name="button_text" id="button_text" class="form-control" value="{{ old('button_text', $banner->button_text) }}">
                                        <small class="text-muted">Optional: Call-to-action button text</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="button_url" class="form-label">Button URL</label>
                                        <input type="text" name="button_url" id="button_url" class="form-control" value="{{ old('button_url', $banner->button_url) }}">
                                        <small class="text-muted">Optional: Where the button should link to</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Media Type Radio Buttons -->
                            <div class="form-group mb-4">
                                <label class="form-label d-block mb-3">Media Type <span class="text-danger">*</span></label>
                                
                                <div class="media-type-selector">
                                    <div class="radio-card">
                                        <input type="radio" id="media-type-image" name="media_type" value="image" {{ old('media_type', $banner->media_type ?? 'image') == 'image' ? 'checked' : '' }}>
                                        <label for="media-type-image">
                                            <i class="bi bi-image"></i>
                                            <div class="radio-card-content">
                                                <h6>Image</h6>
                                                <p class="text-muted small">JPG, PNG, GIF</p>
                                            </div>
                                        </label>
                                    </div>
                                    
                                    <div class="radio-card">
                                        <input type="radio" id="media-type-video" name="media_type" value="video" {{ old('media_type', $banner->media_type) == 'video' ? 'checked' : '' }}>
                                        <label for="media-type-video">
                                            <i class="bi bi-film"></i>
                                            <div class="radio-card-content">
                                                <h6>Video</h6>
                                                <p class="text-muted small">MP4, WebM</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Current Media Section -->
                            @if(($banner->media_type == 'image' && $banner->image) || ($banner->media_type == 'video' && $banner->video))
                                <div class="current-media-container mb-4">
                                    <div class="current-media-header">
                                        Current {{ ucfirst($banner->media_type ?? 'Image') }}
                                    </div>
                                    <div class="current-media-content">
                                        <div class="current-media-preview">
                                            @if(($banner->media_type ?? 'image') == 'image' && $banner->image)
                                                <img src="{{ asset($banner->image) }}" alt="Current Banner">
                                            @elseif(($banner->media_type ?? 'image') == 'video' && $banner->video)
                                                <video controls>
                                                    <source src="{{ asset($banner->video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                        <div class="current-media-info">
                                            <i class="bi bi-{{ ($banner->media_type ?? 'image') == 'image' ? 'image' : 'film' }}"></i>
                                            <span>{{ ($banner->media_type ?? 'image') == 'image' ? basename($banner->image) : basename($banner->video) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Image Upload Area -->
                            <div id="image-upload-container" class="mb-4 {{ old('media_type', $banner->media_type) == 'video' ? 'd-none' : '' }}">
                                <label class="form-label">Upload New Banner Image</label>
                                <div class="file-upload-area" id="image-drop-area">
                                    <div class="file-upload-icon">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </div>
                                    <div class="file-upload-text">
                                        Drag & drop your image here or
                                    </div>
                                    <div class="file-upload-btn">
                                        <i class="bi bi-upload me-2"></i> Browse Files
                                    </div>
                                    <input type="file" class="file-input" name="image" id="image-input" accept="image/*">
                                    <div class="file-preview" id="image-preview"></div>
                                </div>
                                <small class="text-muted d-block mt-2">Recommended size: 1920x600 pixels (16:5 ratio). Max size: 5MB</small>
                            </div>

                            <!-- Video Upload Area -->
                            <div id="video-upload-container" class="mb-4 {{ old('media_type', $banner->media_type ?? 'image') == 'image' ? 'd-none' : '' }}">
                                <label class="form-label">Upload New Banner Video</label>
                                <div class="file-upload-area" id="video-drop-area">
                                    <div class="file-upload-icon">
                                        <i class="bi bi-film"></i>
                                    </div>
                                    <div class="file-upload-text">
                                        Drag & drop your video here or
                                    </div>
                                    <div class="file-upload-btn">
                                        <i class="bi bi-upload me-2"></i> Browse Files
                                    </div>
                                    <input type="file" class="file-input" name="video" id="video-input" accept="video/mp4,video/webm">
                                    <div class="file-preview" id="video-preview"></div>
                                </div>
                                <small class="text-muted d-block mt-2">Supported formats: MP4, WebM. Maximum size: 20MB.</small>
                            </div>

                            <!-- Status and Sorting Fields -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sort_order" class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order) }}">
                                        <small class="text-muted">Lower numbers appear first</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mt-4">
                                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                                        <label for="is_active" class="form-check-label">Active</label>
                                        <small class="d-block text-muted">Uncheck to hide this banner</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Buttons -->
                            <div class="text-end">
                                <a href="{{ route('banner.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Banner</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Media Type Toggle
        const mediaTypeRadios = document.querySelectorAll('input[name="media_type"]');
        const imageContainer = document.getElementById('image-upload-container');
        const videoContainer = document.getElementById('video-upload-container');
        
        mediaTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'image') {
                    imageContainer.classList.remove('d-none');
                    videoContainer.classList.add('d-none');
                } else {
                    imageContainer.classList.add('d-none');
                    videoContainer.classList.remove('d-none');
                }
            });
        });
        
        // Image Upload Handling
        const imageDropArea = document.getElementById('image-drop-area');
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            imageDropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });
        
        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            imageDropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            imageDropArea.addEventListener(eventName, unhighlight, false);
        });
        
        // Handle dropped files
        imageDropArea.addEventListener('drop', handleImageDrop, false);
        
        // Handle browse files
        imageInput.addEventListener('change', handleImageSelect, false);
        
        // Video Upload Handling
        const videoDropArea = document.getElementById('video-drop-area');
        const videoInput = document.getElementById('video-input');
        const videoPreview = document.getElementById('video-preview');
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            videoDropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            videoDropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            videoDropArea.addEventListener(eventName, unhighlight, false);
        });
        
        // Handle dropped files
        videoDropArea.addEventListener('drop', handleVideoDrop, false);
        
        // Handle browse files
        videoInput.addEventListener('change', handleVideoSelect, false);
        
        // Helper functions
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        function highlight(e) {
            this.classList.add('highlight');
        }
        
        function unhighlight(e) {
            this.classList.remove('highlight');
        }
        
        function handleImageDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                imageInput.files = files;
                updateImagePreview(files[0]);
            }
        }
        
        function handleImageSelect(e) {
            const files = e.target.files;
            
            if (files.length) {
                updateImagePreview(files[0]);
            }
        }
        
        function updateImagePreview(file) {
            // Check if the file is an image
            if (!file.type.match('image.*')) {
                alert('Please select an image file');
                return;
            }
            
            // Check file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size exceeds 5MB limit');
                return;
            }
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <div class="file-info">
                        <i class="bi bi-file-earmark-image"></i>
                        <span>${file.name} (${formatFileSize(file.size)})</span>
                    </div>
                `;
            };
            
            reader.readAsDataURL(file);
        }
        
        function handleVideoDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                videoInput.files = files;
                updateVideoPreview(files[0]);
            }
        }
        
        function handleVideoSelect(e) {
            const files = e.target.files;
            
            if (files.length) {
                updateVideoPreview(files[0]);
            }
        }
        
        function updateVideoPreview(file) {
            // Check if the file is a video
            if (!file.type.match('video.*')) {
                alert('Please select a video file');
                return;
            }
            
            // Check file size (20MB max)
            if (file.size > 20 * 1024 * 1024) {
                alert('File size exceeds 20MB limit');
                return;
            }
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                videoPreview.innerHTML = `
                    <video controls>
                        <source src="${e.target.result}" type="${file.type}">
                        Your browser does not support the video tag.
                    </video>
                    <div class="file-info">
                        <i class="bi bi-file-earmark-play"></i>
                        <span>${file.name} (${formatFileSize(file.size)})</span>
                    </div>
                `;
            };
            
            reader.readAsDataURL(file);
        }
        
        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' bytes';
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            else return (bytes / 1048576).toFixed(1) + ' MB';
        }
    });
</script>
@endsection