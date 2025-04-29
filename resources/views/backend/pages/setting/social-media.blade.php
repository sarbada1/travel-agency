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
                                    <h2><i class="bi bi-plus-circle"></i> Manage Social Media </h2>
                                    <hr>
                                    @include('backend.layouts.message')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" action="{{route('manage-social-media.store')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="name">Name:
                                                        <span class="text-danger">
                                                            {{$errors->has('name') ? $errors->first('name') : ''}}
                                                        </span>
                                                    </label>
                                                    <input type="text" id="name" value="{{old('name')}}" name="name"
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
                                                    <input type="text" id="icon" value="{{old('icon')}}" name="icon"
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
                                                    <input type="text" id="url" value="{{old('url')}}" name="url"
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
                                                            {{old('status') == '1' ? 'selected' : ''}}
                                                        >Active
                                                        </option>
                                                        <option value="0"
                                                            {{old('status') == '0' ? 'selected' : ''}}
                                                        >Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group mb-3">
                                            <button class="btn btn-success w-100">Save</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="bi bi-list-ul"></i> Social Media List</h2>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Icon</th>
                                            <th>Link</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($socialMedia as $key => $data)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->icon}}</td>
                                                <td>{{$data->url}}</td>
                                                <td>
                                                    <form action="{{route('manage-social-media-update-status')}}"
                                                          method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                        @if($data->status == 1)
                                                            <button class="btn btn-success btn-sm" name="active"
                                                                    value="0">
                                                                <i class="bi bi-check-lg"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-danger btn-sm" name="inactive"
                                                                    value="1">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        @endif

                                                    </form>
                                                </td>
                                                <td width="12%;">
                                                    <form action="{{route('manage-social-media.destroy', $data->id)}}"
                                                          method="post">
                                                        @csrf
                                                        <a class="btn btn-success btn-sm"
                                                           href="{{route('manage-social-media.edit',$data->id)}}"
                                                        >
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
@endsection

