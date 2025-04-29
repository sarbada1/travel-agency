@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-pencil-square"></i> Edit Ad Placement
                                <a href="{{ route('manage-ad-placement.index') }}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-eye-fill"></i> Show Placements</a>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('backend.layouts.message')
                        <hr>
                    </div>

                    <form action="{{ route('manage-ad-placement.update', $placement->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ad_id" class="form-label">Select Advertisement <span class="text-danger">*</span></label>
                                <select class="form-select" id="ad_id" name="ad_id" required>
                                    <option value="">Select an Advertisement</option>
                                    @foreach($ads as $ad)
                                        <option value="{{ $ad->id }}" {{ old('ad_id', $placement->ad_id) == $ad->id ? 'selected' : '' }}>
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
                                    <option value="">Select a Position</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id', $placement->position_id) == $position->id ? 'selected' : '' }}>
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
                                <input type="number" class="form-control" id="priority" name="priority" 
                                       value="{{ old('priority', $placement->priority) }}" min="1" required>
                                <small class="text-muted">Lower numbers have higher priority (1 is highest)</small>
                                @error('priority')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update Placement</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection