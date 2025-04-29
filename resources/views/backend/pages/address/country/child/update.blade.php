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
                                    <h2><i class="bi bi-pencil-square"></i> Update Country Page
                                        <a href=""
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Country Pages</a>
                                    </h2>
                                    <hr>
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-danger">
                                            {{$error}}
                                        </div>
                                    @endforeach
                                    @include('backend.layouts.message')
                                </div>
                            </div>
                            <div class="row">
                                <form action="" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="page_id">parent:
                                                    <a style="color: red;">{{$errors->first('parent')}}</a>
                                                </label>
                                                <select name="page_id" class="form-control" id="page_id">
                                                    <option value="{{$pcData->page_id}}">
                                                        {{$pcData->country->country_name}}
                                                    </option>

                                                    @foreach($allPage as $page)
                                                        @if($pcData->country_id != $page->id)
                                                            <option value="{{$page->id}}">
                                                                {{$page->country_name}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group mb-1">
                                                <label for="title">Title:
                                                    <a style="color: red;">{{$errors->first('title')}}</a>
                                                </label>
                                                <input type="text" id="title" name="title"
                                                       class="form-control"
                                                       value="{{$pcData->title}}">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label for="slug">Slug:
                                                    <a style="color: red;">{{$errors->first('slug')}}</a>
                                                </label>
                                                <input type="text" id="slug" name="slug"
                                                       class="form-control"
                                                       value="{{$pcData->slug}}">
                                            </div>
                                        </div>
                                        <div class="col-md-8">

                                            <div class="form-group mb-1">
                                                <label for="summary">summary:
                                                    <a style="color: red;">{{$errors->first('summary')}}</a>
                                                </label>
                                                <textarea name="summary"
                                                          id="summary"
                                                          class="form-control">{{$pcData->summary}}</textarea>
                                            </div>

                                            <div class="form-group mb-1">
                                                <label for="description">Description:
                                                    <a style="color: red;">{{$errors->first('description')}}</a>
                                                </label>
                                                <textarea name="description"
                                                          id="description"
                                                          class="form-control">{{$pcData->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label for="sub_title">Sub Title:
                                                    <a style="color: red;">{{$errors->first('sub_title')}}</a>
                                                </label>
                                                <input type="text" id="sub_title" name="sub_title"
                                                       class="form-control"
                                                       value="{{$pcData->sub_title}}">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label for="status">Status</label>
                                                <select name="is_published" id="status" class="form-control">
                                                    <option value="0"
                                                        {{$pcData->is_published == 0 ? 'selected' : ''}}>Draft
                                                    </option>
                                                    <option value="1"
                                                        {{$pcData->is_published == 1 ? 'selected' : ''}}
                                                    >published
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <label for="icons">Icons:
                                                    <a style="color: red;">{{$errors->first('icons')}}</a>
                                                </label>
                                                <input type="text" id="icons" name="icons"
                                                       class="form-control"
                                                       value="{{$pcData->icons}}">
                                            </div>

                                            <div class="form-group mb-1">
                                                    @include('backend.layouts.update-image',['tableName'=>$pcData->getTable(),'id'=>$pcData->id])

                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="website">Website:
                                                    <a style="color: red;">{{$errors->first('website')}}</a>
                                                </label>
                                                <input type="text" id="website" name="website"
                                                       class="form-control"
                                                       value="{{$pcData->website}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-2">
                                                <label for="meta_title">Meta Title:</label>
                                                <input type="text" id="meta_title" name="meta_title"
                                                       class="form-control"
                                                       value="{{$pcData->meta_title}}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="meta_description">Meta Description:</label>
                                                <textarea name="meta_description" id="meta_description"
                                                          class="form-control">{{$pcData->meta_description}}</textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="meta_keywords"> Meta Keywords</label>
                                                <div class="tag-input-container">
                                                    <input type="text" class="form-control"
                                                           name="meta_keywords"
                                                           value="{{$pcData->meta_keywords}}"
                                                           id="meta_keywords">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button class="btn btn-success w-100">
                                                <i class="bi bi-pencil-square"></i> Update Country Page
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

