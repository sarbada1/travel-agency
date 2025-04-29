@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <h2>
                                <i class="bi bi-people-fill"></i> Admin List
                                <a href="{{route('admin.create')}}" class="btn btn-success btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add New Member
                                </a>
                            </h2>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-hover datatable">
                                <thead>
                                <tr>
                                    <th>S.n</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Account Types</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($adminData as $key=>$admin)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>

                                            {{$admin->account_type->name ?? ""}}
                                        </td>

                                        <td>
                                            @foreach($admin->role as $role)
                                                <span class="btn-sm btn-info">
                                                    {{$role->name}}
                                                    </span>
                                            @endforeach

                                        </td>
                                        <th>
                                            @if($admin->image)
                                                <img src="{{url($admin->image)}}" alt="Image"
                                                     style="width: 50px; height: 50px;">

                                            @endif
                                        </th>
                                        <td style="width: 15%;">
                                            <a href="{{route('admin.show',$admin->id)}}" title="View Record"
                                               class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{route('admin.edit',$admin->id)}}" title="Edit Record"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{route('admin.destroy',$admin->id)}}" method="post"
                                                  style="display: inline-block">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete?')">
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
