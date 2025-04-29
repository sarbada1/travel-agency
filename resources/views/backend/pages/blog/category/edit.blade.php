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
                                <i class="bi bi-pencil-square"></i> Update Blog Category
                                <a href="{{route('manage-blog-category.index')}}" class="btn btn-success btn-sm pull-right">
                                   Show Blog Category List</a>
                            </h2>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                        <div class="col-md-12">
                            <form action="{{route('manage-blog-category.update',$category->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-12">



                                    <div class="form-group mb-3">
                                                <label for="parent_id">parent:
                                                    <a style="color: red;">{{$errors->first('parent')}}</a>
                                                </label>

                                                <select name="parent_id" class="form-control" id="parent_id">
                                                    <option value="">Select a parent category</option>
                                                    @foreach($courseData as $cat)
                                                        <option value="{{$cat->id}}"    @if($cat->id == $parentId) selected @endif  >{{$cat->name}}</option>
                                                        @if($cat->child)
                                                            @include('backend.pages.blog.category.create-nested-child',['childrenData' => $cat->child, 'parentId' => $parentId])
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>

                                           

                                        <div class="form-group mb-1">
                                            <label for="name">Name:
                                                <a style="color: red;">{{$errors->first('name')}}</a>
                                            </label>
                                            <input type="text" id="name" name="name"
                                                   required class="form-control"
                                                   value="{{$category->name}}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="slug">Slug:
                                                <a style="color: red;">{{$errors->first('slug')}}</a>
                                            </label>
                                            <input type="text" id="slug" name="slug" class="form-control"
                                                   value="{{$category->slug}}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">

                                        <div class="form-group">
                                            <label for="description">Description:
                                                <a style="color: red;">{{$errors->first('description')}}</a>
                                            </label>
                                            <textarea id="description" name="description"
                                                      class="form-control">{{$category->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="sub_title">Sub Title:
                                                <a style="color: red;">{{$errors->first('sub_title')}}</a>
                                            </label>
                                            <input type="text" id="sub_title" name="sub_title" class="form-control"
                                                   value="{{$category->sub_title}}">
                                        </div>
                                        <div class="form-group mb-4">
                                            @include('backend.layouts.update-image',['tableName'=>$category->getTable(),'id'=>$category->id])
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="0"
                                                    {{$category->status == 0 ? 'selected' : ''}}>Draft
                                                </option>
                                                <option value="1"
                                                    {{$category->status == 1 ? 'selected' : ''}}>
                                                    published
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="meta_title">Meta Title:</label>
                                        <input type="text" id="meta_title" name="meta_title"
                                               class="form-control"
                                               value="{{$category->meta_title}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_description">Meta Description:</label>
                                        <textarea name="meta_description" id="meta_description"
                                                  class="form-control">{{$category->meta_description}}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_keywords"> Meta Keywords</label>
                                        <div class="tag-input-container">
                                            <input type="text" class="form-control"
                                                   name="meta_keywords"
                                                   value="{{$category->meta_keywords}}"
                                                   id="meta_keywords">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mb-3">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-pencil-square"></i> Update record
                                    </button>
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




