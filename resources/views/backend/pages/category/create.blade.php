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
                                    <h2><i class="bi bi-plus-circle"></i> Add Category
                                        <a href="{{ route('manage-category.index') }}"
                                            class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Categories</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{ route('manage-category.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="name">Name:
                                                    <a style="color: red;">{{ $errors->first('name') }}</a>
                                                </label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="slug">Slug:
                                                    <a style="color: red;">{{ $errors->first('slug') }}</a>
                                                </label>
                                                <input type="text" id="slug" name="slug" class="form-control"
                                                    value="{{ old('slug') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="parent_id">Parent Category:
                                                    <a style="color: red;">{{ $errors->first('parent_id') }}</a>
                                                </label>
                                                <select name="parent_id" class="form-control" id="parent_id">
                                                    <option value="">Select Parent Category (optional)</option>
                                                    @foreach ($parents as $parent)
                                                        <option value="{{ $parent->id }}"
                                                            {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                                            {{ $parent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="page_type">Page Type:
                                                    <a style="color: red;">{{ $errors->first('page_type') }}</a>
                                                </label>
                                                <select name="page_type" class="form-control" id="page_type">
                                                    <option value="">Select Page Type</option>
                                                    <option value="tour_package"
                                                        {{ old('page_type') == 'tour_package' ? 'selected' : '' }}>
                                                        Tour Package
                                                    </option>
                                                    <option value="destination"
                                                        {{ old('page_type') == 'destination' ? 'selected' : '' }}>
                                                        Destination
                                                    </option>
                                                    <option value="activity"
                                                        {{ old('page_type') == 'activity' ? 'selected' : '' }}>
                                                        Activity
                                                    </option>
                                                    <option value="travel-guide"
                                                        {{ old('page_type') == 'travel-guide' ? 'selected' : '' }}>
                                                        Travel Guide
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="icon">Icon (FontAwesome Class):
                                                    <a style="color: red;">{{ $errors->first('icon') }}</a>
                                                </label>
                                                <input type="text" id="icon" name="icon" class="form-control"
                                                    value="{{ old('icon') }}" placeholder="fa-map-marker">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="image">Image:
                                                    <a style="color: red;">{{ $errors->first('image') }}</a>
                                                </label>
                                                <input type="file" id="image" name="image" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="is_main"
                                                        name="is_main" value="1"
                                                        {{ old('is_main') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_main">
                                                        Is Main Category
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="status"
                                                        name="status" value="1"
                                                        {{ old('status') ? 'checked' : 'checked' }}>
                                                    <label class="form-check-label" for="status">
                                                        Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label for="description">Description:
                                            <a style="color: red;">{{ $errors->first('description') }}</a>
                                        </label>
                                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>

                                    <!-- Add this right before the final button -->
                                    <div class="mb-4 card">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Category Attributes</h5>
                                            <p class="mb-0 text-muted small">Select attributes that will be associated with
                                                this category</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="40">Select</th>
                                                            <th>Attribute</th>
                                                            <th>Group</th>
                                                            <th width="100">Required</th>
                                                            <th width="100">Filterable</th>
                                                            <th width="80">Order</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($availableAttributes as $attribute)
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input attribute-checkbox"
                                                                            type="checkbox" name="attribute_ids[]"
                                                                            id="attr_{{ $attribute->id }}"
                                                                            value="{{ $attribute->id }}">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <label class="form-check-label"
                                                                        for="attr_{{ $attribute->id }}">
                                                                        <strong>{{ $attribute->name }}</strong>
                                                                        <span
                                                                            class="text-white badge bg-info ms-1">{{ $attribute->type }}</span>
                                                                    </label>
                                                                    @if ($attribute->description)
                                                                        <p class="mb-0 text-muted small">
                                                                            {{ $attribute->description }}</p>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $attribute->attributeGroup->name ?? 'N/A' }}
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="is_required[{{ $attribute->id }}]"
                                                                            id="required_{{ $attribute->id }}"
                                                                            value="1">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="is_filterable[{{ $attribute->id }}]"
                                                                            id="filterable_{{ $attribute->id }}"
                                                                            value="1">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="number"
                                                                        class="form-control form-control-sm"
                                                                        name="display_order[{{ $attribute->id }}]"
                                                                        value="0" min="0">
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center">
                                                                    No attributes available. <a
                                                                        href="{{ route('manage-package-attribute.create') }}">Create
                                                                        some attributes</a> first.
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-success w-100">
                                            <i class="bi bi-plus-circle"></i> Add Category
                                        </button>
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
    @parent
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

            // Auto-generate slug from name
            $('#name').on('keyup', function() {
                var name = $(this).val();
                var slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $('#slug').val(slug);
            });

            // Initially disable inputs for unchecked attributes
            updateAttributeInputStates();

            // When attribute checkboxes change
            $('.attribute-checkbox').on('change', function() {
                updateAttributeInputStates();
            });

            function updateAttributeInputStates() {
                $('.attribute-checkbox').each(function() {
                    var attrId = $(this).val();
                    var isChecked = $(this).is(':checked');

                    // Toggle required, filterable, and order inputs
                    $('#required_' + attrId).prop('disabled', !isChecked);
                    $('#filterable_' + attrId).prop('disabled', !isChecked);
                    $('input[name="display_order[' + attrId + ']"]').prop('disabled', !isChecked);

                    // Apply visual feedback
                    var row = $(this).closest('tr');
                    if (isChecked) {
                        row.addClass('table-active');
                    } else {
                        row.removeClass('table-active');
                    }
                });
            }
        });
    </script>
@endsection
