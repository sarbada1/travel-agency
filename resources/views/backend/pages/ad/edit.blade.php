@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-pencil-square"></i> Edit Ad
                                <a href="{{ route('manage-ad.index') }}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-arrow-left"></i> Back to Ads
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('backend.layouts.message')
                        <hr>
                    </div>

                    <ul class="nav nav-tabs" id="adTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                                type="button" role="tab" aria-controls="basic" aria-selected="true">
                                Basic Information
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                                type="button" role="tab" aria-controls="content" aria-selected="false">
                                Ad Content
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule"
                                type="button" role="tab" aria-controls="schedule" aria-selected="false">
                                Schedule
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats"
                                type="button" role="tab" aria-controls="stats" aria-selected="false">
                                Statistics
                            </button>
                        </li>
                    </ul>

                    <form action="{{ route('manage-ad.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content" id="adTabsContent">
                            <!-- Basic Information Tab -->
                            <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                                <div class="pt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="ad_set_id" class="form-label">Ad Set <span class="text-danger">*</span></label>
                                            <select class="form-select @error('ad_set_id') is-invalid @enderror" 
                                                id="ad_set_id" name="ad_set_id" required>
                                                <option value="">Select Ad Set</option>
                                                @foreach($adSets as $adSet)
                                                    <option value="{{ $adSet->id }}" {{ old('ad_set_id', $ad->ad_set_id) == $adSet->id ? 'selected' : '' }}>
                                                        {{ $adSet->name }}
                                                        @if($adSet->campaign)
                                                            <small>(Campaign: {{ $adSet->campaign->name }})</small>
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ad_set_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Ad Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                id="name" name="name" value="{{ old('name', $ad->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="type" class="form-label">Ad Type <span class="text-danger">*</span></label>
                                            <select class="form-select @error('type') is-invalid @enderror" 
                                                id="type" name="type" required>
                                                <option value="">Select Type</option>
                                                <option value="image" {{ old('type', $ad->type) == 'image' ? 'selected' : '' }}>Image Banner</option>
                                                <option value="html" {{ old('type', $ad->type) == 'html' ? 'selected' : '' }}>HTML Content</option>
                                                <option value="script" {{ old('type', $ad->type) == 'script' ? 'selected' : '' }}>Script/Embed Code</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="is_active" class="form-label">Status</label>
                                            <select class="form-select @error('is_active') is-invalid @enderror" 
                                                id="is_active" name="is_active">
                                                <option value="1" {{ old('is_active', $ad->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('is_active', $ad->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('is_active')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Tab -->
                            <div class="tab-pane fade" id="content" role="tabpanel" aria-labelledby="content-tab">
                                <div class="pt-3">
                                    <!-- Image Type Fields -->
                                    <div id="image-fields" class="content-type-fields">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                @if($ad->image_path)
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Image</label>
                                                        <div>
                                                            <img src="{{ url($ad->image_path) }}" alt="{{ $ad->image_alt }}" class="img-thumbnail" style="max-height: 150px;">
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                <label for="image" class="form-label">Update Banner Image</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                    id="image" name="image" accept="image/*">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Recommended size: 728×90px, 300×250px, or 320×100px</small>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="image_alt" class="form-label">Image Alt Text</label>
                                                <input type="text" class="form-control @error('image_alt') is-invalid @enderror" 
                                                    id="image_alt" name="image_alt" value="{{ old('image_alt', $ad->image_alt) }}">
                                                @error('image_alt')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="url" class="form-label">Destination URL</label>
                                                <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                                    id="url" name="url" value="{{ old('url', $ad->url) }}">
                                                @error('url')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        id="open_in_new_tab" name="open_in_new_tab" value="1" 
                                                        {{ old('open_in_new_tab', $ad->open_in_new_tab) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="open_in_new_tab">
                                                        Open link in new tab
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- HTML Type Fields -->
                                    <div id="html-fields" class="content-type-fields" style="display: none;">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="html_content" class="form-label">HTML Content <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('html_content') is-invalid @enderror" 
                                                    id="html_content" name="html_content" rows="10">{{ old('html_content', $ad->html_content) }}</textarea>
                                                @error('html_content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Enter your HTML code here. You can include images, text, links, etc.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Script Type Fields -->
                                    <div id="script-fields" class="content-type-fields" style="display: none;">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="script_content" class="form-label">Script/Embed Code <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('html_content') is-invalid @enderror" 
                                                    id="script_content" name="html_content" rows="10">{{ old('html_content', $ad->html_content) }}</textarea>
                                                @error('html_content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Enter JavaScript, iframe or third-party ad network code here.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Tab -->
                            <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                                <div class="pt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                                id="start_date" name="start_date" 
                                                value="{{ old('start_date', $ad->start_date ? $ad->start_date->format('Y-m-d') : '') }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Leave blank to start immediately</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                                id="end_date" name="end_date" 
                                                value="{{ old('end_date', $ad->end_date ? $ad->end_date->format('Y-m-d') : '') }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Leave blank for no end date</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics Tab -->
                            <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                                <div class="pt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">Impressions</h5>
                                                    <h2 class="card-text text-primary">{{ $ad->impressions }}</h2>
                                                    <p class="text-muted">Number of times this ad was viewed</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">Clicks</h5>
                                                    <h2 class="card-text text-success">{{ $ad->clicks }}</h2>
                                                    <p class="text-muted">Number of times this ad was clicked</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">Click-Through Rate (CTR)</h5>
                                                    <h2 class="card-text text-info">
                                                        {{ $ad->impressions > 0 ? number_format(($ad->clicks / $ad->impressions) * 100, 2) : 0 }}%
                                                    </h2>
                                                    <p class="text-muted">Percentage of impressions that resulted in clicks</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Update Ad
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            // Handle ad type selection
            $('#type').change(function() {
                const selectedType = $(this).val();
                // Hide all content type fields
                $('.content-type-fields').hide();
                
                // Show the selected type fields
                if (selectedType === 'image') {
                    $('#image-fields').show();
                } else if (selectedType === 'html') {
                    $('#html-fields').show();
                } else if (selectedType === 'script') {
                    $('#script-fields').show();
                }
            });
            
            // Trigger change on page load to initialize the view
            $('#type').trigger('change');
        });
    </script>
@endsection