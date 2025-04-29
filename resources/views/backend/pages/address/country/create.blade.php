@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                Add Country
                                <a href="{{route('countries.index')}}" class="btn btn-primary btn-sm float-end">Show
                                    Country</a>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group mb-2">
                                                    <label for="continent_id">Select Continent:
                                                        <a style="color: red;text-decoration: none">
                                                            {{$errors->first('continent_id')}}
                                                        </a>

                                                    </label>
                                                    <select class="form-control" id="continent_id" name="continent_id">
                                                        <option value="" selected disabled>Select Continent</option>
                                                        @foreach($continentsData as $continent)
                                                            <option value="{{$continent->id}}"
                                                                {{old('continent_id')==$continent->id?'selected':''}}

                                                            >{{$continent->continent_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-2">
                                                    <label for="code">Country Code
                                                        <a style="color: red;text-decoration: none">
                                                            {{$errors->first('code')}}
                                                        </a>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                           value="{{old('code')}}"
                                                           id="code" name="code">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="title">Country Name
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('country_name')}}
                                                </a>
                                            </label>
                                            <input type="text" class="form-control"
                                                   value="{{old('country_name')}}"
                                                   id="title" name="country_name">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="slug">Slug
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('slug')}}
                                                </a>
                                            </label>
                                            <input type="text" class="form-control"
                                                   value="{{old('slug')}}"
                                                   id="slug" name="slug">
                                        </div>
                                    </div>
                                    <div class="col-md-8">

                                        <div class="form-group mb-1">
                                            <label for="summary">summary:
                                                <a style="color: red;">{{$errors->first('summary')}}</a>
                                            </label>
                                            <textarea name="summary"
                                                      id="summary"
                                                      class="form-control">{{old('summary')}}</textarea>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="description">Description:
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('description')}}
                                                </a>
                                            </label>
                                            <textarea class="form-control" id="description"
                                                      name="description">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="form-group mb-2">
                                            <label for="sub_title">Sub Title
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('sub_title')}}
                                                </a>
                                            </label>
                                            <input type="text" class="form-control"
                                                   value="{{old('sub_title')}}"
                                                   id="sub_title" name="sub_title">

                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="status">Status</label>
                                            <select name="is_published" id="status" class="form-control">
                                                <option value="0"
                                                    {{old('is_published') == 0 ? 'selected' : ''}}>Draft
                                                </option>
                                                <option value="1"
                                                    {{old('is_published') == 1 ? 'selected' : ''}}
                                                >published
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="website">Website:
                                                <a style="color: red;">{{$errors->first('website')}}</a>
                                            </label>
                                            <input type="text" id="website" name="website"
                                                   class="form-control"
                                                   value="{{old('website')}}">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="meta_title">Meta Title:</label>
                                            <input type="text" id="meta_title" name="meta_title"
                                                   class="form-control"
                                                   value="{{old('meta_title')}}">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="meta_description">Meta Description:</label>
                                            <textarea name="meta_description" id="meta_description" rows="12"
                                                      class="form-control">{{old('meta_description')}}</textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="meta_keywords"> Meta Keywords</label>
                                            <div class="tag-input-container">
                                                <input type="text" class="form-control"
                                                       name="meta_keywords"
                                                       value="{{old('meta_keywords')}}"
                                                       id="meta_keywords">
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="icons">Icons:
                                                <a style="color: red;">{{$errors->first('icons')}}</a>
                                            </label>
                                            <input type="text" id="icons" name="icons"
                                                   class="form-control"
                                                   value="{{old('icons')}}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="image">Image
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('image')}}
                                                </a>
                                            </label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 mt-2">
                                    <div class="form-group">
                                        <label for="key_features">Child Page Title</label>
                                        <input type="text" class="form-control" id="tag-input"
                                               placeholder="Enter page title">
                                        <input type="hidden" name="tags" id="tags-hidden">
                                        <div class="mt-2" id="tags-container"></div>
                                        <span class="text-muted">Press Enter to add a new tag</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary w-100">Add Country</button>
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
    @parent
    <script>
        $(document).ready(function () {
            const tagInput = document.getElementById("tag-input");
            const tagsContainer = document.getElementById("tags-container");
            const tagsHidden = document.getElementById("tags-hidden");
            let tags = [];

            tagInput.addEventListener("keypress", function (e) {
                if (e.key === "Enter" && tagInput.value.trim() !== "") {
                    e.preventDefault();
                    const tagText = tagInput.value.trim();

                    // Add tag to tags array
                    tags.push(tagText);
                    updateHiddenField();

                    const tag = document.createElement("span");
                    tag.className = "badge bg-primary me-1";
                    tag.textContent = tagText;

                    const closeButton = document.createElement("button");
                    closeButton.className = "btn-close btn-close-white ms-1";
                    closeButton.style.fontSize = "0.8em";
                    closeButton.style.verticalAlign = "middle";
                    closeButton.onclick = () => {
                        tag.remove();
                        tags = tags.filter(t => t !== tagText);
                        updateHiddenField();
                    };

                    tag.appendChild(closeButton);
                    tagsContainer.appendChild(tag);

                    tagInput.value = "";
                }
            });

            function updateHiddenField() {
                tagsHidden.value = JSON.stringify(tags);
            }


            CKEDITOR.replace('summary', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

        });
    </script>
@endsection




