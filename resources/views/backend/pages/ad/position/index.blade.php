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
                                        <i class="bi bi-eye-fill"></i> Ad Positions List
                                        @can('ad_positions_create')
                                            <a href="{{ route('manage-ad-position.create') }}" class="btn btn-primary btn-sm float-end">
                                                <i class="bi bi-plus-circle"></i> Add Position</a>
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
                                        <th>Name</th>
                                        <th>Identifier</th>
                                        <th>Description</th>
                                        <th>Ads Count</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($positions) || $positions->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">No ad positions found</td>
                                        </tr>
                                    @else
                                        @foreach ($positions as $position)
                                            <tr>
                                                <td>{{ $position->name }}</td>
                                                <td><code>{{ $position->identifier }}</code></td>
                                                <td>{{ Str::limit($position->description, 50) }}</td>
                                                <td>{{ $position->ads->count() }}</td>
                                                <td>{{ $position->created_at->diffForHumans() }}</td>
                                                <td style="width: 15%;">
                                                    @can('ad_positions_edit')
                                                        <a href="{{ route('manage-ad-position.edit', $position->id) }}" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                    @endcan
                                                    @can('ad_positions_delete')
                                                        <form action="{{ route('manage-ad-position.destroy', $position->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this position?')">
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