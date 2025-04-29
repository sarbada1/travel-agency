@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-10">
                            <h2>
                                <i class="bi bi-info-circle"></i> Package Attribute Details
                            </h2>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('manage-package-attribute.index')}}" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-arrow-left-circle"></i> Back
                            </a>
                            <a href="{{route('manage-package-attribute.edit', $packageAttribute->id)}}" class="btn btn-warning btn-sm float-end me-2">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <h4 class="mb-4">Basic Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Name</th>
                                    <td>{{$packageAttribute->name}}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{$packageAttribute->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Group</th>
                                    <td>
                                        <a href="{{route('manage-attribute-group.show', $packageAttribute->attributeGroup->id)}}">
                                            {{$packageAttribute->attributeGroup->name}}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td><span class="badge bg-primary">{{ucfirst($packageAttribute->type)}}</span></td>
                                </tr>
                                <tr>
                                    <th>Required</th>
                                    <td>
                                        @if($packageAttribute->is_required)
                                            <span class="badge bg-info">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Filterable</th>
                                    <td>
                                        @if($packageAttribute->is_filterable)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($packageAttribute->active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Display Order</th>
                                    <td>{{$packageAttribute->display_order}}</td>
                                </tr>
                                <tr>
                                    <th>Default Value</th>
                                    <td>{{$packageAttribute->default_value ?? 'None'}}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{$packageAttribute->created_at->format('M d, Y H:i:s')}}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{$packageAttribute->updated_at->format('M d, Y H:i:s')}}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-4">
                            <h4 class="mb-4">Additional Information</h4>
                            
                            @if($packageAttribute->description)
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Description</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{$packageAttribute->description}}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if(isset($packageAttribute->options) && is_array($packageAttribute->options) && count($packageAttribute->options) > 0)
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Options</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($packageAttribute->options as $option)
                                                <li class="list-group-item">{{$option}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection