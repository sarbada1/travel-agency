<?php
$columnName = "image";
?>
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
                                Update Location
                                <a href="{{route('manage-location',$locationData->id)}}"
                                   class="btn btn-primary btn-sm float-end">Show
                                    Locations</a>
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
                            <form action="{{route('manage-location-update',$locationData->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group mb-2">
                                            <label for="title"> Name
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('name')}}
                                                </a>
                                            </label>
                                            <input type="text" class="form-control"
                                                   value="{{$locationData->name}}"
                                                   id="title" name="name">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="slug">Slug
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('slug')}}
                                                </a>
                                            </label>
                                            <input type="text" class="form-control"
                                                   value="{{$locationData->slug}}"
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
                                                      class="form-control">{{$locationData->summary}}</textarea>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="description">Description:
                                                <a style="color: red;text-decoration: none">
                                                    {{$errors->first('description')}}
                                                </a>
                                            </label>
                                            <textarea class="form-control" id="description"
                                                      name="description">{{$locationData->description}}</textarea>
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
                                                   value="{{$locationData->sub_title}}"
                                                   id="sub_title" name="sub_title">

                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="status">Status</label>
                                            <select name="is_published" id="status" class="form-control">
                                                <option value="0"
                                                    {{$locationData->is_published == 0 ? 'selected' : ''}}>Draft
                                                </option>
                                                <option value="1"
                                                    {{$locationData->is_published == 1 ? 'selected' : ''}}
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
                                                   value="{{$locationData->website}}">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="meta_title">Meta Title:</label>
                                            <input type="text" id="meta_title" name="meta_title"
                                                   class="form-control"
                                                   value="{{$locationData->meta_title}}">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="meta_description">Meta Description:</label>
                                            <textarea name="meta_description" id="meta_description"
                                                      class="form-control">{{$locationData->meta_description}}</textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="meta_keywords"> Meta Keywords</label>
                                            <div class="tag-input-container">
                                                <input type="text" class="form-control"
                                                       name="meta_keywords"
                                                       value="{{$locationData->meta_keywords}}"
                                                       id="meta_keywords">
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="icons">Icons:
                                                <a style="color: red;">{{$errors->first('icons')}}</a>
                                            </label>
                                            <input type="text" id="icons" name="icons"
                                                   class="form-control"
                                                   value="{{$locationData->icons}}">
                                        </div>
                                        <div class="form-group mb-2">
                                                <label for="image">Image
                                                    <a style="color: red;text-decoration: none">
                                                        {{$errors->first('image')}}
                                                    </a>
                                                </label>
                                                @include('backend.layouts.update-image',['tableName'=>$locationData->getTable(),'id'=>$locationData->id])
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary w-100">Update Location</button>
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




