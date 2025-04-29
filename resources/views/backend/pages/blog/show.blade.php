@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-10">
                            <h3><i class="bi bi-newspaper"></i> {{$postsData->title}}
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h3>
                            <p class="font-weight-bold">
                                <i class="bi bi-calendar"></i> {{$postsData->created_at->format('d M Y')}}
                                <i class="bi bi-person"></i> {{$postsData->user->name}}
                            </p>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('manage-blog.index')}}"
                               class="btn btn-primary pull-right">
                                <i class="bi bi-arrow-right-circle-fill"></i> Back </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            @if($postsData->image)
                                <img src="{{url($postsData->image)}}" alt="" width="100%">
                            @endif
                            <p>
                                {!! $postsData->excerpt !!}
                            </p>
                            <p>
                                {!! $postsData->description !!}
                            </p>
                        </div>

                        <div class="col-md-12 mt-5 mb-5">
                            <hr>
                            <form action="{{route('manage-blog.destroy',$postsData->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
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






