@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-megaphone"></i> Campaign Details
                                <a href="{{ route('manage-campaign.index') }}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-arrow-left"></i> Back to Campaigns
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('backend.layouts.message')
                        <hr>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3 class="mb-0">{{ $campaign->name }}</h3>
                                            <p class="text-muted">
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
                                                
                                                <small class="ms-2">Created on {{ $campaign->created_at->format('M d, Y') }}</small>
                                            </p>
                                            
                                            @if($campaign->objective)
                                                <p><strong>Objective:</strong> {{ $campaign->objective }}</p>
                                            @endif
                                            
                                            @if($campaign->description)
                                                <div class="mt-3">
                                                    <h5>Description</h5>
                                                    <p>{{ $campaign->description }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card h-100">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Campaign Schedule</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p><strong>Start Date:</strong> {{ $campaign->start_date ? $campaign->start_date->format('M d, Y') : 'Immediate' }}</p>
                                                    <p><strong>End Date:</strong> {{ $campaign->end_date ? $campaign->end_date->format('M d, Y') : 'Ongoing' }}</p>
                                                    
                                                    @if($campaign->start_date && $campaign->end_date)
                                                        <p><strong>Duration:</strong> 
                                                            {{ $campaign->start_date->diffInDays($campaign->end_date) + 1 }} days
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Metrics -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4 class="mb-3">Performance Metrics</h4>
                            
                            @if(isset($campaign->metrics) && $campaign->metrics->count() > 0)
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Impressions</h5>
                                                <h2 class="card-text text-primary">{{ $campaign->metrics->sum('impressions') }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Clicks</h5>
                                                <h2 class="card-text text-success">{{ $campaign->metrics->sum('clicks') }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">CTR</h5>
                                                @php
                                                    $impressions = $campaign->metrics->sum('impressions');
                                                    $clicks = $campaign->metrics->sum('clicks');
                                                    $ctr = $impressions > 0 ? ($clicks / $impressions) * 100 : 0;
                                                @endphp
                                                <h2 class="card-text text-info">{{ number_format($ctr, 2) }}%</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Total Spend</h5>
                                                <h2 class="card-text text-danger">${{ number_format($campaign->metrics->sum('spend'), 2) }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No performance data available for this campaign yet.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Ad Sets -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">Ad Sets</h4>
                                <a href="{{ route('manage-adset.create') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-plus"></i> Add Ad Set
                                </a>
                            </div>
                            
                            @if(isset($campaign->adSets) && $campaign->adSets->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Budget</th>
                                                <th>Start/End Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($campaign->adSets as $adSet)
                                                <tr>
                                                    <td>{{ $adSet->name }}</td>
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
                                                    <td>${{ number_format($adSet->budget_amount, 2) }} ({{ ucfirst($adSet->budget_type) }})</td>
                                                    <td>
                                                        {{ $adSet->start_date ? $adSet->start_date->format('M d, Y') : 'Immediate' }} - 
                                                        {{ $adSet->end_date ? $adSet->end_date->format('M d, Y') : 'Ongoing' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('manage-adset.edit', $adSet->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('manage-adset.destroy', $adSet->id) }}" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No ad sets created for this campaign yet.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex gap-2">
                                @can('campaigns_edit')
                                    <a href="{{ route('manage-campaign.edit', $campaign->id) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil"></i> Edit Campaign
                                    </a>
                                @endcan
                                
                                @if($campaign->status == 'active')
                                    <form action="{{ route('manage-campaign.update', $campaign->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="paused">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-pause"></i> Pause Campaign
                                        </button>
                                    </form>
                                @elseif($campaign->status == 'paused')
                                    <form action="{{ route('manage-campaign.update', $campaign->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-play"></i> Resume Campaign
                                        </button>
                                    </form>
                                @endif
                                
                                @can('campaigns_delete')
                                    <form action="{{ route('manage-campaign.destroy', $campaign->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this campaign?')">
                                            <i class="bi bi-trash"></i> Delete Campaign
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection