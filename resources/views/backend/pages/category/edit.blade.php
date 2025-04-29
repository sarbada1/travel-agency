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
                                    <h2><i class="bi bi-pencil-square"></i> Edit Category
                                        <a href="{{route('manage-category.index')}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Categories</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('manage-category.update', $category->id)}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="name">Name:
                                                    <a style="color: red;">{{$errors->first('name')}}</a>
                                                </label>
                                                <input type="text" id="name" name="name"
                                                       class="form-control"
                                                       value="{{old('name', $category->name)}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="slug">Slug:
                                                    <a style="color: red;">{{$errors->first('slug')}}</a>
                                                </label>
                                                <input type="text" id="slug" name="slug"
                                                       class="form-control"
                                                       value="{{old('slug', $category->slug)}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="parent_id">Parent Category:
                                                    <a style="color: red;">{{$errors->first('parent_id')}}</a>
                                                </label>
                                                <select name="parent_id" class="form-control" id="parent_id">
                                                    <option value="">Select Parent Category (optional)</option>
                                                    @foreach($parents as $parent)
                                                        <option value="{{$parent->id}}"
                                                            {{old('parent_id', $category->parent_id) == $parent->id ? 'selected' : ''}}>
                                                            {{$parent->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="page_type">Page Type:
                                                    <a style="color: red;">{{$errors->first('page_type')}}</a>
                                                </label>
                                                <select name="page_type" class="form-control" id="page_type">
                                                    <option value="">Select Page Type</option>
                                                    <option value="tour_package" {{old('page_type', $category->page_type) == 'tour_package' ? 'selected' : ''}}>
                                                        Tour Package
                                                    </option>
                                                    <option value="destination" {{old('page_type', $category->page_type) == 'destination' ? 'selected' : ''}}>
                                                        Destination
                                                    </option>
                                                    <option value="activity" {{old('page_type', $category->page_type) == 'activity' ? 'selected' : ''}}>
                                                        Activity
                                                    </option>
                                                    <option value="travel-guide" {{old('page_type', $category->page_type) == 'travel-guide' ? 'selected' : ''}}>
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
                                                    <a style="color: red;">{{$errors->first('icon')}}</a>
                                                </label>
                                                <input type="text" id="icon" name="icon"
                                                       class="form-control"
                                                       value="{{old('icon', $category->icon)}}" placeholder="fa-map-marker">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="image">Image:
                                                    <a style="color: red;">{{$errors->first('image')}}</a>
                                                </label>
                                                <input type="file" id="image" name="image" class="form-control">
                                                @if($category->image)
                                                    <div class="mt-2">
                                                        <img src="{{asset($category->image)}}" alt="{{$category->name}}"
                                                             class="img-thumbnail" style="max-height: 100px">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="is_main" name="is_main" value="1" 
                                                        {{old('is_main', $category->is_main) ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="is_main">
                                                        Is Main Category
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                                        {{old('status', $category->status) ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="status">
                                                        Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label for="description">Description:
                                            <a style="color: red;">{{$errors->first('description')}}</a>
                                        </label>
                                        <textarea name="description" id="description"
                                                  class="form-control">{{old('description', $category->description)}}</textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-success w-100">
                                            <i class="bi bi-pencil-square"></i> Update Category
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
        $(document).ready(function () {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

            // Auto-generate slug from name when empty
            $('#name').on('keyup', function () {
                if ($('#slug').val() === '') {
                    var name = $(this).val();
                    var slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                    $('#slug').val(slug);
                }
            });
        });
    </script>
@endsection