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
                                        <i class="bi bi-megaphone"></i> Campaigns
                                        @can('campaigns_create')
                                            <a href="{{ route('manage-campaign.create') }}" class="btn btn-primary btn-sm float-end">
                                                <i class="bi bi-plus-circle"></i> Create Campaign</a>
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
                                        <th>Objective</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($campaigns) || $campaigns->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">No campaigns found</td>
                                        </tr>
                                    @else
                                        @foreach ($campaigns as $campaign)
                                            <tr>
                                                <td>{{ $campaign->name }}</td>
                                                <td>{{ $campaign->objective ?? 'N/A' }}</td>
                                                <td>
                                                    @if($campaign->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($campaign->status == 'paused')
                                                        <span class="badge bg-warning text-dark">Paused</span>
                                                    @elseif($campaign->status == 'ended')
                                                        <span class="badge bg-secondary">Ended</span>
                                                    @elseif($campaign->status == 'rejected')
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @elseif($campaign->status == 'review')
                                                        <span class="badge bg-info text-dark">Under Review</span>
                                                    @endif
                                                </td>
                                                <td>{{ $campaign->start_date ? $campaign->start_date->format('M d, Y') : 'N/A' }}</td>
                                                <td>{{ $campaign->end_date ? $campaign->end_date->format('M d, Y') : 'Ongoing' }}</td>
                                                <td style="width: 15%;">
                                                    @can('campaigns_show')
                                                        <a href="{{ route('manage-campaign.show', $campaign->id) }}" class="btn btn-info btn-sm">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can('campaigns_edit')
                                                        <a href="{{ route('manage-campaign.edit', $campaign->id) }}" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                    @endcan
                                                    @can('campaigns_delete')
                                                        <form action="{{ route('manage-campaign.destroy', $campaign->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this campaign?')">
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