@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-collection"></i> Attribute Groups
                                <a href="{{route('manage-attribute-group.create')}}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add Attribute Group
                                </a>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attributes</th>
                                    <th>Display Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attributeGroups as $key => $group)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$group->name}}</td>
                                        <td>{{$group->slug}}</td>
                                        <td>
                                            <span class="badge bg-info">{{$group->attributes->count()}}</span>
                                        </td>
                                        <td>{{$group->display_order}}</td>
                                        <td>
                                            @if($group->active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('manage-attribute-group.show', $group->id)}}"
                                               class="btn btn-info btn-sm">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{route('manage-attribute-group.edit', $group->id)}}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{route('manage-attribute-group.destroy', $group->id)}}"
                                                  method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this?')">
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