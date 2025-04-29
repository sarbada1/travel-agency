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
                                    <h2><i class="bi bi-plus-circle"></i> Add Package Attribute
                                        <a href="{{route('manage-package-attribute.index')}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Package Attributes</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('manage-package-attribute.store')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6 form-group">
                                            <label for="name">Name:
                                                <a style="color: red;">{{$errors->first('name')}}</a>
                                            </label>
                                            <input type="text" name="name" id="name" value="{{old('name')}}"
                                                   class="form-control" placeholder="Enter attribute name">
                                        </div>

                                        <div class="mb-3 col-md-6 form-group">
                                            <label for="slug">Slug:
                                                <a style="color: red;">{{$errors->first('slug')}}</a>
                                            </label>
                                            <input type="text" name="slug" id="slug" value="{{old('slug')}}"
                                                   class="form-control" placeholder="Enter attribute slug">
                                        </div>

                                        <div class="mb-3 col-md-6 form-group">
                                            <label for="attribute_group_id">Attribute Group:
                                                <a style="color: red;">{{$errors->first('attribute_group_id')}}</a>
                                            </label>
                                            <select name="attribute_group_id" id="attribute_group_id" class="form-control">
                                                <option value="">Select Attribute Group</option>
                                                @foreach($attributeGroups as $group)
                                                    <option value="{{$group->id}}" {{old('attribute_group_id') == $group->id ? 'selected' : ''}}>
                                                        {{$group->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-6 form-group">
                                            <label for="type">Type:
                                                <a style="color: red;">{{$errors->first('type')}}</a>
                                            </label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="">Select Attribute Type</option>
                                                <option value="text" {{old('type') == 'text' ? 'selected' : ''}}>Text</option>
                                                <option value="rich_text" {{old('type') == 'rich_text' ? 'selected' : ''}}>Rich Text</option>
                                                <option value="array" {{old('type') == 'array' ? 'selected' : ''}}>Array</option>
                                                <option value="json" {{old('type') == 'json' ? 'selected' : ''}}>JSON</option>
                                                <option value="boolean" {{old('type') == 'boolean' ? 'selected' : ''}}>Boolean</option>
                                                <option value="number" {{old('type') == 'number' ? 'selected' : ''}}>Number</option>
                                                <option value="date" {{old('type') == 'date' ? 'selected' : ''}}>Date</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-12 form-group">
                                            <label for="description">Description:
                                                <a style="color: red;">{{$errors->first('description')}}</a>
                                            </label>
                                            <textarea name="description" id="description" class="form-control"
                                                      rows="3" placeholder="Enter attribute description">{{old('description')}}</textarea>
                                        </div>

                                        <div class="mb-3 col-md-6 form-group">
                                            <label for="display_order">Display Order:
                                                <a style="color: red;">{{$errors->first('display_order')}}</a>
                                            </label>
                                            <input type="number" name="display_order" id="display_order" 
                                                   value="{{old('display_order', 0)}}" class="form-control">
                                        </div>

                                        <div class="mb-3 col-md-6 form-group">
                                            <label for="default_value">Default Value:
                                                <a style="color: red;">{{$errors->first('default_value')}}</a>
                                            </label>
                                            <input type="text" name="default_value" id="default_value"
                                                   value="{{old('default_value')}}" class="form-control">
                                        </div>

                                        <div class="mb-3 col-md-4 form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_required"
                                                       id="is_required" {{old('is_required') ? 'checked' : ''}}>
                                                <label class="form-check-label" for="is_required">
                                                    Is Required
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-4 form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_filterable"
                                                       id="is_filterable" {{old('is_filterable') ? 'checked' : ''}}>
                                                <label class="form-check-label" for="is_filterable">
                                                    Is Filterable
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-4 form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="active"
                                                       id="active" {{old('active') ? 'checked' : 'checked'}}>
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-12 form-group">
                                            <div id="options_container" style="display: none;">
                                                <label for="options">Options (for select, multiple, etc):
                                                    <a style="color: red;">{{$errors->first('options')}}</a>
                                                </label>
                                                <div class="options-list">
                                                    <div class="mb-2 input-group">
                                                        <input type="text" name="options[]" class="form-control" placeholder="Option value">
                                                        <button type="button" class="btn btn-success add-option">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-12 form-group">
                                            <button class="btn btn-primary">
                                                <i class="bi bi-check-circle"></i> Save
                                            </button>
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

        // Show/hide options based on type
        $('#type').on('change', function() {
            var type = $(this).val();
            if (type === 'array' || type === 'json') {
                $('#options_container').show();
            } else {
                $('#options_container').hide();
            }
        });

        // Add option button
        $('.add-option').on('click', function() {
            var newOption = `
                <div class="mb-2 input-group">
                    <input type="text" name="options[]" class="form-control" placeholder="Option value">
                    <button type="button" class="btn btn-danger remove-option">-</button>
                </div>
            `;
            $('.options-list').append(newOption);
        });

        // Remove option button
        $(document).on('click', '.remove-option', function() {
            $(this).closest('.input-group').remove();
        });

        // Check initial type value
        var initialType = $('#type').val();
        if (initialType === 'array' || initialType === 'json') {
            $('#options_container').show();
        }
    });
</script>
@endsection