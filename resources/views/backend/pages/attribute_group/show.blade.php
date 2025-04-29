@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-10">
                            <h2><i class="bi bi-eye-fill"></i> View Attribute Group - {{$attributeGroup->name}}</h2>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('manage-attribute-group.index')}}" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-list"></i> All Groups
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 150px;">Name</th>
                                        <td>{{$attributeGroup->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug</th>
                                        <td>{{$attributeGroup->slug}}</td>
                                    </tr>
                                    <tr>
                                        <th>Display Order</th>
                                        <td>{{$attributeGroup->display_order}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($attributeGroup->active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{$attributeGroup->description ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="d-flex mt-3">
                                <a href="{{route('manage-attribute-group.edit', $attributeGroup->id)}}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{route('manage-attribute-group.destroy', $attributeGroup->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this? This will also delete all associated attributes!')">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>Attributes in this Group</h5>
                                    <a href="{{route('manage-package-attribute.create')}}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-plus-circle"></i> Add Attribute
                                    </a>
                                </div>
                                <div class="card-body">
                                    @if($attributeGroup->attributes->count() > 0)
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Required</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($attributeGroup->attributes as $attribute)
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('manage-package-attribute.show', $attribute->id)}}">
                                                                {{$attribute->name}}
                                                            </a>
                                                        </td>
                                                        <td>{{ucfirst($attribute->type)}}</td>
                                                        <td>
                                                            @if($attribute->is_required)
                                                                <span class="badge bg-info">Yes</span>
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
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-info">
                                            No attributes found in this group. 
                                            <a href="{{route('manage-package-attribute.create')}}" class="alert-link">
                                                Add attributes
                                            </a> to this group.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection