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
                                        <i class="bi bi-layers"></i> Ad Sets
                                        @can('ad_sets_create')
                                            <a href="{{ route('manage-adset.create') }}" class="btn btn-primary btn-sm float-end">
                                                <i class="bi bi-plus-circle"></i> Create Ad Set</a>
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
                                        <th>Campaign</th>
                                        <th>Status</th>
                                        <th>Budget</th>
                                        <th>Schedule</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($adSets) || $adSets->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">No ad sets found</td>
                                        </tr>
                                    @else
                                        @foreach ($adSets as $adSet)
                                            <tr>
                                                <td>{{ $adSet->name }}</td>
                                                <td>
                                                    @if ($adSet->campaign)
                                                        <a href="{{ route('manage-campaign.show', $adSet->campaign->id) }}">
                                                            {{ $adSet->campaign->name }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">None</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($adSet->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($adSet->status == 'paused')
                                                        <span class="badge bg-warning text-dark">Paused</span>
                                                    @elseif($adSet->status == 'ended')
                                                        <span class="badge bg-secondary">Ended</span>
                                                    @elseif($adSet->status == 'rejected')
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @elseif($adSet->status == 'review')
                                                        <span class="badge bg-info text-dark">Under Review</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    ${{ number_format($adSet->budget_amount, 2) }} / {{ ucfirst($adSet->budget_type) }}
                                                </td>
                                                <td>
                                                    {{ $adSet->start_date ? $adSet->start_date->format('M d, Y') : 'N/A' }}
                                                    -
                                                    {{ $adSet->end_date ? $adSet->end_date->format('M d, Y') : 'Ongoing' }}
                                                </td>
                                                <td style="width: 15%;">
                                                    @can('ad_sets_show')
                                                        <a href="{{ route('manage-adset.show', $adSet->id) }}" class="btn btn-info btn-sm">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can('ad_sets_edit')
                                                        <a href="{{ route('manage-adset.edit', $adSet->id) }}" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                    @endcan
                                                    @can('ad_sets_delete')
                                                        <form action="{{ route('manage-adset.destroy', $adSet->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this ad set?')">
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