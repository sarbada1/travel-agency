@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="py-3 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-briefcase"></i> Tour Packages
                                <a href="{{route('manage-tour-package.create')}}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add Tour Package
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Categories</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tourPackages as $key => $package)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            @if($package->featured_image)
                                                <img src="{{url($package->featured_image)}}" alt="{{$package->name}}" width="60">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{$package->name}}</td>
                                        <td>{{$package->duration_days}} days</td>
                                        <td>
                                            <strong>{{$package->currency}} {{number_format($package->regular_price, 2)}}</strong>
                                            @if($package->sale_price)
                                                <br>
                                                <span class="text-danger">Sale: {{$package->currency}} {{number_format($package->sale_price, 2)}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($package->categories as $category)
                                                <span class="badge bg-info">{{$category->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($package->is_featured)
                                                <span class="badge bg-success">Featured</span>
                                            @endif
                                            @if($package->is_popular)
                                                <span class="badge bg-warning">Popular</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($package->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($package->status == 'inactive')
                                                <span class="badge bg-danger">Inactive</span>
                                            @else
                                                <span class="badge bg-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('manage-tour-package.show', $package->id)}}"
                                               class="btn btn-info btn-sm">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{route('manage-tour-package.edit', $package->id)}}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{route('manage-tour-package.destroy', $package->id)}}"
                                                  method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this package?')">
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