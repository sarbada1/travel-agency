<?php
$columnName = "image";
?>
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
                                    <h2><i class="bi bi-plus-circle"></i> Update Testimonial
                                        <a href="{{route('manage-testimonial.index')}}"
                                           class="btn btn-primary pull-right">
                                            <i class="bi bi-arrow-right-circle-fill"></i> Back </a>
                                    </h2>
                                    <hr>
                                    @include('backend.layouts.message')
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('manage-testimonial.update',$testimonial->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="form-group mb-3">
                                                <label for="name">Name:
                                                    <a style="color: red;">{{$errors->first('name')}}</a>
                                                </label>
                                                <input type="text" id="name" name="name"
                                                       class="form-control"
                                                       value="{{$testimonial->name}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="designation">Designation :
                                                    <a style="color: red;">{{$errors->first('designation')}}</a>
                                                </label>
                                                <input type="text" id="designation" name="designation"
                                                       class="form-control"
                                                       value="{{$testimonial->designation}}">
                                            </div>


                                            <div class="form-group mb-2">
                                                <label for="description">Description:
                                                    <a style="color: red;">{{$errors->first('description')}}</a>
                                                </label>
                                                <textarea name="description" placeholder="Description"
                                                          id="description"
                                                          class="form-control">{{$testimonial->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1" {{$testimonial->status==1?'selected':''}}>
                                                            Active
                                                        </option>
                                                        <option value="0" {{$testimonial->status==0?'selected':''}}>
                                                            Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top: 18px;">
                                                @include('backend.layouts.update-image',['tableName'=>$testimonial->getTable(),'id'=>$testimonial->id])

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-2">
                                                <button class="btn btn-success w-100">
                                                    <i class="bi bi-plus-circle"></i>
                                                    Update Testimonial
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

