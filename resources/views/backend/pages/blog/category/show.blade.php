@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-eye-fill"></i>Blog Category Details
                                <a href="{{route('manage-blog-category.index')}}" class="btn btn-primary pull-right">Back</a>
                            </h2>
                            <hr>
                        </div>

                    </div>
                    <div class="col-row">
                        <div class="col-md-8">
                            <h1>{{$category->name}}</h1>
                            <h3>{{$category->slug}}</h3>
                            <p class="paragraph-image">
                                {!! $category->description !!}
                            </p>
                        </div>
                        <div class="col-md-4">
                            @if($category->image)
                                <img src="{{url($category->image)}}" alt="image not found" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-md-12 mt-5 mb-5">
                            <hr>
                            <form action="{{route('manage-blog-category.destroy',$category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"
                                        onclick="return confirm('Are you sure ?')">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

@endsection






