@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>
                                        <i class="bi bi-eye-fill"></i> Category List
                                        @can('blog_categories_create')
                                            <a href="{{route('manage-blog-category.create')}}"
                                               class="btn btn-success btn-sm float-end">
                                                <i class="bi bi-plus-circle"></i> Add
                                                Category</a>
                                        @endcan
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Posted By</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($categoryData->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            We could not find any data
                                            <br>
                                            <a href="{{route('manage-blog-category.index')}}">Refresh
                                                page</a>

                                        </td>
                                    </tr>
                                @endif
                                @foreach($categoryData as $key=>$category)
                                    <tr>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->postedBy->name}}</td>
                                        <td>
                                            @if($category->image)
                                                <img src="{{url($category->image)}}" alt="{{$category->name}}" width="50">
                                            @else
                                                <img src="{{url('icons/notfound.png')}}" width="50">
                                            @endif


                                        </td>
                                        <td>{{$category->created_at->diffForHumans()}}</td>
                                        <td style="width: 12%;">
                                            <form action="{{route('manage-blog-category.destroy',$category->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')

                                                @can('blog_categories_show')
                                                    <a href="{{route('manage-blog-category.show',$category->id)}}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                @endcan
                                                @can('blog_categories_edit')
                                                    <a href="{{route('manage-blog-category.edit',$category->id)}}"
                                                       class="btn btn-success btn-sm">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                @endcan

                                                @can('blog_categories_delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                @endcan
                                            </form>

                                        </td>
                                    </tr>


                            @if($category->child)
                                @include('backend.pages.blog.category.manageChild',['childDataTable' => $category->child])
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

