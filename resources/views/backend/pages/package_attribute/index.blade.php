@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-tags"></i> Package Attributes
                                <a href="{{route('manage-package-attribute.create')}}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add Package Attribute
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
                                    <th>Group</th>
                                    <th>Type</th>
                                    <th>Required</th>
                                    <th>Filterable</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($packageAttributes as $key => $attribute)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$attribute->name}}</td>
                                        <td>
                                            <a href="{{route('manage-attribute-group.show', $attribute->attributeGroup->id)}}">
                                                {{$attribute->attributeGroup->name}}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ucfirst($attribute->type)}}</span>
                                        </td>
                                        <td>
                                            @if($attribute->is_required)
                                                <span class="badge bg-info">Yes</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($attribute->is_filterable)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($attribute->active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('manage-package-attribute.show', $attribute->id)}}"
                                               class="btn btn-info btn-sm">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{route('manage-package-attribute.edit', $attribute->id)}}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{route('manage-package-attribute.destroy', $attribute->id)}}"
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