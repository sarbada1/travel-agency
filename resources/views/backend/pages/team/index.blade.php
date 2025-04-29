@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-eye-fill"></i> Team Members
                                <a href="{{route('manage-team.create')}}" class="btn btn-success btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add</a>
                            </h2>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>S.n</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Designation</th>
                                    <th>Image</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teamData as $key => $team)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$team->name}}</td>
                                        <td>{{$team->email}}</td>
                                        <td>
                                            {{$team->memberType->type}}
                                        </td>
                                        <td>
                                            @if($team->image)
                                                <img src="{{url($team->image)}}" alt="{{$team->name}}"
                                                     style="width: 50px; height: 50px;">
                                            @endif
                                        </td>
                                        <td>{{$team->phone}}</td>
                                        <td style="width: 10%;">

                                            <form action="{{route('manage-team.destroy', $team->id)}}" method="post">
                                                @csrf
                                                <a href="{{route('manage-team.edit', $team->id)}}" title="Edit Teams"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
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
