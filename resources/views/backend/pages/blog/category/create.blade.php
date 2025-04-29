@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-plus-circle"></i> Add Category
                                <a href="{{route('manage-blog-category.index')}}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-eye-fill"></i> Show Category</a>
                            </h2>

                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('backend.layouts.message')
                        <hr>
                    </div>
                    <div class="col-md-12">
                        @can('blog_categories_create')
                            <form action="{{route('manage-blog-category.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">



                                    

                                    <div class="form-group mb-3">
                                                <label for="parent_id">parent:
                                                    <a style="color: red;">{{$errors->first('parent')}}</a>
                                                </label>

                                                <select name="parent_id" class="form-control" id="parent_id">
                                                    <option value="">Select a parent category</option>
                                                    @foreach($courseData as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @if($category->child)
                                                            @include('backend.pages.blog.category.create-nested-child',['childrenData' => $category->child])
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>


                                        <div class="form-group mb-2">
                                            <label for="title">Name:
                                                <a style="color: red;">{{$errors->first('name')}}</a>
                                            </label>
                                            <input type="text" id="title" name="name" class="form-control"
                                                   value="{{old('name')}}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="slug">Slug:
                                                <a style="color: red;">{{$errors->first('slug')}}</a>
                                            </label>
                                            <input type="text" id="slug" name="slug" class="form-control"
                                                   value="{{old('slug')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">

                                        <div class="form-group mb-2">
                                            <label for="description">Description:
                                                <a style="color: red;">{{$errors->first('description')}}</a>
                                            </label>
                                            <textarea id="description" name="description"
                                                      class="form-control">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="sub_title">Sub Title:
                                                <a style="color: red;">{{$errors->first('sub_title')}}</a>
                                            </label>
                                            <input type="text" id="sub_title" name="sub_title" class="form-control"
                                                   value="{{old('sub_title')}}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="0"
                                                    {{old('status') == 0 ? 'selected' : ''}}>Draft
                                                </option>
                                                <option value="1"
                                                    {{old('status') == 1 ? 'selected' : ''}}
                                                >published
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="meta_title">Meta Title:</label>
                                            <input type="text" id="meta_title" name="meta_title"
                                                   class="form-control"
                                                   value="{{old('meta_title')}}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="meta_description">Meta Description:</label>
                                            <textarea name="meta_description" id="meta_description"
                                                      class="form-control">{{old('meta_description')}}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="meta_keywords"> Meta Keywords</label>
                                            <div class="tag-input-container">
                                                <input type="text" class="form-control"
                                                       name="meta_keywords"
                                                       value="{{old('meta_keywords')}}"
                                                       id="meta_keywords">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mb-3">
                                    <button class="btn btn-success w-100">
                                        <i class="bi bi-plus-circle"></i> Add Category
                                    </button>
                                </div>

                            </form>
                        @endcan

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

        });
    </script>
@endsection

