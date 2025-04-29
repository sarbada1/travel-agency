@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card py-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="bi bi-plus-circle"></i> Add Testimonial
                                        <a href="{{route('manage-testimonial.index')}}"
                                           class="btn btn-primary btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Testimonial</a>
                                    </h2>
                                    <hr>
                                    @include('backend.layouts.message')
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('manage-testimonial.store')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="name">Name:
                                                            <a style="color: red;">{{$errors->first('name')}}</a>
                                                        </label>
                                                        <input type="text" id="name" name="name"
                                                               class="form-control"
                                                               value="{{old('name')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="designation">designation:
                                                            <a style="color: red;">{{$errors->first('designation')}}</a>
                                                        </label>
                                                        <input type="text" id="designation" name="designation"
                                                               class="form-control"
                                                               value="{{old('designation')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-2">
                                                        <div class="form-group">
                                                            <label for="image">Image</label>
                                                            <input type="file" name="image" id="image"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-2">
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group mb-2">
                                                <label for="description">Description:
                                                    <a style="color: red;">{{$errors->first('description')}}</a>
                                                </label>
                                                <textarea name="description" placeholder="Description"
                                                          id="description"
                                                          class="form-control">{{old('description')}}</textarea>
                                            </div>

                                            <div class="form-group mb-2">
                                                <button class="btn btn-success w-100">
                                                    <i class="bi bi-plus-circle"></i>
                                                    Add Testimonial
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
        $(document).ready(function () {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });
        });

    </script>
@endsection

