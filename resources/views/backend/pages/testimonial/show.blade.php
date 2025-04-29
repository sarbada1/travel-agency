@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h1><i class="bi bi-eye-fill"></i> Testimonial Details
                                <a href="{{route('manage-testimonial.index')}}"
                                   class="btn btn-primary pull-right">
                                    <i class="bi bi-arrow-right-circle-fill"></i> Back </a>
                            </h1>
                            <hr>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Name: {{$testimonial->name}}</h3>

                            @if($testimonial->image)
                                <img src="{{url($testimonial->image)}}" alt="" width="100%">
                            @endif

                            <p>
                                {!! $testimonial->description !!}
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->

@endsection






