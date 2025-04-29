@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-pencil-square"></i> Edit Campaign
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

                    <ul class="nav nav-tabs" id="campaignTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                                type="button" role="tab" aria-controls="basic" aria-selected="true">
                                Campaign Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule"
                                type="button" role="tab" aria-controls="schedule" aria-selected="false">
                                Schedule
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="metrics-tab" data-bs-toggle="tab" data-bs-target="#metrics"
                                type="button" role="tab" aria-controls="metrics" aria-selected="false">
                                Performance
                            </button>
                        </li>
                    </ul>

                    <form action="{{ route('manage-campaign.update', $campaign->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="tab-content" id="campaignTabsContent">
                            <!-- Basic Information Tab -->
                            <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                                <div class="pt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Campaign Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                id="name" name="name" value="{{ old('name', $campaign->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="objective" class="form-label">Campaign Objective</label>
                                            <input type="text" class="form-control @error('objective') is-invalid @enderror" 
                                                id="objective" name="objective" value="{{ old('objective', $campaign->objective) }}" 
                                                placeholder="e.g., Brand Awareness, Conversions, Traffic">
                                            @error('objective')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" name="status">
                                                <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="paused" {{ old('status', $campaign->status) == 'paused' ? 'selected' : '' }}>Paused</option>
                                                <option value="ended" {{ old('status', $campaign->status) == 'ended' ? 'selected' : '' }}>Ended</option>
                                                <option value="rejected" {{ old('status', $campaign->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                <option value="review" {{ old('status', $campaign->status) == 'review' ? 'selected' : '' }}>Under Review</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                id="description" name="description" rows="4">{{ old('description', $campaign->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Tab -->
                            <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                                <div class="pt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                                id="start_date" name="start_date" 
                                                value="{{ old('start_date', $campaign->start_date ? $campaign->start_date->format('Y-m-d') : '') }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Leave blank to start immediately</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                                id="end_date" name="end_date" 
                                                value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '') }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Leave blank for no end date</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Metrics Tab -->
                            <div class="tab-pane fade" id="metrics" role="tabpanel" aria-labelledby="metrics-tab">
                                <div class="pt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="alert alert-info">
                                                <i class="bi bi-info-circle me-2"></i>
                                                Performance metrics are displayed here. This data is read-only.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if(isset($campaign->metrics) && $campaign->metrics->count() > 0)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Impressions</h5>
                                                        <h2 class="card-text text-primary">{{ $campaign->metrics->sum('impressions') }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Clicks</h5>
                                                        <h2 class="card-text text-success">{{ $campaign->metrics->sum('clicks') }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <p class="mb-0">No performance data available for this campaign yet.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Update Campaign
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection