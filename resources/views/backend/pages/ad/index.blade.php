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
                                        <i class="bi bi-eye-fill"></i> Advertisement List
                                        @can('ads_create')
                                            <a href="{{ route('manage-ad.create') }}" class="btn btn-primary btn-sm float-end">
                                                <i class="bi bi-plus-circle"></i> Add Advertisement</a>
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
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Impressions</th>
                                        <th>Clicks</th>
                                        <th>Preview</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($ads) || $ads->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">No advertisements found</td>
                                        </tr>
                                    @else
                                        @foreach ($ads as $ad)
                                            <tr>
                                                <td>{{ $ad->name }}</td>
                                                <td>{{ ucfirst($ad->type) }}</td>
                                                <td>
                                                    @if($ad->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $ad->impressions }}</td>
                                                <td>{{ $ad->clicks }}</td>
                                                <td>
                                                    @if($ad->type == 'image' && $ad->image_path)
                                                        <img src="{{ url($ad->image_path) }}" alt="{{ $ad->name }}" style="max-width: 100px; max-height: 50px;">
                                                    @elseif($ad->type == 'html' || $ad->type == 'script')
                                                        <span class="badge bg-info">HTML/Script</span>
                                                    @endif
                                                </td>
                                                <td style="width: 15%;">
                                                 
                                                    @can('ads_edit')
                                                        <a href="{{ route('manage-ad.edit', $ad->id) }}" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                    @endcan
                                                    @can('ads_delete')
                                                        <form action="{{ route('manage-ad.destroy', $ad->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this ad?')">
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