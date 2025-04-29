@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-list-ul"></i> Categories
                                <a href="{{route('manage-category.create')}}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add Category
                                </a>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Page Type</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <i class="{{$category->icon}}"></i> {{$category->name}}
                                            @if($category->is_main)
                                                <span class="badge bg-primary">Main</span>
                                            @endif
                                        </td>
                                        <td>{{$category->page_type}}</td>
                                        <td>
                                            @if($category->parent)
                                                {{$category->parent->name}}
                                            @else
                                                <span class="badge bg-secondary">None</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($category->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('manage-category.show', $category->id)}}"
                                               class="btn btn-info btn-sm">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{route('manage-category.edit', $category->id)}}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{route('manage-category.destroy', $category->id)}}"
                                                  method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @if(count($category->children) > 0)
                                        @include('backend.pages.category.manageChild', ['children' => $category->children, 'level' => 1])
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection