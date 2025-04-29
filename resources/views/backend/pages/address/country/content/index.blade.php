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
                                        <i class="bi bi-eye-fill"></i> Country Content
                                        <a href="{{route('country-content-create',$pageId)}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-plus-circle"></i> Add Country Content </a>
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
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($countryData->getContent as $key=>$content)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$content->title}}</td>
                                        <td>{{$content->created_at->diffForHumans()}}</td>
                                        <td style="width: 12%;">
                                            <form action="{{route('country-content-delete',$content->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')


                                                <a href="{{route('country-content-edit',$content->id)}}"
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

