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
                            <div class="row">
                                <form action="{{route('manage-tour-package.store')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Basic Package Information -->
                                            <div class="mb-4 card">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Basic Information</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="name">Name:
                                                                <a style="color: red;">{{$errors->first('name')}}</a>
                                                            </label>
                                                            <input type="text" name="name" id="name" value="{{old('name')}}"
                                                                   class="form-control" placeholder="Enter package name">
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="slug">Slug:
                                                                <a style="color: red;">{{$errors->first('slug')}}</a>
                                                            </label>
                                                            <input type="text" name="slug" id="slug" value="{{old('slug')}}"
                                                                   class="form-control" placeholder="Enter package slug">
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="short_description">Short Description:
                                                                <a style="color: red;">{{$errors->first('short_description')}}</a>
                                                            </label>
                                                            <textarea name="short_description" id="short_description" class="form-control"
                                                                      rows="3">{{old('short_description')}}</textarea>
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="description">Full Description:
                                                                <a style="color: red;">{{$errors->first('description')}}</a>
                                                            </label>
                                                            <textarea name="description" id="description" class="form-control ckeditor"
                                                                      rows="6">{{old('description')}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Categories and Destinations -->
                                            <div class="mb-4 card">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Categories & Destinations</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6 form-group">
                                                            <label>Categories:
                                                                <a style="color: red;">{{$errors->first('categories')}}</a>
                                                            </label>
                                                            <div class="p-3 border rounded categories-container" style="max-height: 200px; overflow-y: auto;">
                                                                @foreach($categories as $category)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                                                               id="category_{{$category->id}}" value="{{$category->id}}"
                                                                               {{is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="category_{{$category->id}}">
                                                                            {{$category->name}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-6 form-group">
                                                            <label>Destinations:
                                                                <a style="color: red;">{{$errors->first('destinations')}}</a>
                                                            </label>
                                                            <div class="p-3 border rounded destinations-container" style="max-height: 200px; overflow-y: auto;">
                                                                @foreach($destinations as $destination)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="destinations[]"
                                                                               id="destination_{{$destination->id}}" value="{{$destination->id}}"
                                                                               {{is_array(old('destinations')) && in_array($destination->id, old('destinations')) ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="destination_{{$destination->id}}">
                                                                            {{$destination->name}} ({{$destination->country}})
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Activities -->
                                            <div class="mb-4 card">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Activities</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
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
                                                </div>
                                            </div>
                                            
                                            <!-- Dynamic Attributes -->
                                            @foreach($attributeGroups as $group)
                                                @if(count($group->attributes) > 0)
                                                    <div class="mb-4 card">
                                                        <div class="card-header bg-light">
                                                            <h5 class="mb-0">{{$group->name}}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @foreach($group->attributes as $attribute)
                                                                    <div class="mb-3 {{$attribute->type == 'rich_text' ? 'col-md-12' : 'col-md-6'}} form-group">
                                                                        <label for="attribute_{{$attribute->id}}">
                                                                            {{$attribute->name}}:
                                                                            @if($attribute->is_required)
                                                                                <span class="text-danger">*</span>
                                                                            @endif
                                                                            <a style="color: red;">{{$errors->first('attribute_'.$attribute->id)}}</a>
                                                                        </label>
                                                                        
                                                                        @if($attribute->type == 'text')
                                                                            <input type="text" name="attribute_{{$attribute->id}}" 
                                                                                   id="attribute_{{$attribute->id}}" class="form-control"
                                                                                   value="{{old('attribute_'.$attribute->id, $attribute->default_value)}}">
                                                                        @elseif($attribute->type == 'rich_text')
                                                                            <textarea name="attribute_{{$attribute->id}}" 
                                                                                      id="attribute_{{$attribute->id}}" 
                                                                                      class="form-control ckeditor" rows="4">{{old('attribute_'.$attribute->id, $attribute->default_value)}}</textarea>
                                                                        @elseif($attribute->type == 'array')
                                                                            <div class="attribute-array-container">
                                                                                <div class="mb-2 input-group">
                                                                                    <input type="text" name="attribute_{{$attribute->id}}[]" 
                                                                                           class="form-control" placeholder="Enter value">
                                                                                    <button type="button" class="btn btn-success add-array-item">+</button>
                                                                                </div>
                                                                            </div>
                                                                        @elseif($attribute->type == 'boolean')
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" 
                                                                                       name="attribute_{{$attribute->id}}" 
                                                                                       id="attribute_{{$attribute->id}}" value="1"
                                                                                       {{old('attribute_'.$attribute->id, $attribute->default_value) ? 'checked' : ''}}>
                                                                                <label class="form-check-label" for="attribute_{{$attribute->id}}">
                                                                                    Yes
                                                                                </label>
                                                                            </div>
                                                                        @elseif($attribute->type == 'number')
                                                                            <input type="number" name="attribute_{{$attribute->id}}" 
                                                                                   id="attribute_{{$attribute->id}}" class="form-control"
                                                                                   value="{{old('attribute_'.$attribute->id, $attribute->default_value)}}">
                                                                        @elseif($attribute->type == 'date')
                                                                            <input type="date" name="attribute_{{$attribute->id}}" 
                                                                                   id="attribute_{{$attribute->id}}" class="form-control"
                                                                                   value="{{old('attribute_'.$attribute->id, $attribute->default_value)}}">
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <!-- Package Details -->
                                            <div class="mb-4 card">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Package Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6 form-group">
                                                            <label for="duration_days">Duration (Days):
                                                                <a style="color: red;">{{$errors->first('duration_days')}}</a>
                                                            </label>
                                                            <input type="number" name="duration_days" id="duration_days" min="1"
                                                                   value="{{old('duration_days', 1)}}" class="form-control">
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-6 form-group">
                                                            <label for="group_size">Group Size:
                                                                <a style="color: red;">{{$errors->first('group_size')}}</a>
                                                            </label>
                                                            <input type="number" name="group_size" id="group_size" min="1"
                                                                   value="{{old('group_size')}}" class="form-control">
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="difficulty_level">Difficulty Level:
                                                                <a style="color: red;">{{$errors->first('difficulty_level')}}</a>
                                                            </label>
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
                                                </div>
                                            </div>
                                            
                                            <!-- Pricing -->
                                            <div class="mb-4 card">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Pricing</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4 form-group">
                                                            <label for="currency">Currency:
                                                                <a style="color: red;">{{$errors->first('currency')}}</a>
                                                            </label>
                                                            <select name="currency" id="currency" class="form-control">
                                                                <option value="USD" {{old('currency') == 'USD' ? 'selected' : ''}}>USD</option>
                                                                <option value="EUR" {{old('currency') == 'EUR' ? 'selected' : ''}}>EUR</option>
                                                                <option value="GBP" {{old('currency') == 'GBP' ? 'selected' : ''}}>GBP</option>
                                                                <option value="NPR" {{old('currency') == 'NPR' ? 'selected' : ''}}>NPR</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-8 form-group">
                                                            <label for="regular_price">Regular Price:
                                                                <a style="color: red;">{{$errors->first('regular_price')}}</a>
                                                            </label>
                                                            <input type="number" step="0.01" min="0" name="regular_price" id="regular_price"
                                                                   value="{{old('regular_price')}}" class="form-control">
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="sale_price">Sale Price (optional):
                                                                <a style="color: red;">{{$errors->first('sale_price')}}</a>
                                                            </label>
                                                            <input type="number" step="0.01" min="0" name="sale_price" id="sale_price"
                                                                   value="{{old('sale_price')}}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Images -->
                                            <div class="mb-4 card">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Images</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="featured_image">Featured Image:
                                                                <a style="color: red;">{{$errors->first('featured_image')}}</a>
                                                            </label>
                                                            <input type="file" name="featured_image" id="featured_image" class="form-control">
                                                        </div>
                                                        
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="gallery_images">Gallery Images:
                                                                <a style="color: red;">{{$errors->first('gallery_images')}}</a>
                                                            </label>
                                                            <input type="file" name="gallery_images[]" id="gallery_images" 
                                                                   class="form-control" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Status -->
                                            <div class="mb-4 card">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Status & Visibility</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label for="status">Status:
                                                                <a style="color: red;">{{$errors->first('status')}}</a>
                                                            </label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="active" {{old('status') == 'active' ? 'selected' : ''}}>Active</option>
                                                                <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                                                <option value="draft" {{old('status') == 'draft' ? 'selected' : ''}}>Draft</option>
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
                                            
                                            <div class="mb-3 col-md-12 form-group">
                                                <button class="btn btn-primary w-100">
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
            </div>
        </section>
    </main>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Generate slug from name
        $('#name').on('keyup', function() {
            var name = $(this).val();
            var slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
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

        // Add array item button
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

        // Remove array item button
        $(document).on('click', '.remove-array-item', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>
@endsection