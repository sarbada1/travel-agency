@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-10">
                            <h2><i class="bi bi-eye-fill"></i> View Category - {{$category->name}}</h2>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('manage-category.index')}}" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-list"></i> All Categories
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 200px;">Name</th>
                                        <td>{{$category->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug</th>
                                        <td>{{$category->slug}}</td>
                                    </tr>
                                    <tr>
                                        <th>Page Type</th>
                                        <td>{{$category->page_type}}</td>
                                    </tr>
                                    <tr>
                                        <th>Parent Category</th>
                                        <td>
                                            @if($category->parent)
                                                {{$category->parent->name}}
                                            @else
                                                <span class="badge bg-secondary">None</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Icon</th>
                                        <td>
                                            @if($category->icon)
                                                <i class="{{$category->icon}}"></i> {{$category->icon}}
                                            @else
                                                <span class="badge bg-secondary">No Icon</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Is Main Category</th>
                                        <td>
                                            @if($category->is_main)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-danger">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($category->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if($category->image)
                                                <img src="{{asset($category->image)}}" alt="{{$category->name}}"
                                                     class="img-thumbnail" style="max-height: 200px">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12 mt-5 mb-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Description</h5>
                                </div>
                                <div class="card-body">
                                    @if($category->description)
                                        {!! $category->description !!}
                                    @else
                                        <p class="text-muted">No description provided.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="d-flex">
                                <a href="{{route('manage-category.edit', $category->id)}}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{route('manage-category.destroy', $category->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this?')">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection