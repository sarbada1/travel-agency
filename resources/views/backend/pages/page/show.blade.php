@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-10">
                            <h3><i class="bi bi-newspaper"></i> {{$pageData->title}}
                           </h3>
                            <p class="font-weight-bold">
                                <i class="bi bi-calendar"></i> {{$pageData->created_at->format('d M Y')}}
                                <i class="bi bi-person"></i> {{$pageData->user->name}}
                            </p>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('manage-page.index')}}"
                               class="btn btn-primary pull-right">
                                <i class="bi bi-arrow-right-circle-fill"></i> Back </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            @if($pageData->image)
                                <img src="{{url($pageData->image)}}" alt="" width="100%">
                            @endif
                            <p>
                                {!! $pageData->excerpt !!}
                            </p>
                            <p>
                                {!! $pageData->description !!}
                            </p>
                        </div>

                        <div class="col-md-12 mt-5 mb-5">
                            <hr>
                            <form action="{{route('manage-news.destroy',$pageData->id)}}" method="post">
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






