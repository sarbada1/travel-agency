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
                                    <h2><i class="bi bi-pencil-square"></i> Update Blog
                                        <a href="{{route('manage-blog.index')}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Blog</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('manage-blog.update',$blogData->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                                <label for="category_id">category:
                                                    <a style="color: red;">{{$errors->first('category_id')}}</a>
                                                    <a style="color: red;">{{$errors->first('error')}}</a>

                                                </label>

                                                <select name="category_id" class="form-control" id="category_id">
                                                    <option value="">Select a category of blog</option>
                                                    @foreach($categoryData as $category)
                                                        <option value="{{$category->id}}"  @if( isSet($selectedCategoryId) &&  $selectedCategoryId !== "" && $category->id === $selectedCategoryId) selected @endif   >{{$category->name}}</option>
                                                        @if($category->child)
                                                            @include('backend.pages.blog.create-nested-child-category',['childrenData' => $category->child])
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div> 


                                            <div class="form-group mb-3">
                                                <label for="parent_id">parent blog:
                                                    <a style="color: red;">{{$errors->first('parent_id')}}</a>
                                                </label>

                                                <select name="parent_id" class="form-control" id="parent_id">
                                                    <option value="">Select a parent of blog</option>
                                                    @foreach($blogParent as $parent)
                                                        <option value="{{$parent->id}}"   @if( isSet($parentId) &&  $parentId !== "" && $parent->id === $parentId) selected @endif   >{{$parent->title}}</option>
                                                    

                                                        @if($parent->child)
                                                            @include('backend.pages.blog.create-nested-child-blog',['childrenData' => $parent->child])
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div> 
                                


                                            <div class="form-group mb-3">
                                                <label for="title">Title:
                                                    <a style="color: red;">{{$errors->first('title')}}</a>
                                                </label>
                                                <input type="text" id="title" name="title"
                                                       class="form-control"
                                                       value="{{$blogData->title}}">
                                            </div>
                                        </div>
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-8">
                                            <div class="form-group mb-2">
                                                <label for="slug">Slug:
                                                    <a style="color: red;">{{$errors->first('slug')}}</a>
                                                </label>
                                                <input type="text" id="slug" name="slug"
                                                       class="form-control"
                                                       value="{{$blogData->slug}}">
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="summary">Summary:
                                                    <a style="color: red;">{{$errors->first('summary')}}</a>
                                                </label>
                                                <textarea name="summary" id="summary"
                                                          class="form-control">{{$blogData->summary}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="sub_title">Sub Title:
                                                    <a style="color: red;">{{$errors->first('sub_title')}}</a>
                                                </label>
                                                <input type="text" id="sub_title" name="sub_title"
                                                       class="form-control"
                                                       value="{{$blogData->sub_title}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="status">Status</label>
                                                <select name="is_published" id="status" class="form-control">
                                                    <option value="0"
                                                        {{$blogData->is_published == 0 ? 'selected' : ''}}>Draft
                                                    </option>
                                                    <option value="1"
                                                        {{$blogData->is_published == 1 ? 'selected' : ''}}
                                                    >published
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="form-group mt-1 mb-1">
                                                <label for="is_commentable">is commentable</label>
                                                <select name="is_commentable" id="is_commentable"
                                                        class="form-control">
                                                    <option value="0"
                                                        {{$blogData->is_commentable == 0 ? 'selected' : ''}}>No
                                                    </option>
                                                    <option value="1"
                                                        {{$blogData->is_commentable == 1 ? 'selected' : ''}}>Yes
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-1">
                                                <div class="form-group mb-2 mt-4">
                                                    @include('backend.layouts.update-image',['tableName'=>$blogData->getTable(),'id'=>$blogData->id])

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Description:
                                            <a style="color: red;">{{$errors->first('description')}}</a>
                                        </label>
                                        <textarea name="description"
                                                  id="description"
                                                  class="form-control">{{$blogData->description}}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="meta_title">Meta Title:</label>
                                        <input type="text" id="meta_title" name="meta_title"
                                               class="form-control"
                                               value="{{$blogData->meta_title}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_description">Meta Description:</label>
                                        <textarea name="meta_description" id="meta_description"
                                                  class="form-control">{{$blogData->meta_description}}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_keywords"> Meta Keywords</label>
                                        <div class="tag-input-container">
                                            <input type="text" class="form-control"
                                                   name="meta_keywords"
                                                   value="{{$blogData->meta_keywords}}"
                                                   id="meta_keywords">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-success w-100">
                                            <i class="bi bi-plus-circle"></i> Update Blog
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

