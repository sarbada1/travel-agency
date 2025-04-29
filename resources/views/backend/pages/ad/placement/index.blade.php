@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>
                                        <i class="bi bi-eye-fill"></i> Ad Placements List
                                        @can('ad_placements_create')
                                            <a href="{{ route('manage-ad-placement.create') }}" class="btn btn-primary btn-sm float-end">
                                                <i class="bi bi-plus-circle"></i> Add Placement</a>
                                        @endcan
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
                                        <th>Ad</th>
                                        <th>Position</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($placements) || $placements->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">No ad placements found</td>
                                        </tr>
                                    @else
                                        @foreach ($placements as $placement)
                                            <tr>
                                                <td>{{ $placement->ad->name }}</td>
                                                <td>{{ $placement->position->name }} <small class="text-muted">({{ $placement->position->identifier }})</small></td>
                                                <td>{{ $placement->priority }}</td>
                                                <td>
                                                    @if($placement->ad->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $placement->created_at->diffForHumans() }}</td>
                                                <td style="width: 15%;">
                                                    @can('ad_placements_edit')
                                                        <a href="{{ route('manage-ad-placement.edit', $placement->id) }}" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                    @endcan
                                                    @can('ad_placements_delete')
                                                        <form action="{{ route('manage-ad-placement.destroy', $placement->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this placement?')">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection