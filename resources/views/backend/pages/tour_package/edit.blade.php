@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="py-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="bi bi-pencil"></i> Edit Tour Package: {{ $tourPackage->name }}
                                        <a href="{{ route('manage-tour-package.index') }}"
                                            class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Tour Packages</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>

                            <form action="{{ route('manage-tour-package.update', $tourPackage->id) }}" method="post"
                                enctype="multipart/form-data" id="tourPackageForm">
                                @csrf
                                @method('PUT')

                                <!-- Tab Navigation -->
                                <ul class="mb-3 nav nav-tabs" id="packageTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="basics-tab" data-bs-toggle="tab"
                                            data-bs-target="#basics" type="button" role="tab">
                                            Basic Info
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                            data-bs-target="#details" type="button" role="tab">
                                            Package Details
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="attributes-tab" data-bs-toggle="tab"
                                            data-bs-target="#attributes" type="button" role="tab">
                                            Attributes
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media"
                                            type="button" role="tab">
                                            Media
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="packageTabContent">
                                    <!-- STEP 1: Basic Info & Categories -->
                                    <div class="tab-pane fade show active" id="basics" role="tabpanel">
                                        <div class="row">
                                            <!-- Left column -->
                                            <div class="col-md-8">
                                                <div class="mb-4 card">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Basic Information</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="name">Name: <span
                                                                        class="text-danger">*</span>
                                                                    <a style="color: red;">{{ $errors->first('name') }}</a>
                                                                </label>
                                                                <input type="text" name="name" id="name"
                                                                    value="{{ old('name', $tourPackage->name) }}"
                                                                    class="form-control" placeholder="Enter package name"
                                                                    required>
                                                            </div>

                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="slug">Slug: <span
                                                                        class="text-danger">*</span>
                                                                    <a style="color: red;">{{ $errors->first('slug') }}</a>
                                                                </label>
                                                                <input type="text" name="slug" id="slug"
                                                                    value="{{ old('slug', $tourPackage->slug) }}"
                                                                    class="form-control" placeholder="Enter package slug"
                                                                    required>
                                                            </div>

                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="short_description">Short Description:
                                                                    <a
                                                                        style="color: red;">{{ $errors->first('short_description') }}</a>
                                                                </label>
                                                                <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description', $tourPackage->short_description) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4 card">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Categories & Destinations</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label>Categories: <span class="text-danger">*</span>
                                                                    <a
                                                                        style="color: red;">{{ $errors->first('categories') }}</a>
                                                                </label>
                                                                <div class="p-3 border rounded categories-container"
                                                                    style="max-height: 200px; overflow-y: auto;">
                                                                    @foreach ($categories as $category)
                                                                        <div class="form-check">
                                                                            <input
                                                                                class="form-check-input category-checkbox"
                                                                                type="checkbox" name="categories[]"
                                                                                id="category_{{ $category->id }}"
                                                                                value="{{ $category->id }}"
                                                                                {{ in_array($category->id, old('categories', $tourPackage->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="category_{{ $category->id }}">
                                                                                {{ $category->name }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <small class="mt-2 text-muted d-block">Select categories to
                                                                    determine which fields will be shown.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Right column -->
                                            <div class="col-md-4">
                                                <!-- In edit.blade.php -->
                                                <div class="mb-4 card">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Destinations</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="p-3 border rounded destinations-container"
                                                            style="max-height: 200px; overflow-y: auto;">
                                                            <div class="mb-3">
                                                                <label>Select destinations for this package:</label>
                                                                <div class="mt-2">
                                                                    @foreach ($destinations as $destination)
                                                                        <div class="form-check">
                                                                            <input type="checkbox" name="destinations[]"
                                                                                value="{{ $destination->id }}"
                                                                                class="form-check-input destination-checkbox"
                                                                                id="destination_{{ $destination->id }}"
                                                                                @if (isset($tourPackage) && $tourPackage->destinations->contains($destination->id)) checked @endif>
                                                                            <label class="form-check-label"
                                                                                for="destination_{{ $destination->id }}">
                                                                                {{ $destination->name }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4 card">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Status & Visibility</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="status">Status:</label>
                                                                <select name="status" id="status"
                                                                    class="form-control">
                                                                    <option value="draft"
                                                                        {{ old('status', $tourPackage->status) == 'draft' ? 'selected' : '' }}>
                                                                        Draft</option>
                                                                    <option value="active"
                                                                        {{ old('status', $tourPackage->status) == 'active' ? 'selected' : '' }}>
                                                                        Active</option>
                                                                    <option value="inactive"
                                                                        {{ old('status', $tourPackage->status) == 'inactive' ? 'selected' : '' }}>
                                                                        Inactive</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3 col-md-6 form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="is_featured" id="is_featured"
                                                                        {{ old('is_featured', $tourPackage->is_featured) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="is_featured">
                                                                        Featured
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 col-md-6 form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="is_popular" id="is_popular"
                                                                        {{ old('is_popular', $tourPackage->is_popular) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="is_popular">
                                                                        Popular
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-primary next-tab">
                                                        Continue to Package Details <i class="bi bi-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- STEP 2: Package Details -->
                                    <div class="tab-pane fade" id="details" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-4 card">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Package Details</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label for="duration_days">Duration (Days): <span
                                                                        class="text-danger">*</span>
                                                                    <a
                                                                        style="color: red;">{{ $errors->first('duration_days') }}</a>
                                                                </label>
                                                                <input type="number" name="duration_days"
                                                                    id="duration_days" min="1"
                                                                    value="{{ old('duration_days', $tourPackage->duration_days) }}"
                                                                    class="form-control" required>
                                                            </div>

                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label for="group_size">Group Size:</label>
                                                                <input type="number" name="group_size" id="group_size"
                                                                    min="1"
                                                                    value="{{ old('group_size', $tourPackage->group_size) }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label for="difficulty_level">Difficulty Level:</label>
                                                                <select name="difficulty_level" id="difficulty_level"
                                                                    class="form-control">
                                                                    <option value="">Select Difficulty</option>
                                                                    <option value="Easy"
                                                                        {{ old('difficulty_level', $tourPackage->difficulty_level) == 'Easy' ? 'selected' : '' }}>
                                                                        Easy</option>
                                                                    <option value="Moderate"
                                                                        {{ old('difficulty_level', $tourPackage->difficulty_level) == 'Moderate' ? 'selected' : '' }}>
                                                                        Moderate</option>
                                                                    <option value="Challenging"
                                                                        {{ old('difficulty_level', $tourPackage->difficulty_level) == 'Challenging' ? 'selected' : '' }}>
                                                                        Challenging</option>
                                                                    <option value="Difficult"
                                                                        {{ old('difficulty_level', $tourPackage->difficulty_level) == 'Difficult' ? 'selected' : '' }}>
                                                                        Difficult</option>
                                                                    <option value="Extreme"
                                                                        {{ old('difficulty_level', $tourPackage->difficulty_level) == 'Extreme' ? 'selected' : '' }}>
                                                                        Extreme</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="description">Full Description:</label>
                                                                <textarea name="description" id="description" class="form-control ckeditor" rows="6">{{ old('description', $tourPackage->description) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- Pricing -->
                                                <div class="mb-4 card">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Pricing</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-4 form-group">
                                                                <label for="currency">Currency:</label>
                                                                <select name="currency" id="currency"
                                                                    class="form-control">
                                                                    <option value="USD"
                                                                        {{ old('currency', $tourPackage->currency ?? 'USD') == 'USD' ? 'selected' : '' }}>
                                                                        USD</option>
                                                                    <option value="EUR"
                                                                        {{ old('currency', $tourPackage->currency) == 'EUR' ? 'selected' : '' }}>
                                                                        EUR</option>
                                                                    <option value="GBP"
                                                                        {{ old('currency', $tourPackage->currency) == 'GBP' ? 'selected' : '' }}>
                                                                        GBP</option>
                                                                    <option value="NPR"
                                                                        {{ old('currency', $tourPackage->currency) == 'NPR' ? 'selected' : '' }}>
                                                                        NPR</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3 col-md-8 form-group">
                                                                <label for="regular_price">Regular Price: <span
                                                                        class="text-danger">*</span>
                                                                    <a
                                                                        style="color: red;">{{ $errors->first('regular_price') }}</a>
                                                                </label>
                                                                <input type="number" step="0.01" min="0"
                                                                    name="regular_price" id="regular_price"
                                                                    value="{{ old('regular_price', $tourPackage->regular_price) }}"
                                                                    class="form-control" required>
                                                            </div>

                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="sale_price">Sale Price (optional):</label>
                                                                <input type="number" step="0.01" min="0"
                                                                    name="sale_price" id="sale_price"
                                                                    value="{{ old('sale_price', $tourPackage->sale_price) }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="gap-2 d-grid">
                                                    <button type="button" class="btn btn-secondary prev-tab">
                                                        <i class="bi bi-arrow-left"></i> Back to Basics
                                                    </button>
                                                    <button type="button" class="btn btn-primary next-tab">
                                                        Continue to Attributes <i class="bi bi-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- STEP 3: Dynamic Attributes -->
                                    <div class="tab-pane fade" id="attributes" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-4 card">
                                                    <div
                                                        class="card-header bg-light d-flex justify-content-between align-items-center">
                                                        <h5 class="mb-0">Package Attributes</h5>
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            id="add-new-attribute">
                                                            <i class="bi bi-plus-circle"></i> Add New Attribute
                                                        </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="alert alert-info" id="attribute-info">
                                                            <i class="bi bi-info-circle"></i> Select categories in the
                                                            first tab to see suggested attributes, or add custom attributes
                                                            below.
                                                        </div>

                                                        <!-- Attribute Container -->
                                                        <div id="attribute-container">
                                                            <!-- Existing attributes will load here via JavaScript -->
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn btn-secondary prev-tab">
                                                        <i class="bi bi-arrow-left"></i> Back to Details
                                                    </button>
                                                    <button type="button" class="btn btn-primary next-tab">
                                                        Continue to Media <i class="bi bi-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- STEP 6: Media -->
                                    <div class="tab-pane fade" id="media" role="tabpanel">
                                        <div class="mb-4 card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Images</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="mb-4 col-md-12 form-group">
                                                        <label for="featured_image">Featured Image:
                                                            <a
                                                                style="color: red;">{{ $errors->first('featured_image') }}</a>
                                                        </label>
                                                        <input type="file" name="featured_image" id="featured_image"
                                                            class="form-control">
                                                        <div id="featured-image-preview" class="mt-2">
                                                            @if ($tourPackage->featured_image)
                                                                <img src="{{ asset($tourPackage->featured_image) }}"
                                                                    class="img-thumbnail" style="max-height: 200px">
                                                                <p class="text-muted">Current image will be used unless you
                                                                    upload a new one</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                  

<div class="mb-3 col-md-12 form-group">
    <label for="gallery_images">Gallery Images:</label>
    <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" multiple>
    <div id="gallery-images-preview" class="mt-2 row">
        @php
            // Properly handle gallery images regardless of type
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
            }
        @endphp

        @foreach ($gallery as $image)
            <div class="mb-2 col-md-3">
                <img src="{{ asset($image) }}" class="img-thumbnail" alt="Gallery image"
                    style="height: 150px; object-fit: cover;">
            </div>
        @endforeach
        
        @if (count($gallery) > 0)
            <p class="text-muted col-12">Current gallery will be replaced if you upload new images</p>
        @endif
    </div>
</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab">
                                                <i class="bi bi-arrow-left"></i> Back to Attributes
                                            </button>

                                        </div>
                                    </div>

                                    <button type="submit" class="mt-5 btn btn-success">
                                        <i class="bi bi-check-circle"></i> Update Tour Package
                                    </button>
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
        $(document).ready(function() {
            // Tab navigation
            $('.next-tab').on('click', function() {
                // Find the currently active tab
                const activeTab = $('#packageTabs .nav-link.active');
                // Get the next tab
                const nextTab = activeTab.parent().next().find('.nav-link');
                if (nextTab.length) {
                    nextTab.tab('show');
                }
            });

            $('.prev-tab').on('click', function() {
                // Find the currently active tab
                const activeTab = $('#packageTabs .nav-link.active');
                // Get the previous tab
                const prevTab = activeTab.parent().prev().find('.nav-link');
                if (prevTab.length) {
                    prevTab.tab('show');
                }
            });

            // Generate slug from name
            $('#name').on('keyup', function() {
                const name = $(this).val();
                const slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $('#slug').val(slug);
            });

            // Initialize CKEditor
            if (typeof CKEDITOR !== 'undefined') {
                // Destroy existing instances first to avoid conflicts
                for (var instanceName in CKEDITOR.instances) {
                    CKEDITOR.instances[instanceName].destroy();
                }

                // Initialize each CKEditor instance
                $('.ckeditor').each(function() {
                    CKEDITOR.replace($(this).attr('id'), {
                        height: 300,
                        filebrowserUploadUrl: "{{ route('ckeditor-image-upload', ['_token' => csrf_token()]) }}",
                        filebrowserUploadMethod: 'form'
                    });
                });
            }

            // Load the existing attributes on page load
            loadExistingAttributes();
            $(document).on('click', '.add-array-item', function() {
                var container = $(this).closest('.attribute-array-container');
                var newItem = `
        <div class="mb-2 input-group">
            <input type="text" name="${container.find('input').first().attr('name')}" 
                   class="form-control" placeholder="Enter value">
            <button type="button" class="btn btn-danger remove-array-item">-</button>
        </div>
        `;
                container.append(newItem);
            });

            $(document).on('click', '.remove-array-item', function() {
                $(this).closest('.input-group').remove();
            });

            // Remove attribute
            $(document).on('click', '.remove-attribute', function() {
                $(this).closest('.attribute-field').remove();
            });
            // CATEGORY-DRIVEN FIELDS
            // When categories are selected, load specific fields via AJAX
            $('.category-checkbox').on('change', function() {
                loadCategoryFields();
            });

            function loadCategoryFields() {
                const selectedCategories = [];
                $('.category-checkbox:checked').each(function() {
                    selectedCategories.push($(this).val());
                });

                if (selectedCategories.length > 0) {
                    // AJAX call to get category-specific fields
                    $.ajax({
                        url: '{{ route('get-category-fields') }}',
                        type: 'POST',
                        data: {
                            categories: selectedCategories,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#category-specific-fields').html(response.html);

                            // Load attributes based on categories
                            loadCategoryAttributes(selectedCategories);
                        },
                        error: function() {
                            $('#category-specific-fields').html(
                                '<div class="alert alert-danger">Error loading category fields</div>'
                            );
                        }
                    });
                } else {
                    $('#category-specific-fields').html(
                        '<div class="alert alert-info"><i class="bi bi-info-circle"></i> Select categories to see related fields.</div>'
                    );
                }
            }

            function loadExistingAttributes() {
                $.ajax({
                    url: '{{ route('get-package-attributes', $tourPackage->id) }}',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);

                        if (response.attributes && response.attributes.length > 0) {
                            $('#attribute-container').html(response.html);
                            $('#attribute-info').hide();

                            // Update the attributes tab badge with count
                            const attrCount = response.attributes.length;
                            $('#attributes-tab').html(
                                `Attributes <span class="badge bg-primary">${attrCount}</span>`);
                        }
                    }
                });
            }

            function loadCategoryAttributes(categories) {
                $.ajax({
                    url: '{{ route('get-category-attributes') }}',
                    type: 'POST',
                    data: {
                        categories: categories,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.attributes.length > 0) {
                            $('#attribute-container').html(response.html);
                            $('#attribute-info').hide();

                            // Add this to update the attributes tab badge with count
                            const attrCount = response.attributes.length;
                            $('#attributes-tab').html(
                                `Attributes <span class="badge bg-primary">${attrCount}</span>`);
                        } else {
                            $('#attribute-info').show();
                            $('#attribute-container').html(
                                '<div class="alert alert-info">No attributes found for selected categories. Add custom attributes or select different categories.</div>'
                            );
                            $('#attributes-tab').html('Attributes');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error loading attributes:', xhr);
                        $('#attribute-container').html(
                            '<div class="alert alert-danger">Error loading attributes: ' + xhr
                            .responseText + '</div>');
                    }
                });
            }

            $('#packageTabs a[href="#attributes"]').on('shown.bs.tab', function(e) {
                // Reload attributes when tab is shown
                const selectedCategories = [];
                $('.category-checkbox:checked').each(function() {
                    selectedCategories.push($(this).val());
                });

                if (selectedCategories.length > 0 && $('#attribute-container').children().length === 0) {
                    loadCategoryAttributes(selectedCategories);
                }
            });

            // IMAGE PREVIEW
            $('#featured_image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#featured-image-preview').html(`
                        <img src="${e.target.result}" class="img-thumbnail" style="max-height: 200px">
                        <p class="text-muted">New image will replace the current one</p>
                    `);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#gallery_images').on('change', function() {
                const files = this.files;
                $('#gallery-images-preview').html('');

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#gallery-images-preview').append(`
                        <div class="mb-2 col-md-3">
                            <img src="${e.target.result}" class="img-thumbnail" style="height: 150px; object-fit: cover;">
                        </div>
                    `);
                    }
                    reader.readAsDataURL(file);
                }

                if (files.length > 0) {
                    $('#gallery-images-preview').append(
                        '<p class="text-muted col-12">These images will replace all current gallery images</p>'
                    );
                }
            });
            $('#add-new-attribute').on('click', function() {
                $('#attributeModal').modal('show');
            });

            // Search attributes as you type
            let searchTimeout;
            $('#attribute-search').on('keyup', function() {
                clearTimeout(searchTimeout);
                const query = $(this).val();

                if (query.length >= 2) {
                    searchTimeout = setTimeout(function() {
                        $.ajax({
                            url: '{{ route('search-attributes') }}',
                            type: 'GET',
                            data: {
                                q: query
                            },
                            success: function(response) {
                                if (response.attributes.length > 0) {
                                    let html = '<div class="list-group">';
                                    response.attributes.forEach(function(attr) {
                                        html +=
                                            `<a href="#" class="list-group-item list-group-item-action select-attribute" data-id="${attr.id}" data-name="${attr.name}">${attr.name} (${attr.group_name})</a>`;
                                    });
                                    html += '</div>';
                                    $('#attribute-search-results').html(html);
                                } else {
                                    $('#attribute-search-results').html(
                                        '<p class="text-muted">No attributes found. Create a new one.</p>'
                                    );
                                }
                            }
                        });
                    }, 300);
                }
            });

            // Select an existing attribute
            $(document).on('click', '.select-attribute', function(e) {
                e.preventDefault();
                const attrId = $(this).data('id');
                const attrName = $(this).data('name');

                // Add the selected attribute to the form
                addAttributeToForm(attrId, attrName);

                // Close the modal
                $('#attributeModal').modal('hide');
            });

            // Add a new attribute
            $('#add-attribute-btn').on('click', function() {
                const name = $('#new-attribute-name').val();
                const groupId = $('#new-attribute-group').val();
                const type = $('#new-attribute-type').val();

                if (name.trim() === '') {
                    alert('Attribute name is required');
                    return;
                }

                // Create new attribute via AJAX
                $.ajax({
                    url: '{{ route('create-attribute') }}',
                    type: 'POST',
                    data: {
                        name: name,
                        attribute_group_id: groupId,
                        type: type,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Add the new attribute to the form
                        addAttributeToForm(response.attribute.id, response.attribute.name,
                            type);

                        // Close the modal and reset fields
                        $('#attributeModal').modal('hide');
                        $('#new-attribute-name').val('');
                    },
                    error: function(xhr) {
                        alert('Error creating attribute: ' + xhr.responseJSON.message);
                    }
                });
            });

    

                function addAttributeToForm(id, name, type, value = null) {
                    let inputHtml;

                    if (!type) {
                        // Fetch attribute info if type isn't provided
                        $.ajax({
                            url: `{{ url('/get-attribute-info') }}/${id}`,
                            type: 'GET',
                            async: false,
                            success: function(response) {
                                type = response.attribute.type;
                            }
                        });
                    }

                    // Based on attribute type, create appropriate input field
                    switch (type) {
                        case 'text':
                            inputHtml =
                                `<input type="text" name="attribute_${id}" class="form-control" value="${value || ''}">`;
                            break;
                        case 'rich_text':
                            inputHtml =
                                `<textarea name="attribute_${id}" class="form-control" rows="3">${value || ''}</textarea>`;
                            break;
                        case 'boolean':
                            inputHtml = `
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="attribute_${id}" id="attr_${id}" value="1" ${value ? 'checked' : ''}>
                <label class="form-check-label" for="attr_${id}">Yes</label>
            </div>
            `;
                            break;
                        case 'number':
                            inputHtml =
                                `<input type="number" name="attribute_${id}" class="form-control" value="${value || ''}">`;
                            break;
                        case 'date':
                            inputHtml =
                                `<input type="date" name="attribute_${id}" class="form-control" value="${value || ''}">`;
                            break;
                        case 'json':
                            // Format JSON value for display if it exists
                            let formattedJson = '';
                            if (value) {
                                try {
                                    // If value is already an object, stringify it with indentation
                                    if (typeof value === 'object') {
                                        formattedJson = JSON.stringify(value, null, 2);
                                    } else {
                                        // If value is a string, parse and then stringify with indentation
                                        formattedJson = JSON.stringify(JSON.parse(value), null, 2);
                                    }
                                } catch (e) {
                                    // If parsing fails, use as is
                                    formattedJson = value;
                                }
                            }

                            inputHtml = `
            <textarea name="attribute_${id}" class="form-control json-editor" rows="5" 
                      placeholder="Enter valid JSON data">${formattedJson}</textarea>
            <small class="form-text text-muted">Enter valid JSON data (e.g., {"key": "value"})</small>
            `;
                            break;
                        case 'array':
                            inputHtml = `
            <div class="attribute-array-container">
                <!-- Add existing array items if there are any -->
                ${generateArrayItems(id, value)}
            </div>
            `;
                            break;
                        default:
                            inputHtml =
                                `<input type="text" name="attribute_${id}" class="form-control" value="${value || ''}">`;
                    }

                    // Create the attribute field wrapper
                    const attributeField = `
    <div class="p-3 mb-3 border rounded attribute-field" data-id="${id}">
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <label for="attribute_${id}">${name}</label>
            <button type="button" class="btn btn-sm btn-danger remove-attribute">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        ${inputHtml}
    </div>
    `;

                    // Add to the container
                    $('#attribute-container').append(attributeField);

                    // Initialize any special behaviors for JSON fields
                    $('.json-editor').on('blur', function() {
                        try {
                            const jsonValue = $(this).val();
                            if (jsonValue.trim()) {
                                // Try to parse and format the JSON
                                const formattedJson = JSON.stringify(JSON.parse(jsonValue), null, 2);
                                $(this).val(formattedJson);
                                $(this).removeClass('is-invalid');
                            }
                        } catch (e) {
                            // Invalid JSON
                            $(this).addClass('is-invalid');
                        }
                    });
                }

            // Helper function to generate array item inputs
            function generateArrayItems(attributeId, values) {
                let html = '';

                if (values && Array.isArray(values) && values.length > 0) {
                    // Add existing values
                    values.forEach(value => {
                        html += `
            <div class="mb-2 input-group">
                <input type="text" name="attribute_${attributeId}[]" class="form-control" 
                       value="${value}" placeholder="Enter value">
                <button type="button" class="btn btn-danger remove-array-item">-</button>
            </div>
            `;
                    });
                } else {
                    // Add one empty input
                    html += `
        <div class="mb-2 input-group">
            <input type="text" name="attribute_${attributeId}[]" class="form-control" placeholder="Enter value">
            <button type="button" class="btn btn-success add-array-item">+</button>
        </div>
        `;
                }

                return html;
            }
            $('#tourPackageForm').on('submit', function() {
                // Ensure empty array attributes have at least one empty value
                $('.attribute-array-container').each(function() {
                    if ($(this).find('input').length === 0) {
                        // If no inputs exist, add an empty one that will be filtered out server-side
                        const name = $(this).closest('.attribute-field').data('id');
                        $(this).append(`<input type="hidden" name="attribute_${name}[]" value="">`);
                    }
                });

                return true;
            });
        });
    </script>
@endsection
