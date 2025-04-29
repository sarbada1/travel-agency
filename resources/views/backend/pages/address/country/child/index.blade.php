@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-3 mb-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>
                                        <i class="bi bi-eye-fill"></i> Country Child Page
                                        <a href="{{route('country-page-create',$pageId)}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-plus-circle"></i> Add Country Page </a>
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
                                    <td>Sn</td>
                                    <th>Name</th>
                                    <th>Posted By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($pageChildData->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            We could not find any data
                                            <br>
                                            <a href="">Refresh
                                                page</a>

                                        </td>
                                    </tr>
                                @endif
                                @foreach($pageChildData as $key=>$childPage)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$childPage->title}}</td>
                                        <td>{{$childPage->postedBy->name}}</td>
                                        <td>{{$childPage->created_at->diffForHumans()}}</td>
                                        <td style="width: 12%;">
                                            <form action="{{route('delete-country-page',$childPage->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')


                                                <a href="{{route('edit-country-page',$childPage->id)}}"
                                                   class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
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

