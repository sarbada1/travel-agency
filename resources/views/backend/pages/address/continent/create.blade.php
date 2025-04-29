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
                                Add Continent
                                <a href="{{route('continents.index')}}" class="btn btn-primary btn-sm float-end">Show
                                    Continent</a>
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
                            <form action="{{ route('continents.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <label for="continent_name">Continent Name
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('continent_name')}}
                                                </a>
                                            </label>
                                            <input type="text" class="form-control"
                                                   value="{{old('continent_name')}}"
                                                   id="continent_name" name="continent_name">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="continent_code">Continent Code
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('continent_code')}}
                                                </a>
                                            </label>
                                            <input type="text" class="form-control"
                                                   value="{{old('continent_code')}}"
                                                   id="continent_code" name="continent_code">

                                        </div>
                                    </div>
                                    <div class="col-md-8">


                                        <div class="col-md-12 mb-2">
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
                                        <div class="form-group mb-5">
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
                                        <div class="form-group mb-4">
                                            <label for="meta_title">Meta Title:</label>
                                            <input type="text" id="meta_title" name="meta_title"
                                                   class="form-control"
                                                   value="{{old('meta_title')}}">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="meta_description">Meta Description:</label>
                                            <textarea name="meta_description" id="meta_description"
                                                      class="form-control">{{old('meta_description')}}</textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="meta_keywords"> Meta Keywords</label>
                                            <input type="text" class="form-control"
                                                   name="meta_keywords"
                                                   value="{{old('meta_keywords')}}"
                                                   id="meta_keywords">
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


                                <div class="mt-3">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-plus-circle"></i> Add Continent</button>
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


            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

        });
    </script>
@endsection




