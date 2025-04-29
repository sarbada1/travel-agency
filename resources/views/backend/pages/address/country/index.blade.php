@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-eye-fill"></i> Country List
                                <a href="{{route('countries.create')}}"
                                   class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add Country</a>
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
                                    @if($countriesData->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                We could not find any data
                                                <br>
                                                <a href="{{route('manage-blog.index')}}">Refresh
                                                    page</a>

                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($countriesData as $country)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$country->country_name}}  </td>
                                            <td>
                                                @if($country->image)
                                                    <img src="{{url($country->image)}}" alt=""
                                                         style="width: 100px;">
                                                @else
                                                    <span class="badge bg-danger"> No Image</span>
                                                @endif
                                            </td>

                                            <td style="width: 10%;">
                                                <form action="{{route('countries.destroy',$country->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a href="{{route('countries.edit',$country->id)}}"
                                                       title="Update Country"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <button class="btn btn-danger btn-sm"
                                                            title="Delete Country"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="5">
                                                <a href="{{route('country-faq',$country->id)}}" class="p-3">Add Faq</a>

                                                <a href="{{route('manage-location',$country->id)}}" class="p-3">Location
                                                    @if($country->locations->count() > 0)
                                                        -  ({{$country->locations->count()}})

                                                    @endif
                                                </a>
                                                <a href="{{route('country-page',$country->id)}}" class="p-3">Page
                                                    @if($country->pages->count() > 0)
                                                        -  ({{$country->pages->count()}})
                                                    @endif
                                                </a>
                                                <a href="{{route('country-content',$country->id)}}" class="p-3">Content
                                                    Section

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





