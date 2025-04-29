<?php

function getLimitDescription($description, $limit = 100)
{
    return strlen($description) > $limit ? substr($description, 0, $limit) . '...' : $description;
}

?>

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
                                Manage Continent
                                <a href="{{route('continents.create')}}" class="btn btn-primary btn-sm float-end">Add Continent</a>
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
                        @foreach($continentsData as $continent)
                            <div class="col-md-4">
                                <div class="card">
                                    @if($continent->image)
                                        <img src="{{url($continent->image)}}" style="height: 150px;"
                                             class="card-img-top" alt="{{$continent->continent_name}}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{route('continents.edit',$continent->id)}}">{{$continent->continent_name}}</a>
                                        </h5>
                                        <p class="card-text">
                                           {!! getLimitDescription($continent->description) !!}
                                        </p>
                                        <form action="{{route('continents.destroy',$continent->id)}}" method="post">
                                            @csrf
                                            @method('delete')

                                            <a href="{{route('continents.show',$continent->id)}}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <a href="{{route('continents.edit',$continent->id)}}"
                                                    class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection


