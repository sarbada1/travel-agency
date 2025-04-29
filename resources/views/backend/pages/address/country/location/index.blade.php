@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="fa fa-globe"></i> {{$countryData->country_name}}
                                <a href="{{route('manage-location-add',$countryData->id)}}"
                                   class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add</a>
                            </h2>
                        </div>


                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <table class="table datatable">
                                    <thead>
                                    <tr>
                                        <th>S.n</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($countryData->locations->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                We could not find any data
                                                <br>
                                                <a href="{{route('manage-blog.index')}}">Refresh
                                                    page</a>

                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($countryData->locations as $location)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$location->name}}

                                            </td>

                                            <td>
                                                @if($location->image)
                                                    <img src="{{url($location->image)}}" alt=""
                                                         style="width: 100px;">
                                                @else
                                                    <span class="badge bg-danger"> No Image</span>
                                                @endif
                                            </td>

                                            <td style="width: 10%;">

                                                    <a href="{{route('manage-location-edit',$location->id)}}"
                                                       title="Update Country"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <a href="{{route('manage-location-delete',$location->id)}}"
                                                       title="Delete Country"
                                                       class="btn btn-danger btn-sm"
                                                       onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="bi bi-trash"></i>
                                                    </a>


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





