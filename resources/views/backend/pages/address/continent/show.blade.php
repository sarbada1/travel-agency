@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-4 mb-2">
                            <h3>
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                Continent Details
                                <a href="{{route('continents.index')}}" class="btn btn-primary btn-sm float-end">Show
                                    Continent</a>
                            </h3>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                @if($continentData->image)
                                    <img src="{{url($continentData->image)}}"
                                         class="card-img-top img-fluid" alt="{{$continentData->continent_name}}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$continentData->continent_name}}
                                    </h5>
                                    <p class="card-text">
                                        {!! $continentData->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection


