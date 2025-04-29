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
                                    <h2><i class="bi bi-pencil-square"></i> Update Social Media </h2>
                                    <hr>
                                    @include('backend.layouts.message')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post"
                                          action="{{route('manage-social-media.update',$socialMedia->id)}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="name">Name:
                                                        <span class="text-danger">
                                                            {{$errors->has('name') ? $errors->first('name') : ''}}
                                                        </span>
                                                    </label>
                                                    <input type="text" id="name" value="{{$socialMedia->name}}"
                                                           name="name"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="icon">icon:
                                                        <span class="text-danger">
                                                            {{$errors->has('icon') ? $errors->first('icon') : ''}}
                                                        </span>
                                                    </label>
                                                    <input type="text" id="icon" value="{{$socialMedia->icon}}"
                                                           name="icon"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="url">Link:
                                                        <span class="text-danger">
                                                            {{$errors->has('url') ? $errors->first('url') : ''}}
                                                        </span>
                                                    </label>
                                                    <input type="text" id="url" value="{{$socialMedia->url}}" name="url"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group mb-3">
                                                    <label for="status">Status:
                                                        <span class="text-danger">
                                                                    {{$errors->has('status') ? $errors->first('status') : ''}}
                                                                </span>
                                                    </label>
                                                    <select id="status" name="status" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="1"
                                                            {{$socialMedia->status == '1' ? 'selected' : ''}}
                                                        >Active
                                                        </option>
                                                        <option value="0"
                                                            {{$socialMedia->status== '0' ? 'selected' : ''}}
                                                        >Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group mb-3">
                                            <button class="btn btn-success w-100">Update</button>
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

