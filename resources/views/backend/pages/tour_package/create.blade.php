<!-- filepath: /home/sarbada/Desktop/travel-agency/resources/views/backend/pages/tour_package/create.blade.php -->
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
                                    <h2><i class="bi bi-plus-circle"></i> Add Tour Package
                                        <a href="{{route('manage-tour-package.index')}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Tour Packages</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>
                            
                            <form action="{{route('manage-tour-package.store')}}" method="post" enctype="multipart/form-data" id="tourPackageForm">
                                @csrf
                                
                                <!-- Tab Navigation -->
                                <ul class="nav nav-tabs mb-3" id="packageTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="basics-tab" data-bs-toggle="tab" data-bs-target="#basics" type="button" role="tab">
                                            Basic Info
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">
                                            Package Details
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="attributes-tab" data-bs-toggle="tab" data-bs-target="#attributes" type="button" role="tab">
                                            Attributes
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary" type="button" role="tab">
                                            Itinerary
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="inclusions-tab" data-bs-toggle="tab" data-bs-target="#inclusions" type="button" role="tab">
                                            Inclusions/Exclusions
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab">
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
                                                <div class="card mb-4">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Basic Information</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="name">Name: <span class="text-danger">*</span>
                                                                    <a style="color: red;">{{$errors->first('name')}}</a>
                                                                </label>
                                                                <input type="text" name="name" id="name" value="{{old('name')}}"
                                                                       class="form-control" placeholder="Enter package name" required>
                                                            </div>
                                                            
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="slug">Slug: <span class="text-danger">*</span>
                                                                    <a style="color: red;">{{$errors->first('slug')}}</a>
                                                                </label>
                                                                <input type="text" name="slug" id="slug" value="{{old('slug')}}"
                                                                       class="form-control" placeholder="Enter package slug" required>
                                                            </div>
                                                            
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="short_description">Short Description:
                                                                    <a style="color: red;">{{$errors->first('short_description')}}</a>
                                                                </label>
                                                                <textarea name="short_description" id="short_description" class="form-control"
                                                                          rows="3">{{old('short_description')}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card mb-4">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Categories & Destinations</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label>Categories: <span class="text-danger">*</span>
                                                                    <a style="color: red;">{{$errors->first('categories')}}</a>
                                                                </label>
                                                                <div class="p-3 border rounded categories-container" style="max-height: 200px; overflow-y: auto;">
                                                                    @foreach($categories as $category)
                                                                        <div class="form-check">
                                                                            <input class="form-check-input category-checkbox" type="checkbox" name="categories[]"
                                                                                   id="category_{{$category->id}}" value="{{$category->id}}"
                                                                                   {{is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : ''}}>
                                                                            <label class="form-check-label" for="category_{{$category->id}}">
                                                                                {{$category->name}}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <small class="text-muted mt-2 d-block">Select categories to determine which fields will be shown.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Right column -->
                                            <div class="col-md-4">
                                                <div class="card mb-4">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Destinations</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="p-3 border rounded destinations-container" style="max-height: 200px; overflow-y: auto;">
                                                            @foreach($destinations as $destination)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="destinations[]"
                                                                           id="destination_{{$destination->id}}" value="{{$destination->id}}"
                                                                           {{is_array(old('destinations')) && in_array($destination->id, old('destinations')) ? 'checked' : ''}}>
                                                                    <label class="form-check-label" for="destination_{{$destination->id}}">
                                                                        {{$destination->name}}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="card mb-4">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Status & Visibility</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="status">Status:</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="draft" {{old('status', 'draft') == 'draft' ? 'selected' : ''}}>Draft</option>
                                                                    <option value="active" {{old('status') == 'active' ? 'selected' : ''}}>Active</option>
                                                                    <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="is_featured"
                                                                           id="is_featured" {{old('is_featured') ? 'checked' : ''}}>
                                                                    <label class="form-check-label" for="is_featured">
                                                                        Featured
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="is_popular"
                                                                           id="is_popular" {{old('is_popular') ? 'checked' : ''}}>
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
                                                <div class="card mb-4">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Package Details</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label for="duration_days">Duration (Days): <span class="text-danger">*</span>
                                                                    <a style="color: red;">{{$errors->first('duration_days')}}</a>
                                                                </label>
                                                                <input type="number" name="duration_days" id="duration_days" min="1"
                                                                       value="{{old('duration_days', 1)}}" class="form-control" required>
                                                            </div>
                                                            
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label for="group_size">Group Size:</label>
                                                                <input type="number" name="group_size" id="group_size" min="1"
                                                                       value="{{old('group_size')}}" class="form-control">
                                                            </div>
                                                            
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label for="difficulty_level">Difficulty Level:</label>
                                                                <select name="difficulty_level" id="difficulty_level" class="form-control">
                                                                    <option value="">Select Difficulty</option>
                                                                    <option value="Easy" {{old('difficulty_level') == 'Easy' ? 'selected' : ''}}>Easy</option>
                                                                    <option value="Moderate" {{old('difficulty_level') == 'Moderate' ? 'selected' : ''}}>Moderate</option>
                                                                    <option value="Challenging" {{old('difficulty_level') == 'Challenging' ? 'selected' : ''}}>Challenging</option>
                                                                    <option value="Difficult" {{old('difficulty_level') == 'Difficult' ? 'selected' : ''}}>Difficult</option>
                                                                    <option value="Extreme" {{old('difficulty_level') == 'Extreme' ? 'selected' : ''}}>Extreme</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="description">Full Description:</label>
                                                                <textarea name="description" id="description" class="form-control ckeditor"
                                                                          rows="6">{{old('description')}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Category-specific fields will be loaded here via AJAX -->
                                                <div id="category-specific-fields">
                                                    <div class="alert alert-info">
                                                        <i class="bi bi-info-circle"></i> Select categories in the previous tab to see related fields.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <!-- Pricing -->
                                                <div class="card mb-4">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Pricing</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-4 form-group">
                                                                <label for="currency">Currency:</label>
                                                                <select name="currency" id="currency" class="form-control">
                                                                    <option value="USD" {{old('currency', 'USD') == 'USD' ? 'selected' : ''}}>USD</option>
                                                                    <option value="EUR" {{old('currency') == 'EUR' ? 'selected' : ''}}>EUR</option>
                                                                    <option value="GBP" {{old('currency') == 'GBP' ? 'selected' : ''}}>GBP</option>
                                                                    <option value="NPR" {{old('currency') == 'NPR' ? 'selected' : ''}}>NPR</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="mb-3 col-md-8 form-group">
                                                                <label for="regular_price">Regular Price: <span class="text-danger">*</span>
                                                                    <a style="color: red;">{{$errors->first('regular_price')}}</a>
                                                                </label>
                                                                <input type="number" step="0.01" min="0" name="regular_price" id="regular_price"
                                                                       value="{{old('regular_price')}}" class="form-control" required>
                                                            </div>
                                                            
                                                            <div class="mb-3 col-md-12 form-group">
                                                                <label for="sale_price">Sale Price (optional):</label>
                                                                <input type="number" step="0.01" min="0" name="sale_price" id="sale_price"
                                                                       value="{{old('sale_price')}}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-grid gap-2">
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
                                                <div class="card mb-4">
                                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                        <h5 class="mb-0">Package Attributes</h5>
                                                        <button type="button" class="btn btn-sm btn-success" id="add-new-attribute">
                                                            <i class="bi bi-plus-circle"></i> Add New Attribute
                                                        </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="alert alert-info" id="attribute-info">
                                                            <i class="bi bi-info-circle"></i> Select categories in the first tab to see suggested attributes, or add custom attributes below.
                                                        </div>
                                                        
                                                        <!-- Attribute Container -->
                                                        <div id="attribute-container">
                                                            <!-- Existing or category-based attributes will load here -->
                                                        </div>
                                                        
                                                        <!-- Add New Attribute Modal -->
                                                        <div class="modal fade" id="attributeModal" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Add Attribute</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="attribute-search">Search Existing Attributes:</label>
                                                                            <input type="text" id="attribute-search" class="form-control" placeholder="Type to search...">
                                                                            <div id="attribute-search-results" class="mt-2"></div>
                                                                        </div>
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="new-attribute-name">Or Create New Attribute:</label>
                                                                            <input type="text" id="new-attribute-name" class="form-control" placeholder="Attribute name">
                                                                        </div>
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="new-attribute-group">Attribute Group:</label>
                                                                            <select id="new-attribute-group" class="form-control">
                                                                                @foreach($attributeGroups as $group)
                                                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="new-attribute-type">Type:</label>
                                                                            <select id="new-attribute-type" class="form-control">
                                                                                <option value="text">Text</option>
                                                                                <option value="rich_text">Rich Text</option>
                                                                                <option value="number">Number</option>
                                                                                <option value="boolean">Yes/No</option>
                                                                                <option value="date">Date</option>
                                                                                <option value="array">List</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="button" class="btn btn-primary" id="add-attribute-btn">Add Attribute</button>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                        Continue to Itinerary <i class="bi bi-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- STEP 4: Itinerary -->
                                    <div class="tab-pane fade" id="itinerary" role="tabpanel">
                                        <div class="card mb-4">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">Itinerary</h5>
                                                <button type="button" class="btn btn-sm btn-success" id="add-itinerary-day">
                                                    <i class="bi bi-plus-circle"></i> Add Day
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <div id="itinerary-container">
                                                    <div class="itinerary-day mb-3 p-3 border rounded">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label>Day #</label>
                                                                <input type="number" name="itinerary[0][day]" class="form-control" value="1" min="1">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <label>Title</label>
                                                                <input type="text" name="itinerary[0][title]" class="form-control" placeholder="Day title">
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <label>Description</label>
                                                                <textarea name="itinerary[0][description]" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab">
                                                <i class="bi bi-arrow-left"></i> Back to Attributes
                                            </button>
                                            <button type="button" class="btn btn-primary next-tab">
                                                Continue to Inclusions/Exclusions <i class="bi bi-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- STEP 5: Inclusions/Exclusions -->
                                    <div class="tab-pane fade" id="inclusions" role="tabpanel">
                                        <div class="card mb-4">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Inclusions & Exclusions</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Inclusions</label>
                                                        <div class="inclusion-container">
                                                            <div class="input-group mb-2">
                                                                <input type="text" name="inclusions[]" class="form-control" placeholder="Add inclusion item">
                                                                <button type="button" class="btn btn-success add-inclusion">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Exclusions</label>
                                                        <div class="exclusion-container">
                                                            <div class="input-group mb-2">
                                                                <input type="text" name="exclusions[]" class="form-control" placeholder="Add exclusion item">
                                                                <button type="button" class="btn btn-success add-exclusion">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Activities -->
                                        <div class="card mb-4">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Activities</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Activity</th>
                                                                <th width="120">Optional</th>
                                                                <th width="150">Additional Cost</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($activities as $activity)
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input activity-checkbox" type="checkbox" name="activities[]"
                                                                                   id="activity_{{$activity->id}}" value="{{$activity->id}}"
                                                                                   {{is_array(old('activities')) && in_array($activity->id, old('activities')) ? 'checked' : ''}}>
                                                                            <label class="form-check-label" for="activity_{{$activity->id}}">
                                                                                {{$activity->name}}
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="activity_optional[{{$activity->id}}]"
                                                                                   id="optional_{{$activity->id}}" value="1"
                                                                                   {{old('activity_optional.'.$activity->id) ? 'checked' : ''}}>
                                                                            <label class="form-check-label" for="optional_{{$activity->id}}">
                                                                                Optional
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" step="0.01" min="0" class="form-control"
                                                                               name="activity_cost[{{$activity->id}}]"
                                                                               value="{{old('activity_cost.'.$activity->id, 0)}}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab">
                                                <i class="bi bi-arrow-left"></i> Back to Itinerary
                                            </button>
                                            <button type="button" class="btn btn-primary next-tab">
                                                Continue to Media <i class="bi bi-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- STEP 6: Media -->
                                    <div class="tab-pane fade" id="media" role="tabpanel">
                                        <div class="card mb-4">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Images</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="mb-4 col-md-12 form-group">
                                                        <label for="featured_image">Featured Image: <span class="text-danger">*</span>
                                                            <a style="color: red;">{{$errors->first('featured_image')}}</a>
                                                        </label>
                                                        <input type="file" name="featured_image" id="featured_image" class="form-control">
                                                        <div id="featured-image-preview" class="mt-2"></div>
                                                    </div>
                                                    
                                                    <div class="mb-3 col-md-12 form-group">
                                                        <label for="gallery_images">Gallery Images:</label>
                                                        <input type="file" name="gallery_images[]" id="gallery_images" 
                                                               class="form-control" multiple>
                                                        <div id="gallery-images-preview" class="mt-2 row"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab">
                                                <i class="bi bi-arrow-left"></i> Back to Inclusions
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check-circle"></i> Save Tour Package
                                            </button>
                                        </div>
                                    </div>
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
            $('.ckeditor').each(function() {
                CKEDITOR.replace($(this).attr('id'), {
                    filebrowserUploadUrl: "{{route('ckeditor-image-upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form'
                });
            });
        }
        
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
                    url: '{{ route("get-category-fields") }}',
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
                        $('#category-specific-fields').html('<div class="alert alert-danger">Error loading category fields</div>');
                    }
                });
            } else {
                $('#category-specific-fields').html('<div class="alert alert-info"><i class="bi bi-info-circle"></i> Select categories to see related fields.</div>');
            }
        }
        
        function loadCategoryAttributes(categories) {
            $.ajax({
                url: '{{ route("get-category-attributes") }}',
                type: 'POST',
                data: {
                    categories: categories,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.attributes.length > 0) {
                        let html = '<div class="alert alert-info">Common attributes for selected categories:</div>';
                        $('#attribute-container').html(html + response.html);
                        $('#attribute-info').hide();
                    } else {
                        $('#attribute-info').show();
                    }
                }
            });
        }
        
        // DYNAMIC ATTRIBUTES
        // Open attribute modal
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
                        url: '{{ route("search-attributes") }}',
                        type: 'GET',
                        data: { q: query },
                        success: function(response) {
                            if (response.attributes.length > 0) {
                                let html = '<div class="list-group">';
                                response.attributes.forEach(function(attr) {
                                    html += `<a href="#" class="list-group-item list-group-item-action select-attribute" data-id="${attr.id}" data-name="${attr.name}">${attr.name} (${attr.group_name})</a>`;
                                });
                                html += '</div>';
                                $('#attribute-search-results').html(html);
                            } else {
                                $('#attribute-search-results').html('<p class="text-muted">No attributes found. Create a new one.</p>');
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
                url: '{{ route("create-attribute") }}',
                type: 'POST',
                data: {
                    name: name,
                    attribute_group_id: groupId,
                    type: type,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Add the new attribute to the form
                    addAttributeToForm(response.attribute.id, response.attribute.name, type);
                    
                    // Close the modal and reset fields
                    $('#attributeModal').modal('hide');
                    $('#new-attribute-name').val('');
                },
                error: function(xhr) {
                    alert('Error creating attribute: ' + xhr.responseJSON.message);
                }
            });
        });
        
        function addAttributeToForm(id, name, type) {
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
            switch(type) {
                case 'text':
                    inputHtml = `<input type="text" name="attribute_${id}" class="form-control">`;
                    break;
                case 'rich_text':
                    inputHtml = `<textarea name="attribute_${id}" class="form-control" rows="3"></textarea>`;
                    break;
                case 'boolean':
                    inputHtml = `
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="attribute_${id}" id="attr_${id}" value="1">
                            <label class="form-check-label" for="attr_${id}">Yes</label>
                        </div>
                    `;
                    break;
                case 'number':
                    inputHtml = `<input type="number" name="attribute_${id}" class="form-control">`;
                    break;
                case 'date':
                    inputHtml = `<input type="date" name="attribute_${id}" class="form-control">`;
                    break;
                case 'array':
                    inputHtml = `
                        <div class="attribute-array-container">
                            <div class="input-group mb-2">
                                <input type="text" name="attribute_${id}[]" class="form-control" placeholder="Enter value">
                                <button type="button" class="btn btn-success add-array-item">+</button>
                            </div>
                        </div>
                    `;
                    break;
                default:
                    inputHtml = `<input type="text" name="attribute_${id}" class="form-control">`;
            }
            
            // Create the attribute field wrapper
            const attributeField = `
                <div class="mb-3 p-3 border rounded attribute-field" data-id="${id}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
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
        }
        
        // Remove attribute
        $(document).on('click', '.remove-attribute', function() {
            $(this).closest('.attribute-field').remove();
        });
        
        // ITINERARY
        // Add itinerary day
        $('#add-itinerary-day').on('click', function() {
            const dayCount = $('.itinerary-day').length;
            const newDay = `
                <div class="itinerary-day mb-3 p-3 border rounded">
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" class="btn btn-sm btn-danger remove-itinerary-day">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Day #</label>
                            <input type="number" name="itinerary[${dayCount}][day]" class="form-control" value="${dayCount + 1}" min="1">
                        </div>
                        <div class="col-md-10">
                            <label>Title</label>
                            <input type="text" name="itinerary[${dayCount}][title]" class="form-control" placeholder="Day title">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label>Description</label>
                            <textarea name="itinerary[${dayCount}][description]" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            `;
            $('#itinerary-container').append(newDay);
        });
        
        // Remove itinerary day
        $(document).on('click', '.remove-itinerary-day', function() {
            $(this).closest('.itinerary-day').remove();
        });
        
        // INCLUSIONS & EXCLUSIONS
        // Add inclusion
        $('.add-inclusion').on('click', function() {
            $('.inclusion-container').append(`
                <div class="input-group mb-2">
                    <input type="text" name="inclusions[]" class="form-control" placeholder="Add inclusion item">
                    <button type="button" class="btn btn-danger remove-item">-</button>
                </div>
            `);
        });
        
        // Add exclusion
        $('.add-exclusion').on('click', function() {
            $('.exclusion-container').append(`
                <div class="input-group mb-2">
                    <input type="text" name="exclusions[]" class="form-control" placeholder="Add exclusion item">
                    <button type="button" class="btn btn-danger remove-item">-</button>
                </div>
            `);
        });
        
        // Remove inclusion/exclusion item
        $(document).on('click', '.remove-item', function() {
            $(this).closest('.input-group').remove();
        });
        
        // Add array item
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

        // Remove array item
        $(document).on('click', '.remove-array-item', function() {
            $(this).closest('.input-group').remove();
        });
        
        // IMAGE PREVIEW
        $('#featured_image').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#featured-image-preview').html(`
                        <img src="${e.target.result}" class="img-thumbnail" style="max-height: 200px">
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
                        <div class="col-md-3 mb-2">
                            <img src="${e.target.result}" class="img-thumbnail" style="height: 150px; object-fit: cover;">
                        </div>
                    `);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection