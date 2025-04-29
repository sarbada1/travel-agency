@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-plus-circle"></i> Add Ad Placement
                                <a href="{{ route('manage-ad-placement.index') }}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-eye-fill"></i> Show Placements</a>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('backend.layouts.message')
                        <hr>
                    </div>

                    <form action="{{ route('manage-ad-placement.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ad_id" class="form-label">Select Advertisement <span class="text-danger">*</span></label>
                                <select class="form-select" id="ad_id" name="ad_id" required>
                                    <option value="">Select Advertisement</option>
                                    @foreach($ads as $ad)
                                        <option value="{{ $ad->id }}" {{ old('ad_id') == $ad->id ? 'selected' : '' }}>
                                            {{ $ad->name }} ({{ ucfirst($ad->type) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('ad_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="position_id" class="form-label">Select Position <span class="text-danger">*</span></label>
                                <select class="form-select" id="position_id" name="position_id" required>
                                    <option value="">Select Position</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                            {{ $position->name }} ({{ $position->identifier }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="priority" name="priority" value="{{ old('priority', 10) }}" min="1" required>
                                <small class="text-muted">Lower numbers have higher priority (1 is highest)</small>
                                @error('priority')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Save Placement</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection