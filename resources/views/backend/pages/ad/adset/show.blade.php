@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-collection"></i> Ad Set Details
                                <a href="{{ route('manage-adset.index') }}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-arrow-left"></i> Back to Ad Sets
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
                                            <h3 class="mb-0">{{ $adSet->name }}</h3>
                                            <p class="text-muted">
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
                                                
                                                <small class="ms-2">Created on {{ $adSet->created_at->format('M d, Y') }}</small>
                                            </p>
                                            
                                            @if($adSet->description)
                                                <p>{{ $adSet->description }}</p>
                                            @endif
                                            
                                            <div class="mt-3">
                                                <h5>Campaign</h5>
                                                <p>
                                                    <a href="{{ route('manage-campaign.show', $adSet->campaign_id) }}">
                                                        {{ $adSet->campaign->name ?? 'N/A' }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card h-100">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0">Budget Information</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p><strong>Budget Type:</strong> {{ ucfirst($adSet->budget_type) }}</p>
                                                    <p><strong>Budget Amount:</strong> ${{ number_format($adSet->budget_amount, 2) }}</p>
                                                    <p><strong>Bid Strategy:</strong> {{ ucfirst(str_replace('_', ' ', $adSet->bid_strategy ?? 'lowest_cost')) }}</p>
                                                    @if($adSet->bid_amount)
                                                        <p><strong>Bid Amount:</strong> ${{ number_format($adSet->bid_amount, 2) }}</p>
                                                    @endif
                                                    <p><strong>Start Date:</strong> {{ $adSet->start_date ? $adSet->start_date->format('M d, Y') : 'Immediate' }}</p>
                                                    <p><strong>End Date:</strong> {{ $adSet->end_date ? $adSet->end_date->format('M d, Y') : 'Ongoing' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Targeting Information -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4 class="mb-3">Audience Targeting</h4>
                            <div class="card">
                                <div class="card-body">
                                    @php
                                        $targetingSpecs = json_decode($adSet->targeting_specs, true) ?? [];
                                    @endphp
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Location</h5>
                                            @if(!empty($targetingSpecs['location']))
                                                <ul>
                                                    @foreach($targetingSpecs['location'] as $location)
                                                        <li>{{ ucfirst($location) }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="text-muted">No location targeting specified</p>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <h5>Demographics</h5>
                                            <p>
                                                <strong>Age:</strong> 
                                                @if(!empty($targetingSpecs['age_min']) || !empty($targetingSpecs['age_max']))
                                                    {{ $targetingSpecs['age_min'] ?? '18' }} - {{ $targetingSpecs['age_max'] ?? '65+' }}
                                                @else
                                                    All ages
                                                @endif
                                            </p>
                                            <p>
                                                <strong>Gender:</strong> 
                                                @if(!empty($targetingSpecs['gender']))
                                                    {{ ucfirst(implode(', ', $targetingSpecs['gender'])) }}
                                                @else
                                                    All genders
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <h5>Interests</h5>
                                            @if(!empty($targetingSpecs['interests']))
                                                <div>
                                                    @foreach($targetingSpecs['interests'] as $interest)
                                                        <span class="badge bg-light text-dark me-2 mb-2 p-2">
                                                            {{ ucfirst(str_replace('_', ' ', $interest)) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-muted">No specific interests targeted</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ads in this Ad Set -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">Ads</h4>
                                <a href="{{ route('manage-ad.create', ['ad_set_id' => $adSet->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus"></i> Create New Ad
                                </a>
                            </div>
                            
                            @if($adSet->ads && $adSet->ads->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Preview</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Performance</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($adSet->ads as $ad)
                                                <tr>
                                                    <td style="width: 100px">
                                                        @if($ad->type == 'image' && $ad->image_path)
                                                            <img src="{{ asset($ad->image_path) }}" alt="{{ $ad->name }}" class="img-fluid" style="max-height: 60px">
                                                        @else
                                                            <div class="bg-light text-center p-2">
                                                                <i class="bi bi-file-earmark-text"></i> {{ ucfirst($ad->type) }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong>{{ $ad->name }}</strong><br>
                                                        <small class="text-muted">{{ Str::limit($ad->headline, 30) }}</small>
                                                    </td>
                                                    <td>{{ ucfirst($ad->type) }}</td>
                                                    <td>
                                                        @if($ad->status == 'active')
                                                            <span class="badge bg-success">Active</span>
                                                        @elseif($ad->status == 'paused')
                                                            <span class="badge bg-warning text-dark">Paused</span>
                                                        @elseif($ad->status == 'ended')
                                                            <span class="badge bg-secondary">Ended</span>
                                                        @elseif($ad->status == 'rejected')
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @elseif($ad->status == 'review')
                                                            <span class="badge bg-info text-dark">Under Review</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div><strong>Impressions:</strong> {{ number_format($ad->impressions) }}</div>
                                                        <div><strong>Clicks:</strong> {{ number_format($ad->clicks) }}</div>
                                                        <div><strong>CTR:</strong> 
                                                            @if($ad->impressions > 0)
                                                                {{ number_format(($ad->clicks / $ad->impressions) * 100, 2) }}%
                                                            @else
                                                                0.00%
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('manage-ad.edit', $ad->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                  
                                                        <form action="{{ route('manage-ad.destroy', $ad->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ad?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No ads have been created for this ad set yet. 
                                    <a href="{{ route('manage-ad.create', ['ad_set_id' => $adSet->id]) }}" class="alert-link">
                                        Create your first ad
                                    </a> to start promoting your content.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex gap-2">
                                <a href="{{ route('manage-adset.edit', $adSet->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil"></i> Edit Ad Set
                                </a>
                                
                                @if($adSet->status == 'active')
                                    <form action="{{ route('manage-adset.update', $adSet->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="paused">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-pause"></i> Pause Ad Set
                                        </button>
                                    </form>
                                @elseif($adSet->status == 'paused')
                                    <form action="{{ route('manage-adset.update', $adSet->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-play"></i> Resume Ad Set
                                        </button>
                                    </form>
                                @endif
                                
                                <form action="{{ route('manage-adset.destroy', $adSet->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ad set? This will also delete all ads within this ad set.')">
                                        <i class="bi bi-trash"></i> Delete Ad Set
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection